<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php require_once("../assets/values.php"); ?>
<!DOCTYPE html>
<html>
<head lang="ru">
	<?echo Values::request_url();?>
	<title>Место где можно занять очередь</title>
</head>
<body>
	<header>
		<b>Какое то предложение</b>
		<a href="../admin/">Вход в панель управлени</a>
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
Ссылка <a href="register.php">регистрации</a> партнера
	</div>
	<footer>
		
	</footer>
</body>
</html>
