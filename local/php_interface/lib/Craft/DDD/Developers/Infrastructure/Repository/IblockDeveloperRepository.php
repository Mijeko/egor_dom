<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Bitrix\Main\Loader;
use CIBlockElement;
use Craft\DDD\Developers\Domain\Entity\Developer;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\Dto\BxImage;

class IblockDeveloperRepository implements DeveloperRepositoryInterface
{

	public function __construct(
		protected int $iblockId
	)
	{
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		if(!Loader::includeModule('iblock'))
		{
			return [];
		}


		$result = [];
		$query = CIBlockElement::GetList(
			array_merge(
				[],
				$order
			),
			array_merge(
				[
					'ACTIVE'    => 'Y',
					'IBLOCK_ID' => $this->iblockId,
				],
				$filter
			),
		);
		while($element = $query->GetNext())
		{
			$result[] = $this->mapElement($element);
		}

		return $result;
	}

	protected function mapElement(array $element)
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

		return new Developer(
			$element['ID'],
			$element['NAME'],
			$picture,
		);
	}
}