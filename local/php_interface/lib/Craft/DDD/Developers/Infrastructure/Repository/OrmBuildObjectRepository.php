<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\Dto\BxImageDto;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObject;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;

class OrmBuildObjectRepository implements BuildObjectRepositoryInterface
{

	public function __construct(
		protected DeveloperRepositoryInterface $developerRepository,
	)
	{
	}

	public function create(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity
	{
		$model = BuildObjectTable::createObject();

		$gallery = array_map(function(BxImageDto $image) {
			return $image->id;
		}, $buildObjectEntity->getGallery() ?? []);

		$model->setName($buildObjectEntity->getName());
		$model->setPictureId($buildObjectEntity->getPicture()->id);
		$model->setGalleryEx($gallery);
		$model->setDeveloperId($buildObjectEntity->getDeveloper()->getId());

		$result = $model->save();

		if($result->isSuccess())
		{
			$buildObjectEntity->refreshIdAfterCreate($model->getId());
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


		$developer = $this->developerRepository->findById($buildObject->getDeveloperId());

		return new BuildObjectEntity(
			$buildObject->getId(),
			$buildObject->getName(),
			$developer,
			$picture,
			$childApartmentList,
			$gallery
		);
	}
}