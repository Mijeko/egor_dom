<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Импорт");

use Bitrix\Main\Loader;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Bitrix\Main\Application;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = Application::getInstance()->getContext()->getRequest();

if($request->isPost())
{

	$link = $request->getPost('source_link');

	$content = null;
	$cache = \Bitrix\Main\Data\Cache::createInstance(); // получаем экземпляр класса
	if($cache->initCache(7200, "cache_key"))
	{
		$vars = $cache->getVars();
		$content = $vars['xmlData'];
	} elseif($cache->startDataCache())
	{
		$content = file_get_contents($link);
		$cache->endDataCache(["xmlData" => $content]);
	}

	if(!$content)
	{
		LocalRedirect(CRAFT_DEVELOP_ADMIN_URL_IMPORT);
	}

	$read = new SimpleXMLElement($content);

	foreach($read->offer as $offer)
	{
		$offer = json_decode(json_encode($offer), true);

		//		\Bitrix\Main\Diag\Debug::dumpToFile($offer['sales-agent']['name']);
		//		\Bitrix\Main\Diag\Debug::dumpToFile($offer['sales-agent']['category']);
	}
}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");


?>

	<form method="post">

		<select name="developer_id">
			<option>Застройщик</option>
			<?php
			foreach(DeveloperTable::getList()->fetchCollection() as $developer)
			{
				?>
				<option value="<?=$developer->getId();?>"><?=$developer->getName();?></option>
				<?php
			}
			?>
		</select>

		<input type="text" value="<?=$request->getPost('source_link');?>" name="source_link"/>

		<button type="submit">Выполнить импорт</button>
	</form>

<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");