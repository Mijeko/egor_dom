<?php

namespace Sprint\Migration;


class OrmCreateCity20250712035612 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.0.2";

	public function up()
	{
		global $DB;

		$sql = <<<SQL
CREATE TABLE `craft_city` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NAME` varchar(128) NOT NULL,
  `CODE` varchar(128) NOT NULL,
  `ACTIVE` char(1) NOT NULL,
  `IS_DEFAULT` char(1) NOT NULL,
  `SORT` int(11) NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE='InnoDB';
SQL;

		$DB->Query($sql);

	}

	public function down()
	{
		//your code ...
	}
}
