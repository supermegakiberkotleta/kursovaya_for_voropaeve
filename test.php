<?php
$queryString = "editNameInput=Мастер и Маргарита&editAuthorInput=Михаил Булгаков&editGenreInput=Фэнтези&editPublicationYearInput=1967&editCountInput=4";

// Разбиваем строку на пары "ключ=значение"
parse_str($queryString, $queryParams);

// $queryParams теперь содержит ассоциативный массив
echo "<pre>";
print_r($queryParams);
echo "</pre>";