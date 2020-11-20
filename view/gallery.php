<?php
	include __DIR__ . '/../controller/db.php';
	$conn = db_connect();
	if (!isset($_GET['pages'])) {?>
        <script !src="">window.location.href = window.location.href+'&pages=0'</script>
	<?php } ?>


<div class="container gallery-container">
    <div class="row">
		<?php
			$posts = $conn->query('Select * from posts');
			while ($row = $posts->fetch(PDO::FETCH_LAZY)) { ?>
                <div class="img-container col-12 border-danger border m-2">
                    <img src="<?php echo '/img/' . $row['path'] ?>" alt=""
                         class="d-block p-2 m-auto" style="max-height: 200px">
                    <p>Likes =
						<?php echo($conn->query(sprintf("select count(*) from post where id='%d' and is_like=true ;", $row['id']))
							->fetch()[0]); ?>
                    </p>
                    <div>
						<?php
							$commends = $conn->query(sprintf(
								"select * from post where id='%d' and is_like=false;", $row['id']));
							while ($commend = $commends->fetch(PDO::FETCH_LAZY)) { ?>
                                <p class="p-2 border">
                                    <span class="author">Автор сообщения <?php echo $commend['by'] ?><br></span>
									<?php echo $commend['message'] ?>
                                </p>
							<?php } ?>
                    </div>
                    <div class="mb-2">
                        <form class="mx-auto mt-2 w-100 " action="/controller/add_commend.php" method="post">
<!--                            <textarea type="text" class="form-control" placeholder="" name="comment">-->
                            <textarea class="form-control mb-2" name="commend" id=""></textarea>
                            <input class="d-none" type="text" name="img" value="<?php echo $row['id'] ?>">
                            <button class="btn btn-lg btn-primary btn-block d-block w-100" type="submit">Отправить коммент</button>
                        </form>
                    </div>
                </div>
			<?php } ?>
    </div>
</div>