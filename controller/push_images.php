<?php
	session_start();
	//	TODO Сделана авторизация!!
	if (!isset($_SESSION['logged_user'])) {
		header("HTTP/1.0 403 Please login");
		exit();
	}
	foreach ($_FILES['photos']['error'] as $value) {
		if ($value != 0) {
			header("HTTP/1.0 500 Error Image");
			exit();
		}
	}

?>


<pre>
	<?php
		include_once __DIR__.'/db.php';

		$conn = db_connect();
		$userId = $conn->query(sprintf("Select id from users where login='%s';", $_SESSION['logged_user']))->fetch()[0];
		var_dump($userId);
		$dir = __DIR__.'/../img/'.$userId;
		createDir($userId, $dir);
		$dir = $dir.'/';
		$images = $_FILES['photos'];
		var_dump(__DIR__);
		//		$path_parts = pathinfo('/www/htdocs/inc/lib.inc.php');
		//
		//		echo $path_parts['dirname'], "\n";
		//		echo $path_parts['basename'], "\n";
		//		echo $path_parts['extension'], "\n";
		//		echo $path_parts['filename'], "\n"; // начиная с PHP 5.2.0


		for ($i = 0; $i < count($images['name']); $i++) {
			$tmp = $images['tmp_name'][$i];
			$ext = ".".pathinfo($images['name'][$i])['extension'];
			$salt = random_int(-25600, 25600);
			$name = $userId.'/'.date("Y-m-d-H-i-s").md5($images['tmp_name'][$i].$salt).$ext;
			$conn->query(sprintf("insert into posts (creator, path) values ('%s', '%s')", $userId, $name));
			copy($tmp, __DIR__.'/../img/'.$name);
			var_dump($tmp);

		}
		//        var_dump($dir);


		function createDir($userId, $dir)
		{

			if (!file_exists($dir))
				mkdir($dir, 0777, true);
		}

		//        var_dump($_FILES);
	?>



</pre>