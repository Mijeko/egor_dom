<?php

namespace Sprint\Migration;


class OrmAddSettingsColumnToDeveloperTable20251017084956 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$sql = "ALTER TABLE `craft_developers`
ADD `SETTINGS` longtext COLLATE 'utf8mb4_general_ci' NULL AFTER `IMPORT_SETTINGS`;";

		global $DB;

		$DB->Query($sql);
	}

	public function down()
	{
	}
}
