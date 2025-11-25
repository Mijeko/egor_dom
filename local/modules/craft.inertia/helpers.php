<?php


use Bitrix\Main\DI\ServiceLocator;
use Craft\Inertia\Inertia;
use Craft\Inertia\Manifest\ManifestCore;
use Craft\Inertia\Support\Arr;
use Craft\Inertia\Vite\Vite;

if(!function_exists('value'))
{
	/**
	 * Return the default value of the given value.
	 *
	 * @template TValue
	 * @template TArgs
	 *
	 * @param TValue|Closure(TArgs): TValue $value
	 * @param TArgs ...$args
	 * @return TValue
	 */
	function value($value, ...$args)
	{
		return $value instanceof Closure ? $value(...$args) : $value;
	}
}

if(!function_exists('data_get'))
{
	/**
	 * Get an item from an array or object using "dot" notation.
	 *
	 * @param mixed $target
	 * @param string|array|int|null $key
	 * @param mixed $default
	 * @return mixed
	 */
	function data_get($target, $key, $default = null)
	{
		if(is_null($key))
		{
			return $target;
		}

		$key = is_array($key) ? $key : explode('.', $key);

		foreach($key as $i => $segment)
		{
			unset($key[$i]);

			if(is_null($segment))
			{
				return $target;
			}

			if($segment === '*')
			{
				if(!is_iterable($target))
				{
					return value($default);
				}

				$result = [];

				foreach($target as $item)
				{
					$result[] = data_get($item, $key);
				}

				return in_array('*', $key) ? Arr::collapse($result) : $result;
			}

			$segment = match ($segment)
			{
				'\*' => '*',
				'\{first}' => '{first}',
				'{first}' => array_key_first(is_array($target) ? $target : collection_all($target)),
				'\{last}' => '{last}',
				'{last}' => array_key_last(is_array($target) ? $target : collection_all($target)),
				default => $segment,
			};

			if(Arr::accessible($target) && Arr::exists($target, $segment))
			{
				$target = $target[$segment];
			} elseif(is_object($target) && isset($target->{$segment}))
			{
				$target = $target->{$segment};
			} else
			{
				return value($default);
			}
		}

		return $target;
	}
}

if(!function_exists('collection_all'))
{
	function collection_all($items): array
	{
		if(is_array($items))
		{
			return $items;
		}

		return match (true)
		{
			$items instanceof WeakMap => throw new InvalidArgumentException('Collections can not be created using instances of WeakMap.'),
			$items instanceof Traversable => iterator_to_array($items),
			$items instanceof JsonSerializable => (array)$items->jsonSerialize(),
			$items instanceof UnitEnum => [$items],
			default => (array)$items,
		};
	}
}

if(!function_exists('data_set'))
{
	/**
	 * Set an item on an array or object using dot notation.
	 *
	 * @param mixed $target
	 * @param string|array $key
	 * @param mixed $value
	 * @param bool $overwrite
	 * @return mixed
	 */
	function data_set(&$target, $key, $value, $overwrite = true)
	{
		$segments = is_array($key) ? $key : explode('.', $key);

		if(($segment = array_shift($segments)) === '*')
		{
			if(!Arr::accessible($target))
			{
				$target = [];
			}

			if($segments)
			{
				foreach($target as &$inner)
				{
					data_set($inner, $segments, $value, $overwrite);
				}
			} elseif($overwrite)
			{
				foreach($target as &$inner)
				{
					$inner = $value;
				}
			}
		} elseif(Arr::accessible($target))
		{
			if($segments)
			{
				if(!Arr::exists($target, $segment))
				{
					$target[$segment] = [];
				}

				data_set($target[$segment], $segments, $value, $overwrite);
			} elseif($overwrite || !Arr::exists($target, $segment))
			{
				$target[$segment] = $value;
			}
		} elseif(is_object($target))
		{
			if($segments)
			{
				if(!isset($target->{$segment}))
				{
					$target->{$segment} = [];
				}

				data_set($target->{$segment}, $segments, $value, $overwrite);
			} elseif($overwrite || !isset($target->{$segment}))
			{
				$target->{$segment} = $value;
			}
		} else
		{
			$target = [];

			if($segments)
			{
				data_set($target[$segment], $segments, $value, $overwrite);
			} elseif($overwrite)
			{
				$target[$segment] = $value;
			}
		}

		return $target;
	}
}

if(!function_exists('data_forget'))
{
	/**
	 * Remove / unset an item from an array or object using "dot" notation.
	 *
	 * @param mixed $target
	 * @param string|array|int|null $key
	 * @return mixed
	 */
	function data_forget(&$target, $key)
	{
		$segments = is_array($key) ? $key : explode('.', $key);

		if(($segment = array_shift($segments)) === '*' && Arr::accessible($target))
		{
			if($segments)
			{
				foreach($target as &$inner)
				{
					data_forget($inner, $segments);
				}
			}
		} elseif(Arr::accessible($target))
		{
			if($segments && Arr::exists($target, $segment))
			{
				data_forget($target[$segment], $segments);
			} else
			{
				Arr::forget($target, $segment);
			}
		} elseif(is_object($target))
		{
			if($segments && isset($target->{$segment}))
			{
				data_forget($target->{$segment}, $segments);
			} elseif(isset($target->{$segment}))
			{
				unset($target->{$segment});
			}
		}

		return $target;
	}
}

if(!function_exists('inertia'))
{
	/**
	 * Inertia helper.
	 *
	 * @param null|string $component
	 * @param iterable $props
	 * @return Inertia|void
	 */
	function inertia(null|string $component = null, iterable $props = [])
	{
		$serviceLocator = ServiceLocator::getInstance();
		/** @var Inertia $factory */
		$factory = $serviceLocator->get(Inertia::class);

		if($component)
		{
			$factory->view($component, $props);
			return;
		}

		return $factory;
	}
}

if(!function_exists('vite'))
{
	function vite(): ManifestCore
	{
		$serviceLocator = ServiceLocator::getInstance();

		/** @var $vite ManifestCore */
		$vite = $serviceLocator->get(ManifestCore::class);
		return $vite;
	}
}
