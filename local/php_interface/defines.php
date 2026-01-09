<?php

use Craft\Core\Helper\IblockHelper;
use Craft\Core\Helper\UserGroupHelper;

define('IBLOCK_ID_FEEDBACK', IblockHelper::getIblockIdByCode('feedback'));
define('SMARTCAPTCHA_CLIENT_KEY', 'ysc1_dRmWTVxaOLruU0d64eTtcHtCALp83H5fXKdZzKVWd2f1dac9');
define('SMARTCAPTCHA_SERVER_KEY', 'ysc2_dRmWTVxaOLruU0d64eTtWu3xscbim7gcstgjCPkmd1cee5fb');

// groups
define('USER_GROUP_JUR_PERSON_ID', UserGroupHelper::findByCode('NO_USE_HOME_SELLER'));
define('USER_GROUP_PHYS_PERSON_ID', UserGroupHelper::findByCode('NO_USE_STUDENT'));


# old
define('USER_GROUP_MANAGER', UserGroupHelper::findByCode('MANAGER'));
define('USER_GROUP_EXTERNAL_REALTOR', UserGroupHelper::findByCode('EXTERNAL_REALTOR'));
define('USER_GROUP_STUDENT', UserGroupHelper::findByCode('STUDENT'));
define('USER_GROUP_AGENT', UserGroupHelper::findByCode('AGENT'));

# new
define('USER_GROUP_BUYER', UserGroupHelper::findByCode('AGENT'));				# Покупатель (buyer) - базовый пользователь с правами на покупку
define('USER_GROUP_REALTOR', UserGroupHelper::findByCode('AGENT'));			# Риэлтор (realtor) - профессиональный агент с правами на консультации
define('USER_GROUP_DEVELOPER', UserGroupHelper::findByCode('DEVELOPER'));		# Застройщик (developer) - B2B-партнер с правами на публикацию новостроек
define('USER_GROUP_LAWYER', UserGroupHelper::findByCode('AGENT'));			# Юрист/Эксперт (lawyer) - специалист с правами на консультации и экспертный контент

// iblock id
# Недвижимость->Объекты
define('BUILD_OBJECT_IBLOCK_ID', IblockHelper::getIblockIdByCode('immovables_objects'));
define('BUILD_DEVELOPERS_IBLOCK_ID', IblockHelper::getIblockIdByCode('immovables_developers'));