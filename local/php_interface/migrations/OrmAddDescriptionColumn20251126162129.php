<?php

namespace Sprint\Migration;


class OrmAddDescriptionColumn20251126162129 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "5.4.1";

    public function up()
    {
		$sql = "ALTER TABLE `craft_developers`
ADD `DESCRIPTION` varchar(255) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `NAME`;";

		global $DB;

		$DB->Query($sql);
    }

    public function down()
    {
        //your code ...
    }
}
