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
    <link rel="stylesheet" href="css/pannellum.css">
    <script type="text/javascript" src="js/pannellum.js"></script>
    <link href="css/real_estate_list.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php

require ('functions/functions.inc');
if (!check_log())
{
    redirect('error_log.php');
}
require('functions/real_estate.inc');
$pdo = require_once('connections/real_estate.inc');
if (isset($_POST['title']))
{
    $real_estate = [
        'title' => $_POST['title'],
        'type_build' => $_POST['type_build'],
        'property_owner' => $_POST['property_owner'],
        'type_transaction' => $_POST['type_transaction'],
        'type_estate' => $_POST['type_estate'],
        'type_document' => $_POST['type_document'],
        'area' => (INT) $_POST['area'],
        'street' => $_POST['street'],
        'lane' => $_POST['lane'],
        'plaque' => $_POST['plaque'],
        'history' => $_POST['history'],
        'foundation' => (INT) $_POST['foundation'],
        'room_number' => (INT) $_POST['room_number'],
        'input' => $_POST['input'],
        'floor' => $_POST['floor'],
        'unit' => $_POST['unit'],
        'cabinets' => $_POST['cabinets'],
        'roof_top' => $_POST['roof_top'],
        'floor_covering' => $_POST['floor_covering'],
        'price' => (INT) $_POST['price'],
        'mortgage' => (INT) $_POST['mortgage'],
        'rent' => (INT) $_POST['rent'],
        'parking' => 0,
        'elevator' => 0,
        'pool' => 0,
        'cooler' => 0,
        'warehouse' => 0,
        'master' => 0
    ];
    if (isset($_POST['parking']))
    {
        $real_estate['parking'] = 1;
    }
    if (isset($_POST['elevator']))
    {
        $real_estate['elevator'] = 1;
    }
    if (isset($_POST['pool']))
    {
        $real_estate['pool'] = 1;
    }
    if (isset($_POST['cooler']))
    {
        $real_estate['cooler'] = 1;
    }
    if (isset($_POST['warehouse']))
    {
        $real_estate['warehouse'] = 1;
    }
    if (isset($_POST['master']))
    {
        $real_estate['master'] = 1;
    }
    create_real_estate( $pdo , $real_estate );
}

$real_estates = get_part_real_estates ( $pdo );

