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
    <link href="css/manager_list.css" rel="stylesheet" type="text/css">
</head>

<?php
require ('functions/functions.inc');

if (!isset($_COOKIE['fname']))
{
    redirect('error_log.php');
}

if ( $_COOKIE['level'] != 0 )
{
    redirect('error_access.php');
}

$pdo = require_once ('connections/create_user.inc');
require ('functions/create_user_database.inc');

if (isset($_POST['username']))
{
    $manager['username'] = $_POST['username'];
    $manager['password'] = $_POST['password'];
    $manager['fname'] = $_POST['fname'];
    $manager['lname'] = $_POST['lname'];
    $manager['national_code'] = $_POST['national_code'];
    $manager['birthday'] = $_POST['day']."/".$_POST['month']."/".$_POST['year'];
    $manager['gender'] = $_POST['gender'];
    $manager['phone'] = $_POST['phone'];
    if (check_username_manager( $pdo , $_POST['username'] ))
    {
        if ( check_phone_manager( $pdo , $_POST['phone']))
        {
            create_manager($pdo , $manager);
            echo "
            <div class='massage success' id='alert'>
                مدیر جدید با موفقیت ثبت شد.
            </div>
            ";
            echo "
            <script>
                setTimeout( function () {
                    document.getElementById('alert').style.opacity = 0;
                    document.getElementById('alert').style.visibility = 'hidden';
                } , 3000);
            </script>
            ";
            sleep(3.2);
            redirect("manager_list.php");
        }
        else
        {
            echo "
        <div class='massage danger' id='alert'>
            شماره همراه قبلا ثبت شده است!
        </div>
        ";
            echo "
        <script>
            setTimeout( function () {
                document.getElementById('alert').style.opacity = 0;
                document.getElementById('alert').style.visibility = 'hidden';
            } , 3000);
        </script>
        ";
        }
    }
    else
    {
        echo "
        <div class='massage danger' id='alert'>
            نام کاربری قبلا ثبت شده است!
        </div>
        ";
        echo "
        <script>
            setTimeout( function () {
                document.getElementById('alert').style.opacity = 0;
                document.getElementById('alert').style.visibility = 'hidden';
            } , 3000);
        </script>
        ";
    }
}

$managers = get_managers( $pdo );

if ( isset($_POST['search']))
{
    $managers_t = array();
    for ($i = 0 ; $i < count($managers) ; $i++)
    {
        if ( strstr ( $managers[$i]['first_name'] , $_POST['search']))
        {
            array_push( $managers_t, $managers[$i]);
        }
        elseif ( strstr ( $managers[$i]['last_name'] , $_POST['search']))
        {
            array_push( $managers_t, $managers[$i]);
        }
        elseif ( strstr ( $managers[$i]['phone'] , $_POST['search']))
        {
            array_push( $managers_t, $managers[$i]);
        }
    }
    $managers = $managers_t;
}
?>

<body>

<header>
    <?php
    require ('header_manager.inc');
    ?>
</header>

<main id="main_manager_list">
    <div class="under_list">
        <form method="post" action="manager_list.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="جستجو" name="search"
                       aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
        <button id="btn_signin_manager">
            ثبت نام مدیر
            <i class="fa-solid fa-user-plus"></i>
        </button>
    </div>

    <hr style="z-index: 0">

    <div id="customer_list">
        <div>
            <?php
            for ($i = 0 ; $i < count($managers) ; $i++)
            {
                $id = $managers[$i]['id'];
                $fname = $managers[$i]['first_name'];
                $lname = $managers[$i]['last_name'];
                $phone = $managers[$i]['phone'];
                echo "
            <div class='info_card'>
                <form style='z-index: 10' method='post' action='manager_profile.php'>
                    <div style='z-index: 1'>
                        نام:
                        &nbsp;
                        $fname
                        <br>
                        نام خانوادگی:
                        &nbsp;
                        $lname
                        <br>
                        شماره همراه:
                        &nbsp;
                        $phone
                    </div>
                    <div>
                        ";
                $file_name = "manager_" . $id . ".jpg";
                if ( file_exists("image/users/$file_name"))
                {
                    echo "
                    <img src='image/users/$file_name'>
                    ";
                }
                else
                {
                    echo "
                    <i class='fa-solid fa-circle-user'></i>
                    ";
                }
                echo "
                    </div>
                    <button type='submit'></button>
                    <input type='hidden' name='id' value='$id'>
                    <input type='hidden' name='level' value='1'>
                </form>
                
            </div>
            ";
            }

            ?>

        </div>
    </div>
</main>

<footer>

</footer>


