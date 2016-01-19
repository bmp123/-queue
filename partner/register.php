<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php require_once("../assets/values.php"); ?>
<!DOCTYPE html>
<html>
<head lang="ru">
    <?echo Values::request_url();?>
	<script src="../js/jquery.mask.js" type="text/javascript"></script>
	<title>Место где можно занять очередь</title>
</head>
<body>
	<header>
		<b>Какое то предложение</b>
	</header>
	<div id="menu">
		<ul>
			<li><a href="">Главная</a></li>
			<li><a href="">Партнерам</a></li>
			<li><a href="">Что мы делаем</a></li>
			<li><a href="">О нас</a></li>
		</ul>	
	</div>
	<div id="body">
		<input type="text" name="name" id="name" placeholder="name">
		<input type="text" name="number" id="number" placeholder="number">
		<input type="email" name="email" id="email" placeholder="email">
		<input type="password" name="password" id="password" placeholder="password">
		<button id="btn_reg">Отправить</button>
		<div id="error"></div>
	</div>
	<footer>
		
	</footer>
</body>
</html>
<script type="text/javascript">
var t = 0,
	name,
	numb,
	pass,
	email;
$(document).ready(function(){
	
    $("#number").mask("+7(999)9999999",{completed: function(){ numb=$('#number').val(); }
    	// $('#number').css({'border-bottom':'solid 1px #4CAF50','color':'#4CAF50'}); 
    });
    $('#number').blur(function(){
    	if($(this).val()!==""){

                $(this).css({'border-bottom' : '1px solid #4CAF50','color':'#4CAF50','font-size':'14px'});
            	t++;
            } else {
                $(this).css({'border-bottom' : '1px solid #F44336','color':'#F44336','font-size':'14px'});
            }
    });
    // $('#number').focus(function(){
    // 	// if($(this).val() ==""){
    // 		$(this).css({'border-bottom' : '1px solid #9E9E9E','color':'#212121','font-size':'12px'});
    // 	// }
    // });
    $('#email').blur(function() {
    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if(pattern.test($(this).val())){
            	email=$('#email').val();
                $(this).css({'border-bottom' : '1px solid #4CAF50','color':'#4CAF50','font-size':'14px'});
            	t++;
            } else {
                $(this).css({'border-bottom' : '1px solid #F44336','color':'#F44336','font-size':'14px'});
            }
    });
    // $('#email').focus(function(){
    // 	// if($(this).val() ==""){
    // 		$(this).css({'border-bottom' : '1px solid #9E9E9E','color':'#212121','font-size':'12px'});
    // 	// }
    // });
    $('#name').blur(function() {
    var pattern = /^([а-яА-Я])/;
            if(pattern.test($(this).val())){
            	name=$('#name').val();
                $(this).css({'border-bottom' : '1px solid #4CAF50','color':'#4CAF50','font-size':'14px'});
            	t++;
            } else {
                $(this).css({'border-bottom' : '1px solid #F44336','color':'#F44336','font-size':'14px'});
            }
    });
    // $('#name').focus(function(){
    // 	// if($(this).val() ==""){
    // 		$(this).css({'border-bottom' : '1px solid #9E9E9E','color':'#212121','font-size':'12px'});
    // 	// }
    // });
    $('#password').blur(function() {
    var pattern = /^([a-zA-Zа-яА-Я0-9])/;
            if(pattern.test($(this).val())){
            	pass=$('#password').val();
                $(this).css({'border-bottom' : '1px solid #4CAF50','color':'#4CAF50','font-size':'14px'});
            	t++;
            } else {
                $(this).css({'border-bottom' : '1px solid #F44336','color':'#F44336','font-size':'14px'});
            }
    });
    // $('#password').focus(function(){
    // 	// if($(this).val() ==""){
    // 		$(this).css({'border-bottom' : '1px solid #9E9E9E','color':'#212121','font-size':'12px'});
    // 	// }
    // });
});
	
$('#btn_reg').click(function(){
	$.ajax({
    	type : 'POST',
    	url : 'post_reg.php',
    	data : {name:name,numb:numb,pass:pass,email:email},
    	success : function(data) {
    		if (data==1) {
    			$("#error").text("Заявка успесшно отправлена!");
    		}else if(data==2){
    			$("#error").text("ошибка");
    		}

    	}
	});
});
</script>