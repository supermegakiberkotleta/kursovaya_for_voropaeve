<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['addNameInput'];
    $class = $_POST['addClassInput'];
    $group = $_POST['addGroupInput'];


    $conn = connectToDatabase();

    // Получим последний book_id
    $lastIdQuery = "SELECT MAX(student_id) as last_id FROM Students";
    $result = $conn->query($lastIdQuery);
    $row = $result->fetch_assoc();
    $lastId = $row['last_id'];

    // Увеличиваем book_id на 1
    $newId = $lastId + 1;

    // SQL-запрос с использованием подготовленных запросов
    $insertQuery = "INSERT INTO Students (student_id, name, class, group_number) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('isis', $newId, $name, $class, $group);

    $response = array();

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Данные успешно добавлены в базу данных.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Ошибка при добавлении данных: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Возвращаем JSON-ответ
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
