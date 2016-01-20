<?
/**
* Разные нужные штуки
*/
include ("functions.php");

class Values extends Gets
{
    
    function request_url()
    {
        $result = ''; // Пока результат пуст
        $default_port = 80; // Порт по-умолчанию
  
        // А не в защищенном-ли мы соединении?
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
            // В защищенном! Добавим протокол...
            $result .= 'https://';
            // ...и переназначим значение порта по-умолчанию
            $default_port = 443;
        } else {
            // Обычное соединение, обычный протокол
            $result .= 'http://';
        } 
        // Имя сервера, напр. site.com или www.site.com
        $result .= $_SERVER['SERVER_NAME'];
 
        // А порт у нас по-умолчанию?
        if ($_SERVER['SERVER_PORT'] != $default_port) {
            // Если нет, то добавим порт в URL
            $result .= ':'.$_SERVER['SERVER_PORT'];
        }
        $url .='<meta charset="utf-8">';
        $url .='<link rel="stylesheet" type="text/css" href="'.$result.'/css/main.css">';
        $url .="<link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>";
        $url .='<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>';
        return $url;
    }
    function session () 
    {
        session_start();
        $id = $_SESSION['id'];
        $password = $_SESSION['password'];
        $email = $_SESSION['email'];

        if (!empty($id)) {
            $table = "admins";
            $sql = "SELECT * FROM ".$table." WHERE adm_id ='".$id."' LIMIT 1 ";
            $result = Gets::getSql($sql);
            $row = mysqli_fetch_assoc($result);

            if ( $password == $row['adm_password'] && $email == $row['adm_email']) {
                $flag = true;
            }else{
                $flag = false;
            }
        }else{
            $flag = false;
        }
        return $flag;
    }

    function getFun () 
    {   
        $url = $_GET['url'];
        $view = Gets::$url();

        return $view;
    }
}

?>