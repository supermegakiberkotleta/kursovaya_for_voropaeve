
<?php

require_once 'admin/config.php';
function get_header(){
    return require 'header.php';
}
function get_footer(){
   return require 'footer.php';
}
?>
<?php
session_start();

// Функция для проверки авторизации пользователя
function checkAuth() {
    // Проверяем, установлена ли сессия для авторизованного пользователя
    if (!isset($_SESSION["user_id"]) && basename($_SERVER['PHP_SELF']) != 'login.php') {
        // Если сессия не установлена и мы не находимся на странице входа, перенаправляем пользователя на страницу входа
        header("Location: login.php");
        exit();
    }
}
checkAuth()
?>
