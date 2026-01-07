<?php

namespace Sprint\Migration;


class OrmAddViewedTableColumns20260107140357 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$sql = "ALTER TABLE `craft_favorite_product`
ADD `NAME` varchar(255) NOT NULL,
ADD `LINK` varchar(255) NOT NULL AFTER `NAME`;";

		global $DB;

		$DB->Query($sql);
	}

	public function down()
	{
		//your code ...
	}
}
