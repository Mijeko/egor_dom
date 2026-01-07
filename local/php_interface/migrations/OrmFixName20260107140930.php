<?php

namespace Sprint\Migration;


class OrmFixName20260107140930 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "5.4.1";

    public function up()
    {
		$sql = "ALTER TABLE `craft_favorite_product`
RENAME TO `craft_viewed_product`;";

		global $DB;

		$DB->Query($sql);
    }

    public function down()
    {
        //your code ...
    }
}
