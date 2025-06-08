<?php

namespace Sprint\Migration;


class OrmCreateClaimTable20250608215116 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.0.2";

	public function up()
	{
		$sql = <<<SQL
CREATE TABLE `craft_claims` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ACTIVE` int NOT NULL,
  `NAME` varchar(128) NOT NULL,
  `USER_ID` int NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL
) ENGINE='InnoDB';
SQL;


		global $DB;
		$DB->Query($sql);

	}

	public function down()
	{
		//your code ...
	}
}
