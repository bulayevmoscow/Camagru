<?php
	session_start();

	//	session_save_path(__DIR__.'/sessions');
	//
	//?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/nav.css">

</head>
<body>
<?php
	include __DIR__.'/view/nav.php';
	if (($_GET['page'] === 'register') || ($_GET['page'] === 'login')) {
		include __DIR__.'/view/register.php';
	} elseif (($_GET['page']) === 'gallery') {
		include __DIR__.'/view/gallery.php';
	} elseif (($_GET['page']) === 'make') {
		include __DIR__.'/view/make_photo.php';
	} elseif (($_GET['page']) === 'lk') {
		include __DIR__.'/view/lk.php';
	}

?>

<?php
	//    echo mail('alexzlow@yandex.ru', 'subject', 'НЕТ!');

?>

</body>
</html>