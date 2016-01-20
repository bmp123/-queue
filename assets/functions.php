<?
include ("db.php");
/**
* Класс вывода данных из бд
*/
class Gets extends db 
{
	function getSql ($sql)
	{
		$link = db::dbConnect();
		/* Посылаем запрос серверу */ 
		if ($result = mysqli_query($link, $sql)) { 
    		/* Выборка результатов запроса */ 
    		return $result;
    		/* Освобождаем используемую память */ 
    		mysqli_free_result($result); 
		} 

		/* Закрываем соединение */ 
		mysqli_close($link); 
	}

	static function viewIndividual ()
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

	static function viewServices ()
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

	static function viewCategory ()
	{
		$table = "category,services";
		$sql = 'SELECT * FROM '.$table.' GROUP BY `cat_name` ORDER BY `cat_name` ASC ';
		$result = self::getSql($sql);
		$row = mysqli_fetch_assoc($result);

		$view .="<div id=\"category\"><ul>";
		do{ 
			$num = $row['col_services'];
<<<<<<< HEAD
			if ($num != 0) $view .= "<li><a href=\"?url=viewServices&&id=".$row['cat_id']."\">".$row['cat_name']."</a><div>".$num."</div></li>"; 
=======
			if ($num > 1) { $num-= 1; $view .= "<li><a href=\"?url=viewServices&&id=".$row['cat_id']."\">".$row['cat_name']."</a><div>".$num."</div></li>";} 
>>>>>>> dev
		} while ($row = mysqli_fetch_assoc($result));
		$view .= "</ul></div>";

		return $view;
	}

	static function viewCategoryOptions ()
	{
		$table = "category";
		$sql = 'SELECT * FROM '.$table.' GROUP BY `cat_name` ORDER BY `cat_name` ASC';
		$result = self::getSql($sql);
		$row = mysqli_fetch_assoc($result);

		do{ 
			$view .= "<option name=\"".$row['cat_id']."\" value=\"".$row['cat_id']."\">".$row['cat_name']."</option>"; 
		} while ($row = mysqli_fetch_assoc($result));

		return $view;
	}

	static function registerPartner ($name, $password, $email, $number)
	{
		$table = "admins";
		$sql = "SELECT * FROM admins WHERE adm_email ='".$email."' LIMIT 1 ";
		$result = self::getSql($sql);

		if(mysqli_num_rows($result)==0){
			$sql = "INSERT INTO ".$table." (adm_name,adm_password,adm_email,adm_number)
					VALUES ('$name',$password,'$email','$number')";
        	if($result = self::getSql($sql)){
          		$i = 1;
      		}else{
        		$i = 2;
      		}
      	}
		return $i;
	}

	static function destroySession ()
	{
		session_start();
		session_destroy();
		$view = '<script language="JavaScript">window.location.href = "http://www.u.ru/admin/"</script>';
		return $view;
	}

	static function addServices ()
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
<<<<<<< HEAD
=======
	static function home ()
	{
		$view = '<script language="JavaScript">window.location.href = "http://www.u.ru"</script>';
		return $view;
	}
>>>>>>> dev

}
?>
