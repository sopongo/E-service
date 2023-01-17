<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_USER_NOTICE);
ini_set('display_errors','On');
ini_set('display_startup_errors', true);

require_once "../canvas.php";
$file = "test_image.jpg";

$canvas = new canvas($file);

$canvas->set_rgb('#FFFFFF')
 		->resize("300", "300", "crop")
       ->merge("test_image.png", array("center", "middle"))
       //->filter("blur", 23)
//       ->show()
    ->save("new_image.jpg");

/*$img = new canvas("img/banksky3.jpg");
$img->set_crop_coordinates(-400, -410)
    ->resize("938", "240", "crop")
    ->filter("grayscale")
    ->text("banksky.co.uk", array(
           "color" => "#000",
           "background_color" => "#ffff00", 
           "size" => 4, 
           "x" => "right", 
           "y" => "top"))
    ->save("/tmp/new_image.png");*/