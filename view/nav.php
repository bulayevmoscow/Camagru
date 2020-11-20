<div class="container menu">
    <div class="row">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="/">Navbar</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=gallery">Gallery <span class="sr-only">(current)</span></a>
                    </li>

					<?php if ($_SESSION['logged_user']) { ?>
                        <li class="nav-item d-flex flex-row">
                            <a class="nav-link" href="/index.php?page=lk">Вы вошли как <?php echo $_SESSION['logged_user'] ?></a>
                            <a class="nav-link" href="/controller/exit.php">(Выйти)</a>

                        </li>
					<?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/?page=register">Войти</a>
                        </li>
					<?php } ?>
                </ul>
            </div>
        </nav>
    </div>
	<?php if (isset($_GET['out'])) { ?>
        <div class="row">
            <p class="p bg-success w-100 p-2 text-white"><?php echo($_GET['out']) ?></p>
        </div>
	<?php } ?>
	<?php if (isset($_GET['in'])) { ?>
        <div class="row">
            <p class="p bg-success w-100 p-2 text-white"><?php echo($_GET['in']) ?></p>
        </div>
	<?php } ?>
	<?php if (isset($_GET['auth'])) { ?>
        <div class="row">
            <p class="p bg-success w-100 p-2 text-white">Привет <?php echo($_SESSION['logged_user']) ?></p>
        </div>
	<?php } ?>
</div>