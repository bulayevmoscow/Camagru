<?php
	include __DIR__.'/../controller/db.php';
	$conn = db_connect();
	$totalPages = ceil($conn->query(sprintf("select count(*) from posts where path IS NOT NULL"))->fetch()[0] / 5) - 1;
	if (!isset($_GET['pages'])) { ?>
        <script !src="">window.location.href = window.location.href + '&pages=0'</script>
	<?php } ?>

<?php ?>


<div class="container gallery-container">
    <div class="row">
        <nav class="m-auto">
            <ul class="pagination m-3">
				<?php if ($_GET['pages'] != 0) { ?>
                    <li class="page-item"><a class="page-link" href="/?page=gallery&pages=<?php echo $_GET['pages'] - 1 ?>">Previous</a>
                    </li>
				<?php }
					if ($_GET['pages'] < $totalPages) { ?>
                        <li class="page-item"><a class="page-link" href="/?page=gallery&pages=<?php echo $_GET['pages'] + 1 ?>">Next</a>
                        </li>
					<?php } ?>
            </ul>
        </nav>


		<?php
			$page = intval($_GET['pages']);
			$posts = $conn->query(sprintf("Select * from posts ORDER BY times DESC limit 5 offset '%s';", $page * 5));
			while ($row = $posts->fetch(PDO::FETCH_LAZY)) { ?>
                <div class="img-container col-12 border-danger border m-2">
                    <img src="<?php echo '/img/'.$row['path'] ?>" alt=""
                         class="d-block p-2 m-auto" style="max-height: 200px">
					<?php if ($row['creator'] == $conn->query(sprintf("Select id from users where login='%s'", $_SESSION['logged_user']))
							->fetch()[0]) { ?>
                        <div class="delete-commend-icon position-absolute"
                             style="right: 5px; top: 0px">
                            <form action="/controller/delete_post.php" method="post">
                                <input type="text" class="d-none" name="img" value="<?php echo $row['id'] ?>" hidden>
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </form>
                        </div>
					<?php } ?>
                    <div class="like-container d-flex flex-row justify-content-between align-items-center">
                        <p>Понравилось =
							<?php echo($conn->query(sprintf("select count(*) from post where id='%d' and is_like=true ;", $row['id']))
								->fetch()[0]); ?>
                        </p>
                        <span>
                            <form action="/controller/add_like.php" method="post" class="reset-active">
                                <input class="d-none" type="text" name="post" onchange="getPhotoFromLoad()"
                                       value="<?php echo $row['id'] ?>">
                                <?php
	                                $query = sprintf("SELECT count(*) from post where by='%s' and id=%d and is_like=true;",
		                                $_SESSION['logged_user'], $row['id']);
	                                $like = ($conn->query($query)->fetch()['count']);
                                ?>
                                <button type="submit" class="like <?php echo ($like) ? 'yes' : 'no'; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="36" height="36"
                                         viewBox="0 0 24 24"
                                         style=" fill:#000000;">
                                    <path d="M16.5,3C13.605,3,12,5.09,12,5.09S10.395,3,7.5,3C4.462,3,2,5.462,2,8.5C2,14,12,21,12,21s10-7,10-12.5 C22,5.462,19.538,3,16.5,3z M12,18.518C8.517,15.845,4,11.406,4,8.5C4,6.57,5.57,5,7.5,5C9.902,5,12,7.907,12,7.907S14.14,5,16.5,5 C18.43,5,20,6.57,20,8.5C20,11.406,15.483,15.845,12,18.518z"></path>
                                </svg>
                                </button>
                            </form>
                        </span>
                    </div>
                    <p>debug id = <?php echo $row['id'] ?></p>
					<?php
						$commends = $conn->query(sprintf("select * from post where id=%d and is_like=false;", $row['id']));
						while ($commend = $commends->fetch(PDO::FETCH_LAZY)) {
							?>
                            <div class="d-flex flex-column">
                                <div class="p-2 border d-flex flex-column w-100 position-relative">
                                    <span class="author">Автор сообщения <?php echo
	                                    $conn->query(sprintf("select name from users where login='%s'", $commend['by']))->fetch()[0];
	                                    ?><br></span>
                                    <p class="commend"> <?php echo trim($commend['message']) ?></p>
									<?php if ($commend['by'] == $_SESSION['logged_user']) { ?>
                                        <div class="delete-commend-icon position-absolute"
                                             style="right: 5px; top: 0px">
                                            <form action="/controller/delete_commend.php" method="post">
                                                <input type="text" class="d-none" name="img" value="<?php echo $row['id'] ?>" hidden>
                                                <input type="text" class="d-none" name="id" value="<?php echo $commend['id_post'] ?>"
                                                       hidden>
                                                <button type="submit" class="close" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </form>
                                        </div>
									<?php } ?>
                                </div>
                            </div>
						<?php } ?>
                    <div class="mb-2">
                        <form class="mx-auto mt-2 w-100 "
                              action="/controller/add_commend.php"
                              method="post">
                            <textarea class="form-control mb-2" name="commend"
                                      id=""></textarea>
                            <input class="d-none" type="text" name="img"
                                   value="<?php echo $row['id'] ?>">
                            <button class="btn btn-lg btn-primary btn-block d-block w-100"
                                    type="submit">Отправить коммент
                            </button>
                        </form>
                    </div>
                </div>
			<?php } ?>
        <nav class="m-auto">
            <ul class="pagination m-3">
				<?php if ($_GET['pages'] != 0) { ?>
                    <li class="page-item"><a class="page-link" href="/?page=gallery&pages=<?php echo $_GET['pages'] - 1 ?>">Previous</a>
                    </li>
				<?php }
					if ($_GET['pages'] < $totalPages) { ?>
                        <li class="page-item"><a class="page-link" href="/?page=gallery&pages=<?php echo $_GET['pages'] + 1 ?>">Next</a>
                        </li>
					<?php } ?>
            </ul>
        </nav>
    </div>

