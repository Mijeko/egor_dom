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

	private int $countWorkers = 1;

	private array $handlers = [];

	private $onConnect = null;

	private array $customData = [];


	public function __construct(
		private readonly string $host = "websocket://0.0.0.0:8686/",
	)
	{
		$this->worker = new Worker($this->host);
		$this->worker->count = $this->countWorkers;
	}

	public function run(): void
	{
		Worker::runAll();
	}

	public function build(): Server
	{
		$this->worker->onConnect = function(TcpConnection $connection) {

			if(is_callable($this->onConnect))
			{
				call_user_func($this->onConnect, $connection, $this);
			} else
			{
				$connection->id = ++$this->uid;
			}
		};


		$this->worker->onMessage = function(TcpConnection $connection, $request) {

			foreach($this->handlers as $handler)
			{
				call_user_func($handler, $connection, $request, $this);
			}
		};

		return $this;
	}

	public function onConnect(callable $callback): Server
	{
		$this->onConnect = $callback;
		return $this;
	}

	public function incrementUid(): void
	{
		$this->uid++;
	}

	public function decrementUid(): void
	{
		$this->uid--;
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

	public function setCustomData(array $data): Server
	{
		$this->customData = $data;
		return $this;
	}

	public function refreshCustomData(string $key, $value): Server
	{
		$this->customData[$key] = $value;
		return $this;
	}

	public function getCustomData(): array
	{
		return $this->customData;
	}
}