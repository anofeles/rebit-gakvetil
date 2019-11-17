<?php
require dirname(__DIR__).'/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
define("RABBITMQ_HOST", "dove-01.rmq.cloudamqp.com");
define("RABBITMQ_PORT", 5672);
define("RABBITMQ_USERNAME", "dove-01.rmq.cloudamqp.com");
define("RABBITMQ_PASSWORD", "4gPbwgbKEKE1YExEgRatrOcR7yR7RnQv");
define("RABBITMQ_QUEUE_NAME", "task_queue");
$host = 'dove-01.rmq.cloudamqp.com';
$port = 5672;
$user = 'kgmunpfq';
$pass = '4gPbwgbKEKE1YExEgRatrOcR7yR7RnQv';
$vhost = 'kgmunpfq';
$exchange = 'subscribers';
$queue = 'gurucoder_subscribers';
$connection = new AMQPStreamConnection($host, $port, $user, $pass, $vhost);
$channel = $connection->channel();
# Create the queue if it does not already exist.
$channel->queue_declare('task_queue', false, true, false, false);

$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = "Hello World!";
}
$msg = new AMQPMessage(
    $data,
    array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
);

$channel->basic_publish($msg, '', 'task_queue');

echo ' [x] Sent ', $data, "\n";

$channel->close();
