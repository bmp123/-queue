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


  static function getNumRowsCategory ($id)
  {
    $table = "services";
    $sql = "SELECT * FROM ".$table." WHERE cat_id =  '".$id."' ORDER BY  `s_cat` ASC";
    $result = self::getSql($sql);
    if($row = mysqli_num_rows($result)){
      $row += 1;
      if($sql_col = "UPDATE category SET col_services = '$row' WHERE cat_id = '$id'"){
        $col = self::getSql($sql_col);
        $i = 1;
      }
    } 
    return $i;
  }

  function add_service ($name, $min_desc, $full_desc, $city, $areal, $country, $category, $category_id) 
  { 

    $sql = "INSERT INTO services (s_name,s_m_descr,s_f_descr,s_cat,s_city,s_areal,s_country,cat_id) 
        VALUES ('$name','$min_desc','$full_desc','$category','$city','$areal','$country','$category_id')";
    if($result = self::getSql($sql)){
       $i = 1;
       $success = self::getNumRowsCategory($category_id);
    } 
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

  static function myData ()
  { 
    $view .='<div id="form-my-data">';
    $view .= self::viewAdminData();
    $view .='<? echo "$view";?>';
    $view .='<div id="quest" style="display:none;"><p>Ваши Данные Будут изменены! Вы уверенны, что хотите сохранить данные?</p>';
    $view .='<button id="yes">Сохранить</button><button id="no">Отменить</button></div>';
    $view .='<div id="error"></div></div>';

    return $view;
  }

    static function viewAdminData ()
    { 
    session_start();
    $table = "admins";
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM ".$table." WHERE adm_id = '".$id."' ";
    $result = Gets::getSql($sql);
    $row = mysqli_fetch_assoc($result);

    $view .= "<input type=\"text\" id=\"adm_name\" value=\"".$row['adm_name']."\">";
    $view .= "<input type=\"password\" id=\"adm_password\" value=\"".$row['adm_password']."\">";
    $view .= "<input type=\"text\" id=\"adm_email\" value=\"".$row['adm_email']."\">";
    $view .= "<input type=\"text\" id=\"adm_number\" value=\"".$row['adm_number']."\">"; 
    $view .= "<button id=\"btn_save\">Сохранить</button>";

    return $view;
    }

  static function authAdmin ($email, $password)
  { 
    session_start();
    $table = "admins";
    $sql = "SELECT * FROM ".$table." WHERE adm_email = '".$email."'";
    if (!empty($email) && !empty($password)) {
      $result = Gets::getSql($sql);
      $row = mysqli_fetch_assoc($result);
          
          $password2 = $row['adm_password'];
          if ($password == $password2) {
            $_SESSION['email'] = $row['adm_email'];
            $_SESSION['password'] = $row['adm_password'];
            $_SESSION['id'] = $row['adm_id'];
            $i = 1;
          }else{
            $i = 2;
          } 
      }else{
          $i = 2;
      }
      return $i;
  }

  static function getOrders () 
  {
    session_start();
      $id = $_SESSION['id'];
      $sql = "SELECT * FROM orders WHERE adm_id = '$id'";
      if($result = Gets::getSql($sql)) $row = mysqli_fetch_assoc($result);

      return $row;
  }

    static function viewOrders () 
    {   
      $result = self::getOrders();
      $view .='<div id="form-my-data">';
    $view .='<p>'.$result['o_name'].'</p>';
    $view .='<p>'.$result['o_number'].'</p>';
    $view .='<p>'.$result['o_service'].'</p>';
    $view .='<p>'.$result['o_comment'].'</p>';
    $view .='<div id="error"></div></div>';

      return $view;
    }

}

?>
