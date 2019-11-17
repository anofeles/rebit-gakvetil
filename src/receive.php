<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;


$host = 'dove-01.rmq.cloudamqp.com';
$port = 5672;
$user = 'kgmunpfq';
$pass = '4gPbwgbKEKE1YExEgRatrOcR7yR7RnQv';
$vhost = 'kgmunpfq';

$exchange = 'subscribers';
$routing_key = 'hello';
$body = 'Hello_World!1';

$connection = new AMQPStreamConnection($host, $port, $user, $pass, $vhost);
$channel = $connection->channel();

$channel->queue_declare($routing_key);
print ' [*] Waiting for messages. To exit press CTRL+C '. "\n";

$callback="rame";
    print " [x] Received /r".$body;

$channel->basic_consume(
    $routing_key,
    $no_ack=True
);

$channel->start_consuming();
