<?php

namespace Craft\DDD\Objects\Infrastructure\Repository;

use Bitrix\Main\Loader;
use Craft\DDD\Objects\Domain\Entity\BuildObject;
use Craft\DDD\Objects\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\Dto\BxImage;

class IblockBuildOrmRepository implements BuildObjectRepositoryInterface
{
	public function __construct(
		protected int $iblockId
	)
	{
	}

	public function findById(int $id): ?BuildObject
	{
		if(!Loader::includeModule('iblock'))
		{
			return null;
		}

		$query = \CIBlockElement::GetList(
			[],
			[
				'ID'        => $id,
				'IBLOCK_ID' => $this->iblockId,
			]
		);

		if($query->SelectedRowsCount() != 1)
		{
			return null;
		}

		$el = $query->GetNext();

		if(empty($el['ID']))
		{
			return null;
		}

		return $this->mapElement($el);

	}

	public function findAll(array $order = [], array $filter = []): array
	{
		if(!Loader::includeModule('iblock'))
		{
			return [];
		}

		$query = \CIBlockElement::GetList(
			array_merge(
				[],
				$order
			),
			array_merge(
				[
					'IBLOCK_ID' => $this->iblockId,
				],
				$filter
			)
		);

		$result = [];

		while($element = $query->GetNext())
		{
			$result[] = $this->mapElement($element);
		}

		return $result;
	}

	protected function mapElement(array $element): BuildObject
	{
		$_picture = \CFile::GetFileArray($element['DETAIL_PICTURE']);
		$picture = null;
		if($_picture)
		{
			$picture = new BxImage(
				$_picture['ID'],
				$_picture['SRC'],
			);
		}

		return new BuildObject(
			$element['ID'],
			$element['NAME'],
			$picture,
		);
	}
}