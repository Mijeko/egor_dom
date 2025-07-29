<?php

namespace Sprint\Migration;


class OrmCreateApartments20250622210151 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "5.0.2";

    public function up()
    {
		global $DB;

		$sql = <<<SQL
CREATE TABLE `craft_apartment` (
	`ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`NAME` varchar(256) NOT NULL,
	`EXTERNAL_ID` varchar(256) NOT NULL,
	`CODE` varchar(256) NOT NULL,
	`ACTIVE` char(1) NOT NULL DEFAULT '1',
	`SORT` int(11) NOT NULL DEFAULT '500',
	`PRICE` int(11) NOT NULL,
	`ROOMS` int(11) NULL,
	`FLOOR` int(11) NULL,
	`PLAN_IMAGE` longtext COLLATE 'utf8mb4_unicode_ci' NULL,
	`GALLERY` longtext COLLATE 'utf8mb4_unicode_ci' NULL,
	`RENOVATION` varchar(128) COLLATE 'utf8mb4_unicode_ci' NULL,
	`BUILT_YEAR` varchar(128) COLLATE 'utf8mb4_unicode_ci' NULL,
	`BUILDING_STATE` varchar(128) COLLATE 'utf8mb4_unicode_ci' NULL,
	`MORTGAGE` varchar(128) COLLATE 'utf8mb4_unicode_ci' NULL,
	`PARKING` int(2) NULL,
	`BATHROOM_UNIT` int(2) NULL,
	`AREA` longtext COLLATE 'utf8mb4_unicode_ci' NULL,
	`BUILD_OBJECT_ID` int(11) NOT NULL,
	`DESCRIPTION` varchar(255) NULL,
	`CREATED_AT` int NOT NULL,
	`UPDATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
SQL;


		$DB->Query($sql);
    }

    public function down()
    {
        //your code ...
    }
}
