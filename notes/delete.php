<?php

include "../connection.php";

$noteid = filterRequest('id');
$imagename = filterRequest('imagename');

$stmt = $connect->prepare("DELETE FROM notes WHERE note_id = ?");
$stmt->execute(array($noteid));
$count = $stmt->rowCount();
if ($count > 0) {
    deleteFile("../upload/",$imagename);
    echo json_encode(array("status" => "success"));
    
} else {
    echo json_encode(array("status" => "fail"));
}
