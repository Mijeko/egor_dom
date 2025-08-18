<?php

define('IBLOCK_ID_FEEDBACK', \Craft\Core\Helper\IblockHelper::getIblockIdByCode('feedback'));
define('SMARTCAPTCHA_CLIENT_KEY', 'ysc1_dRmWTVxaOLruU0d64eTtcHtCALp83H5fXKdZzKVWd2f1dac9');
define('SMARTCAPTCHA_SERVER_KEY', 'ysc2_dRmWTVxaOLruU0d64eTtWu3xscbim7gcstgjCPkmd1cee5fb');

// groups
define('USER_GROUP_JUR_PERSON_ID', \Craft\Core\Helper\UserGroupHelper::findByCode('NO_USE_HOME_SELLER'));
define('USER_GROUP_PHYS_PERSON_ID', \Craft\Core\Helper\UserGroupHelper::findByCode('NO_USE_STUDENT'));


define('USER_GROUP_MANAGER', \Craft\Core\Helper\UserGroupHelper::findByCode('MANAGER'));
define('USER_GROUP_EXTERNAL_REALTOR', \Craft\Core\Helper\UserGroupHelper::findByCode('EXTERNAL_REALTOR'));
define('USER_GROUP_STUDENT', \Craft\Core\Helper\UserGroupHelper::findByCode('STUDENT'));
define('USER_GROUP_AGENT', \Craft\Core\Helper\UserGroupHelper::findByCode('AGENT'));


// iblock id


# Недвижимость->Объекты
define('BUILD_OBJECT_IBLOCK_ID', \Craft\Core\Helper\IblockHelper::getIblockIdByCode('immovables_objects'));
define('BUILD_DEVELOPERS_IBLOCK_ID', \Craft\Core\Helper\IblockHelper::getIblockIdByCode('immovables_developers'));