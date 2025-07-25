<?php
if(empty($_SERVER['DOCUMENT_ROOT']))
{
	$_SERVER['DOCUMENT_ROOT'] = '/var/www/dom.local';
}


require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('rmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$callback = function($msg) {
	echo ' [x] Received ', $msg->getBody(), "\n";

//	\Bitrix\Main\Diag\Debug::dumpToFile($msg->getBody());
//	\Bitrix\Main\Diag\Debug::dumpToFile(rand());
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

try
{
	$channel->consume();
} catch(\Throwable $exception)
{
	echo $exception->getMessage();
}

$channel->close();
$connection->close();