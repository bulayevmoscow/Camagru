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
    <script>window.location.href = window.location.href + '&type=webcam'</script>
<?php } ?>

<script src="/js/photo.js"></script>

<div class="container make-photo">
    <div class="row border">
		<?php if ($_GET['type'] === 'webcam') { ?>
            <div class="col-8 border web-cam">
                <div id="preview">

                </div>
                <video src="" class="d-none" style="width: 100%; margin: auto; display: block"></video>
                <p id="web-cam-err"></p>
                <div id="wc-makephoto" class="d-flex justify-content-between my-2  d-none">
                    <a id="wc-b-makephoto" class="btn btn-danger d-none" onclick="webcam_make_snapshot(event)">Сделать снимок</a>
                    <input type="file" name="name" id="downloadImage" accept="image/*" hidden onchange="getPhotoFromLoad(event)">
                    <label for="downloadImage"><a id="downloadImageLabel" class="btn btn-success" onclick="">Загрузить
                            файл</a></label>

                    <a id="wc-b-download" class="btn btn-success d-none" onclick="sendImagesToSave()">Отправить</a>
                    <a id="wc-b-submit" class="btn btn-primary d-none" onclick="addPhotoToThumbnails()">Сохранить</a>
                </div>
                <div id="wc-mask-list" class="d-none">
                    <label for="wcSettingBrightness">Яркость</label>
                    <input type="range" class="form-control-range" id="wcSettingBrightness" value="0" min="-255" max="255" step="1">
                    <label for="wcSettingContrast">Контраст</label>
                    <input type="range" class="form-control-range" id="wcSettingContrast" value="0" min="-100" max="100" step="1"
                           onchange="console.log(this.value)">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="wcSettingInvert">
                        <label class="form-check-label" for="wcSettingInvert">Инвертировать цвета</label>
                        <div class="w-100"></div>
                        <input class="form-check-input" type="checkbox" value="" id="wcSettingGrayscale">
                        <label class="form-check-label" for="wcSettingGrayscale">Чернобелое</label>
                        <!--Иконки-->

                        <p class="h4 my-2">Маски</p>
                        <input class="form-check-input" type="radio" name="choiceMask" value="unset" checked>
                        <label class="form-check-label">Без маски</label>
						<?php $files = scandir(__DIR__.'/../img/icons/');
							foreach ($files as $file) {
								if ($file == '.' || $file == '..')
									continue;
								?>
                                <div class="w-100"></div>
                                <input class="form-check-input" type="radio" name="choiceMask" value="<?php echo $file ?>">
                                <label class="form-check-label"><?php echo $file ?></label>
							<?php } ?>
                    </div>
                </div>
            </div>
		<?php } ?>
        <div class="col-4">
            <div id="thumbnails">

            </div>
        </div>
    </div>
</div>

