<?php

// https://github.com/rabbitmq/rabbitmq-tutorials/blob/master/php-amqp/receive.php

//Establish connection AMQP
$connection = new AMQPConnection();
$connection->setHost('queue');
$connection->setLogin('guest');
$connection->setPassword('guest');
$connection->connect();
//Create and declare channel
$channel = new AMQPChannel($connection);
//AMQPC Exchange is the publishing mechanism
$exchange = new AMQPExchange($channel);

$callback_func = function(AMQPEnvelope $message, AMQPQueue $q) use (&$max_consume) {
    echo "Received: ", $message->getBody(), "\n";
    $waitSeconds = rand(3,9);
    echo "Working: " . $waitSeconds . " seconds\n";
    sleep($waitSeconds);
	$q->nack($message->getDeliveryTag());
    echo "Ack", "\n";
};

try{
	$routing_key = 'hello';

	$queue = new AMQPQueue($channel);
	$queue->setName($routing_key);
	$queue->setFlags(AMQP_NOPARAM);
	$queue->declareQueue();

	echo ' [*] Waiting for messages. To exit press CTRL+C ', PHP_EOL;
	$queue->consume($callback_func);
}catch(AMQPQueueException $ex){
	print_r($ex);
}catch(Exception $ex){
	print_r($ex);
}

echo 'Close connection...', PHP_EOL;
$queue->cancel();
$connection->disconnect();

