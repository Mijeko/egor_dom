<?php

namespace Sprint\Migration;


class OrmCreateReferralTable20250831092725 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$sql = "CREATE TABLE `craft_referral` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `USER_ID` int NOT NULL,
  `INVITED_USER_ID` int NULL,
  `CODE` varchar(128) NOT NULL,
  `PHONE` varchar(64) NOT NULL,
  `ACTIVE` char NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';";

		global $DB;

		$DB->Query($sql);
	}

	public function down()
	{
		//your code ...
	}
}
