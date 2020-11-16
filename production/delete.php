<?php
include 'db_connect.php';

$id_val=$_POST['id'];
$sql    = "UPDATE production SET status='archive' where id=".$id_val;
$result = mysql_query($sql, $con);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
else {
	echo "Design deleted...";
}
?>