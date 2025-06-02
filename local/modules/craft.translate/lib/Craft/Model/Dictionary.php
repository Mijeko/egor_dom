<?php

namespace Craft\Translate\Model;

use Craft\Translate\Entity\DictionaryTable;
use Craft\Translate\Entity\EO_Dictionary;

class Dictionary extends EO_Dictionary
{

	public static function createTranslate(string $input, string $output): ?Dictionary
	{
		$model = DictionaryTable::createObject();
		$model->setInput($input);
		$model->setOutput($output);

		if($model->save()->isSuccess())
		{
			return $model;
		}

		return null;
	}

}