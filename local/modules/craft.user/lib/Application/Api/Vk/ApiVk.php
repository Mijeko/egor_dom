<?php

namespace Craft\User\Application\Api\Vk;

use Bitrix\Main\Diag\Debug;
use Craft\Core\Rest\Get;
use Craft\User\Application\Dto\VkUserDto;

final class ApiVk
{
	protected function getApiUrl(): string
	{
		return 'https://api.vk.com/method';
	}

	protected static ?ApiVk $instance = null;

	public static function build(): ApiVk
	{
		if(is_null(self::$instance))
		{
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * @param array<string, string> $params
	 * @return VkUserDto[]|null
	 */
	public function users(int $userId, array $params = []): ?array
	{
		$response = $this->execute('users.get', array_merge(
			[
				'user_id' => $userId,
				'v'       => '5.199',
				'fields'  => 'email',
			],
			$params
		));

		if(empty($response['response']))
		{
			return null;
		}

		$result = [];
		if(is_array($response['response']))
		{
			Debug::dump($response);

			foreach($response['response'] as $item)
			{
				$result[] = new VkUserDto(
					$item['id'],
					$item['screen_name'],
					$item['first_name'],
					$item['last_name'],
					$item['sex'],
					$item['bdate'],
					$item['photo_big'],
				);
			}
		}

		return $result;

	}

	/**
	 * @param array<string, string> $params
	 * @return array|null
	 */
	protected function execute(string $method, array $params = []): ?array
	{
		/* @phpstan-ignore class.notFound */
		return Get::instance()
			->execute(
				sprintf('%s/%s?%s', self::getApiUrl(), $method, http_build_query($params)),
				$params
			)
			->json();
	}
}