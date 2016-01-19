<?
include("../assets/actionsAdmin.php");

if (isset($_POST['cat_name'])) {
	$name = $_POST['cat_name'];
	$result = actionsAdmin::add_category($name);
	if ($result == 1) echo 1;
	if ($result == 2) echo 2;
}
if (isset($_POST['service_name'])) {
	$name = $_POST['service_name'];
	$min_desc = $_POST['min_description'];
	$full_desc = $_POST['full_description'];
	$city = $_POST['city'];
	$areal = $_POST['areal'];
	$country = $_POST['country'];
	$category = $_POST['category'];
	$cat_id = $_POST['cat_id'];
	$result = actionsAdmin::add_service($name, $min_desc, $full_desc, $city, $areal, $country, $category, $category_id);
	if ($result == 1) echo 1;
	if ($result == 2) echo 2;
}
if (isset($_POST['adm_name'])) {
	$name = $_POST['adm_name'];
	$password = $_POST['adm_password'];
	$email = $_POST['adm_email'];
	$number = $_POST['adm_number'];
	$result = actionsAdmin::updateAdminData($name, $password, $email, $number);
	if ($result == 1) echo 1;
	if ($result == 2) echo 2;
}

?>