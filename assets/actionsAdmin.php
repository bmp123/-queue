<?
/**
* Операции в админке
*/
include("functions.php");

class actionsAdmin extends Gets
{
  
  function add_category($name)
  {
    $sql = "INSERT INTO category (cat_name) VALUES ('$name')";
    if($result = self::getSql($sql)) $i = 1; 
    else $i = 2;

    return $i;
  }

  function add_service ($name, $min_desc, $full_desc, $city, $areal, $country, $category, $category_id) 
  {
    $sql = "INSERT INTO services (s_name,s_m_descr,s_f_descr,s_cat,s_city,s_areal,s_country,cat_id) 
        VALUES ('$name','$min_desc','$full_desc','$category','$city','$areal','$country','$category_id')";
    if($result = self::getSql($sql)) $i = 1; 
    else $i = 2;

    return $i;
  }

  function updateAdminData ($name, $password, $email, $number) 
  {
    session_start();
    $id = $_SESSION['id'];
    $sql = "UPDATE admins SET adm_name = '$name',adm_password = '$password',adm_email = '$email',adm_number = '$number'
          WHERE adm_id = '$id'";
    if($result = self::getSql($sql)) $i = 1; 
    else $i = 2;

    return $i;
  }

}

?>
