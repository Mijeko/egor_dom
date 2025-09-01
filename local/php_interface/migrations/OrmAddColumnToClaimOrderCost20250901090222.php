<?php

namespace Sprint\Migration;


class OrmAddColumnToClaimOrderCost20250901090222 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		global $DB;
		$sql = "ALTER TABLE `craft_claims`
ADD `ORDER_COST` bigint(20) NULL AFTER `COST_REWARD`;";

		$DB->Query($sql);
	}

	public function down()
	{
		//your code ...
	}
}
