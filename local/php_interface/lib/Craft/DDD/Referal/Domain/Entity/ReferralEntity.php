<?php

namespace Craft\DDD\Referal\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class ReferralEntity
{
	private ActiveValueObject $active;
	private int $id;
	private int $userId;
	private ?int $inviteUserId;
	private string $code;
	private PhoneValueObject $phone;

	public static function create(
		int              $userId,
		PhoneValueObject $phone,
		string           $code,
	): ReferralEntity
	{
		$self = new self();
		$self->active = ActiveValueObject::active();
		$self->userId = $userId;
		$self->phone = $phone;
		$self->code = $code;
		$self->inviteUserId = 0;
		return $self;
	}

	public static function invite(
		PhoneValueObject $phone,
		string           $code,
	): ReferralEntity
	{
		$self = new self();
		$self->phone = $phone;
		$self->code = $code;
		$self->inviteUserId = null;
		return $self;
	}

	public static function hydrate(
		int               $id,
		ActiveValueObject $active,
		int               $userId,
		int               $inviteUserId,
		string            $code,
		PhoneValueObject  $phone,
	): ReferralEntity
	{
		$self = new self();
		$self->id = $id;
		$self->active = $active;
		$self->phone = $phone;
		$self->code = $code;
		$self->inviteUserId = $inviteUserId;
		$self->userId = $userId;
		return $self;
	}

	public function refreshId(int $id): ReferralEntity
	{
		$this->id = $id;
		return $this;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPhone(): PhoneValueObject
	{
		return $this->phone;
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getUserId(): int
	{
		return $this->userId;
	}

	public function getActive(): ActiveValueObject
	{
		return $this->active;
	}

	public function getInviteUserId(): int
	{
		return $this->inviteUserId;
	}

}