<?php

// https://github.com/rabbitmq/rabbitmq-tutorials/blob/master/php-amqp/send.php

//Establish connection to AMQP
$connection = new AMQPConnection();
$connection->setHost('queue');
$connection->setLogin('guest');
$connection->setPassword('guest');
$connection->connect();
//Create and declare channel
$channel = new AMQPChannel($connection);
//AMQPC Exchange is the publishing mechanism
$exchange = new AMQPExchange($channel);

try{
	$routing_key = 'hello';

	$queue = new AMQPQueue($channel);
	$queue->setName($routing_key);
	$queue->setFlags(AMQP_NOPARAM);
	$queue->declareQueue();

  $cnt = 1;
  while(true) {
    $message = "howdy-do $cnt";
    $exchange->publish($message, $routing_key);
    echo "Sent $message!\n";
    $cnt++;
    $waitSeconds = rand(1,3);
    sleep($waitSeconds);
  }

	$connection->disconnect();
}catch(Exception $ex){
	print_r($ex);
}

