<?php

namespace Sprint\Migration;


use Bitrix\Main\Type\DateTime;
use Craft\DDD\UserBehavior\Infrastructure\Entity\ViewedProductTable;

class FixTime20260107143229 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		foreach(ViewedProductTable::getList()->fetchCollection() as $viewedProduct)
		{
			$viewedProduct->setCreatedAt(new DateTime());
			$viewedProduct->save();
		}
	}

	public function down()
	{
		//your code ...
	}
}
