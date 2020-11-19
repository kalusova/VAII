<?php
declare(strict_types=1);
include "Order.php";

class DB_Storage
{
    public $mysqli;

    /**
     * DB_Storage constructor.
     * @param mysqli $mysqli
     */
    public function __construct(mysqli $mysqli)
    {
    $this->mysqli = $mysqli;
    }

    public function getAll() : array {
        $query = "SELECT count(*) FROM Orders";
        $orders = [];
        if($result = $this->mysqli->query($query)){
            while($row = $result->fetch_row() ){
                $order = new Order($row['id'], $row['meno'], $row['priezvisko'], $row['start'], $row['end'], $row['state']);
                $orders[] = $order;
            }
        }

        return $orders;

    }
    public function saveOrder(Order $order) {
        $sql = "INSERT INTO Orders (meno, priezvisko, start, end, state)
                VALUES ('$order->name', '$order->surname', '$order->start', '$order->end', '$order->state')";

        if ($this->mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->mysqli->error;
        }
    }
    public function createOrder(string $name, string $surname, string $start, string $state) {
        $sql = "INSERT INTO Orders (meno, priezvisko, start, state)
                VALUES ('$name', '$surname', '$start', '$state')";
        echo $sql;
        if ($this->mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->mysqli->error;
        }
    }

    public function printOrder(Order $order){
        echo $order->getId().  ", " . $order->getName().  ", " .  $order->getSurname().  ", " .  $order->getStart().  ", " .  $order->getEnd().  ", " .  $order->getState();
    }
}