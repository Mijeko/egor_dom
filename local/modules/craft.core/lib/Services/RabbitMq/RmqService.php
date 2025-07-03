<?php

namespace Craft\Core\Services\RabbitMq;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RmqService
{


	public static function createQueue(callable $callback): void
	{
//		self::runReceiver();

		$connection = new AMQPStreamConnection('rmq', 5672, 'guest', 'guest');
		$channel = $connection->channel();

		$channel->queue_declare('hello', false, false, false, false);

		$msg = new AMQPMessage(json_encode([
			'execute' => $callback,
		]));
//		$msg = new AMQPMessage('test message');
		$channel->basic_publish($msg, '', 'hello');


		$channel->close();
		$connection->close();

	}

	protected static function runReceiver(): void
	{
		exec('php local/modules/craft.develop/rmq.php');
	}

}