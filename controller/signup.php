<?php
	require __DIR__.'/controller/db.php';
	$data = $_POST;
	$errors = array();
	if (trim($data['login']) == '') {
		$errors[] = "Введите Email";
	}
	if ($data['password'] == '') {
		$errors[] = "Введите пароль";
	}
	$conn = db_connect();
	if ($conn->query("SELECT COUNT(*) FROM users where login='".$data['login']."';")->fetch()[0] > 0) {
		$errors[] = 'Данный email уже используется';
	}
	if (empty($errors)) {
		$user = [
			'login' => $data['login'],
			'pass' => password_hash($data['password'], PASSWORD_DEFAULT),
			'email_check' => true,
			'email_message' => rand(10000, 99999),
			'register_date' => date('Y-m-d'),
		];
		$conn->prepare("INSERT INTO users (login, password, register_date, email_check, email_message)
values (?, ?, ?, ?, ?);")->execute([$user['login'], $user['pass'], $user['register_date'], $user['email_check'], $user['email_message']]);
		header('Location: index.php?need_email_confirm=true');
	} else {
		header("Location: index.php?page=register&reg=".implode(',', $errors));
	}

?>

<!---->
<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <p class="h3 text-center">-->
<!--			--><?php //var_dump($errors); ?>
<!--        </p>-->
<!--        <p class="h3 text-center">-->
<!--			--><?php //if (isset($user)) {
//				var_dump($user);
//			} ?>
<!--        </p>-->
<!--    </div>-->
<!--</div>-->

