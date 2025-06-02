<?php

namespace Craft\Translate\Service;

use Craft\Translate\Entity\DictionaryTable;
use Craft\Translate\Model\Dictionary;

class Translate
{
	protected static $instance;

	public static function instance(): Translate
	{
		if(is_null(self::$instance))
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function make(string $input): ?string
	{

		$translateQuery = DictionaryTable::getList([
			'select' => [
				DictionaryTable::FIELD_INPUT => $input,
			],
		])->fetchCollection();

		if($translateQuery->count() === 1)
		{
			$translate = $translateQuery->getAll();
			$translate = $translate[0];

			/* @var Dictionary $translate */

			return $translate->getOutput();
		}

		if($translateQuery->count() === 0)
		{
			$dictionary = Dictionary::createTranslate($input, $this->translateText($input));
			if($dictionary instanceof Dictionary)
			{
				return $dictionary->getOutput();
			}
		}


		return null;
	}

	protected function translateText(string $input): ?string
	{
		return TranslateText::instance()->translate($input);
	}
}