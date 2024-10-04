<?php
defined('BASEPATH');
require_once 'D:\Aplikasi\wamp64\www\kasir\index.php';

// Load necessary libraries and models
$CI =&get_instance();
$CI->load->library('rabbitmq');


// Callback function to process messages
$callback = function($msg) use ($CI) {
    log_message('error', $msg->body);
    $message = json_decode($msg->body, true);
};

// Consume messages from RabbitMQ queue
$CI->rabbitmq->consume_messages('import', $callback);
?>
