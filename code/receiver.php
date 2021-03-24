<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('queue', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, true, false, false);
$callback = function($msg) {
    $waitSeconds = rand(3,9);
    echo "Received: ", $msg->body, "\n";
    echo "Working: " . $waitSeconds . " seconds\n";
    sleep($waitSeconds);
    echo "Ack", "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('hello', '', false, false, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}