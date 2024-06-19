<html lang="fa" dir="rtl">
<head>
    <link href="css/menu_manager.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="main_menu">
    <div id="menu">
        <div id="brand">
            <a href="index.php">
                <div>
                    مشاور املاک
                    نجاتی
                </div>
            </a>
        </div>
        <div class="btns_list">
            <ul style="right: 0">
                <li id="btn_menu_manager">
                    <i class="fa-solid fa-bars"></i>
                    منو
                </li>
                <li id="btn_buy">
                    خرید
                </li>
                <li id="btn_rent">
                    اجاره
                </li>
                <li id="btn_sell">
                    فروش
                </li>
                <li id="btn_call">
                    راه های ارتباطی
                </li>
            </ul>
        </div>
        <div class="btns_list" style="float: left; z-index: 100">
            <ul style="left: 0">
                <li id="btn_user" style="width: 150px">
                    <?php
                    $fname_t = $_COOKIE["fname"];
                    $lname_t = $_COOKIE["lname"];
                    echo "
                    $fname_t
                    &nbsp;
                    $lname_t
                    ";
                    if ( $_COOKIE['level'] == "0" )
                    {
                        $id_user = $_COOKIE['id'];
                        $file_name = "main_manager_" . $id_user . ".jpg";
                    }
                    elseif ( $_COOKIE['level'] == "1" )
                    {
                        $id_user = $_COOKIE['id'];
                        $file_name = "manager_" . $id_user . ".jpg";
                    }
                    elseif ( $_COOKIE['level'] == "2" )
                    {
                        $id_user = $_COOKIE['id'];
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
                        <i class='fa-solid fa-circle-user' style='font-size: 10pt; vertical-align: middle'></i>
                        ";
                    }
                    ?>
                </li>
            </ul>

        </div>
    </div>
</div>

<div id="menu_user">
    <ul>
        <a href="profile.php">
            <li>
                پروفایل
            </li>
        </a>
        <li>
            <form method="post" action="index.php">
                <input type="hidden" name="exit_user" value="1">
                <button type="submit" style="background-color: rgba(140,140,140,0); border: none;
                color: white">خروج</button>
            </form>
        </li>
    </ul>
</div>

<div id="buy_menu" class="menu_bar">
    <div>
        <span>خرید آپارتمان مسکونی</span>
        <span>خرید زمین</span>
    </div>
    <div>
        <span>خرید خانه ویلایی</span>
    </div>
    <div>
        <span>خرید دفتر کار و اداری</span>
    </div>
    <div>
        <span>خرید مغازه و تجاری</span>
    </div>
</div>

<div id="rent_menu" class="menu_bar">
    <div>
        <span>رهن و اجاره آپارتمان مسکونی</span>
        <span>رهن و اجاره خانه کلنگی</span>
    </div>
    <div>
        <span>رهن و اجاره خانه ویلایی</span>
    </div>
    <div>
        <span>رهن و اجاره دفتر کار و اداری</span>
    </div>
    <div>
        <span>رهن و اجاره مغازه و تجاری</span>
    </div>
</div>

<div id="sell_menu" class="menu_bar">
    <div>
        <span>فروش آپارتمان مسکونی</span>
        <span>فروش خانه کلنگی</span>
    </div>
    <div>
        <span>فروش خانه ویلایی</span>
        <span>فروش زمین</span>
    </div>
    <div>
        <span>فروش دفتر کار و اداری</span>
    </div>
    <div>
        <span>فروش مغازه و تجاری</span>
    </div>
</div>


<div id="menu_manager">
    <ul>
        <a href="index.php">
            <li>
                صفحه نخست
            </li>
        </a>
        <hr>
        <a href="manager_dashboard.php">
            <li>
                داشبورد
            </li>
        </a>
        <hr>
        <?php
        if ($_COOKIE['level'] == '0' )
        {
            echo "
            <a href='manager_list.php'>
                <li>
                    لیست مدیران
                </li>
            </a>
            <hr>
            ";
        }
        if ($_COOKIE['level'] == '0' || $_COOKIE['level'] == '1' )
        {
            echo "
            <a href='manager_customer_list.php'>
                <li>
                    لیست مشتریان
                </li>
            </a>
            <hr>
            ";
        }
        ?>
        <a href="manager_real_estate_list.php">
            <li>
                لیست املاک
            </li>
        </a>
        <hr>
    </ul>
</div>

<script src="js/menu_manager.js"></script>

</body>

</html>
