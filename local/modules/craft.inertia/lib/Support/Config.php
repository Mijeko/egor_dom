<?php

namespace Craft\Inertia\Support;
use ArrayAccess;

class Config implements ArrayAccess
{
    public function __construct(public array $config = [])
    {
    }

    public function mergeWith(string $file): static
    {
        if(
            !file_exists($file)
            || !is_array($config = require_once $file)
        ) {
            return $this;
        }

        return $this->merge($config);
    }

    public function merge(array $config): static
    {
        $this->config = array_merge_recursive($this->config, $config);

        return $this;
    }

    public function get(string $key, $default = null)
    {
        return Arr::get($this->config, $key, $default);
    }

    public function offsetExists(mixed $offset): bool
    {
        return Arr::has($this->config, $offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return Arr::get($this->config, $offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        Arr::set($this->config, $offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        Arr::forget($this->config, $offset);
    }

    public function __isset(string $name): bool
    {
        return $this->offsetExists($name);
    }

    public function __get(string $name)
    {
        return $this->offsetGet($name);
    }

    public function __set(string $name, $value): void
    {
        $this->offsetSet($name, $value);
    }

    public function __unset(string $name): void
    {
        $this->offsetUnset($name);
    }
}