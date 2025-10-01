<?php

namespace Sprint\Migration;


class OrmChatTable20250926213824 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		global $DB;
		$sql = "CREATE TABLE `craft_chat` (
	`ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`ACTIVE` char(1) NOT NULL DEFAULT '1'
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';
";

		$sql2 = "
CREATE TABLE `craft_chat_member` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CHAT_ID` int NOT NULL,
  `USER_ID` int NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';";

		$sql3 = "
CREATE TABLE `craft_chat_message` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CHAT_ID` int NOT NULL,
  `AUTHOR_USER_ID` int NOT NULL,
  `TEXT` longtext NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';";



		$DB->Query($sql);
		$DB->Query($sql2);
		$DB->Query($sql3);
	}

	public function down()
	{
		//your code ...
	}
}
