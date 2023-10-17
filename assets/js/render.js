$(document).ready(function () {
    // Этот код будет выполняться после полной загрузки страницы
    $('.books_table').html(tableRender('Books')); // Заполняем таблицу данными из функции tableRender для таблицы "Books"

    $('#AddForm').submit(function (event) {
        event.preventDefault();
        let currenTable = $(this).attr('data-table-name').toLowerCase();

        // Отправляем форму на сервер через AJAX-запрос при отправке формы
        $.ajax({
            url: '../php/' + currenTable + '/add.php', // URL для отправки данных
            method: 'POST', // HTTP-метод (POST)
            data: $(this).serialize(), // Данные из формы, сериализованные в строку
            dataType: 'json', // Ожидаемый тип данных в ответе (JSON)
            success: function (response) {
                // Обработка успешного ответа от сервера
                if (response.status === 'success') {
                    // Если статус "success", скрываем модальное окно добавления и отображаем модальное окно успешной операции
                    $('#addNewElement').modal('hide');
                    $('#getSuccesModal').modal('show');
                    $('.books_table').html(tableRender('Books')); // Обновляем таблицу
                } else {
                    // В противном случае, скрываем модальное окно добавления и отображаем модальное окно ошибки
                    $('#addNewElement').modal('hide');
                    $('#getDangeresModal').modal('show');
                }
            },
            error: function () {
                // Обработка ошибки AJAX-запроса
                // Скрываем модальное окно добавления и отображаем модальное окно ошибки
                $('#addNewElement').modal('hide');
                $('#getDangeresModal').modal('show');
            }
        });
    });
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
    $('#EditForm').submit(function (event) {
        event.preventDefault();

        let currenTable = $(this).attr('data-table-name');
        let currenElement = $(this).find($('button[type="submit"]')).attr('data-element-id')

        // Отправляем форму на сервер через AJAX-запрос при отправке формы
        $.ajax({
            url: '../php/' + currenTable.toLowerCase() + '/edit.php', // URL для отправки данных
            method: 'POST', // HTTP-метод (POST)
            data: {
                input:$(this).serialize(),
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
