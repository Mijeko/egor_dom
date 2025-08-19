<?php

namespace Sprint\Migration;


class OrmCreateFavoriteProduct20250819074602 extends Version
{
	protected $author = "admin";

	protected $description = "";

	protected $moduleVersion = "5.4.1";

	public function up()
	{
		$sql = "CREATE TABLE craft_favorite_product (
    PRODUCT_ID INT NOT NULL,
    USER_ID INT NOT NULL,
    PRIMARY KEY (PRODUCT_ID, USER_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

		global $DB;

		$DB->Query($sql);
	}

	public function down()
	{
		//your code ...
	}
}
