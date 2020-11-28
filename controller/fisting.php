<?php

	$img = array();

	//	if (!isset($_FILES) ||
	//		!isset($_FILES['indexPhoto']) ||
	//		!isset($_FILES['indexPhoto']['tmp_name']) ||
	//		$_FILES['indexPhoto']['error']) {
	//		header("HTTP/1.0 500 ERROR INPUT DATA");
	//		exit(303);
	//	}
	//	checkExt();

	$img['index'] = $_FILES['indexPhoto'];
	$img['indexPhoto'] = $_FILES['indexPhoto']['tmp_name'];
	$img['indexImage'] = checkExt($_FILES['indexPhoto']);
	$img['params'] = getimagesizefromstring(file_get_contents($_FILES['indexPhoto']['tmp_name']));
	$img['merge'] = json_decode($_POST['json'], true)['wcSettingIcon'];


	$img['indexImage'] = filterImage($img['indexImage']);
	if (isset($img['merge']) && $img['merge'] != 'unset')
		mergeImages($img, $img['merge']);


	header('Content-Type: image/png');
	imagepng($img['indexImage']);
	exit();
?>

<?php
	function mergeImages($img, $addImage)
	{
		$img2 = array();
		$img2['src'] = __DIR__.'/../img/icons/i-b.png';
		$files = scandir(__DIR__.'/../img/icons');
		foreach ($files as $file) {
			if ($file == $addImage)
				$img2['src'] = __DIR__.'/../img/icons/'.$file;
		}
		$img2['indexPhoto'] = imagecreatefromstring(file_get_contents($img2['src']));
		$img2['params'] = getimagesizefromstring(file_get_contents($img2['src']));

		$img2['params'] = getimagesizefromstring(file_get_contents(__DIR__.'/../img/icons/i-b.png'));
		imagecopymerge_alpha($img['indexImage'],
			$img2['indexPhoto'],
			$img['params'][0] - $img2['params'][0] - $img['params'][0] * 0.03,
			$img['params'][1] - $img2['params'][1] - $img['params'][1] * 0.03,
			0, 0,
			$img2['params'][0],
			$img2['params'][1],
			100);
	}


	function checkExt($img)
	{
		if (($image = imagecreatefromstring(file_get_contents($img['tmp_name']))) == false) {
			header("HTTP/1.0 500 ERROR LOAD IMAGE");
			exit(303);
		} else {
			return $image;
		}
	}

	function filterImage($img)
	{
		$config = json_decode($_POST['json'], true);
		if ($config["wcSettingBrightness"] != 0) {
//			from -255 to 255
			imagefilter($img, IMG_FILTER_BRIGHTNESS, $config["wcSettingBrightness"]);
		}
		if ($config["wcSettingContrast"] != 0) {
			imagefilter($img, IMG_FILTER_BRIGHTNESS, $config["wcSettingBrightness"]);
		}
		if ($config["wcSettingInvert"]) {
			imagefilter($img, IMG_FILTER_NEGATE);
		}
		if ($config["wcSettingGrayscale"]) {
			imagefilter($img, IMG_FILTER_GRAYSCALE);
		}
		return $img;
	}

	function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
	{
		$cut = imagecreatetruecolor($src_w, $src_h);
		imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
		imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
		imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
	}

?>
<?php
	//	TODO Сделать валидацию пользователя
	//  TODO  Сделать валидацию файлов
?>

