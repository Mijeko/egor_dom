<?php

namespace Sprint\Migration;


class OrmAddColumnToClaimManagerId20250916072715 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$sql = "ALTER TABLE `craft_claims`
ADD `MANAGER_ID` int(11) NOT NULL AFTER `USER_ID`;";

		global $DB;
		$DB->Query($sql);
	}

	public function down()
	{
		//your code ...
	}
}
