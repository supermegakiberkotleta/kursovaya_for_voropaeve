$(document).ready(function (){
    tableRender('Books');
})

function tableRender(currentTable){
    let rootPath = window.location.protocol + "//" + window.location.host + "/";
    let renderUrl = rootPath + '/php/' + currentTable.toLowerCase() + '/render.php';

    $.ajax({
        url: renderUrl,
        method: 'POST',
        data: {currentTable: currentTable},
        dataType: 'html',
        success: function(response) {
            if (response) {
                $('.books_table').html(response)
            } else {
                $('.books_table').html('Не удалось получить таблицу с сервера :(')
            }
        },
        error: function() {
            $('.books_table').html('Не удалось отправить данные на сервер :(')
        }
    });
}