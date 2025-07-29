<?php

namespace Craft\DDD\User\Infrastructure\Dto;

use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\Shared\Dto\EmailDto;
use Craft\DDD\Shared\Dto\PhoneDto;
use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\Dto\BxImageDto;

class ManagerDto
{
	public function __construct(
		public int         $id,
		public string      $name,
		public ?string     $lastName,
		public ?string     $secondName,
		public ?array      $phoneList,
		public ?array      $emailList,
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
			array_map(function(PhoneValueObject $phone) {
				return new PhoneDto($phone->getPhone());
			}, $entity->getPhones() ?? []),
			[
				new EmailDto(
					$entity->getEmail()->getValue(),
				),
			],
			$avatarDto
		);
	}
}