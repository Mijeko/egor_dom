<?php

namespace Craft\Translate\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Craft\Translate\Collection\DictionaryCollection;
use Craft\Translate\Model\Dictionary;

class DictionaryTable extends DataManager
{

	const FIELD_ID = 'ID';
	const FIELD_ACTIVE = 'ACTIVE';
	const FIELD_SKIP_TRANSLATE = 'SKIP_TRANSLATE';
	const FIELD_INPUT = 'INPUT';
	const FIELD_OUTPUT = 'OUTPUT';


	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	const SKIP_TRANSLATE_Y = 'Y';
	const SKIP_TRANSLATE_N = 'N';


	public static function getTableName()
	{
		return 'craft_dictionary_translate_table';
	}


	public static function getMap()
	{
		return [
			(new IntegerField(self::FIELD_ID))
				->configurePrimary()
				->configureTitle('ID'),
			(new BooleanField(self::FIELD_ACTIVE))
				->configureDefaultValue(self::ACTIVE_Y)
				->configureValues(self::ACTIVE_N, self::ACTIVE_Y)
				->configureTitle('Активность'),
			(new BooleanField(self::FIELD_SKIP_TRANSLATE))
				->configureDefaultValue(self::SKIP_TRANSLATE_N)
				->configureValues(self::SKIP_TRANSLATE_N, self::SKIP_TRANSLATE_Y)
				->configureTitle('Не переводить'),
			(new StringField(self::FIELD_INPUT))
				->configureRequired()
				->configureTitle('Исходный текст'),
			(new StringField(self::FIELD_OUTPUT))
				->configureRequired()
				->configureTitle('Перевод'),
		];
	}

	public static function getObjectClass()
	{
		return Dictionary::class;
	}

	public static function getCollectionClass()
	{
		return DictionaryCollection::class;
	}
}