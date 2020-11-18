<?php
declare(strict_types=1);

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

    public function getAll(){
        $sql = "SELECT count(*) FROM Orders";
        $orders = [];
        $order = new Order();
    }
    public function saveOrder(Order $order) {
        $sql = "INSERT INTO Orders (meno, priezvisko, start, end, state)
                VALUES ('$order->name', '$order->surname', '$order->start', '$order->end', '$order->state')";

        if ($mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
    public function createOrder(string $name, string $surname, string $start, string $state) {
        $sql = "INSERT INTO Orders (meno, priezvisko, start, state)
                VALUES ('$name', '$surname', '$start', '$state')";

        if ($mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}