<?php

namespace Craft\User\Application\Dto;

use Craft\Core\Helper\DtoManager;

final class VkUserInfoDto extends DtoManager implements UserInfoInterface
{
	public ?int $userId;
	public ?string $firstName;
	public ?string $lastName;
	public ?string $sex;
	public ?string $birthday;
	public ?string $avatar;

	//extended

	public ?string $email;


	public function setEmail(?string $email): VkUserInfoDto
	{
		$this->email = $email;
		return $this;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setUserId(?int $id): VkUserInfoDto
	{
		$this->userId = $id;
		return $this;
	}

	public function getUserId(): ?int
	{
		return $this->userId;
	}

	public function setBirthday(?string $birthday): VkUserInfoDto
	{
		$this->birthday = $birthday;
		return $this;
	}

	public function setFirstName(?string $firstName): VkUserInfoDto
	{
		$this->firstName = $firstName;
		return $this;
	}

	public function setLastName(?string $lastName): VkUserInfoDto
	{
		$this->lastName = $lastName;
		return $this;
	}

	public function setSex(?string $sex): VkUserInfoDto
	{
		$this->sex = $sex;
		return $this;
	}

	public function setAvatar(?string $avatar): VKUserInfoDto
	{
		$this->avatar = $avatar;
		return $this;
	}

	public function getAvatar(): ?string
	{
		return $this->avatar;
	}

	public function getBirthday(): ?string
	{
		return $this->birthday;
	}

	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function getSex(): ?string
	{
		return $this->sex;
	}
}