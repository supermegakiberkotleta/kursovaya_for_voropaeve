<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currenElement = $_POST['elem_id']; // Получаем ID элемента

    // Получаем данные из формы
    $inputData = $_POST['input'];

    parse_str($inputData, $formData); // Преобразуем сериализованные данные в ассоциативный массив

    // Установите соединение с базой данных
    $conn = connectToDatabase();

    // Создайте SQL-запрос на обновление данных
    $updateQuery = "UPDATE Books SET ";
    foreach ($formData as $key => $value) {
        $updateQuery .= "$key = '$value', ";
    }
    // Удалите последнюю запятую и пробел
    $updateQuery = rtrim($updateQuery, ', ');

    $updateQuery .= " WHERE book_id = $currenElement";

    $response = array();

    if ($conn->query($updateQuery) === true) {
        $response['status'] = 'success';
        $response['message'] = 'Данные успешно обновлены в базе данных.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Ошибка при обновлении данных: ' . $conn->error;
    }

    $conn->close();

    // Возвращаем JSON-ответ
    header('Content-Type: application/json');
    echo json_encode($response);
}

