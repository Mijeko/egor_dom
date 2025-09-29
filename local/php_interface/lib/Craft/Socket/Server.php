<?php

namespace Craft\Socket;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Stream\Application\Factory\ChatUseCaseFactory;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Worker;

class Server
{

	private $worker;

	private $uid = 0;

	public function run(
		string $host = "websocket://0.0.0.0:8686/",
	): void
	{
		//		global $http_worker;

		$this->worker = new Worker($host);
		// Запуск 4 процессов для предоставления услуг
		$this->worker->count = 1;
		//		$http_worker->count = 4;

		// При получении данных от браузера ответить hello world
		$this->worker->onConnect = function(TcpConnection $connection) {
			$connection->id = ++$this->uid;
		};
		$this->worker->onMessage = function(TcpConnection $connection, $request) {

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

			foreach($this->worker->connections as $conn)
			{
				$conn->send("user[{$connection->uid}] сказал: " . rand());
			}
		};

		// Запуск worker
		Worker::runAll();


	}
}