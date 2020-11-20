<?php

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
	if ($conn->query("SELECT COUNT(*) FROM users where login='".$data['login']."';")->fetch()[0] > 0) {
//		if ($conn->query("SELECT COUNT(*) FROM users where login='".$data['login']."' and email_check=true;")->fetch()[0] > 0) {
//			header('Location: /index.php?need_email_confirm=true');
//		} else
			if (password_verify($data['password'],
			$conn->query("SELECT password FROM users where login='".$data['login']."'")->fetch()['password'])) {
			$_SESSION['logged_user'] = $data['login'];
			header('Location: /index.php?auth=true');
		};

	}


?>


