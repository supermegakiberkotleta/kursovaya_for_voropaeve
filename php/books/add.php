<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['addNameInput'];
    $author = $_POST['addAuthorInput'];
    $genre = $_POST['addGenreInput'];
    $publicationYear = $_POST['addPublicationYearInput'];
    $count = $_POST['addCountInput'];

    $conn = connectToDatabase();

    // Получим последний book_id
    $lastIdQuery = "SELECT MAX(book_id) as last_id FROM Books";
    $result = $conn->query($lastIdQuery);
    $row = $result->fetch_assoc();
    $lastId = $row['last_id'];

    // Увеличиваем book_id на 1
    $newId = $lastId + 1;

    // SQL-запрос с использованием подготовленных запросов
    $insertQuery = "INSERT INTO Books (book_id, title, author, genre, publication_year, copies_available) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('isssii', $newId, $name, $author, $genre, $publicationYear, $count);

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
