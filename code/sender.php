<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('queue', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, true, false, false);

$cnt = 1;
while(true) {
  $msg = new AMQPMessage("Hello World $cnt!",
    array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
  );
  $channel->basic_publish($msg, '', 'hello');
  echo "Sent Hello World $cnt!\n";
  $cnt++;
  $waitSeconds = rand(1,3);
  sleep($waitSeconds);
}

$channel->close();
$connection->close();
