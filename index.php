<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php require_once("assets/values.php"); ?>
<!DOCTYPE html>
<html>
<head lang="ru">
	<meta charset="utf-8">
	<?echo Values::request_url();?>
	<title>Место где можно занять очередь</title>
</head>
<body>
	<header>
		<b>Бесплатный сервис по поиску необходимых услуг</b>
		<a href="admin">Вход в панель управлени</a>
	</header>
	<div id="search">
		<div id="search-panel">
			<form method="get">
				<input type="hidden" name="url" value="viewSearch">
				<input type="text" name="s_category" class="search-inp" id="search-category" value="category">
				<input type="text" name="s_city" class="search-inp" id="search-city" value="city">
				<button id="btn-search">Найти</button>
			<form>
		</div>
	</div>
	<!-- <div id="menu">
		<ul>
			<li><a href="">Главная</a></li>
			<li><a href="partner">Партнерам</a></li>
			<li><a href="">Что мы делаем</a></li>
			<li><a href="">О нас</a></li>
		</ul>	
	</div> -->
	<div id="body">
<<<<<<< HEAD
		<?if (isset($_GET['url'])) $view = Values::getFun(); if(!isset($_GET['url'])) $view = Values::viewCategory();?>
		<? echo "$view"; ?>
=======
		<?if (isset($_GET['url'])) echo Values::getFun(); if(!isset($_GET['url'])) echo Values::viewCategory();?>
<<<<<<< HEAD
>>>>>>> dev
=======

		<div>
			
		</div>
>>>>>>> dev
	</div>
	<footer>
		<p class="copyright">&copy; Ivan Danilov</p>
	</footer>
</body>
</html>
<?
	if (isset($_GET['id'])) {
		echo "<script type=\"text/javascript\">document.getElementById('wrapper').style.display = \"none\";document.getElementById('wrapper_cat').style.display = \"block\";</script>";
	}
	if (isset($_GET['name'])) {
		echo "<script type=\"text/javascript\">document.getElementById('wrapper_cat').style.display = \"none\";document.getElementById('wrapper_ind').style.display = \"block\";</script>";
	}
?>
<script type="text/javascript">
$('#btn-search').click(function () {
	var category = $('#search-category').val(),
		city = $('#search-city').val();
	
	$.ajax({
    	type : 'POST',
    	url : '../assets/search.php',
    	data : {s_category:category,s_city:city},
    	success : function(data) {console.log(data);
    		if (data==1) {          
    			
				$("#error").text("Отправленна");
    		}else if(data==2){
    			$("#error").text("Не отправлена");
    		}

    	}
	});
});
</script>