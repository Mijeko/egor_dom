<?php

namespace Sprint\Migration;


class OrmCreateBuildObject20250609111438 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.0.2";

	public function up()
	{
		global $DB;
		$sql = <<<SQL
CREATE TABLE `craft_build_objects` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `DEVELOPER_ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `SORT` int NOT NULL,
  `FLOORS` int NULL,
  `NAME` varchar(128) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `TYPE` varchar(128) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `GALLERY` longtext COLLATE 'utf8mb4_unicode_ci' NULL,
  `DESCRIPTION` longtext COLLATE 'utf8mb4_unicode_ci' NULL,
  `LOCATION` longtext COLLATE 'utf8mb4_unicode_ci' NULL,
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
