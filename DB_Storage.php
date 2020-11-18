<?php
declare(strict_types=1);
ob_start();
ini_set('display_errors', 1);
include 'db_connect.php';

class DB_Storage
{
    public function saveOrder(Order $order) {

    }
    public function createOrder(int $id, string $name, string $surname, string $start, string $state) {
        $order = new Order($id, $name, $surname, $start, $end, $state);
        $this->saveOrder($order);
    }
}