<?php
include_once("bd.php");
if (isset($_POST['login'])) {
	$login = $_POST['login']; 
	if ($login == '') {
		unset($login);
		//exit ("Введите пожалуйста логин!");
		echo '<script language="javascript">';
	    echo 'alert("Введите пожалуйста логин!")';
	    echo '</script>';
	    echo '<meta http-equiv="refresh" content="0;url=index.php" />';
	} 
}
if (isset($_POST['password'])) {
	$password=$_POST['password']; 
	if ($password =='') {
		unset($password);
		//exit ("Введите пароль");
		echo '<script language="javascript">';
	    echo 'alert("Введите пароль")';
	    echo '</script>';
	    echo '<meta http-equiv="refresh" content="0;url=index.php" />';
	}
}

$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);


$login = trim($login);
$password = trim($password);

$password = md5($password);//шифруем пароль

$user = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password'");
$id_user = mysql_fetch_array($user);
if (empty($id_user['id'])){
	//exit ("Извините, введённый вами логин или пароль неверный.");
	echo '<script language="javascript">';
	echo 'alert("Извините, введённый вами логин или пароль неверный.")';
	echo '</script>';
	echo '<meta http-equiv="refresh" content="0;url=index.php" />';
}
else {

   
    $_SESSION['password']=$password; 
	$_SESSION['login']=$login; 
    $_SESSION['id']=$id_user['id'];
		  
}
echo "<meta http-equiv='Refresh' content='0; URL=index.php'>";
?>