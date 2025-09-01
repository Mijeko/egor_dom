<?php

namespace Craft\DDD\Claims\Domain\Entity;

use Craft\DDD\Claims\Domain\ValueObject\StatusValueObject;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Shared\Domain\ValueObject\BikValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\KppValueObject;
use Craft\DDD\Shared\Domain\ValueObject\OgrnValueObject;
use Craft\DDD\User\Domain\Entity\UserEntity;

class ClaimEntity
{


	protected ?int $id;
	protected ?string $name;
	protected ?StatusValueObject $status;
	protected ?string $email;
	protected ?string $phone;
	protected ?string $client;
	protected ?InnValueObject $inn;
	protected ?KppValueObject $kpp;
	protected ?BikValueObject $bik;
	protected ?OgrnValueObject $ogrn;
	protected ?CurrAccountValueObject $currAcc;
	protected ?CorrAccountValueObject $corrAcc;
	protected ?string $legalAddress;
	protected ?string $postAddress;
	protected ?string $bankName;
	protected ?int $costReward = 0;
	protected ?int $orderCost;
	protected ?bool $isClosed = false;
	protected ?bool $isMoneyReceived = false;
	protected ?string $createdAt = null;

	protected ?int $apartmentId;
	protected ?int $userId;
	protected ?ApartmentEntity $apartmentEntity = null;
	protected ?UserEntity $user = null;

	public function finish(
		StatusValueObject $status,
	): ClaimEntity
	{
		$this->status = $status;
		$this->isClosed = true;
		return $this;
	}

	public static function createClaim(
		StatusValueObject $status,
		string            $email,
		string            $phone,
		string            $client,
		ApartmentEntity   $apartmentEntity,
		UserEntity        $user,
		int               $orderCost,
	): ClaimEntity
	{
		$self = new self();

		$self->name = 'Новая заявка от ' . date('d.m.Y H:i:s');
		$self->status = $status;
		$self->email = $email;
		$self->phone = $phone;
		$self->client = $client;
		//		$self->inn = new InnValueObject($inn);
		//		$self->kpp = new KppValueObject($kpp);
		//		$self->bik = new BikValueObject($bik);
		//		$self->ogrn = new OgrnValueObject($ogrn);
		//		$self->currAcc = new CurrAccountValueObject($currAcc);
		//		$self->corrAcc = new CorrAccountValueObject($corrAcc);
		//		$self->legalAddress = $legalAddress;
		//		$self->postAddress = $postAddress;
		//		$self->bankName = $bankName;
		$self->apartmentEntity = $apartmentEntity;
		$self->user = $user;
		$self->orderCost = $orderCost;

		return $self;

	}

	public static function hydrate(
		?int               $id,
		?int               $apartmentId,
		?string            $name,
		?StatusValueObject $status,
		?string            $email,
		?string            $phone,
		?string            $client,
		?string            $createdAt,
		?bool              $isClosed,
		?bool              $isMoneyReceived,
		?int               $costReward,
	): ClaimEntity
	{
		$self = new self();
		$self->id = $id;
		$self->apartmentId = $apartmentId;
		$self->name = $name;
		$self->status = $status;
		$self->email = $email;
		$self->phone = $phone;
		$self->client = $client;
		$self->createdAt = $createdAt;
		$self->isClosed = $isClosed;
		$self->isMoneyReceived = $isMoneyReceived;
		$self->costReward = $costReward;
		return $self;
	}

	public function addApartment(ApartmentEntity $apartmentEntity): static
	{
		$this->apartmentEntity = $apartmentEntity;
		return $this;
	}

	public function addUser(UserEntity $user): static
	{
		$this->user = $user;
		return $this;
	}

	public function refreshIdAfterCreate(int $id): static
	{
		$this->id = $id;
		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getApartmentEntity(): ?ApartmentEntity
	{
		return $this->apartmentEntity;
	}

	public function getUser(): ?UserEntity
	{
		return $this->user;
	}

	public function getPhone(): ?string
	{
		return $this->phone;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function getClient(): ?string
	{
		return $this->client;
	}

	public function getBankName(): ?string
	{
		return $this->bankName;
	}

	public function getOgrn(): ?OgrnValueObject
	{
		return $this->ogrn;
	}

	public function getKpp(): ?KppValueObject
	{
		return $this->kpp;
	}

	public function getInn(): ?InnValueObject
	{
		return $this->inn;
	}

	public function getCurrAcc(): ?CurrAccountValueObject
	{
		return $this->currAcc;
	}

	public function getCorrAcc(): ?CorrAccountValueObject
	{
		return $this->corrAcc;
	}

	public function getBik(): ?BikValueObject
	{
		return $this->bik;
	}

	public function getPostAddress(): ?string
	{
		return $this->postAddress;
	}

	public function getLegalAddress(): ?string
	{
		return $this->legalAddress;
	}

	public function getCreatedAt(): ?string
	{
		return $this->createdAt;
	}

	public function getApartmentId(): ?int
	{
		return $this->apartmentId;
	}

	public function getUserId(): ?int
	{
		return $this->userId;
	}

	public function getStatus(): ?StatusValueObject
	{
		return $this->status;
	}

	public function getCostReward(): ?int
	{
		return $this->costReward;
	}

	public function getIsClosed(): ?bool
	{
		return $this->isClosed;
	}

	public function getIsMoneyReceived(): ?bool
	{
		return $this->isMoneyReceived;
	}

	public function getOrderCost(): ?int
	{
		return $this->orderCost;
	}
}