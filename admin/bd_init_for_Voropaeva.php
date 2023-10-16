<?php
// Подключение к базе данных (замените значения на свои)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Создание таблиц
$createBooksTable = "CREATE TABLE Books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    genre VARCHAR(50),
    publication_year INT,
    copies_available INT
)";

$createStudentsTable = "CREATE TABLE Students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    class INT,
    group_number CHAR(1)
)";

$createBookLoansTable = "CREATE TABLE BookLoans (
    loan_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    student_id INT,
    loan_date DATE,
    due_date DATE,
    book_title VARCHAR(255),  -- Поле для названия книги
    student_name VARCHAR(50)  -- Поле для имени ученика
)";

$createBookHistoryTable = "CREATE TABLE BookHistory (
    history_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    student_id INT,
    action ENUM('выдача', 'возврат') NOT NULL,
    action_date DATE,
    book_title VARCHAR(255),  -- Поле для названия книги
    student_name VARCHAR(50)  -- Поле для имени ученика
)";

$createAdminsTable = "CREATE TABLE Admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($createBooksTable) === TRUE) {
    echo "Таблица Books создана успешно.<br>";
} else {
    echo "Ошибка создания таблицы Books: " . $conn->error . "<br>";
}

if ($conn->query($createStudentsTable) === TRUE) {
    echo "Таблица Students создана успешно.<br>";
} else {
    echo "Ошибка создания таблицы Students: " . $conn->error . "<br>";
}

if ($conn->query($createBookLoansTable) === TRUE) {
    echo "Таблица BookLoans создана успешно.<br>";
} else {
    echo "Ошибка создания таблицы BookLoans: " . $conn->error . "<br>";
}

if ($conn->query($createBookHistoryTable) === TRUE) {
    echo "Таблица BookHistory создана успешно.<br>";
} else {
    echo "Ошибка создания таблицы BookHistory: " . $conn->error . "<br>";
}

if ($conn->query($createAdminsTable) === TRUE) {
    echo "Таблица Admins создана успешно.<br>";
} else {
    echo "Ошибка создания таблицы Admins: " . $conn->error . "<br>";
}

// Заполнение таблиц данными

// Вставляем 50 реальных книг русской литературы
$books = [
    ["Война и мир", "Лев Толстой", "Роман", 1869, 1],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 2],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 3],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 4],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 5],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 1],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 2],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 3],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 4],
    ["Война и мир", "Лев Толстой", "Роман", 1869, 5],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 1],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 2],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 3],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 4],
    ["Война и мир", "Лев Толстой", "Роман", 1869, 5],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 1],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 2],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 3],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 4],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 5],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 1],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 2],
    ["Война и мир", "Лев Толстой", "Роман", 1869, 3],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 4],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 5],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 1],
    ["Война и мир", "Лев Толстой", "Роман", 1869, 2],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 3],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 4],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 5],
    ["Война и мир", "Лев Толстой", "Роман", 1869, 1],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 2],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 3],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 4],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 5],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 1],
    ["Война и мир", "Лев Толстой", "Роман", 1869, 2],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 3],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 4],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 5],
    ["Преступление и наказание", "Фёдор Достоевский", "Роман", 1866, 1],
    ["Война и мир", "Лев Толстой", "Роман", 1869, 2],
    ["Анна Каренина", "Лев Толстой", "Роман", 1877, 3],
    ["Братья Карамазовы", "Фёдор Достоевский", "Роман", 1880, 4],
    ["Мастер и Маргарита", "Михаил Булгаков", "Фэнтези", 1967, 5],
];


foreach ($books as $book) {
    $title = $book[0];
    $author = $book[1];
    $genre = $book[2];
    $publication_year = $book[3];
    $copies_available = $book[4];

    $insertBookQuery = "INSERT INTO Books (title, author, genre, publication_year, copies_available) VALUES ('$title', '$author', '$genre', $publication_year, $copies_available)";
    $conn->query($insertBookQuery);
}

// Вставляем 20 учеников
$firstNames = ["Иван", "Мария", "Алексей", "Екатерина", "Петр", "Анна", "Сергей", "Надежда", "Дмитрий", "Татьяна", "Александр", "Ольга", "Артем", "Елена", "Андрей", "Людмила", "Максим", "София", "Владимир", "Виктория"];
$lastNames = ["Иванов", "Петров", "Сидоров", "Козлов", "Морозов", "Васильев", "Павлов", "Смирнов", "Михайлов", "Федоров", "Кузнецов", "Соколов", "Новиков", "Морозов", "Андреев", "Орлов", "Козлов", "Гаврилов", "Богданов", "Тимофеев"];
$groups = ["А", "Б", "В", "Г", "Д"];

for ($i = 1; $i <= 20; $i++) {
    $name = $firstNames[array_rand($firstNames)] . " " . $lastNames[array_rand($lastNames)];
    $class = rand(5, 11);
    $group = $groups[array_rand($groups)];

    $insertStudentQuery = "INSERT INTO Students (name, class, group_number) VALUES ('$name', $class, '$group')";
    $conn->query($insertStudentQuery);
}

// Вставляем запись для администратора
$adminUsername = "admin";
$adminPassword = password_hash("12345678", PASSWORD_DEFAULT);
$insertAdminQuery = "INSERT INTO Admins (username, password) VALUES ('$adminUsername', '$adminPassword')";
$conn->query($insertAdminQuery);

// Вставляем несколько записей в таблицу BookLoans и BookHistory для демонстрации
$studentIds = [1, 2, 3];
$bookIds = [1, 2, 3];
$loanDates = ["2023-10-20", "2023-10-22", "2023-10-25"];
$dueDates = ["2023-11-03", "2023-11-07", "2023-11-12"];

for ($i = 0; $i < 3; $i++) {
    $studentId = $studentIds[$i];
    $bookId = $bookIds[$i];
    $loanDate = $loanDates[$i];
    $dueDate = $dueDates[$i];
    $bookTitle = $books[$i][0]; // Название книги
    $studentName = $firstNames[array_rand($firstNames)] . " " . $lastNames[array_rand($lastNames)]; // Имя ученика

    // Вставляем запись в таблицу BookLoans с дополнительными полями
    $insertLoanQuery = "INSERT INTO BookLoans (book_id, student_id, loan_date, due_date, book_title, student_name) VALUES ($bookId, $studentId, '$loanDate', '$dueDate', '$bookTitle', '$studentName')";
    $conn->query($insertLoanQuery);

    // Вставляем запись в таблицу BookHistory с дополнительными полями
    $action = "выдача";
    $actionDate = $loanDate;

    $insertHistoryQuery = "INSERT INTO BookHistory (book_id, student_id, action, action_date, book_title, student_name) VALUES ($bookId, $studentId, '$action', '$actionDate', '$bookTitle', '$studentName')";
    $conn->query($insertHistoryQuery);
}

// Закрываем соединение
$conn->close();
?>
