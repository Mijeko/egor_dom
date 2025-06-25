<?php

namespace Craft\DDD\Objects\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Apartment\Domain\Entity\ApartmentEntity;
use Craft\DDD\Apartment\Infrastructure\Entity\Apartment;
use Craft\DDD\Objects\Domain\Entity\BuildObject;
use Craft\DDD\Objects\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Objects\Infrastructure\Entity\BuildObjectTable;
use Craft\Dto\BxImageDto;

class OrmBuildObjectRepository implements BuildObjectRepositoryInterface
{


	public function findById(int $id): ?BuildObject
	{
		$model = BuildObjectTable::getByPrimary($id)->fetchObject();
		if(!$model)
		{
			return null;
		}

		return $this->hydrateElement($model);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		$result = [];
		$query = BuildObjectTable::getList([
			'order'  => $order,
			'filter' => $filter,
		]);

		foreach($query->fetchCollection() as $buildObject)
		{
			/* @var \Craft\DDD\Objects\Infrastructure\Entity\BuildObject $buildObject */
			$result[] = $this->hydrateElement($buildObject);
		}

		return $result;
	}

	protected function hydrateElement(\Craft\DDD\Objects\Infrastructure\Entity\BuildObject $buildObject): BuildObject
	{
		$_picture = \CFile::GetFileArray($buildObject->getPictureId());
		$picture = null;
		if($_picture)
		{
			$picture = new BxImageDto(
				$_picture['ID'],
				$_picture['SRC'],
			);
		}

		$gallery = array_map(
			function($fileId) {
				$file = \CFile::GetFileArray($fileId);
				if($file)
				{
					return new BxImageDto(
						$file['ID'],
						$file['SRC'],
					);
				}

				return null;
			},
			$buildObject->getGalleryEx()
		);
		# clear null values
		$gallery = array_filter($gallery);


		$aps = $buildObject->fillApartments();
		$_aps = [];
		if($aps)
		{
			foreach($aps as $ap)
			{
				$_aps[] = new ApartmentEntity(
					$ap->getId(),
					$ap->getName(),
					$ap->getPrice(),
				);
			}
		}

		return new BuildObject(
			$buildObject->getId(),
			$buildObject->getName(),
			$picture,
			$_aps,
			$gallery
		);
	}
}