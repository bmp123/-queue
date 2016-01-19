<?
/**
* Подключение к db
*/
class db
{
	
	function dbConnect ()
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
}
?>