<?php

namespace Craft\User\Application\Auth\Social;

use Bitrix\Main\Application;
use Craft\Core\Rest\Post;
use Craft\User\Admin\Settings\VkClientId;
use Craft\User\Admin\Settings\VkClientSecret;
use Craft\User\Admin\Settings\VkRedirectUrl;
use Craft\User\Application\Dto\VkResponseAccessTokenDto;
use Craft\User\Application\Auth\Social\Entity\VkAccessToken;
use Craft\User\Application\Auth\Social\Entity\Auth\CodeChallenge;
use Craft\User\Application\Auth\Social\Entity\Auth\CodeVerifier;
use Craft\User\Application\Auth\Social\Entity\Auth\State;
use Craft\User\Application\Dto\VkUserInfoDto;

final class VkAuthorization implements SocialAuthServiceInterface
{
	protected int $clientId;
	protected string $clientSecret;
	protected string $url = 'https://id.vk.com/authorize';
	protected string $redirectUrl;

	public function __construct()
	{
		$this->clientId = intval(VkClientId::instance()->value());
		$this->clientSecret = VkClientSecret::instance()->value();
		$this->redirectUrl = VkRedirectUrl::instance()->value();
	}

	public function label(): string
	{
		return 'Vk';
	}

	/**
	 * @return array<string, int|string>
	 */
	public function getDefaultParamsAuth(): array
	{
		$state = State::init()->generate(true)->getValue();
		CodeVerifier::init()->generate(true)->getValue();
		$code_challenge = CodeChallenge::init()->generate(true)->getValue();

		return [
			'client_id'             => $this->clientId,
			'scope'                 => 'email',
			'redirect_uri'          => $this->redirectUrl,
			'code_challenge'        => $code_challenge,
			'code_challenge_method' => 's256',
			'response_type'         => 'code',
			'state'                 => $state,
		];
	}


	public function getRegisterLink(): string
	{
		return $this->url . '?' . urldecode(http_build_query($this->getDefaultParamsAuth()));
	}

	function getAccessToken(string $code): VkResponseAccessTokenDto
	{
		$accessToken = VkAccessToken::instance();

		if(!$accessToken->isAlive())
		{
			$tokenInfo = Post::instance()
				->execute(
					'https://id.vk.com/oauth2/auth',
					[
						'grant_type'    => 'authorization_code',
						'code_verifier' => CodeVerifier::init()->sessionValue(),
						'redirect_uri'  => $this->redirectUrl,
						'code'          => $code,
						'client_id'     => $this->clientId,
						'device_id'     => Application::getInstance()->getContext()->getRequest()->get('device_id'),
					],
					[
						'Content-Type' => 'application/x-www-form-urlencoded',
					]
				)
				->json();

			if(!$tokenInfo)
			{
				throw new \Exception('Access token not found');
			}

			$accessTokenResponse = VkResponseAccessTokenDto::fromArray($tokenInfo);

			$accessToken->store($accessTokenResponse);
		}

		return $accessToken->getTokenData();
	}

	public function userInfo(string $accessToken): ?VkUserInfoDto
	{
		$response = Post::instance()
			->execute(
				'https://id.vk.com/oauth2/user_info',
				[
					'client_id'    => $this->clientId,
					'access_token' => $accessToken,
				]
			)
			->json();

		if(array_key_exists('user', $response))
		{
			return VkUserInfoDto::fromArray($response['user']);
		}

		return null;
	}
}