<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Loader;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\Dto\BxImageDto;

class IblockBuildObjectOrmRepository implements BuildObjectRepositoryInterface
{
	public function __construct(
		protected int $iblockId
	)
	{
	}

	public function findById(int $id): ?BuildObjectEntity
	{
		if(!Loader::includeModule('iblock'))
		{
			return null;
		}


		$filter = array_merge(
			[
				'ID'        => $id,
				'IBLOCK_ID' => $this->iblockId,
			],
		);


		$select = array_merge(
			[
				'*',
			],
			$this->propertiesForSelect()
		);


		$query = \CIBlockElement::GetList(
			[],
			$filter,
			false,
			false,
			$select
		);


		if($query->SelectedRowsCount() != 1)
		{
			return null;
		}

		$rawIblockElement = $query->GetNext();


		if(empty($rawIblockElement['ID']))
		{
			return null;
		}

		return $this->hydrateElement($rawIblockElement);

	}

	public function findAll(array $order = [], array $filter = []): array
	{
		if(!Loader::includeModule('iblock'))
		{
			return [];
		}

		$baseFilter = array_merge(
			[
				'IBLOCK_ID' => $this->iblockId,
			],
			array_map(function(string $propertyCode) { return 'PROPERTY_' . $propertyCode; }, $this->properties()),
			$filter
		);


		$query = \CIBlockElement::GetList(
			array_merge(
				[],
				$order
			),
			$baseFilter
		);

		$result = [];

		while($element = $query->GetNext())
		{
			$result[] = $this->hydrateElement($element);
		}

		return $result;
	}

	protected function propertiesForSelect(): array
	{
		$properties = $this->properties();

		return array_map(function(array $property) {

			if($property['TYPE'] == 'E')
			{
				return 'PROPERTY_' . $property['CODE'] . '_VALUE';
			}

			return 'PROPERTY_' . $property['CODE'];
		}, $properties);
	}

	protected function properties(): array
	{
		$result = [];

		$properties = \CIBlockProperty::GetList(
			[],
			[
				'IBLOCK_ID' => $this->iblockId,
			]
		);

		while($property = $properties->GetNext())
		{
			$result[$property['CODE']] = $property;
		}

		return $result;
	}

	protected function hydrateElement(array $element): BuildObjectEntity
	{

		Debug::dump($element);

		$_picture = \CFile::GetFileArray($element['DETAIL_PICTURE']);
		$picture = null;
		if($_picture)
		{
			$picture = new BxImageDto(
				$_picture['ID'],
				$_picture['SRC'],
			);
		}

		return new BuildObjectEntity(
			$element['ID'],
			$element['NAME'],
			$picture,
		);
	}

	public function findByName(string $name): ?BuildObjectEntity
	{
		return null;
	}

	public function create(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity
	{
		return null;
	}
}