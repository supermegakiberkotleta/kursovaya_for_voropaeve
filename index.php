<?php require_once  $_SERVER['DOCUMENT_ROOT'] . '/functions.php';?>
<?php get_header();?>
<div class="row">
    <div class="col-lg-6">
        <div class="card card-body">
            <h4 class="card-title">Книги</h4>
            <p class="card-text">Перейдите к таблице со всеми книгами в библиотеке.</p>
            <a href="/books/" class="btn btn-primary waves-effect waves-light">Перейти</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-body">
            <h4 class="card-title">Учащиеся</h4>
            <p class="card-text">Перейдите к таблице со всеми учащимися, которые записались.</p>
            <a href="/students/" class="btn btn-primary waves-effect waves-light">Перейти</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card card-body">
            <h4 class="card-title">Учет книг</h4>
            <p class="card-text">Ведите учет выдаваемых книг.</p>
            <a href="/books/" class="btn btn-primary waves-effect waves-light">Перейти</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-body">
            <h4 class="card-title">История</h4>
            <p class="card-text">Перейдите к истории выдачи всех книг.</p>
            <a href="/bookloans/" class="btn btn-primary waves-effect waves-light">Перейти</a>
        </div>
    </div>
</div>
<?php get_footer();?>
