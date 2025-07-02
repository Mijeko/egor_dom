<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;
use Craft\Dto\BxImageDto;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObject;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;

class OrmBuildObjectRepository implements BuildObjectRepositoryInterface
{
	public function create(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity
	{
		$model = BuildObjectTable::createObject();

		$gallery = array_map(function(?ImageGalleryValueObject $image) {
			if($image)
			{
				return ['ID' => $image->getId()];
			}

			return null;
		}, $buildObjectEntity->getGallery()->getImages() ?? []);

		$model->setGalleryEx($gallery);
		$model->setLocationEx($buildObjectEntity->getLocation());

		$model->setName($buildObjectEntity->getName());
		$model->setDeveloperId($buildObjectEntity->getDeveloper()->getId());
		$model->setFloors($buildObjectEntity->getFloors());
		$model->setType($buildObjectEntity->getType());


		$result = $model->save();

		if($result->isSuccess())
		{
			$buildObjectEntity->refreshId($model->getId());
			return $buildObjectEntity;
		}

		throw new \Exception(implode("\n", $result->getErrorMessages()));
	}

	public function findByName(string $name): ?BuildObjectEntity
	{
		$model = BuildObjectTable::getList([
			'filter' => [
				BuildObjectTable::F_NAME => $name,
			],
		])->fetchObject();

		if(!$model)
		{
			return null;
		}

		return $this->hydrateElement($model);
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
			/* @var BuildObject $buildObject */
			$result[] = $this->hydrateElement($buildObject);
		}

		return $result;
	}

	protected function hydrateElement(BuildObject $buildObject): BuildObjectEntity
	{
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


		$apartments = $buildObject->fillApartments();
		$childApartmentList = [];
		if($apartments)
		{
			foreach($apartments as $apartment)
			{
				$childApartmentList[] = new ApartmentEntity(
					$apartment->getId(),
					null,
					$apartment->getName(),
					$apartment->getPrice(),
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
				);
			}
		}

		return new BuildObjectEntity(
			$buildObject->getId(),
			$buildObject->getName(),
			$buildObject->getType(),
			$buildObject->getFloors(),
			null,
			$buildObject->getDeveloperId(),
			null,
			null,
			null,
		);
	}
}