<div id="signin_manager">
    <div>
        <span>
            ثبت نام مدیر جدید
        </span>
        <section id="exit_signin_manager">
            <i class="fa-solid fa-xmark"></i>
        </section>

        <form class="was-validated" method="post" action="manager_list.php">
            <div>
                <span class="input-group-text" id="basic-addon1">نام کاربری:</span>
                <input type="text" class="form-control" placeholder="Username"
                       aria-label="Username" aria-describedby="basic-addon1" required
                       minlength="3" maxlength="16"
                       pattern="[A-Za-z]+[A-Za-z0-9]{3,16}" name="username"
                       title="نام کاربری با حروف انگلیسی شروع شده و شامل حروف کوچک و بزرگ انگلیسی و اعداد می باشد.">
                <div class="invalid-feedback">
                    نام کاربری را وارد کنید.
                </div>
            </div>
            <div>
                <span class="input-group-text" id="basic-addon1">رمز عبور:</span>
                <input type="password" class="form-control" placeholder="Password"
                       aria-label="Password" aria-describedby="basic-addon1"
                       minlength="3" maxlength="16"
                       pattern="[A-Za-z0-9]{3,16}" name="password" required>
                <div class="invalid-feedback">
                    رمز عبور را وارد کنید.
                </div>
            </div>
            <div>
                <span class="input-group-text" id="basic-addon1">کد ملی:</span>
                <input type="text" class="form-control" placeholder="National Code"
                       aria-label="Username" aria-describedby="basic-addon1"
                       pattern="[0-9]{10}"
                       name="national_code" required>
                <div class="invalid-feedback">
                    کد ملی را وارد کنید.
                </div>
            </div>
            <div>
                <span class="input-group-text" id="basic-addon1">نام:</span>
                <input type="text" class="form-control" placeholder="First Name"
                       aria-label="Username" aria-describedby="basic-addon1"
                       minlength="3" maxlength="16"
                       name="fname" required>
                <div class="invalid-feedback">
                    نام را وارد کنید.
                </div>
            </div>
            <div>
                <span class="input-group-text" id="basic-addon1">نام خانوادگی:</span>
                <input type="text" class="form-control" placeholder="Last name"
                       aria-label="Username" aria-describedby="basic-addon1"
                       minlength="3" maxlength="16"
                       name="lname" required>
                <div class="invalid-feedback">
                    نام خانوادگی را وارد کنید.
                </div>
            </div>
            <div>
                <span class="input-group-text" id="basic-addon1">تاریخ تولد:</span>
                <input type="number" class="form-control" placeholder="Day"
                       aria-label="Username" aria-describedby="basic-addon1"
                       min="1" max="31" name="day" required
                       style="width: 70px; float: right; border-radius: 0; padding: 0;
                       height: 38px; padding-right: 28px">
                <input type="number" class="form-control" placeholder="Month"
                       aria-label="Username" aria-describedby="basic-addon1"
                       min="1" max="12" name="month" required
                       style="width: 70px; float: right; border-radius: 0; padding: 0;
                       height: 38px;  padding-right: 28px">
                <input type="number" class="form-control" placeholder="Year"
                       aria-label="Username" aria-describedby="basic-addon1"
                       min="1300" max="1400" name="year" required
                       style="width: 90px; float: right; padding: 0; height: 38px;
                        padding-right: 28px;">
                <div class="invalid-feedback">
                    تاریخ تولد را وارد کنید.
                </div>
            </div>
            <div>
                <span class="input-group-text" id="basic-addon1">شماره همراه:</span>
                <input type="tel" class="form-control" placeholder="Phone Number"
                       aria-label="Number" aria-describedby="basic-addon1"
                       minlength="3" maxlength="16"
                       pattern="[0-9]{11}" name="phone" required>
                <div class="invalid-feedback">
                    شماره همراه را وارد کنید.
                </div>
            </div>
            <div>
                <span class="input-group-text" id="basic-addon1">جنسیت:</span>
                <div class="form-check" style="margin-right: 25px; color: black; margin-top: 5px; transition: 0.2s">
                    <input class="form-check-input" type="radio" name="gender"
                           id="gender1" checked value="male" style="transition: 0.4s">
                    <label class="form-check-label" for="gender1" style="color: black">
                        مرد
                    </label>
                </div>
                <div class="form-check" style="margin-right: 20px; color: black; margin-top: 5px; transition: 0.2s">
                    <input class="form-check-input" type="radio" name="gender" id="gender2"
                           style="transition: 0.4s" value="female">
                    <label class="form-check-label" for="gender2" style="color: black">
                        زن
                    </label>
                </div>
                <div class="invalid-feedback">
                    جنسیت را انتخاب کنید.
                </div>
            </div>
            <div>
                <span class="input-group-text" id="basic-addon1">عکس:</span>
                <input type="file" class="form-control"
                       aria-describedby="basic-addon1"
                       name="image">
            </div>
            <button type="submit" class="btn btn-primary">
                ثبت نام
            </button>
        </form>
    </div>
</div>

<script src="js/manager_list.js"></script>
<script src="js/header_menu.js"></script>
</body>



</html>
