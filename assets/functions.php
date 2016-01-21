<?
include ("db.php");
/**
* Класс вывода данных из бд
*/
class View extends db 
{

	public function viewIndividual ()
	{	
		$table = "services";
		$id = $_GET['id'];
		$sql = 'SELECT * FROM '.$table.' WHERE id = '.$id.'';
		$result = self::getSql($sql);
		$row = mysqli_fetch_assoc($result);

		$view .= "<p>".$row['s_cat']."</p><div id=\"wrapper_ind\">";
		do{ 
			$view .= "<div class=\"ind_divs\">";
			$view .= "<p>".$row['s_name']."</p>";
			$view .= "<p>".$row['s_f_descr']."</p>";
			$view .= "</div>"; 
		} while ($row = mysqli_fetch_assoc($result)); 
		$view .= "</div>";

		return $view;
	}

	public function viewServices ()
	{
		$table = "services";
		$id = $_GET['id'];
		$sql = 'SELECT * FROM '.$table.' WHERE cat_id = '.$id.'';
		$result = self::getSql($sql);
		$row = mysqli_fetch_assoc($result);

		$view .= "<a href='?url=home'>Главная</a>/<a href='?url=viewServices&&id=".$id."'>".$row['s_cat']."</a><div id=\"wrapper_cat\">";
		do{ 
			$view .= "<div class=\"cat_divs\">";
			$view .= "<p>".$row['s_name']."</p>";
			$view .= "<p>".$row['s_m_descr']."</p>";
			$view .= "<a href=\"?url=viewIndividual&&id=".$row['id']."&&name=".$row['s_name']."\">Подробнее</a>";
			$view .= "</div>"; 
		} while ($row = mysqli_fetch_assoc($result)); 
		$view .= "</div>";
		return $view;
	}

	public function viewCategory ()
	{
		$table  = "category";
		$result    = db::getCategory($table);
		$row    =  mysqli_fetch_assoc($result);

		$view .="<div id=\"category\"><ul>";
		do{ 
			$num = $row['col_services'];
			if ($num != 0) $view .= "<li><a href=\"?url=viewServices&&id=".$row['cat_id']."\">".$row['cat_name']."</a><div>".$num."</div></li>"; 
			if ($num > 1) { $num-= 1; $view .= "<li><a href=\"?url=viewServices&&id=".$row['cat_id']."\">".$row['cat_name']."</a><div>".$num."</div></li>";} 
		} while ($row = mysqli_fetch_assoc($result));
		$view .= "</ul></div>";

		return $view;
	}

	public function viewSearch()
	{
		$table_c  = "category";
		$category = $_GET['s_category'];
		$city = $_GET['s_city'];

		$sql_c = "SELECT * FROM ".$table_c." WHERE cat_name = '".$category."'";
		$result_c = db::getSql($sql_c);
		$row_c =  mysqli_fetch_assoc($result_c);
		$id_c = $row_c['cat_id'];

		$table  = "services";
		$sql = "SELECT * FROM ".$table." WHERE cat_id = '".$id_c."' OR s_city = '".$city."'";
		$result = db::getSql($sql);
		$row =  mysqli_fetch_assoc($result);

		$view .= "<div id=\"wrapper_cat\">";
		do{ 
			$view .= "<div class=\"cat_divs\">";
			$view .= "<p>".$row['s_name']."</p>";
			$view .= "<p>".$row['s_m_descr']."</p>";
			$view .= "<a href=\"?url=viewIndividual&&id=".$row['id']."&&name=".$row['s_name']."\">Подробнее</a>";
			$view .= "</div>"; 
		} while ($row = mysqli_fetch_assoc($result)); 
		$view .= "</div>";

		return $view;
	}

	public function viewCategoryOptions ()
	{
		$table  = "category";
		$result    = db::getCategory($table);
		$row    =  mysqli_fetch_assoc($result);

		do{ 
			$view .= "<option name=\"".$row['cat_id']."\" value=\"".$row['cat_id']."\">".$row['cat_name']."</option>"; 
		} while ($row = mysqli_fetch_assoc($result));

		return $view;
	}