if (isset($_GET['title_search']))
{
    $real_estates_t = $real_estates;
    $real_estates = array();
    for ( $i = 0; $i < count($real_estates_t); $i++ )
    {
        $check = true;
        if ( (!strstr ( $real_estates_t[$i]['title'] , $_GET['title_search'] )) ||
            ( !($real_estates_t[$i]['room_number'] == $_GET['number_room_search']) && $_GET['number_room_search'] != null ) ||
            ( !($real_estates_t[$i]['area'] >= $_GET['min_area']) && $_GET['min_area'] != null ) ||
            ( !($real_estates_t[$i]['area'] <= $_GET['max_area']) && $_GET['max_area'] != null ) ||
            ( !strstr ($real_estates_t[$i]['street'] , $_GET['address_search']) && $_GET['address_search'] != null ) )
        {
            $check = false;
        }
        elseif ( (!( $_GET['type_transaction_search'] == $real_estates_t[$i]['type_transaction'] ) &&
            $_GET['type_transaction_search'] != 'full') ||
            (!( $_GET['type_build_seaech'] == $real_estates_t[$i]['type_build'] ) &&
                $_GET['type_build_seaech'] != 'full') )
        {
            $check = false;
        }
        if ( $_GET['min_money'] != null )
        {
            if ( $real_estates_t[$i]['type_transaction'] == 'mortgage_rent' &&
                !($real_estates_t[$i]['mortgage'] >= $_GET['min_money']))
            {
                $check = false;
            }
            elseif ( !($real_estates_t[$i]['price'] >= $_GET['min_money']) )
            {
                $check = false;
            }
        }
        if ($_GET['max_money'] != null)
        {
            if ( $real_estates_t[$i]['type_transaction'] == 'mortgage_rent' &&
                    !($real_estates_t[$i]['mortgage'] <= $_GET['max_money']))
            {
                $check = false;
            }
            elseif (!($real_estates_t[$i]['price'] <= $_GET['max_money']) )
            {
                $check = false;
            }
        }
        elseif ( (isset($_GET['elevator_search']) && $_GET['elevator_search'] != $real_estates_t[$i]['elevator']) ||
            (isset($_GET['cooler_search']) && $_GET['cooler_search'] != $real_estates_t[$i]['cooler']) ||
            (isset($_GET['pool_search']) && $_GET['pool_search'] != $real_estates_t[$i]['pool']) ||
            (isset($_GET['master_search']) && $_GET['master_search'] != $real_estates_t[$i]['master']) ||
            (isset($_GET['parking_search']) && $_GET['parking_search'] != $real_estates_t[$i]['parking']) ||
            (isset($_GET['warehouse_search']) && $_GET['warehouse_search'] != $real_estates_t[$i]['warehouse']) )
        {
            $check = false;
        }

        if ( $check )
        {
            array_push( $real_estates , $real_estates_t[$i]);
        }
    }
}
for ( $i = 0; $i < count($real_estates); $i++)
{
    if ( $real_estates[$i]['type_build'] == 'apartment' )
    {
        $real_estates[$i]['type_build'] = 'آپارتمانی';
    }
    elseif ( $real_estates[$i]['type_build'] == 'villa' )
    {
        $real_estates[$i]['type_build'] = 'ویلایی';
    }
    elseif ( $real_estates[$i]['type_build'] == 'earth' )
    {
        $real_estates[$i]['type_build'] = 'زمین';
    }
    //*******************************************
    if ( $real_estates[$i]['type_transaction'] == 'buy_sell' )
    {
        $real_estates[$i]['type_transaction'] = 'خرید و فروش';
    }
    elseif ( $real_estates[$i]['type_transaction'] == 'mortgage_rent' )
    {
        $real_estates[$i]['type_transaction'] = 'رهن و اجاره';
    }
    elseif ( $real_estates[$i]['type_transaction'] == 'exchange' )
    {
        $real_estates[$i]['type_transaction'] = 'معاوضه';
    }
    elseif ( $real_estates[$i]['type_transaction'] == 'presell' )
    {
        $real_estates[$i]['type_transaction'] = 'پیش فروش';
    }
    //********************************************
    if ( $real_estates[$i]['type_estate'] == 'commercial' )
    {
        $real_estates[$i]['type_estate'] = 'تجاری';
    }
    elseif ( $real_estates[$i]['type_estate'] == 'residential' )
    {
        $real_estates[$i]['type_estate'] = 'مسکونی';
    }
    //**********************************************
    if ( $real_estates[$i]['type_document'] == 'property' )
    {
        $real_estates[$i]['type_document'] = 'ملکی';
    }
    elseif ( $real_estates[$i]['type_document'] == 'endowment' )
    {
        $real_estates[$i]['type_document'] = 'اوقاف';
    }
}
?>

<header>
    <?php
    require ('header_manager.inc');
    ?>
</header>

