<?php
include "../connection.php";


$userid = filterRequest('id');


$stmt = $connect->prepare("SELECT * FROM notes WHERE `note_user`= ? ");
$stmt->execute(array($userid));
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "fail"));
}
