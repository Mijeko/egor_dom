<?php

namespace Craft\DDD\UserBehavior\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\DateTimeValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\DetailLinkValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\NameValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\UserIdValueObject;

class ProductViewedEntity
{
	private NameValueObject $name;
	private DetailLinkValueObject $detailLink;
	private ProductIdValueObject $productId;
	private UserIdValueObject $userId;
	private DateTimeValueObject $createdAt;

	public static function hydrate(
		ProductIdValueObject  $productId,
		UserIdValueObject     $userId,
		NameValueObject       $name,
		DetailLinkValueObject $detailLink,
		DateTimeValueObject   $createdAt,

	): ProductViewedEntity
	{
		$self = new self();
		$self->productId = $productId;
		$self->userId = $userId;
		$self->name = $name;
		$self->detailLink = $detailLink;
		$self->createdAt = $createdAt;
		return $self;
	}

	public static function create(
		ProductIdValueObject  $productId,
		UserIdValueObject     $userId,
		NameValueObject       $name,
		DetailLinkValueObject $detailLink,
	): ProductViewedEntity
	{
		$self = new self();
		$self->productId = $productId;
		$self->userId = $userId;
		$self->name = $name;
		$self->detailLink = $detailLink;
		$self->createdAt = DateTimeValueObject::now();
		return $self;
	}

	public function getUserId(): UserIdValueObject
	{
		return $this->userId;
	}

	public function getProductId(): ProductIdValueObject
	{
		return $this->productId;
	}

	public function getDetailLink(): DetailLinkValueObject
	{
		return $this->detailLink;
	}

	public function getName(): NameValueObject
	{
		return $this->name;
	}

	public function getCreatedAt(): DateTimeValueObject
	{
		return $this->createdAt;
	}
}