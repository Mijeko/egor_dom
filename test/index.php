<?php

if(empty($_SERVER['DOCUMENT_ROOT']))
{
	$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);
}

use Craft\DDD\Stream\Application\Factory\ChatUseCaseFactory;
use Craft\Socket\Server;
use Workerman\Connection\TcpConnection;


define('NEED_AUTH', false);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

global $USER;
$uid = $USER->GetID();

\Bitrix\Main\Diag\Debug::dumpToFile($uid);

$server = new Server();
$server
	->build()
	->onConnect(function(TcpConnection $connection, Server $server) use ($uid) {
		
		$customData = $server->getCustomData();

		$customData['uid'] = $customData['uid'] ?? [];
		$customData['uid'][] = $uid;

		$server->setCustomData($customData);

	})
	->handlers([
		function(TcpConnection $connection, $request, Server $server) {
			$acceptData = null;
			if(json_validate($request))
			{
				$acceptData = json_decode($request, true);
			}

			$service = ChatUseCaseFactory::getUseCase();
			$service->sendMessage(
				$acceptData['sendUserId'],
				$acceptData['acceptUserId'],
				$acceptData['message'],
			);


			$connection->send('hello world');

			\Bitrix\Main\Diag\Debug::dumpToFile($server->getCustomData());

			foreach($server->getWorker()->connections as $conn)
			{
				$conn->send(json_encode([
					'action' => 'refreshStream',
				]));


				//			$conn->send("user[{$connection->uid}] сказал: " . rand());
			}
		},
	])
	->run();
