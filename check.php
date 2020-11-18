<?php
ob_start();
ini_set('display_errors', 1);
include 'db_connect.php';

$meno_login=$_POST["u_name"];
$heslo_login=$_POST["psw"];

$sql = "SELECT count(*) as pocet FROM users where login='".$meno_login."' and pass='".$heslo_login."'";

if ($result = $mysqli -> query($sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $login_ok=$row["pocet"];
    }
}

$result -> free_result();
$mysqli -> close();

if ($login_ok==1) {
    setcookie("LoginOK", "1", time()+3600);
}
else {
    setcookie("LoginOK", "0", time()+3600);
}

?>

<html>
<body>
<?php
if ($login_ok==1) {
    ?>
    <form action="dashboard.html" method="post">
    </form>
<?php
}
else
{
?>
        <form action="dashboard.html" method="post">
        </form>
    <?php
}
ob_end_flush();
?>
</body>
</html>