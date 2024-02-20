<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>

<?php
session_start();

// Проверяем, отправлена ли форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $login = $_POST["username"];
    $pass = md5($_POST["password"]); // Хешируем пароль для сравнения с данными в БД

    // Получаем данные из базы данных
    $users = getDataTable("Admins");

    // Проверяем данные пользователя
    foreach ($users as $user) {
        if ($user["username"] == $login && $user["password"] == $pass) {
            $_SESSION["user_id"] = $user["admin_id"];
            $_SESSION["username"] = $user["username"]; // Сохраняем имя пользователя в сессии, если нужно
            header("Location: /"); // Замените dashboard.php на адрес вашей защищенной страницы
            exit();
        }
    }

    $error = "Неверный логин или пароль";
}

// Проверяем, авторизован ли пользователь, если да, перенаправляем его на защищенную страницу
if (isset($_SESSION["user_id"])) {
    header("Location: /"); // Замените dashboard.php на адрес вашей защищенной страницы
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>MyBooks - Войти</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-primary">

    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block my-5">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-5">
                                     <div class="card">
                                        <div class="card-body">
                                            
                                            <form action="login.php" method="post" class="p-2" id="login-form">
                                            <div class="form-group">
                                                <label for="username">Логин</label>
                                                <input class="form-control" type="text" id="username" name="username" required placeholder="Логин">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Пароль</label>
                                                <input class="form-control" type="password" required id="password" name="password" placeholder="Пароль">
                                            </div>
                                            <?php if(isset($error)) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?php echo $error; ?>
                                                </div>
                                            <?php } ?>
                                            <div class="mb-3 text-center">
                                                <button class="btn btn-primary btn-block" type="submit">Войти</button>
                                            </div>
                                            </form>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
            
                                
            
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="assets/js/theme.js"></script>

</body>

</html>
