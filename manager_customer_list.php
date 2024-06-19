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
    <link href="css/customer_list.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
require ('functions/functions.inc');
if (!isset($_COOKIE['fname']))
{
    redirect('error_log.php');
}

if ( $_COOKIE['level'] != 0 && $_COOKIE['level'] != 1 )
{
    redirect('error_access.php');
}


$pdo = require_once ('connections/create_user.inc');
require ('functions/create_user_database.inc');

if ( isset($_POST['username']) )
{
    $user['username'] = $_POST['username'];
    $user['password'] = $_POST['password'];
    $user['fname'] = $_POST['fname'];
    $user['lname'] = $_POST['lname'];
    $user['gender'] = $_POST['gender'];
    $user['phone'] = $_POST['phone'];
    if (check_username_user( $pdo , $_POST['username'] ))
    {
        if ( check_phone_user( $pdo , $_POST['phone']))
        {
            create_user($pdo , $user);
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
            redirect("manager_customer_list.php");
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

$users = get_users( $pdo );

if ( isset($_POST['search']))
{
    $users_t = array();
    for ($i = 0 ; $i < count($users) ; $i++)
    {
        if ( strstr ( $users[$i]['first_name'] , $_POST['search']))
        {
            array_push( $users_t, $users[$i]);
        }
        elseif ( strstr ( $users[$i]['last_name'] , $_POST['search']))
        {
            array_push( $users_t, $users[$i]);
        }
        elseif ( strstr ( $users[$i]['phone'] , $_POST['search']))
        {
            array_push( $users_t, $users[$i]);
        }
    }
    $users = $users_t;
}

?>

<header>
    <?php
    require ('header_manager.inc');
    ?>
</header>

<main id="main_customer_list">
    <div class="under_list">
        <form method="post" action="manager_customer_list.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="جستوجو"
                       aria-label="Recipient's username" aria-describedby="button-addon2"
                        name="search">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
        <button id="btn_signin_customer">
            ثبت نام مشتری
            <i class="fa-solid fa-user-plus"></i>
        </button>
    </div>

    <hr style="z-index: 0">

    <div id="customer_list">
        <div>
            <?php
            for ($i = 0 ; $i < count($users) ; $i++)
            {
                $id = $users[$i]['id'];
                $fname = $users[$i]['first_name'];
                $lname = $users[$i]['last_name'];
                $phone = $users[$i]['phone'];
                echo "
            <div class='info_card'>
                <form style='z-index: 10' method='post' action='manager_profile.php'>
                    <div style='z-index: 1'>
                        نام:
                        &nbsp;
                        $fname

                        <br>
                        نام خانوادگی:
                        &nbsp;`
                        $lname
                        <br>
                        شماره همراه:
                        &nbsp;
                        $phone
                    </div>
                    <div>
                    ";
                $file_name = "user_" . $id . ".jpg";
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
                    <input type='hidden' name='level' value='2'>
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


<div id="signin_customer">
    <div>
        <span>
            ثبت نام مشتری جدید
        </span>
        <section id="exit_signin_customer">
            <i class="fa-solid fa-xmark"></i>
        </section>

        <form class="was-validated" method="post" action="manager_customer_list.php">
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
                           id="gender1" checked style="transition: 0.4s" value="male">
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

<script src="js/customer_list.js"></script>
<script src="js/header_menu.js"></script>
</body>


<table border="">

</table>
</html>
