<?php
// Начинаем сессию
session_start();

// Удаляем все переменные сессии
$_SESSION = array();

// Удаляем сессию
session_destroy();

// Возвращаем успешный статус
http_response_code(200);
?>
