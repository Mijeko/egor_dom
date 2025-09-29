<?php

namespace Sprint\Migration;


class OrmChatTable20250926213824 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$sql = "CREATE TABLE `craft_chat` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`ACTIVE` char(1) NOT NULL DEFAULT '1',
  `USER_ID` int NOT NULL,
  `ACCEPT_USER_ID` int NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';
";

		global $DB;

		$DB->Query($sql);

		$sql2 = "
CREATE TABLE `craft_chat_message` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CHAT_ID` int NOT NULL,
  `TEXT` longtext NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';";

		$DB->Query($sql2);
	}

	public function down()
	{
		//your code ...
	}
}
