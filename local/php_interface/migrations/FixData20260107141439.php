<?php

namespace Sprint\Migration;


use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\UserBehavior\Infrastructure\Entity\ViewedProductTable;

class FixData20260107141439 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$els = ViewedProductTable::getList()->fetchCollection();
		foreach($els as $el)
		{
			$productId = $el->getProductId();

			$bo = BuildObjectTable::getByPrimary($productId)->fetchObject();
			if(!$bo)
			{
				continue;
			}

			$el->setName($bo->getName());
			$el->setLink('/objects/' . $bo->getId() . '/');

			$el->save();
		}
	}

	public function down()
	{
		//your code ...
	}
}
