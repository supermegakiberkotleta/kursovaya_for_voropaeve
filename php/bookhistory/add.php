<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['AddBook'];
    $student_id = $_POST['AddStudent'];
    $action_date = $_POST['AddDate'];
    $action = 'выдача';
    $conn = connectToDatabase();

    // Получаем количество доступных копий книги
    $copies_available_query = "SELECT copies_available FROM Books WHERE book_id = $book_id";
    $copies_result = $conn->query($copies_available_query);

    if ($copies_result->num_rows > 0) {
        $copies_row = $copies_result->fetch_assoc();
        $copies_available = $copies_row['copies_available'];

        if ($copies_available > 0) {
            // Получим последний history_id
            $lastIdQuery = "SELECT MAX(history_id) as last_id FROM BookHistory";
            $result = $conn->query($lastIdQuery);
            $row = $result->fetch_assoc();
            $lastId = $row['last_id'];

            // Получаем название книги
            $bookQuery = 'SELECT title FROM Books WHERE book_id='. $book_id;
            $resultBook = $conn->query($bookQuery);
            $rowBook = $resultBook->fetch_assoc();
            $book_title = $rowBook['title'];

            // Получаем имя студента
            $studentQuery = 'SELECT name FROM Students WHERE student_id='. $student_id;
            $resultStudent = $conn->query($studentQuery);
            $rowStudent = $resultStudent->fetch_assoc();
            $student_name = $rowStudent['name'];

            // Увеличиваем history_id на 1
            $newId = $lastId + 1;

            // SQL-запрос с использованием подготовленных запросов
            $insertQuery = "INSERT INTO BookHistory (history_id, book_id, student_id, action, action_date, book_title, student_name) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param('iiissss', $newId, $book_id, $student_id, $action, $action_date, $book_title, $student_name);

            $response = array();

            if ($stmt->execute()) {
                // Уменьшаем количество доступных копий на 1
                $updateCopiesQuery = "UPDATE Books SET copies_available = copies_available - 1 WHERE book_id = $book_id";
                $conn->query($updateCopiesQuery);

                $response['status'] = 'success';
                $response['message'] = 'Данные успешно добавлены в базу данных.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Ошибка при добавлении данных: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Нет доступных копий этой книги.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Книга с указанным book_id не найдена.';
    }

    $conn->close();

    // Возвращаем JSON-ответ
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
