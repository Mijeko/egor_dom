<?php

if(empty($_SERVER['DOCUMENT_ROOT']))
{
	$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);
}

use Craft\DDD\Stream\Application\Factory\ChatServiceFactory;
use Craft\DDD\Stream\Application\Factory\ChatUseCaseFactory;
use Craft\Socket\Server;
use Workerman\Connection\TcpConnection;


define('NEED_AUTH', false);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$server = new Server();
$server
	->build()
	->handlers([
		function(TcpConnection $connection, $request, Server $server) {
			$acceptData = null;
			if(json_validate($request))
			{
				$acceptData = json_decode($request, true);
			}

			$service = ChatUseCaseFactory::getUseCase();
			$service->sendMessage(
				$acceptData['chatId'],
				$acceptData['sendUserId'],
				$acceptData['acceptUserId'],
				$acceptData['message'],
			);


			$service = ChatServiceFactory::getService();
			foreach($server->getWorker()->connections as $tcpConnection)
			{
				$tcpConnection->send(json_encode([
					'action' => 'refreshStream',
					'chats'  => $service->findAll(),
				]));
			}
		},
	])
	->run();
