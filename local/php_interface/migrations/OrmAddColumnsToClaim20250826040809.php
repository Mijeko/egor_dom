<?php

namespace Sprint\Migration;


class OrmAddColumnsToClaim20250826040809 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$sql = "ALTER TABLE `craft_claims`
ADD `IS_CLOSED` char(1) NOT NULL AFTER `APARTMENT_ID`,
ADD `IS_MONEY_RECEIVED` char(1) NOT NULL AFTER `IS_CLOSED`;";
		global $DB;
		$DB->Query($sql);


		$sql2 = "ALTER TABLE `craft_claims`
ADD `COST_REWARD` bigint NULL AFTER `IS_MONEY_RECEIVED`;";

		$DB->Query($sql2);
	}

	public function down()
	{
		//your code ...
	}
}
