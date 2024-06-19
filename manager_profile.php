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
    <link href="css/manager_profile.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
require ('functions/functions.inc');

if (!isset($_COOKIE['fname']))
{
    redirect('error_log.php');
}

if ($_COOKIE['level'] == '2')
{
    redirect('error_access.php');
}

$pdo = require_once('connections/profile_manager.inc');
require('functions/profile_manager_database.inc');

if (isset($_POST['username']))
{
    $user['id'] = $_POST['id'];
    $user['username'] = $_POST['username'];
    $user['fname'] = $_POST['fname'];
    $user['lname'] = $_POST['lname'];
    $user['phone'] = $_POST['phone'];
    $user['gender'] = $_POST['gender'];
    $user['password'] = null;
    if ( $_POST['level'] != '2')
    {
        $user['national_code'] = null;
        $user['birthday'] = $_POST['day']."/".$_POST['month']."/".$_POST['year'];
    }
    $user['level'] = $_POST['level'];
    if ( $_COOKIE['level'] == 0 && isset($_POST['national_code']))
    {
        $user['national_code'] = $_POST['national_code'];
    }
    if (isset($_POST['password']))
    {
        $user['password'] = $_POST['password'];
    }
    $result = change_info ( $pdo , $user );
    if ($result == 0)
    {
        if ( isset($_FILES['image']))
        {
            $file = $_FILES['image']['tmp_name'];
            if ( $user['level'] == "1" )
            {
                $id_user = $user['id'];
                $file_name = "manager_" . $id_user . ".jpg";
            }
            elseif ( $user['level'] == "2" )
            {
                $id_user = $user['id'];
                $file_name = "user_" . $id_user . ".jpg";
            }
            move_uploaded_file($file, "image/users/" . $file_name);
        }
        echo "
        <div class='massage success' id='alert'>
            اطلاعات با موفقیت ویرایش شد.
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
    elseif ($result == 1 )
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
    elseif ($result == 2 )
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



$user = get_user ( $pdo , $_POST['id'] , $_POST['level']);
$fname = $user['first_name'];
$lname = $user['last_name'];

$phone = $user['phone'];
$username = $user['user_name'];
$id = $user['id'];
$gender = $user['gender'];
if ( $_POST['level'] == 1)
{
    $birthday = $user['birthday'];
    $day = substr($user['birthday'] , 0 , 2);
    $month = substr($user['birthday'] , 3 , 2);
    $year = substr($user['birthday'] , 6 , 4);
    $national_code = $user['national_code'];
}
$level = $_POST['level'];
if ($gender == 'male')
{
    $gender = 'مرد';
}
else
{
    $gender = 'زن';
}

?>

<header>
    <?php
    require ('header_manager.inc');
    ?>
</header>

<main id="main_manager_profile">
    <div class="profile">
        <?php
        echo "
        <section>
            ";
        if ( $_POST['level'] == "0" )
        {
            $id_user = $_POST['id'];
            $file_name = "main_manager_" . $id_user . ".jpg";
        }
        elseif ( $_POST['level'] == "1" )
        {
            $id_user = $_POST['id'];
            $file_name = "manager_" . $id_user . ".jpg";
        }
        elseif ( $_POST['level'] == "2" )
        {
            $id_user = $_POST['id'];
            $file_name = "user_" . $id_user . ".jpg";
        }
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
            <div style='font-size: 18pt; line-height: 25px'>
            ID:
            &nbsp;
            $id
            </div>
            <button class='btn btn-primary' id='btn_change_info'>
                ویرایش اطلاعات
            </button>
        </section>
        ";
        if ( $_POST['level'] == 1)
        {
            echo "
            <div>
                کد ملی:
                &nbsp;
                $national_code
            </div>
            ";
        }
        echo "
        <div>
            نام:
            &nbsp;
            $fname
        </div>
        <div>
            نام خانوادگی:
            &nbsp;
            $lname
        </div>
        <div>
            جنسیت:
            &nbsp;
            $gender
        </div>
        ";
        if ( $_POST['level'] == 1)
        {
            echo "
            <div>
                تاریخ تولد:
                &nbsp;
                $birthday
            </div>
            ";
        }
        echo "
        <div>
            شماره تماس:
            &nbsp;
            $phone
        </div>
        <div>
            نام کاربری:
            &nbsp;
            $username
        </div>
        ";
        ?>


    </div>
</main>

<footer>

</footer>


<div id="change_info">
    <div>
        <span>
            ویرایش اطلاعات
        </span>
        <section id="exit_change_info">
            <i class="fa-solid fa-xmark"></i>
        </section>

        <form class="was-validated" method="post" action="manager_profile.php" enctype="multipart/form-data">
            <?php
            if ( $_COOKIE['level'] == 0 && $_POST['level'] == 1 )
            {
                echo "
                <div>
                    <span class='input-group-text' id='basic-addon1'>کد ملی:</span>
                    <input type='text' class='form-control' placeholder='Username'
                           aria-label='Username' aria-describedby='basic-addon1' required
                           minlength='3' maxlength='16' value='$national_code'
                           pattern='[0-9]{10,10}' name='national_code'
                           title='کد ملی را به صورت صحیح وارد نمایید.'>
                    <div class='invalid-feedback'>
                        کد ملی را وارد کنید.
                    </div>
                </div>
                ";
            }
            echo "
            <div>
                <span class='input-group-text' id='basic-addon1'>نام کاربری:</span>
                <input type='text' class='form-control' placeholder='Username'
                       aria-label='Username' aria-describedby='basic-addon1' required
                       minlength='3' maxlength='16' value='$username'
                       pattern='[A-Za-z]+[A-Za-z0-9]{3,16}' name='username'
                       title='نام کاربری با حروف انگلیسی شروع شده و شامل حروف کوچک و بزرگ انگلیسی و اعداد می باشد.'>
                <div class='invalid-feedback'>
                    نام کاربری را وارد کنید.
                </div>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>رمز عبور:</span>
                <input type='password' class='form-control' placeholder='Password'
                       aria-label='Password' aria-describedby='basic-addon1'
                       minlength='3' maxlength='16'
                       pattern='[A-Za-z0-9]{3,16}' name='password'>
                <div class='invalid-feedback'>
                    رمز عبور را وارد کنید.
                </div>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نام:</span>
                <input type='text' class='form-control' placeholder='First Name'
                       aria-label='Username' aria-describedby='basic-addon1'
                       minlength='3' maxlength='16' value='$fname'
                       name='fname' required>
                <div class='invalid-feedback'>
                    نام را وارد کنید.
                </div>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نام خانوادگی:</span>
                <input type='text' class='form-control' placeholder='Last name'
                       aria-label='Username' aria-describedby='basic-addon1'
                       minlength='3' maxlength='16' value='$lname'
                       name='lname' required>
                <div class='invalid-feedback'>
                    نام خانوادگی را وارد کنید.
                </div>
            </div>
            ";
            if ( $_POST['level'] == 1)
                {
                    echo "
                    <div>
                        <span class='input-group-text' id='basic-addon1'>تاریخ تولد:</span>
                        <input type='number' class='form-control' placeholder='Day'
                               aria-label='Username' aria-describedby='basic-addon1'
                               min='1' max='31' name='day' required value='$day'
                               style='width: 70px; float: right; border-radius: 0; padding: 0;
                               height: 38px; padding-right: 28px'>
                        <input type='number' class='form-control' placeholder='Month'
                               aria-label='Username' aria-describedby='basic-addon1'
                               min='1' max='12' name='month' required value='$month'
                               style='width: 70px; float: right; border-radius: 0; padding: 0;
                               height: 38px;  padding-right: 28px'>
                        <input type='number' class='form-control' placeholder='Year'
                               aria-label='Username' aria-describedby='basic-addon1'
                               min='1300' max='1400' name='year' required value='$year'
                               style='width: 90px; float: right; padding: 0; height: 38px;
                                padding-right: 28px;'>
                        <div class='invalid-feedback'>
                            تاریخ تولد را وارد کنید.
                        </div>
                    </div>
                    ";
                }
            echo "
            <div>
                <span class='input-group-text' id='basic-addon1'>شماره همراه:</span>
                <input type='tel' class='form-control' placeholder='Phone Number'
                       aria-label='Number' aria-describedby='basic-addon1'
                       minlength='3' maxlength='16' value='$phone'
                       pattern='[0-9]{11}' name='phone' required>
                <div class='invalid-feedback'>
                    شماره همراه را وارد کنید.
                </div>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>جنسیت:</span>
                <div class='form-check' style='margin-right: 25px; color: black; margin-top: 5px; transition: 0.2s'>
                    <input class='form-check-input' type='radio' name='gender'
                           id='gender1' checked value='male' style='transition: 0.4s'>
                    <label class='form-check-label' for='gender1' style='color: black'>
                        مرد
                    </label>
                </div>
                <div class='form-check' style='margin-right: 20px; color: black; margin-top: 5px; transition: 0.2s'>
                    <input class='form-check-input' type='radio' name='gender' id='gender2'
                           style='transition: 0.4s' value='female'>
                    <label class='form-check-label' for='gender2' style='color: black'>
                        زن
                    </label>
                </div>
                <div class='invalid-feedback'>
                    جنسیت را انتخاب کنید.
                </div>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>عکس:</span>
                <input type='file' class='form-control'
                       aria-describedby='basic-addon1'
                       name='image'>
            </div>
            <input type='hidden' value='$id' name='id'>
            <input type='hidden' value='$level' name='level'>
            ";
            ?>

            <button type="submit" class="btn btn-primary">
                ویرایش
            </button>
        </form>
    </div>
</div>


<script src="js/manager_profile.js"></script>
<script src="js/header_menu.js"></script>
</body>


</html>

