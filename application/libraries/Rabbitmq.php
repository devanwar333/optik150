<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'D:\Aplikasi\wamp64\www\kasir\vendor\autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Rabbitmq {

    private $connection;
    private $channel;

    public function __construct() {
        $CI =& get_instance();
    
        $config = $CI->config->item('rabbitmq');
        
        $this->connection = new AMQPStreamConnection(
            $config['hostname'],
            $config['port'],
            $config['username'],
            $config['password'],
            $config['vhost']
        );

        $this->channel = $this->connection->channel();
    }

    public function publish_message($exchange, $routing_key, $message) {
        try {
            $msg = new AMQPMessage(
                json_encode($message),
                array('content_type' => 'application/json', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
            );
             
            
            $this->channel->basic_publish($msg, $exchange, $routing_key);
            
        } catch (Exception $ex) {
            
            echo $ex->getMessage();
        }
    }

    public function consume_messages($queue, $callback) {
        $this->channel->queue_declare($queue, false, true, false, false);

        $this->channel->basic_consume($queue, '', false, true, false, false, $callback);

        while($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function getChannel() {
        return $this->channel;
    }

    public function __destruct() {
        $this->channel->close();
        $this->connection->close();
    }
}
?>
