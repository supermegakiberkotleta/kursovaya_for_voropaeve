<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

$conn = connectToDatabase();

$elemId = $_POST['elemId'];
$currenTable = $_POST['currenTable'];

$sql = "DELETE FROM " . $currenTable . " WHERE book_id = " . $elemId;
$result = $conn->query($sql);

if ($result) {
    $response = array("status" => "success");
} else {
    $response = array("status" => "error", "message" => "Ошибка при удалении элемента: " . $conn->error);
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();