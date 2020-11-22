<?php
	session_start();
	require_once __DIR__ . '/db.php';


	$id = $_POST['img'];
	$post = $_POST['id'];
	$user = $_SESSION['logged_user'];
	$err = array();
	if ($user == NULL) {
		header('Location: /index.php?page=register&msg=Для продолжения залогиньтесь');
		exit();
	}

	if (!is_numeric($id))
		$err[] = 'Неверный код изображения';
	if (!is_numeric($post))
		$err[] = 'Неверный код поста';
	if ($err) {
		header(sprintf('Location: http://localhost:8080/?page=gallery&pages=%d&err=%s',
			$id / 10, implode(',', $err)));
		exit();
	} else {
		$conn = db_connect();
//		Проверка на владельца
//		SELECT count(*) from post where id_post='5' and by='1@4' and id='1'
		if ($conn->query(sprintf("SELECT count(*) from post where id_post='%d' and by='%s' and id='%d'", $post, $user, $id))->fetch()[0]) {
			$conn->query(sprintf("delete FROM post where id_post=%d;", $post));
			header('Location: /index.php/?page=gallery'.parse_nbr_page($_SERVER['HTTP_REFERER']));
			exit();
		} else {
			$err[] = 'Вы пытаетесь удалить чужой комментарий';
		}

	}
	header('Location: /index.php/?page=gallery'.parse_nbr_page($_SERVER['HTTP_REFERER'])
		.'&err='.implode(',', $err));
	exit();