<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php'); ?>
<?php

use Bitrix\Main\Application;
use Craft\Core\Rest\Response;
use Bitrix\Main\Security\Password;
use Craft\User\Domain\Entity\SocialType;
use Craft\User\Application\Auth\Social\VkAuthorization;
use Craft\User\Application\Service\RegisterFactory;

$request = Application::getInstance()->getContext()->getRequest();

$code = $request->get('code');

if(!$code)
{
	Response::badRequest();
}


if(!\Bitrix\Main\Loader::includeModule('craft.user'))
{
	Response::badRequest();
}

try
{
	$vk = new VkAuthorization();
	$accessToken = $vk->getAccessToken($code);


	var_dump($accessToken->getRefreshToken());

	$userInfo = $vk->userInfo($accessToken->getAccessToken());


	$reg = RegisterFactory::create();
	$user = $reg->registerUser(
		$userInfo->getEmail(),
		'89967026637',
		Password::hash(rand()),
	);


	$reg->addUserSocial(
		$user,
		$userInfo->getUserId(),
		new SocialType($vk->label())
	);


} catch(Exception $exception)
{
	\Bitrix\Main\Diag\Debug::dump($exception->getMessage());
}
?>
