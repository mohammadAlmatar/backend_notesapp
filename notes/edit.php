<?php

header('Content-Type:application/json');
include "../connection.php";

$noteid = filterRequest('id');
$title = filterRequest('title');
$content = filterRequest('content');

$stmt = $connect->prepare("UPDATE `notes` SET `note_title`=?,`note_content`=? WHERE note_id = ?");
$stmt->execute(array($title, $content, $noteid));
$count = $stmt->rowCount();
if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}
