<?php

namespace Sprint\Migration;


class OrmAddColumnCreatedAt20260107142335 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$sql = "ALTER TABLE `craft_viewed_product`
ADD `CREATED_AT` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP;";

		global $DB;

		$DB->Query($sql);
	}

	public function down()
	{
		//your code ...
	}
}
