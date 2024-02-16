<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php

$currentTable = $_POST['currentTable'];
$table = '';
$data = getDataTable($currentTable);

foreach ($data as $items) {
    $table .= '<tr data-element-id="' . $items['history_id'] . '">';
    $table .= '<td>' . $items['book_title'] . '</td>';
    $table .= '<td>' . $items['student_name'] . '</td>';
    $table .= '<td>' . $items['action_date'] . '</td>';
    $table .= '<td>';
    $table .= '<button class="btn btn-success btn-sm success" data-element-id="' . $items['student_id'] . '">Сдать книгу</button>';
    $table .= '<button class="btn btn-danger btn-sm delete" data-element-id="' . $items['student_id'] . '">Удалить</button>';
    $table .= '</td>';
    $table .= '</tr>';
}
echo $table;