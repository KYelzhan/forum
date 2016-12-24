<?php
include_once("bd.php");
if (empty($_SESSION['login']) or empty($_SESSION['password'])) {
	exit ("Доступ на эту страницу разрешен только зарегистрированным пользователям. Если вы зарегистрированы, то войдите на сайт под своим логином и паролем<br><a href='index.php'>Главная страница</a>");
}

unset($_SESSION['password']);
unset($_SESSION['login']); 
unset($_SESSION['id']);// уничтожаем переменные в сессиях

exit("<meta http-equiv='Refresh' content='0; URL=index.php'>");
?>