<main id="main_real_estate_list">
    <div class="under_list" id="under_list">
        <span style="position: relative">
            <span id="btn_serch">
                <i class="fa-solid fa-chevron-down fa-rotate-90" style="transition: 0.3s" id="icon_serch"></i>
                &nbsp;
                جست و جو
            </span>

            <button id="btn_new_real_estate" class="btn btn-primary"
                    style="left: 5px; position: absolute">ثبت ملک جدید</button>
        </span>

        <form id="serch_form" method="get" action="manager_real_estate_list.php">
            <div>
                <label for="title_search">عنوان:</label>
                &nbsp;
                <?php
                if (isset($_GET['title_search']))
                {
                    $value = $_GET['title_search'];
                    echo "<input type='text' name='title_search' id='title_search' class='form-control'
                style='width: 250px' value='$value'>";
                }
                else
                {
                    echo "<input type='text' name='title_search' id='title_search' class='form-control'
                style='width: 250px'>";
                }
                ?>
            </div>
            <div>
                <label for="type_build_seaech">نوع:</label>
                &nbsp;
                <select class="form-select" style="height: 30px; line-height: 30px; float: right;
                    width: 110px; margin-right: 5px; padding-top: 0; padding-bottom: 0;" name="type_build_seaech"
                        id="type_build_seaech">
                    <?php
                    if ( $_GET['type_build_seaech'] == 'apartment')
                    {
                        echo "
                        <option value='full'>همه</option>
                        <option selected value='apartment'>آپارتمانی</option>
                        <option value='villa'>ویلایی</option>
                        <option value='earth'>زمین</option>
                        ";
                    }
                    elseif ( $_GET['type_build_seaech'] == 'villa')
                    {
                        echo "
                        <option value='full'>همه</option>
                        <option value='apartment'>آپارتمانی</option>
                        <option selected value='villa'>ویلایی</option>
                        <option value='earth'>زمین</option>
                        ";
                    }
                    elseif ( $_GET['type_build_seaech'] == 'earth')
                    {
                        echo "
                        <option value='full'>همه</option>
                        <option value='apartment'>آپارتمانی</option>
                        <option value='villa'>ویلایی</option>
                        <option selected value='earth'>زمین</option>
                        ";
                    }
                    else
                    {
                        echo "
                        <option selected value='full'>همه</option>
                        <option value='apartment'>آپارتمانی</option>
                        <option value='villa'>ویلایی</option>
                        <option value='earth'>زمین</option>
                        ";
                    }
                    ?>

                </select>
            </div>
            <div>
                <label for="type_transaction_search">نوع معامله:</label>
                &nbsp;
                <select class="form-select" style="height: 30px; line-height: 30px; float: right;
                    width: 120px; margin-right: 5px; padding-top: 0; padding-bottom: 0;" name="type_transaction_search"
                        id="type_transaction_search">
                    <?php
                    if ( $_GET['type_transaction_search'] == 'buy_sell')
                    {
                        echo "
                        <option value='full'>همه</option>
                        <option selected value='buy_sell'>خرید و فروش</option>
                        <option value='mortgage_rent'>رهن و اجاره</option>
                        <option value='exchange'>معاوضه</option>
                        <option value='presell'>پیش فروش</option>
                        ";
                    }
                    elseif ( $_GET['type_transaction_search'] == 'mortgage_rent')
                    {
                        echo "
                        <option value='full'>همه</option>
                        <option value='buy_sell'>خرید و فروش</option>
                        <option selected value='mortgage_rent'>رهن و اجاره</option>
                        <option value='exchange'>معاوضه</option>
                        <option value='presell'>پیش فروش</option>
                        ";
                    }
                    elseif ( $_GET['type_transaction_search'] == 'exchange')
                    {
                        echo "
                        <option value='full'>همه</option>
                        <option value='buy_sell'>خرید و فروش</option>
                        <option value='mortgage_rent'>رهن و اجاره</option>
                        <option selected value='exchange'>معاوضه</option>
                        <option value='presell'>پیش فروش</option>
                        ";
                    }
                    elseif ( $_GET['type_transaction_search'] == 'presell')
                    {
                        echo "
                        <option value='full'>همه</option>
                        <option value='buy_sell'>خرید و فروش</option>
                        <option value='mortgage_rent'>رهن و اجاره</option>
                        <option value='exchange'>معاوضه</option>
                        <option selected value='presell'>پیش فروش</option>
                        ";
                    }
                    else
                    {
                        echo "
                        <option selected value='full'>همه</option>
                        <option value='buy_sell'>خرید و فروش</option>
                        <option value='mortgage_rent'>رهن و اجاره</option>
                        <option value='exchange'>معاوضه</option>
                        <option value='presell'>پیش فروش</option>
                        ";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="address_search">آدرس (خیابان):</label>
                &nbsp;
                <?php
                if (isset($_GET['address_search']))
                {
                    $value = $_GET['address_search'];
                    echo "<input type='text' name='address_search' id='address_search' class='form-control'
                       style='width: 200px' value='$value'>";
                }
                else
                {
                    echo "<input type='text' name='address_search' id='address_search' class='form-control'
                       style='width: 200px'>";
                }
                ?>
            </div>
            <div>
                <label for="number_room_search">تعداد اتاق:</label>
                &nbsp;
                <?php
                if (isset($_GET['number_room_search']))
                {
                    $value = $_GET['number_room_search'];
                    echo "<input type='number' name='number_room_search' id='number_room_search' class='form-control'
                min='0' style='width: 55px; padding-left: 0' value='$value'>";
                }
                else
                {
                    echo "<input type='number' name='number_room_search' id='number_room_search' class='form-control'
                min='0' style='width: 55px; padding-left: 0'>";
                }
                ?>
            </div>

            <div>
                <label for="min_area">حداقل مساحت:</label>
                &nbsp;
                <?php
                if (isset($_GET['min_area']))
                {
                    $value = $_GET['min_area'];
                    echo "<input type='min_area' name='min_area' id='min_area' class='form-control'
                       min='0' style='width: 70px; padding-left: 0' value='$value'>";
                }
                else
                {
                    echo "<input type='min_area' name='min_area' id='min_area' class='form-control'
                       min='0' style='width: 70px; padding-left: 0'>";
                }
                ?>
            </div>
            <div>
                <label for="max_area">حداکثر مساحت:</label>
                &nbsp;
                <?php
                if (isset($_GET['max_area']))
                {
                    $value = $_GET['max_area'];
                    echo "<input type='number' name='max_area' id='max_area' class='form-control'
                       min='0' style='width: 70px; padding-left: 0' value='$value'>";
                }
                else
                {
                    echo "<input type='number' name='max_area' id='max_area' class='form-control'
                       min='0' style='width: 70px; padding-left: 0'>";
                }
                ?>
            </div>
            <div>
                <label for="min_money">حداقل مبلغ:</label>
                &nbsp;
                <?php
                if (isset($_GET['min_money']))
                {
                    $value = $_GET['min_money'];
                    echo "<input type='number' name='min_money' id='min_money' class='form-control'
                       min='0' style='width: 70px; padding-left: 0' value='$value'>";
                }
                else
                {
                    echo "<input type='number' name='min_money' id='min_money' class='form-control'
                       min='0' style='width: 70px; padding-left: 0'>";
                }
                ?>
            </div>
            <div>
                <label for="max_money">حداکثر مبلغ:</label>
                &nbsp;
                <?php
                if (isset($_GET['max_money']))
                {
                    $value = $_GET['max_money'];
                    echo "<input type='number' name='max_money' id='max_money' class='form-control'
                       min='0' style='width: 70px; padding-left: 0' value='$value'>";
                }
                else
                {
                    echo "<input type='number' name='max_money' id='max_money' class='form-control'
                       min='0' style='width: 70px; padding-left: 0'>";
                }
                ?>
            </div>
            <div class="form-check">
                <?php
                if (isset($_GET['elevator_search']))
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='elevator_search' name='elevator_search'
                style='height: 16px; margin-top: 7px' checked>";
                }
                else
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='elevator_search' name='elevator_search'
                style='height: 16px; margin-top: 7px'>";
                }
                ?>
                <label class="form-check-label" for="elevator_search">
                    آسانسور
                </label>
            </div>
            <div class="form-check">
                <?php
                if (isset($_GET['cooler_search']))
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='cooler_search' name='cooler_search'
                       style='height: 16px; margin-top: 7px' checked>";
                }
                else
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='cooler_search' name='cooler_search'
                       style='height: 16px; margin-top: 7px'>";
                }
                ?>
                <label class="form-check-label" for="cooler_search">
                    کولر
                </label>
            </div>
            <div class="form-check">
                <?php
                if (isset($_GET['pool_search']))
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='pool_search' name='pool_search'
                       style='height: 16px; margin-top: 7px' checked>";
                }
                else
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='pool_search' name='pool_search'
                       style='height: 16px; margin-top: 7px'>";
                }
                ?>
                <label class="form-check-label" for="pool_search">
                    استخر
                </label>
            </div>
            <div class="form-check">
                <?php
                if (isset($_GET['master_search']))
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='master_search' name='master_search'
                       style='height: 16px; margin-top: 7px' checked>";
                }
                else
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='master_search' name='master_search'
                       style='height: 16px; margin-top: 7px'>";
                }
                ?>
                <label class="form-check-label" for="master_search">
                    مستر
                </label>
            </div>
            <div class="form-check">
                <?php
                if (isset($_GET['parking_search']))
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='parking_search' name='parking_search'
                       style='height: 16px; margin-top: 7px' checked>";
                }
                else
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='parking_search' name='parking_search'
                       style='height: 16px; margin-top: 7px'>";
                }
                ?>
                <label class="form-check-label" for="parking_search">
                    پارکینگ
                </label>
            </div>
            <div class="form-check">
                <?php
                if (isset($_GET['warehouse_search']))
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='warehouse_search' name='warehouse_search'
                       style='height: 16px; margin-top: 7px' checked>";
                }
                else
                {
                    echo "<input class='form-check-input' type='checkbox' value='1' id='warehouse_search' name='warehouse_search'
                       style='height: 16px; margin-top: 7px'>";
                }
                ?>
                <label class="form-check-label" for="warehouse_search">
                    انباری
                </label>
            </div>
            <button type="submit" class="btn btn-primary">
                جست و جو
            </button>
        </form>
    </div>

    <hr style="z-index: 0">

    <div id="real_estate_list">
        <?php
        for ( $i = 0; $i < count($real_estates); $i++)
        {
            $id = $real_estates[$i]['id'];
            $title = $real_estates[$i]['title'];
            $type_build = $real_estates[$i]['type_build'];
            $type_transaction = $real_estates[$i]['type_transaction'];
            $type_estate = $real_estates[$i]['type_estate'];
            $type_document = $real_estates[$i]['type_document'];
            $area = $real_estates[$i]['area'];
            $street = $real_estates[$i]['street'];
            $foundation = $real_estates[$i]['foundation'];
            $price = $real_estates[$i]['price'];
            $mortgage = $real_estates[$i]['mortgage'];
            $rent = $real_estates[$i]['rent'];

            echo "
            <form method='post' action='manager_real_estate_info.php'>
                <div>
                    <div>
                        <span>
                            $title
                        </span>
                        <span>
                            نوع: 
                            $type_build
                        </span>
                        <span>
                            نوع معامله: 
                            $type_transaction
                        </span>
                        <span>
                            نوع ملک: 
                            $type_estate
                        </span>
                        <span>
                            نوع سند: 
                            $type_document
                        </span>
                        <span>
                            مساحت: 
                            $area
                        </span>
                        <span>
                            آدرس: 
                            $street
                        </span>
                        ";
            if ($price != null)
            {
                echo "
                <span>
                    قیمت: 
                    $price تومان
                    
                </span>
                ";
            }
            elseif ( $mortgage != null )
            {
                echo "
                <span>
                    رهن: 
                    $mortgage
                     تومان
                </span>
                <span>
                    اجاره: 
                    $rent
                    تومان
                </span>
                ";
            }
            echo "
                    </div>
                    <div id='panorama$i' class='my_panorama'>
                    </div>
                    <script>
                        pannellum.viewer('panorama$i', {
                            'type': 'equirectangular',
                            'panorama': './image/main_picture.jpg',
                            'autoLoad': true,
                            'autoRotate': -3,
                            'autoRotateInactivityDelay' : 4000,
                            'northOffset': 0,
                        });
                    </script>
                    <input type='hidden' name='id_real_estate' value='$id'>
                    <button type='submit'></button>
                </div>
            </form>
            
            ";
        }
        ?>
    </div>
