<?php
	session_start();

	$host = "localhost";
	$user = "root";
	$pwd  = "";
	$db   = "forum";

	$con = mysql_connect($host,$user,$pwd) or die("Could not connect");
	mysql_select_db($db,$con) or die("No database");
	mysql_query("SET NAMES utf8");

	$login = @$_SESSION['login'];
	$password = @$_SESSION['password'];
	$id_user = @$_SESSION['id'];
?>