<?php

use Craft\Core\Helper\IblockHelper;
use Craft\Core\Helper\UserGroupHelper;

define('IBLOCK_ID_FEEDBACK', IblockHelper::getIblockIdByCode('feedback'));
define('SMARTCAPTCHA_CLIENT_KEY', 'ysc1_dRmWTVxaOLruU0d64eTtcHtCALp83H5fXKdZzKVWd2f1dac9');
define('SMARTCAPTCHA_SERVER_KEY', 'ysc2_dRmWTVxaOLruU0d64eTtWu3xscbim7gcstgjCPkmd1cee5fb');

// groups
define('USER_GROUP_JUR_PERSON_ID', UserGroupHelper::findByCode('NO_USE_HOME_SELLER'));
define('USER_GROUP_PHYS_PERSON_ID', UserGroupHelper::findByCode('NO_USE_STUDENT'));


define('USER_GROUP_DEVELOPER', UserGroupHelper::findByCode('DEVELOPER'));
define('USER_GROUP_MANAGER', UserGroupHelper::findByCode('MANAGER'));
define('USER_GROUP_EXTERNAL_REALTOR', UserGroupHelper::findByCode('EXTERNAL_REALTOR'));
define('USER_GROUP_STUDENT', UserGroupHelper::findByCode('STUDENT'));
define('USER_GROUP_AGENT', UserGroupHelper::findByCode('AGENT'));


// iblock id


# Недвижимость->Объекты
define('BUILD_OBJECT_IBLOCK_ID', IblockHelper::getIblockIdByCode('immovables_objects'));
define('BUILD_DEVELOPERS_IBLOCK_ID', IblockHelper::getIblockIdByCode('immovables_developers'));