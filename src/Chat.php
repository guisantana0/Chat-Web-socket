<?php
namespace Chat;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use SplObjectStorage;

final class ChatServer implements MessageComponentInterface{
    private $clientes;

    public function __construct()
    {
        $this->clientes = new SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn):void
    {
        $this->clientes->attach($conn);
    }

    public function onClose(ConnectionInterface $conn):void
    {
        $this->clientes->detach($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e):void
    {
        $conn->close();
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg):void
    {
           foreach ($this->clientes as $cliente){
               $cliente->send($msg);
               print($msg);
           }
    }

}