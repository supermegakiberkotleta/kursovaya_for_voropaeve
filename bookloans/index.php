<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php get_header();?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">История выдачи</h4>
                    <p class="card-subtitle mb-4">
                        История выдачи книг.
                    </p>
                    <table id="basic-datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Название книги</th>
                            <th>Имя ученика</th>
                            <th>Дата выдачи</th>
                            <th>Дата сдачи</th>
                        </tr>
                        </thead>


                        <tbody class="books_table" data-table-name="BookLoans">

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    
    

<?php get_footer();?>