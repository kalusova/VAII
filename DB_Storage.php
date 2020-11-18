<?php
declare(strict_types=1);
ob_start();
ini_set('display_errors', 1);
include 'db_connect.php';

class DB_Storage
{
    public function saveOrder(Order $order) {
        $sql = "INSERT INTO Orders (id, meno, priezvisko, start, end, state)
                VALUES ($order->id , $order->name, $order->surname, $order->start, $order->end, $order->state)";

        if ($mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    public function createOrder(string $name, string $surname, string $start, string $state) {
        $order = new Order($id, $name, $surname, $start, $state);
        $this->saveOrder($order);
    }
}