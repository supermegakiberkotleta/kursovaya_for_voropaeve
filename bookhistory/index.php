<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php get_header();?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Выдача книг</h4>
                    <p class="card-subtitle mb-4">
                        Учет выдачи книг.
                    </p>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addNewElement">Выдать книгу</button>
                    <pre>

                    </pre>

                    <table id="basic-datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Название книги</th>
                            <th>Имя ученика</th>
                            <th>Дата выдачи</th>
                            <th></th>
                        </tr>
                        </thead>


                        <tbody class="books_table" data-table-name="BookHistory">

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
                <form  method="POST" id="AddForm" data-table-name="BookHistory">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Добавить нового ученика</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                           <label for="AddBook" class="form-label">Выберите книгу:</label>
                            <select class="form-select form-control" id="AddBook" name="AddBook">
                                <? 
                                $data = getDataTable('Books');
                                foreach ($data as $items) {
                                    if($items["copies_available"] > 0){
                                        echo '<option value="'.$items["book_id"].'">'.$items["title"].'</option>';
                                    } else{
                                        continue;
                                    }  
                                }
                                ?> 
                            </select>
                        </div>
                        <div class="form-group">
                           <label for="AddStudent" class="form-label">Выберите ученика:</label>
                            <select class="form-select form-control" id="AddStudent" name="AddStudent">
                                <?
                                $data = getDataTable('Students');
                                foreach ($data as $items) {
                                    echo '<option value="' . $items["student_id"] . '">' . $items["name"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="AddDate" class="form-label">Дата выдачи:</label>
                            <input type="date" class="form-control" id="AddDate" name="AddDate">
                        </div>
                        <div class="error-message" style="color: red">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Выдать книгу</button>
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
                    <h5 class="text-center">Книга выдана успешно</h5>
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
    

<?php get_footer();?>