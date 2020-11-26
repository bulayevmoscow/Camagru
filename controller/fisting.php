<?php

	$img = array();

	if (!isset($_FILES) ||
		!isset($_FILES['indexPhoto']) ||
		!isset($_FILES['indexPhoto']['tmp_name']) ||
		$_FILES['indexPhoto']['error']) {

	}
	//	checkExt();

	$img['index'] = $_FILES['indexPhoto'];
	$img['indexPhoto'] = $_FILES['indexPhoto']['tmp_name'];
	$img['indexImage'] = checkExt($_FILES['indexPhoto']);
	$img['second'] = null;
	$img['final'] = null;
	//	header('Content-Type: image/jpg');
	header('Content-Type: image/png');
	//	test
	$img['indexImage'] = filterImage($img['indexImage']);
//	imagefilter($img['indexImage'], IMG_FILTER_GRAYSCALE);
	imagepng($img['indexImage']);


	//	print_r($_FILES);
?>

<?php
	function checkExt($img)
	{
		if (($image = imagecreatefromstring(file_get_contents($img['tmp_name']))) == false) {
			header("HTTP/1.0 500 ERROR LOAD IMAGE");
			exit(303);
		} else {
			return $image;
		}
	}
	function filterImage($img){
		$config = json_decode($_POST['json'], true);


		if ($config["wcSettingBrightness"] != 0)
		{
//			from -255 to 255
			imagefilter($img, IMG_FILTER_BRIGHTNESS, $config["wcSettingBrightness"]);
		}
		if ($config["wcSettingContrast"] != 0)
		{
			imagefilter($img, IMG_FILTER_BRIGHTNESS, $config["wcSettingBrightness"]);
		}
		if ($config["wcSettingInvert"])
		{
			imagefilter($img, IMG_FILTER_NEGATE);
		}
		if ($config["wcSettingGrayscale"])
		{
			imagefilter($img, IMG_FILTER_GRAYSCALE);
		}
		return $img;
	}
?>
<?php
	//	TODO Сделать валидацию пользователя
	//  TODO  Сделать валидацию файлов
?>

