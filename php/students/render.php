<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php

$currentTable = $_POST['currentTable'];
$table = '';
$data = getDataTable($currentTable);

foreach ($data as $items) {
    $table .= '<tr data-element-id="' . $items['student_id'] . '">';
    $table .= '<td>' . $items['name'] . '</td>';
    $table .= '<td>' . $items['class'] . '</td>';
    $table .= '<td>' . $items['group_number'] . '</td>';
    $table .= '<td>';
    $table .= '<button class="btn btn-light btn-sm edit" data-element-id="' . $items['student_id'] . '">Редактировать</button>';
    $table .= '<button class="btn btn-danger btn-sm delete" data-element-id="' . $items['student_id'] . '">Удалить</button>';
    $table .= '</td>';
    $table .= '</tr>';
}
echo $table;