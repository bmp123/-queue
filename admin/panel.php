<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start() ?>
<?php require_once("../assets/values.php"); ?>

<? if(Values::session()){ ?>
<!DOCTYPE html>
<html>
<head lang="ru">
	<?echo Values::request_url();?>
	<title>Место где можно занять очередь</title>
</head>
<body>
	<header>
		<b>Какое то предложение</b> <a href="?url=destroySession">Выйти</a>
	</header>
	<div id="menu">
		<ul>
			<li><a href="">Главная</a></li>
			<li><a href="?url=addServices">Добавить услугу</a></li>
			<li><a href="?url=myData">Личные данные</a></li>
			<li><a href="?url=viewOrders">Заявки</a></li>
		</ul>	
	</div>
	<div id="body">
		<?if (isset($_GET['url'])) echo Values::getFun(); ?>
	</div>
	<footer>
		
	</footer>
</body>
</html>
<?}else{echo '<script language="JavaScript">window.location.href = "http://www.u.ru/admin/"</script>';}?>
<script type="text/javascript" src="../js/post.js"></script>