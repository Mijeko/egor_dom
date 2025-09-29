<?php

namespace Craft\Socket;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Stream\Application\Factory\ChatUseCaseFactory;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Worker;

class Server
{

	private Worker $worker;

	private int $uid = 0;

	private int $workers = 1;

	private array $handlers = [];

	public function run(
		string $host = "websocket://0.0.0.0:8686/",
	): void
	{
		$this->worker = new Worker($host);
		$this->worker->count = $this->workers;

		$this->worker->onConnect = function(TcpConnection $connection) {
			$connection->id = ++$this->uid;
		};

		$this->worker->onMessage = function(TcpConnection $connection, $request) {

			foreach($this->handlers as $handler)
			{
				call_user_func($handler, $connection, $request, $this);
			}

		};

		// Запуск worker
		Worker::runAll();


	}

	public function getWorker(): Worker
	{
		return $this->worker;
	}

	public function handlers(array $handlers = []): Server
	{
		$this->handlers = $handlers;
		return $this;
	}
}