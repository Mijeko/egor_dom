<?php

namespace Sprint\Migration;


class OrmCreateDeveloperTable20250609105230 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.0.2";

	public function up()
	{
		global $DB;
		$sql = <<<SQL
CREATE TABLE `craft_developers` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NAME` varchar(128) NOT NULL,
  `ACTIVE` int(1) NOT NULL,
  `SORT` int(11) NOT NULL,
  `PICTURE_ID` int(11) NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL
) ENGINE='InnoDB';
SQL;

		$DB->Query($sql);
	}

	public function down()
	{
		//your code ...
	}
}
