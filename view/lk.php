<?php
	session_start();
	$user = $_SESSION['logged_user'];
	if ($user == NULL) {
		echo "<script>window.location = '/index.php?page=register&msg=Для продолжения залогиньтесь'</script>";
		exit();
	}
	include_once __DIR__.'/../controller/db.php';
	$conn = db_connect();
	$info = [
		"name" => $conn->query(sprintf("Select name from users where login='%s'", $user))->fetch()[0],
		"login" => $conn->query(sprintf("Select login from users where login='%s'", $user))->fetch()[0],
	]

?>
<div class="container">
    <div class="row d-flex flex-column">
        <p class="h1">Привет <?php echo $info["name"] ?></p>
        <div class="form">
            <form action="/controller/change.php" class="m-2" method="post">
                <p>Не заполняйте поля, если не хотите их менять</p>
                <input class="form-control mt-1" type="text" id="name" name="name" placeholder="Имя" minlength="3" maxlength="18">
                <small class="form-text text-muted float-right"><?php echo $info['name'] ?></small>
                <input class="form-control mt-1" type="email" id="email" name="email" placeholder="Почта" maxlength="80">
                <small class="form-text text-muted float-right"><?php echo $info['login'] ?></small>
                <!--TODO Валидация данных-->
                <input class="form-control mt-1" type="password" name="password" id="" placeholder="Пароль">
                <button class="d-block ml-auto btn btn-primary" type="submit">Изменить</button>
            </form>
        </div>
    </div>
</div>
