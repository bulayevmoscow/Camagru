<?php
	session_start();
	$err = array();
	$user = $_SESSION['logged_user'];
	$info = array();

	if ($user == NULL) {
		header('Location: /index.php?page=login&msg=Для продолжения залогиньтесь');
		exit();
	}
	include_once __DIR__.'/../controller/db.php';
	$conn = db_connect();
	if (isset($_POST)) {
		// Проверка имени
		if ($_POST['name'] && trim($_POST['name']) != '') {
			if (reg_name($_POST['name']) && strlen($_POST['name']) > 5 && mb_strlen($_POST['name']) < 25) {
				if ($conn->query("SELECT COUNT(*) FROM users where name='".trim($_POST['name'])."';")->fetch()[0] > 0) {
					$err[] = 'Данное имя уже используется';
				} else
					$info['name'] = trim($_POST['name']);
			} else {
				$err[] = "Разрешены только <br>- Заглавные и строчные русские английские буквы<br>- Числа длиной от 5 до 18 символов";
			}
		}
		//  Проверка почты
		if ($_POST['email'] && trim($_POST['email']) != '') {
			if (reg_email($_POST['email'])) {
				if ($conn->query("SELECT COUNT(*) FROM users where login='".trim($_POST['email'])."';")->fetch()[0] > 0) {
					$err[] = 'Данный email уже используется';
				} else
					$info['email'] = trim($_POST['email']);
			} else {
				$err[] = "Проверте пожалуйста правильность написания почты";
			}
		}
		//  Проверка пароля
		if ($_POST['password'] && trim($_POST['password']) != '') {
			if (mb_strlen($_POST['password']) > 5)
				$info['password'] = ($_POST['password']);
			else {
				$err[] = 'Неправильный пароль<br>- Разрешены пароли от 6 символов';
			}
		}
	} else {
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}

	if (count($err)) {
		header("Location: /index.php?page=lk&err=".implode(",", $err));
		exit();
	}


	$id = $conn->query(sprintf("SELECT id from users where login='%s';", $user))->fetch()[0];
	if (!$id) {
		header("Location: /?page=login&mgs=".'Неверные данные пользователя');
		exit();
	}
	if ($info['email']) {
		if ($conn->query("SELECT COUNT(*) FROM users where login='".$info['email']."';")->fetch()[0] > 0) {
			$err[] = 'Данный email уже используется';
		} else
			$conn->query(sprintf("update users set login='%s' where id=%d;", $info['email'], $id));
	}
	if ($info['name']) {
		$conn->query(sprintf("update users set name='%s' where id=%d;", $info['name'], $id));
	}
	if ($info['password']) {
		$conn->query(sprintf("update users set password='%s' where id=%d;",
			password_hash($info['password'], PASSWORD_DEFAULT), $id));
	}
	if ($info['password']) {
		unset($_SESSION['logged_user']);

	}
	header('Location: /index.php?page=lk');

	function reg_name($str)
	{
		$check = array($str);
		if (count(preg_grep('/[^\wА-Яа-я0-9 \-]+/u', $check)) == 0)
			return true;
		else
			return false;
	}

	function reg_email($str)
	{
		$check = array($str);
		if (count(preg_grep('/[^\wА-Яа-я0-9@.]+/u', $check)) == 0)
			return true;
		else
			return false;
	}