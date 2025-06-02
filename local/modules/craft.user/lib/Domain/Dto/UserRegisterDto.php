<?php

namespace Craft\User\Domain\Dto;

use Craft\Core\Helper\DtoManager;

class UserRegisterDto extends DtoManager
{

	public ?bool $active;
	public ?string $lastName;
	public ?string $secondName;
	public ?string $password;
	public ?string $confirmPassword;
	public ?array $groupId;

	public function __construct(
		?string $lastName = null
	)
	{
		$this->lastName = $lastName;
	}
}