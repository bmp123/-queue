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
			<input type="text" name="category" class="search-inp" id="search-category" value="category">
			<input type="text" name="city" class="search-inp" id="search-city" value="city">
			<button id="btn-search">Найти</button>
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
>>>>>>> dev
	</div>
	<footer>

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