<?
/**
* Подключение к db
*/
class db
{
	
	protected function dbConnect ()
	{
		/* Подключение к серверу MySQL */ 
		$link = mysqli_connect( 
            'localhost',  /* Хост, к которому мы подключаемся */ 
            'root',       /* Имя пользователя */ 
            '',   /* Используемый пароль */ 
            'och');     /* База данных для запросов по умолчанию */ 

		if (!$link) { 
   			printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   			exit; 
		} else {
			return $link;
		}
	}

	function getSql ($sql)
	{
		$link = self::dbConnect();
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

	function getCategory($table) 
	{
		$sql    = 'SELECT * FROM '.$table.' GROUP BY `cat_name` ORDER BY `cat_name` ASC ';
		$result =  self::getSql($sql);
		
		return $result;
	}

	function getOrders () 
  	{
    	session_start();
      	$id = $_SESSION['id'];
      	$sql = "SELECT * FROM orders WHERE adm_id = '$id'";
      	if($result = self::getSql($sql)) return $row;
 	}		

}
?>