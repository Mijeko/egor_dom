<?php

namespace Craft\DDD\User\Infrastructure\Dto;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\Shared\Presentation\Dto\EmailDto;
use Craft\DDD\Shared\Presentation\Dto\PhoneDto;
use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\Dto\BxImageDto;

final class ManagerDto
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

	public static function fromEntity(ManagerEntity $entity): ManagerDto
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

		return new ManagerDto(
			$entity->getId(),
			$entity->getName(),
			$entity->getLastName(),
			$entity->getSecondName(),
			array_map(function(PhoneValueObject $phone) {
				return new PhoneDto($phone->getValue());
			}, $entity->getAdditionalPhones() ?? []),
			array_map(function(EmailValueObject $email) {
				return new EmailDto(
					$email->getValue(),
				);
			}, $entity->getAdditionalEmailList()),
			$avatarDto
		);
	}
}