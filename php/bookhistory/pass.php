<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

$conn = connectToDatabase();

$elemId = $_POST['elemId'];
$currenTable = $_POST['currenTable'];

// Запрос для получения необходимых колонок из таблицы
$getColumnsQuery = "SELECT book_id, student_id, action_date, book_title, student_name FROM $currenTable WHERE history_id = $elemId";

$resultColumns = $conn->query($getColumnsQuery);

if ($resultColumns && $resultColumns->num_rows > 0) {
    $row = $resultColumns->fetch_assoc();
    
    // Сохранение значений в переменные
    $book_id = $row['book_id'];
    $student_id = $row['student_id'];
    $loan_date = $row['action_date'];
    $due_date = date('Y-m-d H:i:s');
    $book_title = $row['book_title'];
    $student_name = $row['student_name'];

    // Получаем текущее количество доступных копий
    $getCopiesQuery = "SELECT copies_available FROM Books WHERE book_id = $book_id";
    $resultCopies = $conn->query($getCopiesQuery);

    if ($resultCopies && $resultCopies->num_rows > 0) {
        $row = $resultCopies->fetch_assoc();
        $copies_available = $row['copies_available'];
        $new_copies_available = $copies_available + 1;

        // Обновляем значение колонки copies_available
        $updateCopiesQuery = "UPDATE Books SET copies_available = $new_copies_available WHERE book_id = $book_id";
        $resultUpdate = $conn->query($updateCopiesQuery);

        if ($resultUpdate) {
            // Если успешно увеличили количество доступных копий, удаляем запись истории
            $deleteHistoryQuery = "DELETE FROM $currenTable WHERE history_id = $elemId";
            $resultDelete = $conn->query($deleteHistoryQuery);

            if ($resultDelete) {
                $lastIdQuery = "SELECT MAX(loan_id) as last_id FROM bookloans";
                $result = $conn->query($lastIdQuery);
                $row = $result->fetch_assoc();
                $lastId = $row['last_id'];
                $newId = $lastId + 1;

                $insertQuery = "INSERT INTO bookloans (loan_id, book_id, student_id, loan_date, due_date, book_title, student_name) VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param('iiissss', $newId, $book_id, $student_id, $loan_date, $due_date, $book_title, $student_name);

                $response = array();

                if ($stmt->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = 'Данные успешно добавлены в базу данных.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Ошибка при добавлении данных: ' . $stmt->error;
                }
            } else {
                $response = array("status" => "error", "message" => "Ошибка при удалении записи истории: " . $conn->error);
            }
        } else {
            $response = array("status" => "error", "message" => "Ошибка при увеличении числа доступных копий: " . $conn->error);
        }
    } else {
        $response = array("status" => "error", "message" => "Ошибка: Нет записи о книге с указанным book_id.");
    }
} else {
    $response = array("status" => "error", "message" => "Ошибка: Запись истории с указанным history_id не найдена.");
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
