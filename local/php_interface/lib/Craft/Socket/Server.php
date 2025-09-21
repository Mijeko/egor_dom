<?php

namespace Craft\Socket;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Worker;

class Server
{
	public function run(): void
	{
		$http_worker = new Worker("websocket://127.0.0.1:80");

		// Запуск 4 процессов для предоставления услуг
		$http_worker->count = 4;

		// При получении данных от браузера ответить hello world
		$http_worker->onMessage = function(TcpConnection $connection, Request $request) {
			// Отправить браузеру hello world
			$connection->send('hello world');
		};

		// Запуск worker
		Worker::runAll();
	}
}