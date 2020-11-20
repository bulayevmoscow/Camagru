<?php
	session_start();
	include __DIR__.'/db.php';
	$err = array();
	$data = array();
	$data['login'] = trim($_POST['login']);
	$data['email_msg'] = trim($_POST['email_msg']);

	if ($data['login'] == '') {
		$err[] = 'Введите вашу почту';
	}
	if ($data['email_msg'] == '') {
		$err[] = 'Введите код из письма';
	}
	if ($err) {
		header('Location: /index.php?page=register&need_email_confirm=true&err='.implode(',', $err));
	}
	else {
		$conn = db_connect();
		$query = 'SELECT count(*) from users where login='.query_quotes($data['login']).' and email_message='.query_quotes($data['email_msg']).';';
		if ($conn->query($query)->fetch()[0] >= 1) {
			$query = "UPDATE users SET email_check=false, email_message='0' where login=".query_quotes($data['login']).";";
			$conn->query($query);
			$_SESSION['logged_user'] = $data['login'];
			header('Location: /index.php');
			exit();
		} else {
			$err[] = 'Неправильный код';
		}
		header('Location: /index.php?page=register&need_email_confirm=true&err='.implode(',', $err));
	}


	//	var_dump($data, $err);