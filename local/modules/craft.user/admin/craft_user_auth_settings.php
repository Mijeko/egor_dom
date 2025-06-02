<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\User\Admin\Settings\VkClientId;
use Craft\User\Admin\Settings\VkClientSecret;
use Craft\User\Admin\Settings\AvailableSocial;
use Craft\User\Admin\Settings\GoogleClientId;
use Craft\User\Admin\Settings\GoogleClientSecret;
use Craft\User\Admin\Settings\VkRedirectUrl;
use Craft\User\Admin\Settings\GoogleRedirectUrl;

/**
 * @global CMain $APPLICATION
 */
$APPLICATION->SetTitle("Пользователи - настройки");

foreach(['craft.user'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	}
}


$request = Application::getInstance()->getContext()->getRequest();

if($request->isPost())
{
	$availableSocial = $request->getPost(AvailableSocial::instance()->name());
	if($availableSocial && is_array($availableSocial) && count($availableSocial) > 0)
	{
		AvailableSocial::instance()->save($availableSocial);
	}

	$vkClientId = $request->getPost(VkClientId::instance()->name());
	if($vkClientId)
	{
		VkClientId::instance()->save($vkClientId);
	}

	$vkClientSecret = $request->getPost(VkClientSecret::instance()->name());
	if($vkClientSecret)
	{
		VkClientSecret::instance()->save($vkClientSecret);
	}

	$googleClientId = $request->getPost(GoogleClientId::instance()->name());
	if($googleClientId)
	{
		GoogleClientId::instance()->save($googleClientId);
	}

	$googleClientSecret = $request->getPost(GoogleClientSecret::instance()->name());
	if($googleClientSecret)
	{
		GoogleClientSecret::instance()->save($googleClientSecret);
	}

	$googleRedirectUrl = $request->getPost(GoogleRedirectUrl::instance()->name());
	if($googleRedirectUrl)
	{
		GoogleRedirectUrl::instance()->save($googleRedirectUrl);
	}

	$vkRedirectUrl = $request->getPost(VkRedirectUrl::instance()->name());
	if($vkRedirectUrl)
	{
		VkRedirectUrl::instance()->save($vkRedirectUrl);
	}

	LocalRedirect(CRAFT_USER_ADMIN_URL_LIST_AREA);
}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Настройки',
		"ICON"  => "iblock_section",
		"TITLE" => 'Настройки',
	],
];
$tabControl = new CAdminTabControl("tabControl", $aTabs);
?>


	<form name="main_options" method="POST" action="<?=$APPLICATION->GetCurPage()?>">
		<?=bitrix_sessid_post()?>
		<?php
		$tabControl->Begin();

		$tabControl->BeginNextTab();
		?>
		<tr class="heading">
			<td colspan="2"><b>Параметры авторизации</b></td>
		</tr>
		<tr>
			<td width="50%">Разрешенные социальные сети</td>
			<td width="50%">
				<select name="<?=AvailableSocial::instance()->name();?>[]" multiple size="15">
					<?php
					$currentValue = AvailableSocial::instance()->value();
					foreach(AvailableSocial::list() as $key => $social)
					{
						$selected = false;

						if(is_array($currentValue) && in_array($key, $currentValue))
						{
							$selected = true;
						} elseif($key == $currentValue)
						{
							$selected = true;
						}
						?>
						<option
							<?=$selected ? 'selected' : '';?>
							value="<?=$key?>"
						>
							<?=$social?>
						</option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>


		<?php
		if($social = AvailableSocial::instance()->value())
		{
			?>
			<tr class="heading">
				<td colspan="2"><b>Настройки авторизации</b></td>
			</tr>
			<?php

			foreach($social as $value)
			{
				switch($value)
				{
					case AvailableSocial::V_VK:
						?>
						<tr class="heading">
							<td colspan="2"><b>Настройки <?=AvailableSocial::instance()->label($value);?></b></td>
						</tr>
						<tr>
							<td width="50%">
								Client ID
							</td>
							<td width="50%">
								<input
									type="text"
									name="<?=VkClientId::instance()->name();?>"
									value="<?=VkClientId::instance()->value();?>"
								>
							</td>
						</tr>
						<tr>
							<td width="50%">
								Client secret
							</td>
							<td width="50%">
								<input
									type="text"
									name="<?=VkClientSecret::instance()->name();?>"
									value="<?=VkClientSecret::instance()->value();?>"
								>
							</td>
						</tr>
						<tr>
							<td width="50%">
								Redirect Url
							</td>
							<td width="50%">
								<input
									type="text"
									name="<?=VkRedirectUrl::instance()->name();?>"
									value="<?=VkRedirectUrl::instance()->value();?>"
								>
							</td>
						</tr>
						<?php
						break;
					case AvailableSocial::V_GOOGLE:
						?>
						<tr class="heading">
							<td colspan="2"><b>Настройки <?=AvailableSocial::instance()->label($value);?></b></td>
						</tr>
						<tr>
							<td width="50%">
								Client ID
							</td>
							<td width="50%">
								<input
									type="text"
									name="<?=GoogleClientId::instance()->name();?>"
									value="<?=GoogleClientId::instance()->value();?>"
								>
							</td>
						</tr>
						<tr>
							<td width="50%">
								Client secret
							</td>
							<td width="50%">
								<input
									type="text"
									name="<?=GoogleClientSecret::instance()->name();?>"
									value="<?=GoogleClientSecret::instance()->value();?>"
								>
							</td>
						<tr>
							<td width="50%">
								Redirect Url
							</td>
							<td width="50%">
								<input
									type="text"
									name="<?=GoogleRedirectUrl::instance()->name();?>"
									value="<?=GoogleRedirectUrl::instance()->value();?>"
								>
							</td>
						</tr>
						<?php
						break;
				}
			}
		}
		?>

		<?php
		$tabControl->EndTab();
		?>

	</form>
<?php $tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_USER_ADMIN_URL_LIST_AREA,
]); ?>

<?php $tabControl->End(); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
