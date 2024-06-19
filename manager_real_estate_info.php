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
    <link href="css/real_estate_info.css" rel="stylesheet" type="text/css">
</head>

<?php

require ('functions/functions.inc');
if (!check_log())
{
    redirect('error_log.php');
}

require('functions/real_estate.inc');
$pdo = require_once('connections/real_estate.inc');

if ( !isset($_POST['id_real_estate']) )
{
    redirect('error_id.php');
}

if ( isset($_POST['title_pic']) )
{
    $image['title'] =  $_POST['title_pic'];
    $image['type'] = $_POST['type_pic'];
    $image['file'] = $_FILES['image'];
    insert_image ( $pdo , $image , $_POST['id_real_estate']);
}

if (isset($_POST['title']))
{
    $real_estate = [
        'id' => $_POST['id_real_estate'],
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
    change_real_estate( $pdo , $real_estate );
}




$real_estate = get_real_estate( $pdo , $_POST['id_real_estate'] );
if ( count($real_estate) == 0 )
{
    redirect('error_id.php');
}
else
{
    $real_estate = $real_estate[0];
    $id = $real_estate['id'];
    $title = $real_estate['title'];
    $type_build = $real_estate['type_build'];
    if ( $type_build == 'apartment')
    {
        $type_build_t = 'آپارتمانی';
    }
    elseif ( $type_build == 'villa' )
    {
        $type_build_t = 'ویلایی';
    }
    elseif ( $type_build == 'earth' )
    {
        $type_build_t = 'زمین';
    }
    $type_transaction = $real_estate['type_transaction'];
    if ( $type_transaction == 'buy_sell')
    {
        $type_transaction_t = 'خرید و فروش';
    }
    elseif ( $type_transaction == 'mortgage_rent' )
    {
        $type_transaction_t = 'رهن و اجاره';
    }
    elseif ( $type_transaction == 'exchange' )
    {
        $type_transaction_t = 'معاوضه';
    }
    elseif ( $type_transaction == 'presell' )
    {
        $type_transaction_t = 'پیش فروش';
    }
    $type_estate = $real_estate['type_estate'];
    if ( $type_estate == 'commercial')
    {
        $type_estate_t = 'تجاری';
    }
    elseif ( $type_estate == 'residential' )
    {
        $type_estate_t = 'مسکونی';
    }
    $type_document = $real_estate['type_document'];
    if ( $type_document == 'property')
    {
        $type_document_t = 'ملکی';
    }
    elseif ( $type_document == 'endowment' )
    {
        $type_document_t = 'اوقاف';
    }
    $unit = $real_estate['unit'];
    $floor = $real_estate['floor'];
    $foundation = $real_estate['foundation'];
    $room_number = $real_estate['room_number'];
    $history = $real_estate['history'];
    $input = $real_estate['input'];
    if ( $input == 'independent')
    {
        $input_t = 'مستقل';
    }
    elseif ( $input == 'common' )
    {
        $input_t = 'مشترک';
    }
    $cabinets = $real_estate['cabinets'];
    if ( $cabinets == 'melamine')
    {
        $cabinets_t = 'ملامینه';
    }
    elseif ( $cabinets == 'mdf' )
    {
        $cabinets_t = 'ام دی اف';
    }
    elseif ( $cabinets == 'vacuum' )
    {
        $cabinets_t = 'وکیوم';
    }
    elseif ( $cabinets == 'wood_veneer' )
    {
        $cabinets_t = 'روکش چوب';
    }
    elseif ( $cabinets == 'wooden' )
    {
        $cabinets_t = 'تمام چوب';
    }
    elseif ( $cabinets == 'high_glass' )
    {
        $cabinets_t = 'های گلاس';
    }
    elseif ( $cabinets == 'polyglass' )
    {
        $cabinets_t = 'پلی گلاس';
    }
    elseif ( $cabinets == 'metallic' )
    {
        $cabinets_t = 'فلزی';
    }
    $roof_top = $real_estate['roof_top'];
    if ( $roof_top == 'simple')
    {
        $roof_top_t = 'ساده';
    }
    elseif ( $roof_top == 'spaced' )
    {
        $roof_top_t = 'فضا سازی شده';
    }
    $floor_covering = $real_estate['floor_covering'];
    if ( $floor_covering == 'ceramic')
    {
        $floor_covering_t = 'سرامیک';
    }
    elseif ( $floor_covering == 'mosaic' )
    {
        $floor_covering_t = 'موزائیک';
    }
    elseif ( $floor_covering == 'cement' )
    {
        $floor_covering_t = 'سیمان';
    }
    elseif ( $floor_covering == 'wood' )
    {
        $floor_covering_t = 'چوب';
    }
    elseif ( $floor_covering == 'rock' )
    {
        $floor_covering_t = 'سنگ';
    }
    $parking = $real_estate['parking'];
    if ( $parking == '0')
    {
        $parking_t = 'ندارد';
    }
    else
    {
        $parking_t = 'دارد';
    }
    $elevator = $real_estate['elevator'];
    if ( $elevator == '0')
    {
        $elevator_t = 'ندارد';
    }
    else
    {
        $elevator_t = 'دارد';
    }
    $pool = $real_estate['pool'];
    if ( $pool == '0')
    {
        $pool_t = 'ندارد';
    }
    else
    {
        $pool_t = 'دارد';
    }
    $warehouse = $real_estate['warehouse'];
    if ( $warehouse == '0')
    {
        $warehouse_t = 'ندارد';
    }
    else
    {
        $warehouse_t = 'دارد';
    }
    $cooler = $real_estate['cooler'];
    if ( $cooler == '0')
    {
        $cooler_t = 'ندارد';
    }
    else
    {
        $cooler_t = 'دارد';
    }
    $master = $real_estate['master'];
    if ( $master == '0')
    {
        $master_t = 'ندارد';
    }
    else
    {
        $master_t = 'دارد';
    }
    $area = $real_estate['area'];
    $street = $real_estate['street'];
    $price = $real_estate['price'];
    $mortgage = $real_estate['mortgage'];
    $rent = $real_estate['rent'];
    $lane = $real_estate['lane'];
    $plaque = $real_estate['plaque'];
}

$images = get_images_real_estate ( $pdo , $id );

?>

<body>

<header>
    <?php
    require ('header_manager.inc');
    ?>
</header>

<main id="main_real_estate_info">
    <div class="images" id="images">
        <div style="margin-bottom: 7px">
            <?php
            for ($i = 0; $i < count($images); $i++)
            {
                $title_t = $images[$i]['title'];
                $name = $images[$i]['name'];
                echo "
                <button id = 'btn_$name'>
                    $title_t
                </button>
                ";
            }
            ?>

            <button id = "btn_insert_photo">
                اضافه کردن
                <i class="fa-solid fa-plus"></i>
            </button>

        </div>
        <?php

        for ($i = 0; $i < count($images); $i++)
        {
            $name = $images[$i]['name'];
            if ( $i == 0 )
            {
                echo "
                <div id='$name' class='panorama' style='transition: 0.4s;'>
                </div>
                ";
            }
            else
            {
                echo "
                <div id='$name' class='panorama' style='visibility: hidden;opacity: 0;z-index: 1;
                width: 0; height: 0; transition: 0.4s;'>
                </div>
                ";
            }
        }

        ?>


    </div>
    <div id="info">
        <span>
            <?php
            echo "$title";
            ?>
            <button class="btn btn-primary" style="float: left; margin-left: 30px; font-family: 'B Titr'">
                اطلاعات مالک
            </button>
            <button class="btn btn-primary" style="float: left; margin-left: 30px; font-family: 'B Titr'" id = "btn_change_real_estate">
                ویرایش اطلاعات
            </button>
        </span>
        <fieldset>
            <legend>
                اطلاعات کلی
            </legend>
            <?php
            echo "
            <div>
                <section>
                    <i class='fa-solid fa-building'></i>
                    نوع ساختمان:
                </section>
                <section>
                    $type_build_t
                </section>
            </div>
            <div>
                <section>
                    <i class='fa-solid fa-file-lines'></i>
                    نوع معامله:
                </section>
                <section>
                    $type_transaction_t
                </section>
            </div>
            <div>
                <section>
                    <i class='fa-solid fa-file-lines'></i>
                    نوع سند:
                </section>
                <section>
                    $type_document_t
                </section>
            </div>
            <div>
                <section>
                    <i class='fa-solid fa-file-lines'></i>
                    نوع ملک:
                </section>
                <section>
                    $type_estate_t
                </section>
            </div>
            <div>
                <section>
                    <i class='fa-solid fa-map'></i>
                    مساحت:
                </section>
                <section>
                    $area
                     متر مربع
                </section>
            </div>
            ";
            if ( $type_build == 'apartment' || $type_build == 'villa')
            {
                echo "
                <div>
                    <section>
                        <i class='fa-solid fa-map'></i>
                        مساحت زیربنا:
                    </section>
                    <section>
                        $foundation
                         متر مربع
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-clock-rotate-left'></i>
                        سال ساخت:
                    </section>
                    <section>
                        $history
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-house'></i>
                        تعداد اتاق:
                    </section>
                    <section>
                        $room_number
                         عدد
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-door-open'></i>
                        ورودی خانه:
                    </section>
                    <section>
                        $input_t
                         عدد
                    </section>
                </div>
                ";
            }
            if ( $type_transaction == 'buy_sell' || $type_transaction == 'presell')
            {
                echo "
                <div>
                    <section>
                        <i class='fa-solid fa-sack-dollar'></i>
                        قیمت:
                    </section>
                    <section>
                        $price
                         تومان
                    </section>
                </div>
                ";
            }
            elseif ( $type_transaction == 'mortgage_rent')
            {
                echo "
                <div>
                    <section>
                        <i class='fa-solid fa-sack-dollar'></i>
                        رهن:
                    </section>
                    <section>
                        $mortgage
                         تومان
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-sack-dollar'></i>
                        اجاره:
                    </section>
                    <section>
                        $rent
                         تومان
                    </section>
                </div>
                ";
            }


            ?>
        </fieldset>

        <fieldset>
            <legend>
                <i class="fa-solid fa-location-dot"></i>
                آدرس
            </legend>
            <?php
            echo "
            <div>
                <section>
                    <i class='fa-solid fa-road'></i>
                    خیابان:
                </section>
                <section>
                    $street
                </section>
            </div>
            <div>
                <section>
                    <i class='fa-solid fa-road'></i>
                    کوچه:
                </section>
                <section>
                    $lane
                </section>
            </div>
            <div>
                <section>
                    <svg width='20' height='20' fill='currentColor' class='bi bi-7-square-fill' viewBox='0 0 16 16' style='margin-left: 4px'>
                        <path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm3.37 5.11V4.001h5.308V5.15L7.42 12H6.025l3.317-6.82v-.07H5.369Z'/>
                    </svg>
                    پلاک:
                </section>
                <section>
                    $plaque
                </section>
            </div>
            ";
            if ( $type_build == 'apartment')
            {
                echo "
                    <div>
                    <section>
                        <i class='fa-regular fa-building'></i>
                        طبقه:
                    </section>
                    <section>
                        $floor
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-building-user'></i>
                        واحد:
                    </section>
                    <section>
                        $unit
                    </section>
                </div>
                ";
            }
            ?>
        </fieldset>
        <?php
        if ( $type_build == 'apartment' || $type_build == 'villa' )
        {
            echo "
            <fieldset>
                <legend>
                    <i class='fa-solid fa-list-ul'></i>
                    امکانات
                </legend>
                <div>
                    <section>
                        <i class='fa-solid fa-building-user'></i>
                        کابینت:
                    </section>
                    <section>
                        $cabinets_t
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-building-user'></i>
                        پشت بام:
                    </section>
                    <section>
                        $roof_top_t
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-square-parking'></i>
                        پارکینگ:
                    </section>
                    <section>
                        $parking_t
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-elevator'></i>
                        آسانسور:
                    </section>
                    <section>
                        $elevator_t
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-person-swimming'></i>
                        استخر:
                    </section>
                    <section>
                        $pool_t
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-warehouse'></i>
                        انباری:
                    </section>
                    <section>
                        $warehouse_t
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-fan'></i>
                        کولر:
                    </section>
                    <section>
                        $cooler_t
                    </section>
                </div>
                <div>
                    <section>
                        <i class='fa-solid fa-shower'></i>
                        مستر:
                    </section>
                    <section>
                        $master_t
                    </section>
                </div>
            </fieldset>
            ";
        }
        ?>
        
    </div>

</main>

<div class="insert" id="insert_photo">
    <div>
        <section id="btn_exit_insert">
            <i class="fa-solid fa-xmark"></i>
        </section>
        <span>
            افزودن تصویر جدید
        </span>
        <form method="post" class="was-validated" action="manager_real_estate_info.php" enctype="multipart/form-data">
            <section>
                <div>
                    <span class="input-group-text" id="basic-addon1">عنوان:</span>
                    <input type="text" class="form-control" placeholder="Title"
                           aria-label="Username" aria-describedby="basic-addon1" required
                           minlength="3" maxlength="70" name="title_pic">
                    <div class="invalid-feedback">
                        عنوان را وارد کنید.
                    </div>
                </div>
                <div>
                    <span class="input-group-text" id="basic-addon1">عکس:</span>
                    <input type="file" class="form-control"
                           aria-label="Password" aria-describedby="basic-addon1"
                           name="image" required>
                    <div class="invalid-feedback">
                        عکس را بارگزاری کنید.
                    </div>
                </div>
                <div style="text-align: center">
                    <div class='form-check' style='margin-right: 15px; color: black; margin-top: 5px; transition: 0.2s; float: right'>
                        <input class='form-check-input' type='radio' name='type_pic'
                               id='type1' checked value='0' style='transition: 0.4s'>
                        <label class='form-check-label' for='gender1' style='color: black; margin-right: 75px'>
                            تصویر معمولی
                        </label>
                    </div>
                    <div class='form-check' style='margin-right: 15px; color: black; margin-top: 5px; transition: 0.2s; float: right'>
                        <input class='form-check-input' type='radio' name='type_pic' id='type2'
                               style='transition: 0.4s' value='1'>
                        <label class='form-check-label' for='gender2' style='color: black; margin-right: 25px'>
                            تصویر کروی
                        </label>
                    </div>
                </div>
                <?php
                $id = $_POST['id_real_estate'];
                echo "<input type='hidden' name='id_real_estate' value='$id'>";
                ?>
                <div>
                    <button class="btn btn-primary" type="submit">
                        افزودن
                    </button>
                </div>

            </section>
        </form>
    </div>
</div>

<footer>

</footer>


<script src="js/header_menu.js"></script>

<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
<?php

for ($i = 0; $i < count($images); $i++)
{
    $name = $images[$i]['name'];
    if ( $i == 0 )
    {
        echo "
        pannellum.viewer('$name', {
            'type': 'equirectangular',
            'panorama': './image/real_estates/$name',
            'autoLoad': true,
            'autoRotate': -3,
            'compass': false,
            'autoRotateInactivityDelay' : 4000,
            'northOffset': 0,
        });
        ";
    }
    echo "
    
    document.getElementById('btn_$name').onclick = function () {
    ";
    for ($j = 0; $j < count($images); $j++)
    {
        $name_t = $images[$j]['name'];
        echo "
        document.getElementById('$name_t').style.visibility = 'hidden';
        document.getElementById('$name_t').style.opacity = '0';
        document.getElementById('$name_t').style.transition = '0.4s';
        document.getElementById('$name_t').style.width = '0';
        document.getElementById('$name_t').style.height = '0';
    ";
    }
    echo "
    document.getElementById('$name').style.visibility = 'visible';
    document.getElementById('$name').style.opacity = '1';
    document.getElementById('$name').style.transition = '0.4s';
    document.getElementById('$name').style.width = '80%';
    document.getElementById('$name').style.height = '500px';
    
    ";

    echo "
    sleep(450).then(() => { 
     pannellum.viewer('$name', {
            'type': 'equirectangular',
            'panorama': './image/real_estates/$name',
            'autoLoad': true,
            'autoRotate': -3,
            'compass': false,
            'autoRotateInactivityDelay' : 4000,
            'northOffset': 0,
        });
     });
    
    
        
    ";

    echo "}";

}

?>
</script>

</body>

<div id="change_real_estate" class="new_real_estate">
    <div>
        <span>
            ویرایش اطلاعات
        </span>
        <section id="exit_change_info">
            <i class="fa-solid fa-xmark"></i>
        </section>
        <form class="was-validated" method="post" action="manager_real_estate_info.php">
            <?php
            echo "
            <div>
                <span class='input-group-text' id='title'>عنوان:</span>
                <input type='text' class='form-control' placeholder='Title'
                       aria-label='Username' aria-describedby='basic-addon1' required
                       minlength='3' maxlength='50' name='title'
                       title='عنوان را وارد نمایید.' value = '$title'>
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
                <select class='form-select' name='type_build'
                        id='type_build'>
            ";
            if ( $type_build == "apartment")
            {
                echo "
                    <option selected value='apartment'>آپارتمانی</option>
                    <option value='villa'>ویلایی</option>
                    <option value='earth'>زمین</option>
                ";
            }
            elseif ( $type_build == "villa")
            {
                echo "
                    <option value='apartment'>آپارتمانی</option>
                    <option selected value='villa'>ویلایی</option>
                    <option value='earth'>زمین</option>
                ";
            }
            elseif ( $type_build == "earth")
            {
                echo "
                    <option value='apartment'>آپارتمانی</option>
                    <option value='villa'>ویلایی</option>
                    <option selected value='earth'>زمین</option>
                ";
            }

            echo "
                </select>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نوع معامله:</span>
                <select class='form-select' name='type_transaction'
                        id='type_transaction'>
            ";
            if ( $type_transaction == "buy_sell")
            {
                echo "
                    <option selected value='buy_sell'>خرید و فروش</option>
                    <option value='mortgage_rent'>رهن و اجاره</option>
                    <option value='exchange'>معاوضه</option>
                    <option value='presell'>پیش فروش</option>
                ";
            }
            elseif ( $type_transaction == "mortgage_rent")
            {
                echo "
                    <option value='buy_sell'>خرید و فروش</option>
                    <option selected value='mortgage_rent'>رهن و اجاره</option>
                    <option value='exchange'>معاوضه</option>
                    <option value='presell'>پیش فروش</option>
                ";
            }
            elseif ( $type_transaction == "exchange")
            {
                echo "
                    <option value='buy_sell'>خرید و فروش</option>
                    <option value='mortgage_rent'>رهن و اجاره</option>
                    <option selected value='exchange'>معاوضه</option>
                    <option value='presell'>پیش فروش</option>
                ";
            }
            elseif ( $type_transaction == "presell")
            {
                echo "
                    <option value='buy_sell'>خرید و فروش</option>
                    <option value='mortgage_rent'>رهن و اجاره</option>
                    <option value='exchange'>معاوضه</option>
                    <option selected value='presell'>پیش فروش</option>
                ";
            }
            echo "
                </select>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نوع ملک:</span>
                <select class='form-select' name='type_estate'
                        id='type_estate'>
            ";
            if ( $type_estate == "commercial")
            {
                echo "
                    <option selected value='commercial'>تجاری</option>
                    <option value='residential'>مسکونی</option>
                ";
            }
            elseif ( $type_estate == "residential")
            {
                echo "
                    <option value='commercial'>تجاری</option>
                    <option selected value='residential'>مسکونی</option>
                ";
            }
            echo "
                </select>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>نوع سند:</span>
                <select class='form-select' name='type_document'
                        id='type_build'>
            ";
            if ( $type_document == "property")
            {
                echo "
                    <option selected value='property'>ملکی</option>
                    <option value='endowment'>اوقاف</option>
                ";
            }
            elseif ( $type_document == "endowment")
            {
                echo "
                    <option selected value='property'>ملکی</option>
                    <option value='endowment'>اوقاف</option>
                ";
            }
            echo "
                </select>
            </div>
            <div>
                <span class='input-group-text' id='basic-addon1'>مساحت:</span>
                <input type='number' class='form-control' placeholder='ََArea'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='1' name='area' required value='$area'
                       title='مساحت را وارد نمایید.'>
                <div class='invalid-feedback'>
                    مساحت را وارد کنید.
                </div>
            </div>
            <div id='foundation' style='display: none'>
                <span class='input-group-text' id='basic-addon1'>مساحت زیربنا:</span>
                <input type='number' class='form-control' placeholder='Foundation'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='1' name='foundation' value='$foundation'
                       title='مساحت زیربنا را وارد نمایید.'>
                <div class='invalid-feedback'>
                    مساحت زیربنا را وارد کنید.
                </div>
            </div>
            <div id='history' style='display: none'>
                <span class='input-group-text' id='basic-addon1'>سال ساخت:</span>
                <input type='number' class='form-control' placeholder='Year of construction'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='1300' max='1410' name='history' value='$history'
                       title='سال ساخت را وارد نمایید.'>
                <div class='invalid-feedback'>
                    سال ساخت را وارد کنید.
                </div>
            </div>
            <div id='room_number' style='display: none'>
                <span class='input-group-text' id='basic-addon1'>تعداد اتاق:</span>
                <input type='number' class='form-control' placeholder='Number of rooms'
                       aria-label='Username' aria-describedby='basic-addon1' value='$room_number'
                       name='room_number' title='تعداد اتاق را وارد نمایید.'>
                <div class='invalid-feedback'>
                    تعداد اتاق را وارد کنید.
                </div>
            </div>
            <div id='price' style='display: none'>
                <span class='input-group-text' id='basic-addon1'>قیمت:</span>
                <input type='number' class='form-control' placeholder='Price'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='0' name='price' step='1000' value='$price'
                       title='قیمت را وارد نمایید.'>
                <div class='invalid-feedback'>
                    قیمت را وارد کنید.
                </div>
            </div>
            <div id='mortgage' style='display: none'>
                <span class='input-group-text' id='basic-addon1'>رهن:</span>
                <input type='number' class='form-control' placeholder='Mortgage'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='0' name='mortgage' step='1000' value='$mortgage'
                       title='مقدار رهن را وارد نمایید.'>
                <div class='invalid-feedback'>
                    مقدار رهن را وارد کنید.
                </div>
            </div>
            <div id='rent' style='display: none'>
                <span class='input-group-text' id='basic-addon1'>اجاره:</span>
                <input type='number' class='form-control' placeholder='Rent'
                       aria-label='Username' aria-describedby='basic-addon1'
                       min='0' name='rent' step='1000' value='$rent'
                       title='مقدار اجاره را وارد نمایید.'>
                <div class='invalid-feedback'>
                    مقدار اجاره را وارد کنید.
                </div>
            </div>
            <div id='input'>
                <span class='input-group-text'>ورودی خانه:</span>
                <select class='form-select' name='input'
                        id='type_build'>
            ";
            if ( $input == "independent")
            {
                echo "
                    <option selected value='independent'>مستقل</option>
                    <option value='common'>مشترک</option>
                ";
            }
            elseif ( $input == "common")
            {
                echo "
                    <option value='independent'>مستقل</option>
                    <option selected value='common'>مشترک</option>
                ";
            }
            echo "
                </select>
            </div>
            <fieldset>
                <legend >
                    <i class='fa-solid fa-location-dot'></i>
                    آدرس
                </legend>
                <div>
                    <span class='input-group-text' id='street'>خیابان:</span>
                    <input type='text' class='form-control' placeholder='Street'
                           aria-label='Username' aria-describedby='basic-addon1' name='street'
                           title='خیابان را وارد نمایید.' value='$street'>
                    <div class='invalid-feedback'>
                        خیابان را وارد کنید.
                    </div>
                </div>
                <div>
                    <span class='input-group-text' id='lane'>کوچه:</span>
                    <input type='text' class='form-control' placeholder='Lane'
                           aria-label='Username' aria-describedby='basic-addon1' name='lane'
                           title='کوچه را وارد نمایید.' value='$lane'>
                    <div class='invalid-feedback'>
                        کوچه را وارد کنید.
                    </div>
                </div>
                <div>
                    <span class='input-group-text' id='plaque'>پلاک:</span>
                    <input type='text' class='form-control' placeholder='Plaque'
                           aria-label='Username' aria-describedby='basic-addon1' name='plaque'
                           title='پلاک را وارد نمایید.' value='$plaque'>
                    <div class='invalid-feedback'>
                        پلاک را وارد کنید.
                    </div>
                </div>
                <div id='floor' style='display: none'>
                    <span class='input-group-text' id='floor'>طبقه:</span>
                    <input type='text' class='form-control' placeholder='Floor'
                           aria-label='Username' aria-describedby='basic-addon1' name='floor'
                           title='شماره طبقه را وارد نمایید.' value='$floor'>
                    <div class='invalid-feedback'>
                        شماره طبقه را وارد کنید.
                    </div>
                </div>
                <div id='unit' style='display: none'>
                    <span class='input-group-text' id='unit'>واحد:</span>
                    <input type='text' class='form-control' placeholder='Unit'
                           aria-label='Username' aria-describedby='basic-addon1' name='unit'
                           title='واحد را وارد نمایید.' value='$unit'>
                    <div class='invalid-feedback'>
                        واحد را وارد کنید.
                    </div>
                </div>
            </fieldset>
            <fieldset id='equipment' style='display: none'>
                <legend>
                    <i class='fa-solid fa-list-ul'></i>
                    امکانات
                </legend>
                <div>
                    <span class='input-group-text' id='cabinets'>کابینت:</span>
                    <select class='form-select' name='cabinets'
                            id='cabinets'>
            ";
            if ( $cabinets == "melamine")
            {
                echo "
                        <option selected value='melamine'>ملامینه</option>
                        <option value='mdf'>ام دی اف</option>
                        <option value='vacuum'>وکیوم</option>
                        <option value='wood_veneer'>روکش چوب</option>
                        <option value='wooden'>تمام چوب</option>
                        <option value='high_glass'>های گلاس</option>
                        <option value='polyglass'>پلی گلاس</option>
                        <option value='metallic'>فلزی</option>
                ";
            }
            elseif ( $cabinets == "mdf")
            {
                echo "
                        <option value='melamine'>ملامینه</option>
                        <option selected value='mdf'>ام دی اف</option>
                        <option value='vacuum'>وکیوم</option>
                        <option value='wood_veneer'>روکش چوب</option>
                        <option value='wooden'>تمام چوب</option>
                        <option value='high_glass'>های گلاس</option>
                        <option value='polyglass'>پلی گلاس</option>
                        <option value='metallic'>فلزی</option>
                ";
            }
            elseif ( $cabinets == "vacuum")
            {
                echo "
                        <option value='melamine'>ملامینه</option>
                        <option value='mdf'>ام دی اف</option>
                        <option selected value='vacuum'>وکیوم</option>
                        <option value='wood_veneer'>روکش چوب</option>
                        <option value='wooden'>تمام چوب</option>
                        <option value='high_glass'>های گلاس</option>
                        <option value='polyglass'>پلی گلاس</option>
                        <option value='metallic'>فلزی</option>
                ";
            }
            elseif ( $cabinets == "wood_veneer")
            {
                echo "
                        <option value='melamine'>ملامینه</option>
                        <option selected value='mdf'>ام دی اف</option>
                        <option value='vacuum'>وکیوم</option>
                        <option selected value='wood_veneer'>روکش چوب</option>
                        <option value='wooden'>تمام چوب</option>
                        <option value='high_glass'>های گلاس</option>
                        <option value='polyglass'>پلی گلاس</option>
                        <option value='metallic'>فلزی</option>
                ";
            }
            elseif ( $cabinets == "wooden")
            {
                echo "
                        <option value='melamine'>ملامینه</option>
                        <option value='mdf'>ام دی اف</option>
                        <option value='vacuum'>وکیوم</option>
                        <option value='wood_veneer'>روکش چوب</option>
                        <option selected value='wooden'>تمام چوب</option>
                        <option value='high_glass'>های گلاس</option>
                        <option value='polyglass'>پلی گلاس</option>
                        <option value='metallic'>فلزی</option>
                ";
            }
            elseif ( $cabinets == "high_glass")
            {
                echo "
                        <option value='melamine'>ملامینه</option>
                        <option value='mdf'>ام دی اف</option>
                        <option value='vacuum'>وکیوم</option>
                        <option value='wood_veneer'>روکش چوب</option>
                        <option value='wooden'>تمام چوب</option>
                        <option selected value='high_glass'>های گلاس</option>
                        <option value='polyglass'>پلی گلاس</option>
                        <option value='metallic'>فلزی</option>
                ";
            }
            elseif ( $cabinets == "polyglass")
            {
                echo "
                        <option value='melamine'>ملامینه</option>
                        <option value='mdf'>ام دی اف</option>
                        <option value='vacuum'>وکیوم</option>
                        <option value='wood_veneer'>روکش چوب</option>
                        <option value='wooden'>تمام چوب</option>
                        <option value='high_glass'>های گلاس</option>
                        <option selected value='polyglass'>پلی گلاس</option>
                        <option value='metallic'>فلزی</option>
                ";
            }
            elseif ( $cabinets == "metallic")
            {
                echo "
                        <option value='melamine'>ملامینه</option>
                        <option value='mdf'>ام دی اف</option>
                        <option value='vacuum'>وکیوم</option>
                        <option value='wood_veneer'>روکش چوب</option>
                        <option value='wooden'>تمام چوب</option>
                        <option value='high_glass'>های گلاس</option>
                        <option value='polyglass'>پلی گلاس</option>
                        <option selected value='metallic'>فلزی</option>
                ";
            }

            echo "
                    </select>
                </div>
                <div>
                    <span class='input-group-text' id='roof_top'>پشت بام:</span>
                    <select class='form-select' name='roof_top'
                            id='roof_top'>
                ";
            if ( $roof_top == "simple")
            {
                echo "
                        <option selected value='simple'>ساده</option>
                        <option value='spaced'>فضا سازی شده</option>
                ";
            }
            elseif ( $roof_top == "spaced")
            {
                echo "
                        <option value='simple'>ساده</option>
                        <option selected value='spaced'>فضا سازی شده</option>
                ";
            }
            echo "
                    </select>
                </div>
                <div>
                    <span class='input-group-text' id='floor_covering'>کفپوش:</span>
                    <select class='form-select' name='floor_covering'
                            id='floor_covering'>
            ";
            if ( $floor_covering == "ceramic")
            {
                echo "
                        <option selected value='ceramic'>سرامیک</option>
                        <option value='mosaic'>موزائیک</option>
                        <option value='cement'>سیمان</option>
                        <option value='wood'>چوب</option>
                        <option value='rock'>سنگ</option>
                ";
            }
            elseif ( $floor_covering == "mosaic")
            {
                echo "
                        <option value='ceramic'>سرامیک</option>
                        <option selected value='mosaic'>موزائیک</option>
                        <option value='cement'>سیمان</option>
                        <option value='wood'>چوب</option>
                        <option value='rock'>سنگ</option>
                ";
            }
            elseif ( $floor_covering == "cement")
            {
                echo "
                        <option value='ceramic'>سرامیک</option>
                        <option value='mosaic'>موزائیک</option>
                        <option selected value='cement'>سیمان</option>
                        <option value='wood'>چوب</option>
                        <option value='rock'>سنگ</option>
                ";
            }
            elseif ( $floor_covering == "wood")
            {
                echo "
                        <option value='ceramic'>سرامیک</option>
                        <option value='mosaic'>موزائیک</option>
                        <option value='cement'>سیمان</option>
                        <option selected value='wood'>چوب</option>
                        <option value='rock'>سنگ</option>
                ";
            }
            elseif ( $floor_covering == "rock")
            {
                echo "
                        <option value='ceramic'>سرامیک</option>
                        <option value='mosaic'>موزائیک</option>
                        <option value='cement'>سیمان</option>
                        <option value='wood'>چوب</option>
                        <option selected value='rock'>سنگ</option>
                ";
            }
            echo "
                    </select>
                </div>
                <div class='form-check'>
            ";
            if ( $parking == "1")
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='parking'
                           name='parking' checked>
                ";
            }
            else
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='parking'
                           name='parking'>
                ";
            }
            echo "
                    <label class='form-check-label' for='parking'>
                        <i class='fa-solid fa-square-parking'></i>
                        پارکینگ
                    </label>
                </div>
                <div class='form-check'>
            ";
            if ( $elevator == "1")
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='elevator'
                           name='elevator' checked>
                ";
            }
            else
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='elevator'
                           name='elevator'>
                ";
            }
            echo "
                    <label class='form-check-label' for='elevator'>
                        <i class='fa-solid fa-elevator'></i>
                        آسانسور
                    </label>
                </div>
                <div class='form-check'>
            ";
            if ( $pool == "1")
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='pool'
                           name='pool' checked>
                ";
            }
            else
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='pool'
                           name='pool'>
                ";
            }
            echo "
                    <label class='form-check-label' for='pool'>
                        <i class='fa-solid fa-person-swimming'></i>
                        استخر
                    </label>
                </div>
                <div class='form-check'>
            ";
            if ( $warehouse == "1")
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='warehouse'
                           name='warehouse' checked>
                ";
            }
            else
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='warehouse'
                           name='warehouse'>
                ";
            }
            echo "
                    <label class='form-check-label' for='elevator'>
                        <i class='fa-solid fa-warehouse'></i>
                        انباری
                    </label>
                </div>
                <div class='form-check'>
            ";
            if ( $cooler == "1")
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='cooler'
                           name='cooler' checked>
                ";
            }
            else
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='cooler'
                           name='cooler'>
                ";
            }
            echo "
                    <label class='form-check-label' for='cooler'>
                        <i class='fa-solid fa-fan'></i>
                        کولر
                    </label>
                </div>
                <div class='form-check'>
            ";
            if ( $master == "1")
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='master'
                           name='master' checked>
                ";
            }
            else
            {
                echo "
                <input class='form-check-input' type='checkbox' value='1' id='master'
                           name='master'>
                ";
            }
            $id = $_POST['id_real_estate'];
            echo "
                    <label class='form-check-label' for='master'>
                        <i class='fa-solid fa-shower'></i>
                        مستر
                    </label>
                </div>
                <input type='hidden' name='id_real_estate' value='$id' >
                ";
                ?>
            </fieldset>
            <br>

            <button class="btn btn-primary" style="margin-top: 15px; font-family: 'B Titr';
            width: 150px; height: 25px; line-height: 25px; margin-bottom: 15px;
            padding: 0">
                ویرایش
            </button>

        </form>
    </div>
</div>
<script src="js/real_estate_info.js"></script>

</html>


