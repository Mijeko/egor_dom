<?php

namespace Craft\DDD\User\Infrastructure\Dto;

use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\Dto\BxImageDto;

class ManagerDto
{
	public function __construct(
		public int         $id,
		public string      $name,
		public ?string     $lastName,
		public ?string     $secondName,
		public ?array      $phones,
		public ?BxImageDto $avatar,
	)
	{
	}

	public static function fromEntity(ManagerEntity $entity): static
	{
		$avatarDto = null;

		$avatar = $entity->getAvatar();
		if($avatar)
		{
			$avatarDto = new BxImageDto(
				$avatar->getId(),
				$avatar->getSrc(),
			);
		}

		return new static(
			$entity->getId(),
			$entity->getName(),
			$entity->getLastName(),
			$entity->getSecondName(),
			$entity->getPhones(),
			$avatarDto
		);
	}
}