<?php
	session_start();
	$data = $_POST;
	$errors = array();
	$answer = array();

	if (trim($data['login']) == '') {
		$errors[] = "Введите Email";
	}
	if ($data['password'] == '') {
		$errors[] = "Введите пароль";
	}


	include __DIR__."/../controller/db.php";
	$conn = db_connect();
	if ($conn->query(sprintf("select count(*) from users where login='%s'", $data['login']))->fetch()[0]) {
//		почта есть
		if (password_verify($data['password'],
			$conn->query(sprintf("SELECT password FROM users where login='%s'", $data['login']))->fetch()[0])) {
//			пароли совпадают
			if ($conn->query(sprintf("SELECT email_check FROM users where login='%s'", $data['login']))->fetch()[0] == 'true') {
				$errors[] = 'Нужна проверка почты';
				header('Location: /index.php?page=login&need_email_confirm=true');
				exit();
			} else {
				$_SESSION['logged_user'] = $data['login'];
				header('Location: /index.php');
				exit();
			}
		} else {
			$errors[] = 'Неверный пароль';
		}
	} else {
		$errors[] = 'Неверный логин';
	}
	header('Location: /index.php?page=login&err='.implode(',', $errors));

?>