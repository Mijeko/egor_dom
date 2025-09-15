<?php

namespace Craft\Dto;

use Craft\DDD\User\Infrastructure\Dto\ManagerDto;

class BxUserDto
{

	public int $id;
	public ?BxUserGroupDto $position;
	public ?string $name;
	public ?string $lastName;
	public ?string $secondName;
	public ?string $fullName;
	public string $email;
	public string $phone;
	public ?string $inn = null;
	public ?string $ogrn = null;
	public ?string $kpp = null;
	public ?string $bik = null;
	public ?string $currAccount = null;
	public ?string $corrAccount = null;
	public ?string $legalAddress = null;
	public ?string $postAddress = null;
	public ?string $bankName = null;
	public ?ManagerDto $manager = null;
	public ?BxImageDto $avatar = null;


	public static function agent(
		int         $id,
		string      $name,
		string      $lastName,
		string      $secondName,
		string      $fullName,
		string      $email,
		string      $phone,
		?string     $inn = null,
		?string     $ogrn = null,
		?string     $kpp = null,
		?string     $bik = null,
		?string     $currAccount = null,
		?string     $corrAccount = null,
		?string     $legalAddress = null,
		?string     $postAddress = null,
		?string     $bankName = null,
		?ManagerDto $manager = null,
		?BxImageDto $avatarImage = null,
	): BxUserDto
	{
		$self = new self();
		$self->id = $id;
		$self->name = $name;
		$self->lastName = $lastName;
		$self->secondName = $secondName;
		$self->fullName = $fullName;
		$self->email = $email;
		$self->phone = $phone;
		$self->inn = $inn;
		$self->ogrn = $ogrn;
		$self->kpp = $kpp;
		$self->bik = $bik;
		$self->currAccount = $currAccount;
		$self->corrAccount = $corrAccount;
		$self->legalAddress = $legalAddress;
		$self->postAddress = $postAddress;
		$self->bankName = $bankName;
		$self->manager = $manager;
		$self->avatar = $avatarImage;
		return $self;
	}

	public static function manager(
		int             $id,
		string          $name,
		string          $lastName,
		string          $secondName,
		string          $fullName,
		string          $email,
		string          $phone,
		?BxImageDto     $avatarDto = null,
		?BxUserGroupDto $groupDto = null,
	): BxUserDto
	{
		$self = new self();
		$self->id = $id;
		$self->name = $name;
		$self->lastName = $lastName;
		$self->secondName = $secondName;
		$self->fullName = $fullName;
		$self->email = $email;
		$self->phone = $phone;
		$self->avatar = $avatarDto;
		$self->position = $groupDto;
		return $self;
	}

	public static function extRealtor(
		int             $id,
		string          $name,
		string          $lastName,
		string          $secondName,
		string          $fullName,
		string          $email,
		string          $phone,
		BxImageDto      $bxImageDto,
		?BxUserGroupDto $groupDto = null,
	): BxUserDto
	{
		$self = new self();
		$self->id = $id;
		$self->name = $name;
		$self->lastName = $lastName;
		$self->secondName = $secondName;
		$self->fullName = $fullName;
		$self->email = $email;
		$self->phone = $phone;
		$self->avatar = $bxImageDto;
		$self->position = $groupDto;
		return $self;
	}

}