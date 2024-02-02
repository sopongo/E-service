<?php
ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");

require_once __DIR__ . "/../../../include/connect_db.inc.php";
require_once __DIR__ . "/../../../include/class_crud.inc.php";
require_once __DIR__ . "/../../../include/function.inc.php";
require_once __DIR__ . "/../../../include/setting.inc.php";

if (isset($_POST["imgData"])) {
    // Get the image data from the POST request
    $imgData = $_POST["imgData"];

    // Remove the data prefix from the base64-encoded image data
    $imgData = str_replace("data:image/png;base64,", "", $imgData);

    // Decode the base64-encoded image data
    $imgData = base64_decode($imgData);

    $PathImg = getPathImg(Setting::$PathImg);

    // Set the path where you want to save the image
    $savePath = __DIR__ . "/../../../dist/img/img_itnotify/" . $PathImg . "/". date('d').".png";

    // Save the image to the specified path
    file_put_contents($savePath, $imgData);

    // Send a response back to the client
    echo $savePath;
} else {
    // Send an error response if imgData is not set
    header("HTTP/1.1 400 Bad Request");
    echo "Bad Request: imgData parameter is missing.";
}