<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Infrastructure\Entity\Apartment;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\Dto\BxImageDto;

class OrmBuildObjectRepository implements BuildObjectRepositoryInterface
{

	public function findByName(string $name): ?BuildObjectEntity
	{
		return null;
	}

	public function findById(int $id): ?BuildObjectEntity
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
			/* @var \Craft\DDD\Developers\Infrastructure\Entity\BuildObject $buildObject */
			$result[] = $this->hydrateElement($buildObject);
		}

		return $result;
	}

	protected function hydrateElement(\Craft\DDD\Developers\Infrastructure\Entity\BuildObject $buildObject): BuildObjectEntity
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
		$childApartmentList = [];
		if($aps)
		{
			foreach($aps as $ap)
			{
				$childApartmentList[] = new ApartmentEntity(
					$ap->getId(),
					$buildObject->getId(),
					$ap->getName(),
					$ap->getPrice(),
				);
			}
		}

		return new BuildObjectEntity(
			$buildObject->getId(),
			$buildObject->getName(),
			$picture,
			$childApartmentList,
			$gallery
		);
	}
}