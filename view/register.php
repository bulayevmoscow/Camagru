<?php
	if (isset($_GET['err'])) {
		foreach (explode(',', $_GET['err']) as $value) {
			?>
            <p class="bg-danger p-2 text-white mb-0"><?php echo $value ?></p>
			<?php
		}
	}
?>
<?php
	if (isset($_GET['msg'])) {
		foreach (explode(',', $_GET['msg']) as $value) {
			?>
            <p class="bg-success p-2 text-white mb-0"><?php echo $value ?></p>
			<?php
		}
	}
?>

<?php if (!isset($_GET['need_email_confirm'])) { ?>
    <div class="container text-center h-100 d-flex justify-content-center flex-column mt-5" style="min-height: 1vh">
        <form class="form-signin mx-auto mt-2 d-none" action="/controller/signup.php" method="post" style="min-width: 400px">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
			<?php if (isset($_GET['reg'])) {
				if ($_GET['reg'] == 'true') {
					echo '<p class="bg-success p-2">Регистрация успешна!<br>Проверте почту</p>';
				} else {
					foreach (explode(',', $_GET['reg']) as $key) {
						echo '<p class="bg-danger p-2 text-white">'.$key.'</p>';
					}
				}
			} ?>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control mb-1" placeholder="Email address" autofocus=""
                   name="login">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control mb-1" placeholder="Password"
                   name="password">
            <a class="m-2 text-left d-flex" href="">Забыл пароль</a>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
        <form class="form-login mx-auto mt-2 " action="/controller/login.php" method="post" style="min-width: 400px">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control mb-1" placeholder="Email address" autofocus=""
                   name="login">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control mb-1" placeholder="Password"
                   name="password">
            <a class="m-2 text-left d-flex" href="">Забыл пароль</a>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
        <div class="row my-auto">
            <div class="w-100 p-2">
                <div id="regSwitcher" class="btn-group btn-group-toggle " data-toggle="buttons">
                    <label class="btn btn-secondary ">
                        <input type="radio" name="options" id="option1" autocomplete="off" checked> Зарегестрироваться
                    </label>
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Войти
                    </label>
                </div>
            </div>
        </div>
        <script src="/js/reg.js"></script>
    </div>

<?php } elseif (isset($_GET['need_email_confirm'])) { ?>

    <div class="container text-center h-100 d-flex justify-content-center flex-column mt-5">
        <div class="row">
            <form class="mx-auto mt-2 " action="/controller/confirm_mail.php" method="post" style="min-width: 400px">
                <p class="h3">Подтвердите вашу почту</p>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" class="form-control mb-1" placeholder="Ваша почта" autofocus=""
                       name="login">
                <label for="inputPassword" class="sr-only">Код из письма</label>
                <input type="text" id="inputPassword" class="form-control mb-1" placeholder="Код из письма"
                       name="email_msg">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Подтвердить</button>
            </form>
        </div>
    </div>
<?php } ?>