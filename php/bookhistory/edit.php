<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

// Подключение к базе данных
$conn = connectToDatabase();

// Проверка наличия соединения с базой данных
if (!$conn) {
    $response = array(
        'status' => 'error',
        'message' => 'Не удалось подключиться к базе данных'
    );
    echo json_encode($response);
    exit;
}

// Проверка наличия обязательных данных в запросе
if (isset($_POST['input']) && isset($_POST['elem_id'])) {
    // Распаковываем данные из JSON
    $formData = json_decode($_POST['input'], true);
    $elemId = $_POST['elem_id'];

    // Здесь вы можете добавить дополнительные проверки и валидацию данных из $formData

    // SQL-запрос для редактирования элемента с использованием подготовленных запросов
    $sql = "UPDATE Students SET name = ?, class = ?, group_number = ? WHERE student_id = ?";

    // Подготовка SQL-запроса
    $stmt = $conn->prepare($sql);

    // Привязываем значения к параметрам
    $stmt->bind_param('sisi', $formData['editNameInput'], $formData['editClassInput'], $formData['editGroupInput'], $elemId);

    // Выполняем SQL-запрос
    if ($stmt->execute()) {
        // Успешное редактирование
        $response = array(
            'status' => 'success',
            'message' => 'Элемент успешно отредактирован'
        );
    } else {
        // Ошибка редактирования
        $response = array(
            'status' => 'error',
            'message' => 'Ошибка при редактировании элемента: ' . $stmt->error
        );
    }

    // Закрытие подготовленного запроса
    $stmt->close();

    // Закрытие соединения с базой данных
    $conn->close();

    echo json_encode($response);
} else {
    // Если не были переданы обязательные данные
    $response = array(
        'status' => 'error',
        'message' => 'Отсутствуют обязательные данные в запросе'
    );
    echo json_encode($response);
}
?>
