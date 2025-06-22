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
	`CODE` varchar(256) NOT NULL,
	`ACTIVE` int(1) NOT NULL DEFAULT '1',
	`SORT` int(11) NOT NULL DEFAULT '500',
	`PRICE` int(11) NOT NULL,
	`PLAN_IMAGE_ID` int NULL,
	`BUILD_OBJECT_ID` int(11) NOT NULL,
	`CREATED_AT` int NOT NULL,
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
