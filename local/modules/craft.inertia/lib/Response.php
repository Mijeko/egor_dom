<?php

namespace Craft\Inertia;

use Bitrix\Main\HttpRequest;
use Bitrix\Main\HttpResponse;
use Closure;
use Craft\Inertia\Support\Arr;
use Craft\Inertia\Support\Header;
use GuzzleHttp\Promise\PromiseInterface;

class Response
{
    protected string $component;
    protected array $props;
    protected string $version;

    public function __construct(
        string $component,
        iterable $props = [],
        string $version = '',
    ) {
        $this->component = $component;
        $this->props = collection_all($props);
        $this->version = $version;
    }

    public function with(string|array $key, mixed $value = null): self
    {
        if (is_array($key)) {
            $this->props = array_merge($this->props, $key);
        } else {
            $this->props[$key] = $value;
        }

        return $this;
    }

    public function toPage(HttpRequest $request): array
    {
        return array_merge(
            [
                'component' => $this->component,
                'props' => $this->resolveProperties($request, $this->props),
                'url' => $this->getUrl($request),
                'version' => $this->version,
            ],
            $this->resolveMergeProps($request),
            $this->resolveDeferredProps($request),
        );
    }

    /**
     * Resolve the properites for the response.
     */
    public function resolveProperties(HttpRequest $request, array $props): array
    {
        $props = $this->resolvePartialProperties($props, $request);
        $props = $this->resolveArrayableProperties($props, $request);
        $props = $this->resolveAlways($props);
        $props = $this->resolvePropertyInstances($props, $request);

        return $props;
    }

    /**
     * Resolve the `only` and `except` partial request props.
     */
    public function resolvePartialProperties(array $props, HttpRequest $request): array
    {
        if (!$this->isPartial($request)) {
            return array_filter($this->props, static function ($prop) {
                return !($prop instanceof Props\IgnoreFirstLoad);
            });
        }

        $only = array_filter(explode(',', $request->getHeader(Header::PARTIAL_ONLY) ?? ''));
        $except = array_filter(explode(',', $request->getHeader(Header::PARTIAL_EXCEPT) ?? ''));

        if (count($only)) {
            $newProps = [];

            foreach ($only as $key) {
                Arr::set($newProps, $key, Arr::get($props, $key));
            }

            $props = $newProps;
        }

        if ($except) {
            Arr::forget($props, $except);
        }

        return $props;
    }

    /**
     * Resolve all arrayables properties into an array.
     */
    public function resolveArrayableProperties(array $props, HttpRequest $request, bool $unpackDotProps = true): array
    {
        foreach ($props as $key => $value) {
            if ($value instanceof Closure) {
                $value = value($value);
            }

            if (is_array($value)) {
                $value = $this->resolveArrayableProperties($value, $request, false);
            }

            if ($unpackDotProps && str_contains($key, '.')) {
                Arr::set($props, $key, $value);
                unset($props[$key]);
            } else {
                $props[$key] = $value;
            }
        }

        return $props;
    }

    /**
     * Resolve `always` properties that should always be included on all visits, regardless of "only" or "except" requests.
     */
    public function resolveAlways(array $props): array
    {
        $always = array_filter($this->props, static function ($prop) {
            return $prop instanceof Props\AlwaysProp;
        });

        return array_merge(
            $always,
            $props
        );
    }

    /**
     * Resolve all necessary class instances in the given props.
     */
    public function resolvePropertyInstances(array $props, HttpRequest $request): array
    {
        foreach ($props as $key => $value) {
            $resolveViaApp = Arr::first([
                Closure::class,
                Props\LazyProp::class,
                Props\OptionalProp::class,
                Props\DeferProp::class,
                Props\AlwaysProp::class,
                Props\MergeProp::class,
            ], fn($class) => $value instanceof $class);

            if ($resolveViaApp) {
                $value = value($value);
            }

            if ($value instanceof PromiseInterface) {
                $value = $value->wait();
            }

            if ($value instanceof HttpResponse) {
                $value = json_decode($value->getContent(), true);
            }

            if (is_array($value)) {
                $value = $this->resolvePropertyInstances($value, $request);
            }

            $props[$key] = $value;
        }

        return $props;
    }

    public function resolveMergeProps(HttpRequest $request): array
    {
        $resetProps = array_filter(explode(',', $request->getHeader(Header::RESET) ?? ''));
        $onlyProps = array_filter(explode(',', $request->getHeader(Header::PARTIAL_ONLY) ?? ''));
        $exceptProps = array_filter(explode(',', $request->getHeader(Header::PARTIAL_EXCEPT) ?? ''));

        $mergeProps = array_filter($this->props, fn($prop, $key) => (
            $prop instanceof Props\Mergeable
            && $prop->shouldMerge()
            && !in_array($key, $resetProps)
            && (count($onlyProps) === 0 || in_array($key, $onlyProps))
            && !in_array($key, $exceptProps)
        ), ARRAY_FILTER_USE_BOTH);

        $deepMergeProps = array_keys(
            array_filter(
                $mergeProps,
                fn($prop) => $prop->shouldDeepMerge()
            )
        );

        $matchPropsOn = array_values(
            Arr::flatten(
                Arr::map(
                    $mergeProps,
                    fn($prop, $key) => Arr::map($prop->matchesOn(), fn($strategy) => $key . '.' . $strategy)
                )
            )
        );

        $mergeProps = array_diff(array_keys($mergeProps), $deepMergeProps);

        return array_filter([
            'mergeProps' => $mergeProps,
            'deepMergeProps' => $deepMergeProps,
            'matchPropsOn' => $matchPropsOn,
        ], fn($prop) => count($prop) > 0);
    }

    public function resolveDeferredProps(HttpRequest $request): array
    {
        if ($this->isPartial($request)) {
            return [];
        }

        $deferredPropsRaw = Arr::map(
            array_filter(
                $this->props,
                fn($prop) => $prop instanceof Props\DeferProp,
            ),
            fn($prop, $key) => [
                'key' => $key,
                'group' => $prop->group()
            ]
        );

        if (empty($deferredPropsRaw)) {
            return [];
        }

        $deferredProps = [];

        foreach ($deferredPropsRaw as $key => $prop) {
            if (!array_key_exists($group = $prop->group(), $deferredProps)) {
                $deferredProps[$group] = [];
            }

            $deferredProps[$group][] = $key;
        }

        return ['deferredProps' => $deferredProps];
    }

    /**
     * Determine if the request is a partial request.
     */
    public function isPartial(HttpRequest $request): bool
    {
        return $request->getHeader(Header::PARTIAL_COMPONENT) === $this->component;
    }

    /**
     * Get the URL from the request (without the scheme and host) while preserving the trailing slash if it exists.
     */
    protected function getUrl(HttpRequest $request): string
    {
        $url = parse_url($request->getRequestUri());
        $path = $url['path'] ?? '/';
        
        // Preserve trailing slash if it exists (except for root path)
        $hasTrailingSlash = $path !== '/' && substr($path, -1) === '/';
        $normalizedPath = '/' . trim($path, '/');
        
        // Restore trailing slash if it was present
        if ($hasTrailingSlash && $normalizedPath !== '/') {
            $normalizedPath .= '/';
        }
        
        return $normalizedPath . ($url['query'] ?? '' ? ('?' . $url['query']) : '');
    }
}

