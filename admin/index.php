<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start()?>
<?php require_once("../assets/values.php"); ?>

<? $flag = Values::session();?>
<? if($flag){ echo "Пожалуйста,подождите..."; echo '<script language="JavaScript">window.location.href = "http://www.u.ru/admin/panel.php"</script>'; }else{?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
		<input type="email" name="email" id="email" >
		<input type="password" name="pass" id="pass" >
		<button id="btn_sub">Войти</button>
		<div id="error"></div>	
</body>
</html>
<?}?>
<script type="text/javascript">
$('#btn_sub').click(function(){
	var email = $('#email').val(),
		pass  = $('#pass').val();

	$.ajax({
    	type : 'POST',
    	url : 'auth.php',
    	data : {email:email,pass:pass},
    	success : function(data) {
    		if (data==1) {            
    			window.location.href = "http://www.u.ru/admin/panel.php";
    		}else if(data==2){
    			$("#error").text("Неверный Логин/Пароль");
    		}

    	}
	});
});

</script>