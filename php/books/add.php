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

    // Вставляем данные в таблицу
    $insertQuery = "INSERT INTO Books (book_id, title, author, genre, publication_year, copies_available) VALUES ($newId, '$name', '$author', '$genre', '$publicationYear', $count)";

    $response = array();

    if ($conn->query($insertQuery) === true) {
        $response['status'] = 'success';
        $response['message'] = 'Данные успешно добавлены в базу данных.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Ошибка при добавлении данных: ' . $conn->error;
    }

    $conn->close();

    // Возвращаем JSON-ответ
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
