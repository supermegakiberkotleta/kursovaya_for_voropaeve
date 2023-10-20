<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php get_header();?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ученики</h4>
                    <p class="card-subtitle mb-4">
                        Таблица со списком всех учеников
                    </p>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addNewElement">Добавить нового ученика</button>
                    <pre>

                    </pre>

                    <table id="basic-datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Имя Фамилия</th>
                            <th>Класс</th>
                            <th>Группа класса</th>
                            <th></th>
                        </tr>
                        </thead>


                        <tbody class="books_table" data-table-name="Students">

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
                <form  method="POST" id="AddForm" data-table-name="Students">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Добавить нового ученика</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNameInput">Имя Фамилия</label>
                            <input type="text" class="form-control text" id="addNameInput" name="addNameInput" placeholder="Введите имя и фамилию ученика">
                        </div>
                        <div class="form-group">
                            <label for="addClassInput">Класс</label>
                            <input type="text" class="form-control number" id="addClassInput"  name="addClassInput" placeholder="Введите класс в котором он учится">
                        </div>
                        <div class="form-group">
                            <label for="addGroupInput">Группа класса</label>
                            <input type="text" class="form-control text" id="addGroupInput" name="addGroupInput" placeholder="Введите группу этого класс(А,Б и т.д.)">
                        </div>
                        <div class="error-message" style="color: red">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Добавить ученика</button>
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
                    <h5 class="text-center">Новый ученик успешно добавлена в базу ;)</h5>
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
                <form  method="POST" id="EditForm" data-table-name="Students">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Редактировать данные ученика</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editNameInput">Имя Фамилия</label>
                            <input type="text" class="form-control text" id="editNameInput" name="editNameInput" placeholder="Введите имя и фамилию ученика">
                        </div>
                        <div class="form-group">
                            <label for="editClassInput">Класс</label>
                            <input type="text" class="form-control number" id="editClassInput"  name="editClassInput" placeholder="Введите класс в котором он учится">
                        </div>
                        <div class="form-group">
                            <label for="editGroupInput">Группа класса</label>
                            <input type="text" class="form-control text" id="editGroupInput" name="editGroupInput" placeholder="Введите группу этого класс(А,Б и т.д.)">
                        </div>
                        <div class="error-message" style="color: red">

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