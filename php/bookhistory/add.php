<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['AddBook'];
    $student_id = $_POST['AddStudent'];
    $action_date = $_POST['AddDate'];
    $action = 'выдача';
    $conn = connectToDatabase();

    // Получим последний book_id
    $lastIdQuery = "SELECT MAX(history_id) as last_id FROM BookHistory";
    $result = $conn->query($lastIdQuery);
    $row = $result->fetch_assoc();
    $lastId = $row['last_id'];
    $bookQuery = 'SELECT title FROM Books WHERE book_id='. $book_id;
    $resultBook = $conn->query($bookQuery);
    $rowBook = $resultBook->fetch_assoc();
    $book_title = $rowBook['title'];
    $studentQuery = 'SELECT name FROM Students WHERE student_id='. $student_id;
    $resultStudent = $conn->query($studentQuery);
    $rowStudent = $resultStudent->fetch_assoc();
    $student_name = $rowStudent['name'];

    // Увеличиваем book_id на 1
    $newId = $lastId + 1;

    // SQL-запрос с использованием подготовленных запросов
    $insertQuery = "INSERT INTO BookHistory (history_id, book_id, student_id, action, action_date, book_title, student_name) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('iiissss', $newId, $book_id, $student_id, $action, $action_date, $book_title, $student_name);

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
