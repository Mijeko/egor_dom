<?php

namespace Craft\Socket;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Stream\Application\Factory\ChatUseCaseFactory;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Worker;

class Server
{

	public function run(
		string $host = "websocket://0.0.0.0:8686/",
	): void
	{
		global $http_worker;

		$http_worker = new Worker($host);
		$global_uid = 0;
		// Запуск 4 процессов для предоставления услуг
		$http_worker->count = 1;
		//		$http_worker->count = 4;

		// При получении данных от браузера ответить hello world
		$http_worker->onConnect = function(TcpConnection $connection) {
			global $text_worker, $global_uid;
			$connection->id = ++$global_uid;
		};
		$http_worker->onMessage = function(TcpConnection $connection, $request) {

			$acceptData = null;
			if(json_validate($request))
			{
				$acceptData = json_decode($request, true);
			}

			Debug::dumpToFile($acceptData, '', '__messageLog.log');

			//			$service = ChatUseCaseFactory::getUseCase();
			//			$service->sendMessage(
			//				$acceptData['sendUserId'],
			//				$acceptData['acceptUserId'],
			//				$acceptData['message'],
			//			);


			$connection->send('hello world');

			global $http_worker;

			foreach($http_worker->connections as $conn)
			{
				$conn->send("user[{$connection->uid}] сказал: " . rand());
			}
		};

		// Запуск worker
		Worker::runAll();


	}
}