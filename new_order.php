<?php
ob_start();
ini_set('display_errors', 1);
include 'db_connect.php';
require "DB_Storage.php";

$storage = new DB_Storage($mysqli);

$meno=$_POST["firstName"];
$priezvisko=$_POST["lastName"];
$datum = $_POST["date"];
$login_ok = 0;

$storage->createOrder($meno, $priezvisko, $datum, "Open");
?>

<html lang="utf8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>

<SCRIPT language="JavaScript">
    window.location="dashboard.html";
</SCRIPT>
ob_end_flush();
?>
</body>
</html>