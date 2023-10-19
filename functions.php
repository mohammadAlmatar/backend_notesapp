<?php

define('MB', 1048576);

function filterRequest($requestname)
{
    return htmlspecialchars(strip_tags($_POST[$requestname]));
}

function imageUpload($imageRequest)
{
    global $msgError;
    $imageName = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
    $imageTmp = $_FILES[$imageRequest]['tmp_name'];
    $imageSize = $_FILES[$imageRequest]['size'];
    $allowExt = array("jpg", "png", "gif", "mb3", "pdf");
    $stringToArray = explode(".", $imageName);
    $ext = end($stringToArray);
    $ext = strtolower($ext);
    if (!empty($imageName) && !in_array($ext, $allowExt)) {
        $msgError[] = "Extention";
    }
    if ($imageSize > 5 * MB) {
        $msgError[] = "Size";
    }
    if (empty($msgError)) {
        move_uploaded_file($imageTmp, "../upload/" . $imageName);
        return $imageName;
    } else {
        return "fail";
    }
}
function deleteFile($dir, $imageName)
{
    if (file_exists($dir . $imageName)) {
        unlink($dir . $imageName);
    } else {
        echo "error deleting not found";
    }
}
