<?php

namespace Craft\User\Application\Dto;

use Craft\Core\Helper\DtoManager;

final class VkUserDto extends DtoManager
{

	// Социальный ID пользователя
	public ?string $id;

	// Ссылка на профиль пользователя
	public ?string $screenName;

	// Имя пользователя
	public ?string $firstName;

	// Фамилия пользователя
	public ?string $lastName;

	// Пол пользователя
	public ?string $sex;

	//День Рождения
	public ?string $birthDate;

	// URL к фото
	public ?string $photo_big;

	public function __construct(
		?string $id,
		?string $screen_name,
		?string $first_name,
		?string $last_name,
		?string $sex,
		?string $bdate,
		?string $photo_big
	)
	{
		$this->id = $id;
		$this->screenName = $screen_name;
		$this->firstName = $first_name;
		$this->lastName = $last_name;
		$this->sex = $sex;
		$this->birthDate = $bdate;
		$this->photo_big = $photo_big;
	}
}