<?
require_once("../assets/functions.php.php");
$name = $_POST['name'];
$password = $_POST['pass'];
$email = $_POST['email'];
$number = $_POST['numb'];
$result = Gets::registerPartner ($name, $password, $email, $number);
if ($result == 1) echo 1;
if ($result == 2) echo 2;
?>