<?php
//	var_dump($_FILES);
//	session_start();
//	require_once 'db.php';
////	TODO:ВАЛИДАЦИЯ
//	$images = $_POST['img'];
//	$conn = db_connect();
//	$idUser = $conn->query(sprintf("SELECT ID FROM users where login='%s';", $_SESSION['logged_user']))->fetch()[0];
//	$path = $_SERVER['DOCUMENT_ROOT'].'/img/'.$idUser;
////	Проверяем наличие папки
//	if (!file_exists($path))
//		mkdir($path, 0777);
//	$path = $path.'/'.md5($images[0]).'.jpg';
//	var_dump(move_uploaded_file($images[0], $path));
//	var_dump($_FILES['picture']['tmp_name']);
//
//
//
//
//	var_dump($path);
//
//
//	$first = $images[0];
//	$second = $images[1];

//	imagecopymerge($first, $second, 0, 0, 10, 10, 500, 200, 75);
//	header('Content-Type: image/png');
//	imagegif($first);
//
//	imagedestroy($first);
//	imagedestroy($second);
//	var_dump($_FILES['f']['tmp_name']);
//	var_dump($_FILES);

//	copy($_FILES['f']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/img/1.jpg');
//	//	echo 'MOLODEC';
//	header('Content-Type: image/jpg');
//
//	imagejpeg($_SERVER['DOCUMENT_ROOT'].'/img/1.jpg');

?>


<?php
//	session_start();
//	var_dump($_SESSION['logged_user'], 1);
//	var_dump($_POST);
//	print_r($_POST['PHPSESSID']);
    print_r($_COOKIE)

?>


