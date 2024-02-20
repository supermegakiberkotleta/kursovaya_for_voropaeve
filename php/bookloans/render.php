<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php

$currentTable = $_POST['currentTable'];
$table = '';
$data = getDataTable($currentTable);

foreach ($data as $items) {
    $table .= '<tr data-element-id="' . $items['loan_id'] . '">';
    $table .= '<td>' . $items['book_title'] . '</td>';
    $table .= '<td>' . $items['student_name'] . '</td>';
    $table .= '<td>' . $items['loan_date'] . '</td>';
    $table .= '<td>' . $items['due_date'] . '</td>';
    $table .= '</tr>';
}
echo $table;