<?php
// Настройки подключения к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$database = "library_bd";

// Функция для подключения к базе данных
function connectToDatabase() {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    return $conn;
}

// Функция для извлечения данных из таблицы
function getDataTable($tableName) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM {$tableName}";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Ошибка выполнения SQL-запроса: " . $conn->error);
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $conn->close();
    $data = array_reverse($data);

    return $data;
}
?>
