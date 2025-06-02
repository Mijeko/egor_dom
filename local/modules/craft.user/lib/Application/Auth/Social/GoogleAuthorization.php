<?php

namespace Craft\User\Application\Auth\Social;

use Craft\Core\Rest\Get;
use Craft\Core\Rest\Post;
use Craft\User\Admin\Settings\GoogleClientId;
use Craft\User\Admin\Settings\GoogleClientSecret;
use Craft\User\Admin\Settings\GoogleRedirectUrl;
use Craft\User\Application\Auth\Social\Entity\GoogleAccessToken;
use Craft\User\Application\Dto\GoogleResponseAccessToken;
use Craft\User\Application\Dto\GoogleUserInfo;

final class GoogleAuthorization implements SocialAuthServiceInterface
{
	protected string $clientId;
	protected string $clientSecret;
	protected string $redirectUri;
	protected string $url = 'https://accounts.google.com/o/oauth2/auth';

	public function __construct()
	{
		$this->clientId = GoogleClientId::instance()->value();
		$this->clientSecret = GoogleClientSecret::instance()->value();
		$this->redirectUri = GoogleRedirectUrl::instance()->value();
	}

	public function getRegisterLink(): string
	{
		return $this->url . '?' . urldecode(http_build_query($this->getDefaultParamsAuth()));
	}

	public function getDefaultParamsAuth(): array
	{
		return [
			'redirect_uri'  => $this->redirectUri,
			'response_type' => 'code',
			'client_id'     => $this->clientId,
			'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
		];
	}

	public function label(): string
	{
		return 'Google';
	}

	public function getAccessToken(string $code): GoogleResponseAccessToken
	{
		$accessToken = new GoogleAccessToken();

		if(!$accessToken->isAlive())
		{
			$response = Post::instance()
				->execute(
					'https://accounts.google.com/o/oauth2/token',
					[
						'client_id'     => $this->clientId,
						'client_secret' => $this->clientSecret,
						'redirect_uri'  => $this->redirectUri,
						'grant_type'    => 'authorization_code',
						'code'          => $code,
					])
				->json();

			if(array_key_exists('error', $response))
			{
				throw new \Exception('Access token could not be retrieved from Google');
			}

			$accessToken->store(GoogleResponseAccessToken::fromArray($response));
		}

		return $accessToken->getTokenData();
	}

	public function userInfo(string $accessToken): ?GoogleUserInfo
	{
		$response = Get::instance()
			->execute(
				'https://www.googleapis.com/oauth2/v1/userinfo',
				[
					'access_token' => $accessToken,
				]
			)
			->json();

		if(array_key_exists('id', $response))
		{
			return GoogleUserInfo::fromArray($response);
		}

		return null;
	}
}