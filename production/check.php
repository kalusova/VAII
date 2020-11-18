<?php
ob_start();
ini_set('display_errors', 1);
include 'db_connect.php';

$meno_login=$_POST["meno_login"];
$heslo_login=$_POST["heslo_login"];

$sql = "SELECT count(*) as pocet FROM users where login='".$meno_login."' and pass='".$heslo_login."'";

if ($result = $mysqli -> query($sql)) {

	while ($row = mysqli_fetch_assoc($result)) {
		$login_ok = $row["pocet"];
	}
}

$result -> free_result();
$mysqli -> close();

printf("Login: %s\n", $login_ok);



if ($login_ok==1) { 
	setcookie("LoginOK", "1", time()+3600);
	/*
	if (isset($_COOKIE['f_none'])==FALSE) { setcookie("f_none", "true", time()+60*60*24*30); }
	if (isset($_COOKIE['f_printed'])==FALSE) { setcookie("f_printed", "true", time()+60*60*24*30); }
	if (isset($_COOKIE['f_up'])==FALSE) { setcookie("f_up", "true", time()+60*60*24*30); }
	if (isset($_COOKIE['f_done'])==FALSE) { setcookie("f_done", "true", time()+60*60*24*30); }
	if (isset($_COOKIE['f_priority'])==FALSE) { setcookie("f_priority", "false", time()+60*60*24*30); }
	if (isset($_COOKIE['f_search'])==FALSE) { setcookie("f_search", "null", time()+60*60*24*30); }	
	if (isset($_COOKIE['f_archive'])==FALSE) { setcookie("f_archive", "null", time()+60*60*24*30); }	
	*/
}
else
{
	setcookie("LoginOK", "0", time()+3600);
}

?>

<html>
<head>
<title>Objednávky</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--script src="/production/js/jquery.cookie.js"></script-->
</head>
<body>
<?php
if ($login_ok==1) {
	?>
	<SCRIPT language="JavaScript">
	window.location="production.php";
	</SCRIPT>
	<?php
}
else
{
	?>
	<SCRIPT language="JavaScript">
	window.location="index.htm";
	</SCRIPT>
	<?php
}
ob_end_flush();
?>
</body>
</html>