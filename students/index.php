<?php require '../functions.php'?>
<?php get_header();?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Учащиеся</h4>
                    <p class="card-subtitle mb-4">
                        Таблица со списком всех учащихся, которые записаны в библиотеку
                    </p>
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
                        </tr>
                        </thead>


                        <tbody>
                            <?php foreach (getDataBooksTable() as $items):?>
                                <tr>
                                    <td><?=$items['title'];?></td>
                                    <td><?=$items['author'];?></td>
                                    <td><?=$items['genre'];?></td>
                                    <td><?=$items['publication_year'];?></td>
                                    <td><?=$items['copies_available'];?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
<?php get_footer();?>