<?php

header('Content-Type:application/json');
include "../connection.php";

$title = filterRequest('title');
$content = filterRequest('content');
$userid = filterRequest('id');
$imageName = imageUpload('file');

if ($imageName != 'fail') {
    $stmt = $connect->prepare("
    INSERT INTO `notes`(`note_title`, `note_content`, `note_user`,`note_image`)
    VALUES (?,?,?,?)
    ");
    $stmt->execute(array($title, $content, $userid,$imageName));
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "fail"));
    }
} else {
    echo json_encode(array("status" => "fail"));
}
