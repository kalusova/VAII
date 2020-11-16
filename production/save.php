<?php
include 'db_connect.php';

$id_val=$_POST['id'];
$priority_val=$_POST['priority'];
$design_val=$_POST['design'];
$model_val=$_POST['model'];
$format_val=$_POST['format'];
$newPrinter_val=$_POST['newPrinter'];
$status_val=$_POST['status'];
$ebay_val=$_POST['ebay'];
$notes_val=$_POST['notes'];
$payment_val=$_POST['payment'];
$change_status_val=$_POST['change_status'];
//if ($priority_par == "true") { $priority_val=1; } else  { $priority_val=0; }

$sql = "update production set priority='".$priority_val."', design='".mysql_real_escape_string($design_val)."', model='".mysql_real_escape_string($model_val)."', format='".mysql_real_escape_string($format_val)."', status='".mysql_real_escape_string($status_val)."', ebay='".mysql_real_escape_string($ebay_val)."', new_printer='".mysql_real_escape_string($newPrinter_val)."', notes='".mysql_real_escape_string($notes_val)."', payment='".mysql_real_escape_string($payment_val). "' ";
if ($change_status_val=="1") { $sql = $sql . ", s_change='". date('Y-m-d H:i:s') . "' "; }
//date('Y-m-d H:i:s')
$sql = $sql . " where id=".$id_val.";";
$result = mysql_query($sql, $con);
//echo $sql;
if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
else {
	echo "Saving data... ".$id_val." ".$priority_val." ".$design_val." ".$model_val." ".$format_val." ".$status_val." ".$ebay_val." ".$notes_val;
}
?>