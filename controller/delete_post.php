<?php
	session_start();
	if (!$_SESSION['logged_user']) {
		header('Location: /');
	}
	include_once __DIR__.'/db.php';
	$conn = db_connect();
	$user = $_SESSION['logged_user'];
	$id_post = $_POST['img'];
	$id_user = $conn->query(sprintf("Select id from users where login='%s'", $user))->fetch()[0];
	if ($id_user == null) {
		header('Location: /');
	}
	if ($conn->query(sprintf("Select count(*) from posts where id='%d' and  creator='%d'", $id_post, $id_user))->fetch()[0]) {
//	    Валидация успешна!
		$path = $conn->query(sprintf("select path from posts where id='%d'", $id_post))->fetch()[0];
		$conn->query(sprintf("delete FROM post where id='%d';", $id_post));
		unlink(__DIR__.'/../img/'.$path);
		$conn->query(sprintf("delete from posts where id='%d'", $id_post));
		header('Location: /index.php/?page=gallery'.parse_nbr_page($_SERVER['HTTP_REFERER'])."&msg=Пост удален");
	}
