<?php

namespace Craft\User\Domain\Entity;

use Craft\User\Application\Entity\JUser;

class UserSocialIdentity
{
	protected int $id;
	protected JUser $user;
	protected string $socialId;
	protected SocialType $socialType;

	public function __construct(
		JUser      $user,
		string     $socialId,
		SocialType $socialType
	)
	{
		$this->user = $user;
		$this->socialId = $socialId;
		$this->socialType = $socialType;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getSocialId(): string
	{
		return $this->socialId;
	}

	public function getSocialType(): SocialType
	{
		return $this->socialType;
	}

	public function getUser(): JUser
	{
		return $this->user;
	}

	public function addSocialType(SocialType $socialType): UserSocialIdentity
	{
		$this->socialType = $socialType;
		return $this;
	}

}