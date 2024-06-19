<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مشاور املاک نجاتی</title>
    <link href="bootstrap-5.3.0-dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <link href="fontawesome-free-6.4.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome-free-6.4.0-web/css/brands.css" rel="stylesheet">
    <link href="fontawesome-free-6.4.0-web/css/solid.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/manager_dashboard.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
require ('functions/functions.inc');

if (!isset($_COOKIE['fname']))
{
    redirect('error_log.php');
}
?>

<header>
    <?php
    require ('header_manager.inc');
    ?>
</header>

<main id="main_manager_profile">
    <div id="date">
        <span></span>
        <span></span>
    </div>
    <div class="info">
        تعداد مشتریان
        <br>
        0 نفر
    </div>
    <div class="info">
        تعداد خانه های ثبت شده
        <br>
        0 واحد
    </div>
    <div class="info">
        تعداد زمین های ثبت شده
        <br>
        0 عدد
    </div>
    <div class="info">
        تعداد افراد آنلاین
        <br>
        0 نفر
    </div>
</main>

<footer>

</footer>

<script src="js/manager_dashboard.js"></script>
<script src="js/header_menu.js"></script>
</body>



</html>


