<?php
defined('BASEPATH');
require_once 'D:\Aplikasi\wamp64\www\kasir\index.php';

// Load necessary libraries and models
$CI =&get_instance();
$CI->load->library('rabbitmq');

// Exchange details
$exchangeName = 'import';
$queueName = 'import';
$routingKey = 'import';
$exchangeName = 'import';
$exchangeType = 'direct';

try {
    // Create a channel
    $channel = $CI->rabbitmq->getChannel();

    // Declare the exchange)
    $channel->exchange_declare(
        $exchangeName, // exchange name
        $exchangeType, // exchange type
        false,         // passive: don't check if the exchange exists
        true,          // durable: the exchange will survive broker restarts
        false          // auto_delete: the exchange will be deleted once the channel is closed
    );

    echo "Exchange '$exchangeName' created successfully.\n";

      // Declare the queue
    $channel->queue_declare(
        $queueName, // queue name
        false,      // passive: don't check if the queue exists
        true,       // durable: the queue will survive broker restarts
        false,      // exclusive: the queue can be accessed by other channels
        false       // auto_delete: the queue will be deleted once the channel is closed
    );

    $channel->queue_bind($queueName, $exchangeName, $routingKey);

    echo "Queue '$queueName' bound to exchange '$exchangeName' with routing key '$routingKey'.\n";

    echo "Queue '$queueName' declared successfully.\n";

    // Close the channel and connection
    $channel->close();

} catch (\Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\n";
    exit(1);
}
