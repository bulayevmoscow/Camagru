<?php
	session_start();
	require __DIR__.'/../controller/db.php';
	$data = $_POST;
	$err = array();
	$conn = db_connect();

	//		name

	if (trim($data['name']) != '') {

		if (reg_name($data['name']) && strlen($data['name']) > 5 && mb_strlen($data['name']) < 25) {
			if ($conn->query("SELECT COUNT(*) FROM users where name='".trim($_POST['name'])."';")->fetch()[0] > 0) {
				$err[] = 'Данное имя уже используется';
			}
		} else {
			$err[] = "Разрешены для имени только <br>- Заглавные и строчные русские английские буквы<br>- Числа длиной от 5 до 18 символов";
		}
	} else {
		$err[] = "Введите Имя";
	}
	//	email

	if ($data['login'] && trim($data['login']) != '') {
		if (reg_email($data['login'])) {
			if ($conn->query("SELECT COUNT(*) FROM users where login='".trim($data['login'])."';")->fetch()[0] > 0) {
				$err[] = 'Данный email уже используется';
			}
		} else {
			$err[] = "Проверте пожалуйста правильность написания почты";
		}
	}
	//  password

	if ($data['password'] && trim($data['password']) != '') {
		if (mb_strlen($data['password']) < 6)
			$err[] = 'Неправильный пароль<br>- Разрешены пароли от 6 символов';
	}

	if (empty($err)) {
		$user = [
			'login' => $data['login'],
			'pass' => password_hash($data['password'], PASSWORD_DEFAULT),
			'email_check' => true,
			'email_message' => rand(10000, 99999),
			'register_date' => date('Y-m-d'),
			'name' => trim($data['name']),
		];
//		TODO Отправка почты
		$conn->prepare
		("INSERT INTO users (login, password, register_date, email_check, email_message, name)
		values (?, ?, ?, ?, ?, ?);")->execute
		([$user['login'], $user['pass'], $user['register_date'], $user['email_check'], $user['email_message'], $user['name']]);
		header('Location: /index.php?page=register&need_email_confirm=true');
	} else {
		header("Location: /index.php?page=register&reg=".implode(',', $err));
	}

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

