<?
include("../assets/functions.php.php");
$email = $_POST['email'];
$password = $_POST['pass'];
$result = Gets::authAdmin($email, $password);
if ($result == 1) echo 1;
if ($result == 2) echo 2;
?>