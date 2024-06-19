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
    <link rel="stylesheet" href="css/pannellum.css">
    <script type="text/javascript" src="js/pannellum.js"></script>
    <link href="css/index.css" rel="stylesheet" type="text/css">

</head>



<body>

<?php
require ('functions/functions.inc');
if (isset($_POST['exit_user']))
{
    if ($_POST['exit_user'] == "1")
    {
        exit_user();
        echo "
        <div class='massage success' id='alert'>
            با موفقیت از حساب کاربری خارج شدید.
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

if (isset($_POST['username']))
{
    $pdo = require_once ('connections/check_log.inc');
    require ('functions/check_log_database.inc');
    if ( $_POST['level'] == '0')
    {
        $check = check_managers_for_log ( $pdo , $_POST['username'] , $_POST['password'] );
        if ($check == 0)
        {
            echo "
            <header>
            ";
                require ('header_index.inc');
                echo "
            </header>
            ";
                echo "
            <div class='massage danger' id='alert'>
                نام کاربری وجود ندارد!!!
            </div>
            ";
        }
        elseif ($check == 1)
        {
                echo "
            <header>
            ";
                require ('header_index.inc');
                echo "
            </header>
            ";
                echo "
            <div class='massage danger' id='alert'>
                رمز عبور اشتباه است!!!
            </div>
            ";
        }
        elseif ($check == 2)
        {
            $user = get_managers_for_log ( $pdo , $_POST['username'] , $_POST['password']);
            create_cookie( $user );
            echo "
            <header>
            ";
            require ('header_manager.inc');
            echo "
            </header>
            ";
            echo "
            <div class='massage success' id='alert'>
                با موفقیت وارد شدید.
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
            redirect("index.php");
        }
        echo "
            <script>
                setTimeout( function () {
                    document.getElementById('alert').style.opacity = 0;
                    document.getElementById('alert').style.visibility = 'hidden';
                } , 3000);
            </script>
        ";
    }
    elseif ( $_POST['level'] == '2' )
    {
        $check = check_users_for_log ( $pdo , $_POST['username'] , $_POST['password'] );
        if ($check == 0)
        {
            echo "
            <header>
            ";
            require ('header_index.inc');
            echo "
            </header>
            ";
            echo "
            <div class='massage danger' id='alert'>
                نام کاربری وجود ندارد!!!
            </div>
            ";
        }
        elseif ($check == 1)
        {
            echo "
            <header>
            ";
            require ('header_index.inc');
            echo "
            </header>
            ";
            echo "
            <div class='massage danger' id='alert'>
                رمز عبور اشتباه است!!!
            </div>
            ";
        }
        elseif ($check == 2)
        {
            echo "
            <header>
            ";
            require ('header_index.inc');
            echo "
            </header>
            ";
            echo "
            <div class='massage danger' id='alert'>
                حساب شما غیر فعال است!!!
            </div>
            ";
        }
        elseif ($check == 3)
        {
            $user = get_users_for_log ( $pdo , $_POST['username'] , $_POST['password']);
            create_cookie( $user );
            echo "
            <header>
            ";
            require ('header_manager.inc');
            echo "
            </header>
            ";
            echo "
            <div class='massage success' id='alert'>
                با موفقیت وارد شدید.
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
            redirect("index.php");
        }
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
elseif (isset($_COOKIE['username']))
{
    echo "
        <header>
        ";
    require ('header_manager.inc');
    echo "
        </header>
        ";
}
else
{
    echo "
        <header>
        ";
    require ('header_index.inc');
    echo "
        </header>
        ";
}

?>

<main id="main_index" style="transition: 0.5s">
    <div id="panorama" class="my_panorama">
        <div class="Slogan">
            <div>
                حس زیبای یک انتخاب حرفه ای
            </div>
        </div>
        <button id="start"><i class="fa-solid fa-chevron-down fa-beat-fade"></i></button>
    </div>

    <div class="index_text">
        <hr style="width: 85%; margin-right: auto; margin-left: auto" >
        <span>
            تفاوتی نمی کند که شما قصد خرید، فروش یا اجاره را داشته باشید ما در این بازار متلاطم تا آخر شما را همراهی می کنیم.
        </span>
        <hr style="width: 85%; margin-right: auto; margin-left: auto" >
    </div>
    <div class="extra_text">
        <div>
            <img src="image/360degree.jpg">
            <br>
            <span>
                استفاده از فناوری تصاویر 360 درجه
            </span>
        </div>
        <div>
            <img src="image/home.jpg">
            <br>
            <span>
                تنوع بالا در املاک
            </span>
        </div>
        <div>
            <img src="image/many.jpg">
            <br>
            <span>
                تنوع بالا در قیمت ها
            </span>
        </div>
        <br>
        <div>
            <img src="image/phone.jpg" style="height: 200px">
            <br>
            <span>
                با گوشی خود به راحتی املاک را مشاهده کنید!!!
            </span>
        </div>
        <div>
            <img src="image/customer.jpg">
            <br>
            <span>
                فروش املاک شما در کمترین زمان
            </span>
        </div>
        <div>

        </div>
    </div>
    <div class="index_text">
        <hr style="width: 85%; margin-right: auto; margin-left: auto" >
        <span>
            هدف ما رضایت حداکثری شماست!!!
        </span>
        <hr style="width: 85%; margin-right: auto; margin-left: auto" >
    </div>



</main>


<footer>
<div class="footer">
    راه های ارتباطی
    <br>
    <div>
        <div>
            <i class="fa-solid fa-location-dot""></i>
            آدرس: کاشمر، خیابان خرمشهر، بین خرمشهر 5 و 7
        </div>
        <div>
            <i class="fa-solid fa-phone"></i>
            شماره تماس: 09151111111
        </div>
    </div>
    <div>
        <div style="direction: ltr">
            <i class="fa-brands fa-telegram"></i>
            @wwwwwwwwwwww
        </div>
        <div style="direction: ltr">
            <i class="fa-brands fa-whatsapp"></i>
            @wwwwwwwwwwww
        </div>
    </div>
    <div>
        <div style="direction: ltr">
            <i class="fa-brands fa-instagram"></i>
            @instagram
        </div>
        <div style="direction: ltr">
            <i class="fa-solid fa-envelope"></i>
            negati@gmail.com
        </div>
    </div>
</div>
<div class="web_developer">
    راه ارتباطی با سازنده سایت: 09218499013
</div>
</footer>

<?php
 require ('log_sign.inc');
?>

<script>
    pannellum.viewer('panorama', {
        "type": "equirectangular",
        "panorama": "./image/main_picture.jpg",
        "autoLoad": true,
        "autoRotate": -3,
        "autoRotateInactivityDelay" : 4000,
        "compass": true,
        "northOffset": 0,
    });
</script>
<script src="bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="js/index.js"></script>

</body>
<?php
if (isset($_POST['exit_user']))
{
    if ( $_POST['exit_user'] == "1" )
    {
        sleep(3);
        redirect("index.php");
    }
}
?>

</html>