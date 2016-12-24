<?php
	include_once("bd.php");
	
	if (isset($_POST['submit'])){
		if(empty($_POST['login']))  {
			echo '<script language="javascript">';
	        echo 'alert("Введите логин!")';
	        echo '</script>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		} 
		elseif (!preg_match("/^\w{3,}$/", $_POST['login'])) {
			echo '<script language="javascript">';
	        echo 'alert("В поле "Логин" введены недопустимые символы! Только буквы, цифры и подчеркивание!")';
	        echo '</script>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		}
		elseif(empty($_POST['password'])) {
			echo '<script language="javascript">';
	        echo 'alert("Введите пароль!")';
	        echo '</script>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		}
		elseif (!preg_match("/\A(\w){6,20}\Z/", $_POST['password'])) {
			echo '<script language="javascript">';
	        echo 'alert("Пароль слишком короткий! Пароль должен быть не менее 6 символов!")';
	        echo '</script>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		}
		elseif(empty($_POST['password2'])) {
			echo '<script language="javascript">';
	        echo 'alert("Введите подтверждение пароля!")';
	        echo '</script>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		}
		elseif($_POST['password'] != $_POST['password2']) {
			echo '<script language="javascript">';
	        echo 'alert("Введенные пароли не совпадают!")';
	        echo '</script>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		}
		elseif(empty($_POST['email'])) {
			echo '<script language="javascript">';
	        echo 'alert("Введите E-mail!")';
	        echo '</script>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		}
		elseif (!preg_match("/^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/", $_POST['email'])) {
			echo '<script language="javascript">';
	        echo 'alert("E-mail имеет недопустимий формат! Например, name@gmail.com!")';
	        echo '</script>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
		}
		 
		else{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$mdPassword = md5($password);
			$password2 = $_POST['password2'];
			$email = $_POST['email'];
			$rdate = date("d-m-Y в H:i");
			$name = $_POST['name'];
			$lastname = $_POST['lastname'];  
			  
			$query = ("SELECT id FROM users WHERE login='$login'");
			$sql = mysql_query($query) or die(mysql_error());
			
			if (mysql_num_rows($sql) > 0) {
				echo '<script language="javascript">';
		        echo 'alert("Пользователь с таким логином зарегистрирован!")';
		        echo '</script>';
		        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
			}
			else {
				$query2 = ("SELECT id FROM users WHERE email='$email'");
				$sql = mysql_query($query2) or die(mysql_error());
				if (mysql_num_rows($sql) > 0){
					echo '<script language="javascript">';
			        echo 'alert("Пользователь с таким e-mail уже зарегистрирован!")';
			        echo '</script>';
			        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
				}
				else{
					$query = "INSERT INTO users (login, password, email, reg_date, name_user, lastname )
							  VALUES ('$login', '$mdPassword', '$email', '$rdate', '$name', '$lastname')";
					$result = mysql_query($query) or die(mysql_error());;
					echo '<script language="javascript">';
	                echo 'alert("Поздравляем вы успешно зарегистрировались")';
	                echo '</script>';
	                echo '<meta http-equiv="refresh" content="0;url=index.php" />';
					
								
				}
			}
		}
	}
?>