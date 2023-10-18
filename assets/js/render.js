$(document).ready(function () {
    // Этот код будет выполняться после полной загрузки страницы
    $('.books_table').html(tableRender($('.books_table').attr('data-table-name')));

    $('.books_table').on('click','.delete',function (event) {

        let currenTable = $('.books_table').attr('data-table-name');

        // Отправляем форму на сервер через AJAX-запрос при отправке формы
        $.ajax({
            url: '../php/' + currenTable.toLowerCase() + '/delete.php', // URL для отправки данных
            method: 'POST', // HTTP-метод (POST)
            data: {elemId: $(this).attr('data-element-id'), currenTable: currenTable}, // Данные из формы, сериализованные в строку
            dataType: 'json', // Ожидаемый тип данных в ответе (JSON)
            success: function (response) {
                // Обработка успешного ответа от сервера
                if (response.status === 'success') {
                    // Если статус "success", скрываем модальное окно добавления и отображаем модальное окно успешной операции
                    $('.books_table').html(tableRender('Books')); // Обновляем таблицу
                } else {
                    // В противном случае, скрываем модальное окно добавления и отображаем модальное окно ошибки
                    alert(response.message)
                }
            },
            error: function () {
                // Обработка ошибки AJAX-запроса
                // Скрываем модальное окно добавления и отображаем модальное окно ошибки
                alert('Не удалось отправить запрос')
            }
        });
    });
    $('.books_table').on('click','.edit',function (event) {

        let currenElement = $(this).attr('data-element-id');
        let editElement = $(this).parent().parent();
        let editInput = $('#EditForm input.form-control')

        editInput.each(function(index) {
            let inputValue = editElement.find('td:eq(' + index + ')').text();
            $(this).val(inputValue);
        });

        $('#EditElement button[type="submit"]').attr('data-element-id', currenElement)
        $('#EditElement').modal('show')
    })
    $('#AddForm').submit(function (event) {
        event.preventDefault();
        let currenTable = $(this).attr('data-table-name');

        // Добавляем проверки на вводимые данные
        var inputs = $(this).find("input");
        var valid = true;

        inputs.each(function() {
            var input = $(this);
            var inputValue = input.val().trim();

            if (inputValue === "") {
                alert("Пожалуйста, заполните все поля.");
                valid = false;
                return false; // Прерываем выполнение цикла
            }

            if (input.hasClass("text") && inputValue.length > 300) {
                alert("Поле с классом 'text' не должно содержать более 300 символов.");
                valid = false;
                return false;
            }

            if (input.hasClass("year")) {
                var yearValue = parseInt(inputValue);
                if (isNaN(yearValue) || inputValue.length > 4) {
                    alert("Поле с классом 'year' должно содержать число до 4 знаков.");
                    valid = false;
                    return false;
                }
                input.val(yearValue); // Округляем до целого числа
            }

            if (input.hasClass("number")) {
                var numberValue = parseFloat(inputValue.replace(",", ".")); // Заменяет запятую на точку и парсит число

                if (isNaN(numberValue) || inputValue.length > 5 || numberValue < 0 || numberValue > 10000) {
                    alert("Поле с классом 'number' должно содержать положительное число до 10000.");
                    valid = false;
                    return false;
                }
                input.val(Math.round(numberValue)); // Округляем до целого числа
            }
        });

        if (!valid) {
            return;
        }

        // Остальной код для отправки данных на сервер через AJAX-запрос
        $.ajax({
            url: '../php/' + currenTable.toLowerCase() + '/add.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    $('#addNewElement').modal('hide');
                    $('#getSuccesModal').modal('show');
                    $('.books_table').html(tableRender(currenTable));
                } else {
                    $('#addNewElement').modal('hide');
                    $('#getDangeresModal').modal('show');
                }
            },
            error: function () {
                $('#addNewElement').modal('hide');
                $('#getDangeresModal').modal('show');
            }
        });
    });

    $('#EditForm').submit(function (event) {
        event.preventDefault();

        let currenTable = $(this).attr('data-table-name');
        let currenElement = $(this).find($('button[type="submit"]')).attr('data-element-id')
        let formData = {};
        $("#EditForm :input").each(function() {
            formData[this.name] = $(this).val();
        });
        // Добавляем проверки на вводимые данные
        var inputs = $(this).find("input");
        var valid = true;

        inputs.each(function() {
            var input = $(this);
            var inputValue = input.val().trim();

            if (inputValue === "") {
                alert("Пожалуйста, заполните все поля.");
                valid = false;
                return false; // Прерываем выполнение цикла
            }

            if (input.hasClass("text") && inputValue.length > 300) {
                alert("Поле с классом 'text' не должно содержать более 300 символов.");
                valid = false;
                return false;
            }

            if (input.hasClass("year")) {
                var yearValue = parseInt(inputValue);
                if (isNaN(yearValue) || inputValue.length > 4) {
                    alert("Поле с классом 'year' должно содержать число до 4 знаков.");
                    valid = false;
                    return false;
                }
                input.val(yearValue); // Округляем до целого числа
            }

            if (input.hasClass("number")) {
                var numberValue = parseFloat(inputValue.replace(",", ".")); // Заменяет запятую на точку и парсит число

                if (isNaN(numberValue) || inputValue.length > 5 || numberValue < 0 || numberValue > 10000) {
                    alert("Поле с классом 'number' должно содержать положительное число до 10000.");
                    valid = false;
                    return false;
                }
                input.val(Math.round(numberValue)); // Округляем до целого числа
            }
        });

        if (!valid) {
            return;
        }
        // Отправляем форму на сервер через AJAX-запрос при отправке формы
        $.ajax({
            url: '../php/' + currenTable.toLowerCase() + '/edit.php', // URL для отправки данных
            method: 'POST', // HTTP-метод (POST)
            data: {
                input:JSON.stringify(formData),
                elem_id: currenElement
            },
            dataType: 'json', // Ожидаемый тип данных в ответе (JSON)
            success: function (response) {
                // Обработка успешного ответа от сервера
                if (response.status === 'success') {
                    console.log(response.message)
                    // Если статус "success", скрываем модальное окно добавления и отображаем модальное окно успешной операции
                    $('#EditElement').modal('hide');
                    //$('#getSuccesModal').modal('show');
                    $('.books_table').html(tableRender(currenTable)); // Обновляем таблицу
                } else {
                    // В противном случае, скрываем модальное окно добавления и отображаем модальное окно ошибки
                    //$('#addNewElement').modal('hide');
                    //$('#getDangeresModal').modal('show');
                }
            },
            error: function () {
                // Обработка ошибки AJAX-запроса
                // Скрываем модальное окно добавления и отображаем модальное окно ошибки
                //$('#addNewElement').modal('hide');
                //$('#getDangeresModal').modal('show');
            }
        });
    });

});

function tableRender(currentTable) {
    // Функция для отрисовки таблицы на основе данных с сервера
    let rootPath = window.location.protocol + "//" + window.location.host + "/"; // Получение корневого пути сайта
    let renderUrl = rootPath + '/php/' + currentTable.toLowerCase() + '/render.php'; // Формирование URL для запроса

    $.ajax({
        url: renderUrl, // URL для запроса данных таблицы
        method: 'POST', // HTTP-метод (POST)
        data: { currentTable: currentTable }, // Дополнительные данные для запроса
        dataType: 'html', // Ожидаемый тип данных в ответе (HTML)
        success: function (response) {
            if (response) {
                // Если получен ответ, обновляем содержимое элемента с классом 'books_table' и возвращаем ответ
                $('.books_table').html(response);
                return response;
            } else {
                // В противном случае, возвращаем сообщение об ошибке
                return 'Не удалось получить таблицу с сервера :(';
            }
        },
        error: function () {
            // Обработка ошибки AJAX-запроса и возвращение сообщения об ошибке
            return 'Не удалось отправить данные на сервер :(';
        }
    });
}
