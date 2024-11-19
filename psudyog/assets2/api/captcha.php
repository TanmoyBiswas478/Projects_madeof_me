<?php 
session_start();
// Generate captcha code
$random_num    = md5(random_bytes(64));
$captcha_code  = substr($random_num, 0, 6);
// Assign captcha in session

$_SESSION['CAPTCHA_CODE'] = $captcha_code;
$font = dirname(__FILE__) . "\Verdana_Bold.ttf";
//echo $font;
// Create captcha image

$layer = imagecreatetruecolor(168, 37);
$captcha_bg = imagecolorallocate($layer, 255,255,255);
imagefill($layer, 0, 0, $captcha_bg);
$captcha_text_color = imagecolorallocate($layer, 0, 0, 0);

//imagettftext($layer, 20,10, 40, 10, $captcha_code, $captcha_text_color);

imagettftext($layer, 15, 0, 10, 20, $captcha_text_color, $font, $captcha_code);

//header("Content-type: image/jpeg");
imagejpeg($layer);

//imagepng($layer);
imagedestroy($layer);
?>
