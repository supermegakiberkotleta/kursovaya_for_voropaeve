<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

$conn = connectToDatabase();

$elemId = $_POST['elemId']; // Получаем history_id из elemId
$currenTable = $_POST['currenTable'];

// Получаем book_id для данной history_id
$getBookIdQuery = "SELECT book_id FROM $currenTable WHERE history_id = $elemId";
$resultBookId = $conn->query($getBookIdQuery);

if ($resultBookId) {
    if ($resultBookId->num_rows > 0) {
        $rowBookId = $resultBookId->fetch_assoc();
        $book_id = $rowBookId['book_id'];

        // Получаем текущее количество доступных копий
        $getCopiesQuery = "SELECT copies_available FROM Books WHERE book_id = $book_id";
        $resultCopies = $conn->query($getCopiesQuery);

        if ($resultCopies) {
            if ($resultCopies->num_rows > 0) {
                $row = $resultCopies->fetch_assoc();
                $copies_available = $row['copies_available'];

                // Увеличиваем количество доступных копий на 1
                $new_copies_available = $copies_available + 1;

                // Обновляем значение колонки copies_available
                $updateCopiesQuery = "UPDATE Books SET copies_available = $new_copies_available WHERE book_id = $book_id";
                $resultUpdate = $conn->query($updateCopiesQuery);

                if ($resultUpdate) {
                    // Если успешно увеличили количество доступных копий, удаляем запись истории
                    $deleteHistoryQuery = "DELETE FROM $currenTable WHERE history_id = $elemId";
                    $resultDelete = $conn->query($deleteHistoryQuery);

                    if ($resultDelete) {
                        $response = array("status" => "success");
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
            $response = array("status" => "error", "message" => "Ошибка при выполнении запроса: " . $conn->error);
        }
    } else {
        $response = array("status" => "error", "message" => "Ошибка: Запись истории с указанным history_id не найдена.");
    }
} else {
    $response = array("status" => "error", "message" => "Ошибка при выполнении запроса: " . $conn->error);
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
