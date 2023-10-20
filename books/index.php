<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php get_header();?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Книги</h4>
                    <p class="card-subtitle mb-4">
                        Таблица со списком всех доступных книг
                    </p>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addNewElement">Добавить книгу</button>
                    <pre>
                        <?php /*print_r(getDataBooksTable());*/?>
                    </pre>

                    <table id="basic-datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Название книги</th>
                            <th>Автор</th>
                            <th>Жанр</th>
                            <th>Год публикации</th>
                            <th>Количество книг</th>
                            <th></th>
                        </tr>
                        </thead>


                        <tbody class="books_table" data-table-name="Books">

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    <div class="modal fade" id="addNewElement" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form  method="POST" id="AddForm" data-table-name="Books">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Добавить новую книгу</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNameInput">Название книги</label>
                            <input type="text" class="form-control text" id="addNameInput" name="addNameInput" placeholder="Введите название книги">
                        </div>
                        <div class="form-group">
                            <label for="addAuthorInput">Автор</label>
                            <input type="text" class="form-control text" id="addAuthorInput"  name="addAuthorInput" placeholder="Введите автора книги">
                        </div>
                        <div class="form-group">
                            <label for="addGenreInput">Жанр</label>
                            <input type="text" class="form-control text" id="addGenreInput" name="addGenreInput" placeholder="Введите жанр книги">
                        </div>
                        <div class="form-group">
                            <label for="addPublicationYearInput">Год публикации</label>
                            <input type="text" class="form-control year" id="addPublicationYearInput" name="addPublicationYearInput" placeholder="Введите год публикации">
                        </div>
                        <div class="form-group">
                            <label for="addCountInput">Количество</label>
                            <input type="text" class="form-control number" id="addCountInput" name="addCountInput" placeholder="Введите количество книг">
                        </div>
                        <div class="error-message" style="color: red">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Добавить книгу</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="getSuccesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Успешно!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Новая книга успешно добавлена в базу ;)</h5>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="getDangeresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Провал</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Добавление не удалось ;(</h5>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditElement" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form  method="POST" id="EditForm" data-table-name="Books">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Редактировать книгу</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNameInput">Название книги</label>
                            <input type="text" class="form-control text" id="editNameInput" name="editNameInput" placeholder="Введите название книги">
                        </div>
                        <div class="form-group">
                            <label for="addAuthorInput">Автор</label>
                            <input type="text" class="form-control text" id="editAuthorInput"  name="editAuthorInput" placeholder="Введите автора книги">
                        </div>
                        <div class="form-group">
                            <label for="addGenreInput">Жанр</label>
                            <input type="text" class="form-control text" id="editGenreInput" name="editGenreInput" placeholder="Введите жанр книги">
                        </div>
                        <div class="form-group">
                            <label for="addPublicationYearInput">Год публикации</label>
                            <input type="text" class="form-control year" id="editPublicationYearInput" name="editPublicationYearInput" placeholder="Введите год публикации">
                        </div>
                        <div class="form-group">
                            <label for="addCountInput">Количество</label>
                            <input type="text" class="form-control number" id="editCountInput" name="editCountInput" placeholder="Введите количество книг">
                        </div>
                        <div class="error-message">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-success">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php get_footer();?>