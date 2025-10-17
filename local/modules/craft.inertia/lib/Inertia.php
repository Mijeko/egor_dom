<?php

namespace Craft\Inertia;

use Bitrix\Main\HttpRequest;
use Bitrix\Main\HttpResponse;
use Bitrix\Main\Page\Asset;
use Closure;
use Craft\Inertia\Support\Arr;
use Craft\Inertia\Support\Config;
use Bitrix\Main\Application;
use Craft\Inertia\Support\Header;

class Inertia
{
	protected array $sharedProps = [];

	protected null|string $bundle = null;

	protected string|Closure|null $version = null;

	protected Config $config;

	protected array $response = [
		'dispatched' => false,
		'instance'   => null,
	];

	protected string $dir = 'abn';

	public function __construct()
	{
		$this->config = new Config();
	}

	public function share($key, $value = null): static
	{
		if(is_array($key))
		{
			$this->sharedProps = array_merge($this->sharedProps, $key);
		} elseif(method_exists($key, 'toArray'))
		{
			$this->sharedProps = array_merge($this->sharedProps, $key->toArray());
		} else
		{
			Arr::set($this->sharedProps, $key, $value);
		}

		return $this;
	}

	public function getShared(string $key = null, $default = null): mixed
	{
		if($key)
		{
			return Arr::get($this->sharedProps, $key, $default);
		}

		return $this->sharedProps;
	}

	public function flushShared(): void
	{
		$this->sharedProps = [];
	}

	public function getLocalRoot(): string
	{
		return rtrim(dirname(__DIR__, 3), '/');
	}

	public function getVersionFromManifest(): ?string
	{
		if(file_exists($manifest = $this->getLocalRoot() . '/markup/' . $this->dir . '/dist/.vite/manifest.json'))
		{
			return hash_file('xxh128', $manifest);
		}

		return null;
	}

	public function getBundlePath(): ?string
	{
		return $this->bundle;
	}

	public function setBundlePath(?string $bundle): void
	{
		$this->bundle = $bundle;
	}

	public function config(string $key, $default = null)
	{
		return $this->config->get($key, $default);
	}

	public function getConfig(): Config
	{
		return $this->config;
	}

	/**
	 * @param Closure|string|null $version
	 */
	public function version(Closure|string|null $version): void
	{
		$this->version = $version;
	}

	public function getVersion(): string
	{
		$version = $this->version instanceof Closure
			? call_user_func($this->version)
			: $this->version;

		return (string)$version;
	}

	public function lazy(callable $callback): Props\LazyProp
	{
		return new Props\LazyProp($callback);
	}

	public function globalShare(string $file): static
	{
		if(
			!file_exists($file)
			|| !is_iterable($shared = require_once $file)
		)
		{
			return $this;
		}

		return $this->share(collection_all($shared));
	}

	public function view(string $component, array $props = []): void
	{
		$inertiaResponse = new Response($component, array_merge($this->sharedProps, $props), $this->getVersion());

		$this->globalShare($this->getLocalRoot() . '/php_interface/inertia.share.php');

		$bxRequest = Application::getInstance()->getContext()->getRequest();
		$pageData = $inertiaResponse->toPage($bxRequest);


		$response = $this->withMiddleware(
			$bxRequest,
			$pageData,
			function() use ($pageData) {
				if($gatewayAnswer = (new Ssr\HttpGateway())->dispatch($pageData))
				{
					Asset::getInstance()->addString($gatewayAnswer->head);
				}

				if(!$gatewayAnswer)
				{
					echo sprintf(
						'<div id="app" data-page="%s"></div>',
						htmlspecialchars(json_encode($pageData), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
					);
				} else
				{
					echo $gatewayAnswer->body;
				}

				return new HttpResponse();
			}
		);

		if($response->getContent())
		{
			$response->writeHeaders();
			$response->send();
		}
	}

	protected function withMiddleware(HttpRequest $bxRequest, array $page, Closure $next): HttpResponse
	{
		return (new Middleware())->handle($bxRequest, value(function(HttpRequest $bxRequest) use ($page, $next) {
			if($bxRequest->getHeader(Header::INERTIA) === 'true')
			{
				$response = new HttpResponse();
				$response->addHeader(Header::INERTIA, 'true');
				$response->setContent(json_encode($page));
				$response->getHeaders()->setStatus(200);

				return $response;
			}

			return $next($bxRequest);
		}, $bxRequest));
	}
}