</main>

<footer>

</footer>

<div id="new_real_estate" class="new_real_estate">
    <div>
        <span>
            ثبت ملک جدید
        </span>
        <section id="exit_change_info">
            <i class="fa-solid fa-xmark"></i>
        </section>
        <form class="was-validated" method="post" action="manager_real_estate_list.php">
            <div>
                <span class='input-group-text' id='title'>عنوان:</span>
                <input type='text' class='form-control' placeholder='Title'
                       aria-label='Username' aria-describedby='basic-addon1' required
                       minlength='3' maxlength='50' name='title'
                       title='عنوان را وارد نمایید.'>
                <div class='invalid-feedback'>
                    عنوان را وارد کنید.
                </div>
            </div>
            <div>
                <span class='input-group-text' id='property owner'>نام صاحب ملک:</span>
                <input type='text' class='form-control' placeholder='property owner'
                       aria-label='Username' aria-describedby='basic-addon1'
                       minlength='3' maxlength='50' name='property_owner'
                       title='نام صاحب ملک را وارد نمایید.'>
                <div class='invalid-feedback'>
                    نام صاحب ملک را وارد کنید.
                </div>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نوع ساختمان:</span>
                <select class="form-select" name="type_build"
                        id="type_build">
                    <option value="apartment">آپارتمانی</option>
                    <option value="villa">ویلایی</option>
                    <option value="earth">زمین</option>
                </select>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نوع معامله:</span>
                <select class="form-select" name="type_transaction"
                        id="type_transaction">
                    <option value="buy_sell">خرید و فروش</option>
                    <option value="mortgage_rent">رهن و اجاره</option>
                    <option value="exchange">معاوضه</option>
                    <option value="presell">پیش فروش</option>
                </select>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نوع ملک:</span>
                <select class="form-select" name="type_estate"
                        id="type_estate">
                    <option value="commercial">تجاری</option>
                    <option value="residential">مسکونی</option>
                </select>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نوع سند:</span>
                <select class="form-select" name="type_document"
                        id="type_build">
                    <option value="property">ملکی</option>
                    <option value="endowment">اوقاف</option>
                </select>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>مساحت:</span>
                <input type='number' class='form-control' placeholder='ََArea'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='1' name='area' required
                       title='مساحت را وارد نمایید.'>
                <div class='invalid-feedback'>
                    مساحت را وارد کنید.
                </div>
            </div>
            <div id="foundation" style="display: none">
                <span class='input-group-text' id='basic-addon1'>مساحت زیربنا:</span>
                <input type='number' class='form-control' placeholder='Foundation'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='1' name='foundation'
                       title='مساحت زیربنا را وارد نمایید.'>
                <div class='invalid-feedback'>
                    مساحت زیربنا را وارد کنید.
                </div>
            </div>
            <div id="history" style="display: none">
                <span class='input-group-text' id='basic-addon1'>سال ساخت:</span>
                <input type='number' class='form-control' placeholder='Year of construction'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='1300' max='1410' name='history'
                       title='سال ساخت را وارد نمایید.'>
                <div class='invalid-feedback'>
                    سال ساخت را وارد کنید.
                </div>
            </div>
            <div id="room_number" style="display: none">
                <span class='input-group-text' id='basic-addon1'>تعداد اتاق:</span>
                <input type='number' class='form-control' placeholder='Number of rooms'
                       aria-label='Username' aria-describedby='basic-addon1'
                       name='room_number' title='تعداد اتاق را وارد نمایید.'>
                <div class='invalid-feedback'>
                    تعداد اتاق را وارد کنید.
                </div>
            </div>
            <div id="price" style="display: none">
                <span class='input-group-text' id='basic-addon1'>قیمت:</span>
                <input type='number' class='form-control' placeholder='Price'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='0' name='price' step="1000"
                       title='قیمت را وارد نمایید.'>
                <div class='invalid-feedback'>
                    قیمت را وارد کنید.
                </div>
            </div>
            <div id="mortgage" style="display: none">
                <span class='input-group-text' id='basic-addon1'>رهن:</span>
                <input type='number' class='form-control' placeholder='Mortgage'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='0' name='mortgage' step="1000"
                       title='مقدار رهن را وارد نمایید.'>
                <div class='invalid-feedback'>
                    مقدار رهن را وارد کنید.
                </div>
            </div>
            <div id="rent" style="display: none">
                <span class='input-group-text' id='basic-addon1'>اجاره:</span>
                <input type='number' class='form-control' placeholder='Rent'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='0' name='rent' step="1000"
                       title='مقدار اجاره را وارد نمایید.'>
                <div class='invalid-feedback'>
                    مقدار اجاره را وارد کنید.
                </div>
            </div>
            <div id='input'>
                <span class='input-group-text'>ورودی خانه:</span>
                <select class="form-select" name="input"
                        id="type_build">
                    <option value="independent">مستقل</option>
                    <option value="common">مشترک</option>
                </select>
            </div>
            <fieldset>
                <legend >
                    <i class="fa-solid fa-location-dot"></i>
                    آدرس
                </legend>
                <div>
                    <span class='input-group-text' id='street'>خیابان:</span>
                    <input type='text' class='form-control' placeholder='Street'
                           aria-label='Username' aria-describedby='basic-addon1' name='street'
                           title='خیابان را وارد نمایید.'>
                    <div class='invalid-feedback'>
                        خیابان را وارد کنید.
                    </div>
                </div>
                <div>
                    <span class='input-group-text' id='lane'>کوچه:</span>
                    <input type='text' class='form-control' placeholder='Lane'
                           aria-label='Username' aria-describedby='basic-addon1' name='lane'
                           title='کوچه را وارد نمایید.'>
                    <div class='invalid-feedback'>
                        کوچه را وارد کنید.
                    </div>
                </div>
                <div>
                    <span class='input-group-text' id='plaque'>پلاک:</span>
                    <input type='text' class='form-control' placeholder='Plaque'
                           aria-label='Username' aria-describedby='basic-addon1' name='plaque'
                           title='پلاک را وارد نمایید.'>
                    <div class='invalid-feedback'>
                        پلاک را وارد کنید.
                    </div>
                </div>
                <div id="floor" style="display: none">
                    <span class='input-group-text' id='floor'>طبقه:</span>
                    <input type='text' class='form-control' placeholder='Floor'
                           aria-label='Username' aria-describedby='basic-addon1' name='floor'
                           title='شماره طبقه را وارد نمایید.'>
                    <div class='invalid-feedback'>
                        شماره طبقه را وارد کنید.
                    </div>
                </div>
                <div id="unit" style="display: none">
                    <span class='input-group-text' id='unit'>واحد:</span>
                    <input type='text' class='form-control' placeholder='Unit'
                           aria-label='Username' aria-describedby='basic-addon1' name='unit'
                           title='واحد را وارد نمایید.'>
                    <div class='invalid-feedback'>
                        واحد را وارد کنید.
                    </div>
                </div>
            </fieldset>
            <fieldset id="equipment" style="display: none">
                <legend>
                    <i class="fa-solid fa-list-ul"></i>
                    امکانات
                </legend>
                <div>
                    <span class='input-group-text' id='cabinets'>کابینت:</span>
                    <select class="form-select" name="cabinets"
                            id="cabinets">
                        <option value="melamine">ملامینه</option>
                        <option value="mdf">ام دی اف</option>
                        <option value="vacuum">وکیوم</option>
                        <option value="wood_veneer">روکش چوب</option>
                        <option value="wooden">تمام چوب</option>
                        <option value="high_glass">های گلاس</option>
                        <option value="polyglass">پلی گلاس</option>
                        <option value="metallic">فلزی</option>
                    </select>
                </div>
                <div>
                    <span class='input-group-text' id='roof_top'>پشت بام:</span>
                    <select class="form-select" name="roof_top"
                            id="roof_top">
                        <option value="simple">ساده</option>
                        <option value="spaced">فضا سازی شده</option>
                    </select>
                </div>
                <div>
                    <span class='input-group-text' id='floor_covering'>کفپوش:</span>
                    <select class="form-select" name="floor_covering"
                            id="floor_covering">
                        <option value="ceramic">سرامیک</option>
                        <option value="mosaic">موزائیک</option>
                        <option value="cement">سیمان</option>
                        <option value="wood">چوب</option>
                        <option value="rock">سنگ</option>
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="parking"
                           name="parking">
                    <label class="form-check-label" for="parking">
                        <i class="fa-solid fa-square-parking"></i>
                        پارکینگ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="elevator"
                    name="elevator">
                    <label class="form-check-label" for="elevator">
                        <i class="fa-solid fa-elevator"></i>
                        آسانسور
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="pool"
                           name="pool">
                    <label class="form-check-label" for="pool">
                        <i class="fa-solid fa-person-swimming"></i>
                        استخر
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="warehouse"
                           name="warehouse">
                    <label class="form-check-label" for="elevator">
                        <i class="fa-solid fa-warehouse"></i>
                        انباری
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="cooler"
                           name="cooler">
                    <label class="form-check-label" for="cooler">
                        <i class="fa-solid fa-fan"></i>
                        کولر
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="master"
                           name="master">
                    <label class="form-check-label" for="master">
                        <i class="fa-solid fa-shower"></i>
                        مستر
                    </label>
                </div>
            </fieldset>
            <br>
            <button class="btn btn-primary" style="margin-top: 15px; font-family: 'B Titr';
            width: 150px; height: 25px; line-height: 25px; margin-bottom: 15px;
            padding: 0">
                ثبت
            </button>

        </form>
    </div>
</div>

<script src="js/real_estate_list.js"></script>
<script src="js/header_menu.js"></script>
</body>


</html>

