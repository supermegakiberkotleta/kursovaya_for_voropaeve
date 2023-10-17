<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php

$currentTable = $_POST['currentTable'];
$table = '';
$data = getDataTable($currentTable);

foreach ($data as $items) {
    $table .= '<tr data-element-id="' . $items['book_id'] . '">';
    $table .= '<td>' . $items['title'] . '</td>';
    $table .= '<td>' . $items['author'] . '</td>';
    $table .= '<td>' . $items['genre'] . '</td>';
    $table .= '<td>' . $items['publication_year'] . '</td>';
    $table .= '<td>' . $items['copies_available'] . '</td>';
    $table .= '<td>';
    $table .= '<button class="btn btn-light btn-sm edit" data-element-id="' . $items['book_id'] . '">Редактировать</button>';
    $table .= '<button class="btn btn-danger btn-sm delete" data-element-id="' . $items['book_id'] . '">Удалить</button>';
    $table .= '</td>';
    $table .= '</tr>';
}
echo $table;