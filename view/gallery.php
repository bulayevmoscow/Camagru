<?php
	include __DIR__.'/../controller/db.php';
	$conn = db_connect();
	if (!isset($_GET['pages'])) { ?>
        <script !src="">window.location.href = window.location.href + '&pages=0'</script>
	<?php } ?>

<?php ?>


<div class="container gallery-container">
    <div class="row">
		<?php
			$posts = $conn->query('Select * from posts');
			while ($row = $posts->fetch(PDO::FETCH_LAZY)) { ?>
        <div class="img-container col-12 border-danger border m-2">
            <img src="<?php echo '/img/'.$row['path'] ?>" alt=""
                 class="d-block p-2 m-auto" style="max-height: 200px">
            <p>Likes =
				<?php echo($conn->query(sprintf("select count(*) from post where id='%d' and is_like=true ;", $row['id']))
					->fetch()[0]); ?>
            </p>
            <p>debug id = <?php echo $row['id'] ?></p>
			<?php
				$commends = $conn->query(sprintf("select * from post where id=%d and is_like=false;", $row['id']));
				while ($commend = $commends->fetch(PDO::FETCH_LAZY)) {
			?>
            <div class="d-flex flex-column">
                <div class="p-2 border d-flex flex-column w-100 position-relative">
                    <span class="author">Автор сообщения <?php echo $commend['by'] ?><br></span>
                    <p class="commend"> <?php echo trim($commend['message']) ?></p>
                    <!--							--><?php //var_dump($commend); ?>
                    <div class="delete-commend-icon position-absolute"
                         style="right: 5px; top: 0px">
                        <form action="/controller/delete_commend.php" method="post">
                            <input type="text" class="d-none" name="img" value="<?php echo $row['id'] ?>">
                            <input type="text" class="d-none" name="id" value="<?php echo $commend['id_post'] ?>">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                    </div>
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

</div>