	public function registerPartner ($name, $password, $email, $number)
	{
		$table = "admins";
		$sql = 'SELECT * FROM '.$table.' WHERE adm_email ='.$email.' LIMIT 1 ';
		$result = self::getSql($sql);

		if(mysqli_num_rows($result)==0){
			$sql = "INSERT INTO '".$table."' (adm_name,adm_password,adm_email,adm_number)
					VALUES ('$name',$password,'$email','$number')";
        	if($result = self::getSql($sql)){
          		$i = 1;
      		}else{
        		$i = 2;
      		}
      	}
		return $i;
	}

	public function addServices ()
	{
		$view .= '<div id="form-add-service">';
		$view .= '<select id="s_category" name="category" size="1">';
		$view .=  self::viewCategoryOptions();
		$view .= '</select>';
		$view .= '<input type="text" name="service_name" id="service_name" value="Название фирмы">';
		$view .= '<input type="text" name="min_description" id="min_description" value="Мини описание">';
		$view .= '<input type="text" id="country" name="country" value="Страна">';		
		$view .= '<input type="text" id="areal" name="areal" value="Область">';
		$view .= '<input type="text" id="city" name="city" value="Город">';
		$view .= '<textarea type="text" name="full_description" id="full_description">полное описание</textarea>';
		$view .= '<button id="btn_addservice">Отправить</button>';
		$view .= '<div id="error"></div>';
		$view .= '<button id="btn_addcat">Создать категорию</button>';
		$view .= '</div>';
		$view .= '<div id="form_addcat" style="display:none;">';
		$view .= '<input type="text" name="cat_name" id="cat_name">';
		$view .= '<button id="add_cat_btn">Отправить</button>';
		$view .= '<div id="error"></div>';
		$view .= '</div>';

		return $view;
	}

	public function myData ()
  	{ 
    	$view .='<div id="form-my-data">';
    	$view .= self::viewAdminData();
    	$view .='<? echo "$view";?>';
    	$view .='<div id="quest" style="display:none;"><p>Ваши Данные Будут изменены! Вы уверенны, что хотите сохранить данные?</p>';
    	$view .='<button id="yes">Сохранить</button><button id="no">Отменить</button></div>';
    	$view .='<div id="error"></div></div>';

    	return $view;
  	}

    public function viewAdminData ()
    { 
    	session_start();
    	$table = "admins";
    	$id = $_SESSION['id'];
    	$sql = "SELECT * FROM ".$table." WHERE adm_id = '".$id."' ";
    	$result = self::getSql($sql);
    	$row = mysqli_fetch_assoc($result);

    	$view .= "<input type=\"text\" id=\"adm_name\" value=\"".$row['adm_name']."\">";
    	$view .= "<input type=\"password\" id=\"adm_password\" value=\"".$row['adm_password']."\">";
    	$view .= "<input type=\"text\" id=\"adm_email\" value=\"".$row['adm_email']."\">";
    	$view .= "<input type=\"text\" id=\"adm_number\" value=\"".$row['adm_number']."\">"; 
    	$view .= "<button id=\"btn_save\">Сохранить</button>";

    return $view;
    }

    public function viewOrders () 
    {   
      	$result = self::getOrders();
      	$row = mysqli_fetch_assoc($result);

      	$view .='<div id="form-my-data">';
    	$view .='<p>'.$result['o_name'].'</p>';
    	$view .='<p>'.$result['o_number'].'</p>';
    	$view .='<p>'.$result['o_service'].'</p>';
    	$view .='<p>'.$result['o_comment'].'</p>';
    	$view .='<div id="error"></div></div>';

      	return $view;
    }

    public function home ()
    {
        $view = '<script language="JavaScript">window.location.href = "http://www.u.ru"</script>';
        return $view;
    }
}
?>
