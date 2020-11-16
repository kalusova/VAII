<?php
include 'db_connect.php';

$design_val=$_POST['design'];

$sql    = "INSERT INTO production (design, status) VALUES('".mysql_real_escape_string($design_val)."','none');";
$result = mysql_query($sql, $con);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
else {
	echo "New design inserted...";
}
?>