<?php
	// TODO Допилить коментарии
	session_start();
	require_once __DIR__.'/db.php';
	// add commend
	$message = trim(htmlspecialchars($_POST['commend'], ENT_QUOTES));
	$id = $_POST['img'];
	$user = $_SESSION['logged_user'];
	$err = array();

	if ($user == NULL) {
		//FIXME: Сделать нормальную адресацию
		header('Location: /index.php?page=register&msg=Для продолжения залогиньтесь');
		exit();
	}
	if (trim($message) == '')
		$err[] = 'Пустое сообщение';
	if (!is_numeric($id))
		$err[] = 'Неверное изображение';
	if ($err) {
		//FIXME: Сделать нормальную адресацию
		header(sprintf('Location: http://localhost:8080/?page=gallery&pages=%d&err=%s',
			$id / 10, implode(',', $err)));
		exit();
	}
	$conn = db_connect();
	$query = $conn->query(sprintf("INSERT INTO post (id, is_like, by, message) values (%s, %s, %s, %s);",
		$id, 'false', query_quotes($user), query_quotes($message)));
	header('Location: /index.php/?page=gallery'
		.parse_nbr_page($_SERVER['HTTP_REFERER'])
		.implode(',', ['Вы успешно добавили комментарий']));
	//			TODO Сделать отправку письма на почту для добавления комментария







