<?php

	//
	//	TODO:
	//	   Эта часть должна быть доступна только пользователям, которые аутентифицированы / подключены
	//	   и вежливо отклоняют всех других пользователей, которые пытаются получить к ней доступ без успешного входа в систему.
	//	TODO: Эта страница должна содержать 2 раздела:
	//		- Основной раздел, содержащий предварительный просмотр веб-камеры пользователя, список наложенных изображений и кнопку,
	//		позволяющую сделать снимок.
	//		- Боковая часть, показывающая эскизы всех ранее сделанных снимков. Макет вашей страницы обычно должен выглядеть так, как показано
	//		 на рисунке V.1.
	//	TODO: Функционал
	//		- Наложение изображений должно быть доступно для выбора, а кнопка, позволяющая сделать снимок, должна быть неактивной (не
	//		кликабельной) до тех пор, пока не выбрано наложенное изображение.
	//		- Создание окончательного изображения (среди прочего, наложение двух изображений) должно выполняться на стороне сервера в PHP.
	//		- Поскольку не у всех есть веб-камера, вам следует разрешить загрузку пользовательского изображения вместо того, чтобы снимать его с
	//		помощью веб-камеры.
	//		- Пользователь должен иметь возможность удалять свои отредактированные изображения, но только свои, а не творения других пользователей.

?>

<?php if (!isset($_GET['type'])) { ?>
    <script !src="">window.location.href = window.location.href + '&type=webcam'</script>
<?php } ?>
<script src="/js/photo.js"></script>

<div class="container make-photo">
    <div class="row border">
		<?php if ($_GET['type'] === 'webcam') { ?>
            <div class="col-8 border web-cam">
                <div id="preview">

                </div>
                <video src="" class="d-none" style="width: 100%; margin: auto; display: block"></video>
                <!--                Окно захвата-->
                <script !src="">        </script>
                <p id="web-cam-err"></p>
                <!--                Содание снепшота-->


                <div id="wc-makephoto" class="d-flex justify-content-between my-2  d-none">
                    <a id="wc-b-makephoto" class="btn btn-danger d-none" onclick="webcam_make_snapshot(event)">Сделать снимок</a>
                    <a id="wc-b-addmask" class="btn btn-success d-none" onclick="webcamAddMask()" disabled>Добавить маску</a>
                    <a id="wc-b-submit" class="btn btn-primary d-none" onclick="sumbit_photo()">Отправить</a>
                </div>
                <div id="wc-mask-list">
                    <p>Mask</p>
                </div>

<!--                <form class="hand" action="/controller/fisting.php" method="post">-->
<!--                    <input type="file" name="picture">-->
<!--                    <button type="submit">1</button>-->
<!--                </form>-->
<!--                <div id="fileOutput">-->
<!--                    <img id="output" class="w-75 m-auto d-block" src="" alt="">-->
<!--                </div>-->

            </div>
		<?php } ?>
        <div class="col-4">

        </div>
    </div>
</div>

