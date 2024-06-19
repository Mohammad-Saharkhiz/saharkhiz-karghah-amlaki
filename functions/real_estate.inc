<?php

function create_real_estate ( $pdo , $real_estate )
{
    $title = $real_estate['title'];
    $property_owner = $real_estate['property_owner'];
    $type_build = $real_estate['type_build'];
    $type_transaction = $real_estate['type_transaction'];
    $type_estate = $real_estate['type_estate'];
    $type_document = $real_estate['type_document'];
    $area = $real_estate['area'];
    $street = $real_estate['street'];
    $lane = $real_estate['lane'];
    $plaque = $real_estate['plaque'];
    if ( $type_build == "apartment" )
    {
        $history = $real_estate['history'];
        $foundation = $real_estate['foundation'];
        $room_number = $real_estate['room_number'];
        $input = $real_estate['input'];
        $floor = $real_estate['floor'];
        $unit = $real_estate['unit'];
        $cabinets = $real_estate['cabinets'];
        $roof_top = $real_estate['roof_top'];
        $floor_covering = $real_estate['floor_covering'];
        $parking = $real_estate['parking'];
        $elevator = $real_estate['elevator'];
        $pool = $real_estate['pool'];
        $warehouse = $real_estate['warehouse'];
        $cooler = $real_estate['cooler'];
        $master = $real_estate['master'];
    }
    else if ( $type_build == "villa" )
    {
        $history = $real_estate['history'];
        $foundation = $real_estate['foundation'];
        $room_number = $real_estate['room_number'];
        $input = $real_estate['input'];
        $floor = null;
        $unit = null;
        $cabinets = $real_estate['cabinets'];
        $roof_top = $real_estate['roof_top'];
        $floor_covering = $real_estate['floor_covering'];
        $parking = $real_estate['parking'];
        $elevator = $real_estate['elevator'];
        $pool = $real_estate['pool'];
        $warehouse = $real_estate['warehouse'];
        $cooler = $real_estate['cooler'];
        $master = $real_estate['master'];
    }
    else if ( $type_build == "earth" )
    {
        $history = null;
        $foundation = null;
        $room_number = null;
        $input = null;
        $floor = null;
        $unit = null;
        $cabinets = null;
        $roof_top = null;
        $floor_covering = null;
        $parking = null;
        $elevator = null;
        $pool = null;
        $warehouse = null;
        $cooler = null;
        $master = null;
    }
    //****************************************
    if ( $type_transaction == "buy_sell" )
    {
        $price = $_POST['price'];
        $mortgage = null;
        $rent = null;
    }
    else if ( $type_transaction == "mortgage_rent" )
    {
        $price = null;
        $mortgage = $real_estate['mortgage'];
        $rent = $real_estate['rent'];
    }
    else if ( $type_transaction == "exchange" )
    {
        $price = null;
        $mortgage = null;
        $rent = null;
    }
    else if ( $type_transaction == "presell" )
    {
        $price = $real_estate['price'];
        $mortgage = null;
        $rent = null;
    }
    $registrar = $_COOKIE['level'].$_COOKIE['id'];
    $sql = "INSERT INTO real_estates ( title , property_owner , registrar , type_build , type_transaction , type_estate , type_document , area ,
                    street , lane , plaque , history , foundation , room_number , input , floor , unit , cabinets , roof_top , floor_covering ,
                    parking , elevator , pool , warehouse , cooler , master , price , mortgage , rent )
            VALUES ( '$title' , '$property_owner' , '$registrar' , '$type_build' , '$type_transaction' , '$type_estate' , '$type_document' , '$area' , '$street' ,
                    '$lane' , '$plaque' , '$history' , '$foundation' , '$room_number' , '$input' , '$floor' , '$unit' , '$cabinets' , '$roof_top' ,
                    '$floor_covering' , '$parking' , '$elevator' , '$pool' , '$warehouse' , '$cooler' , '$master' , '$price' , '$mortgage' , '$rent')";
    $statment = $pdo -> prepare ($sql);
    $statment -> execute ();
    $sql = "SELECT id  FROM real_estates";
    $statment = $pdo -> query ($sql);
    $real_estate = $statment -> fetchall (PDO::FETCH_ASSOC);
    $id = $real_estate[count($real_estate) - 1]['id'];

    $sql = "CREATE TABLE `real_estate`.`real_estate_$id` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `type` VARCHAR(1) NOT NULL,
              `title` VARCHAR(100) NOT NULL,
              `name` VARCHAR(50) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
              UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8;";
    $statment = $pdo -> prepare ($sql);
    $statment -> execute ();
}

function change_real_estate ( $pdo , $real_estate )
{
    $id = $real_estate['id'];
    $title = $real_estate['title'];
    $property_owner = $real_estate['property_owner'];
    $type_build = $real_estate['type_build'];
    $type_transaction = $real_estate['type_transaction'];
    $type_estate = $real_estate['type_estate'];
    $type_document = $real_estate['type_document'];
    $area = $real_estate['area'];
    $street = $real_estate['street'];
    $lane = $real_estate['lane'];
    $plaque = $real_estate['plaque'];
    if ($type_build == "apartment") {
        $history = $real_estate['history'];
        $foundation = $real_estate['foundation'];
        $room_number = $real_estate['room_number'];
        $input = $real_estate['input'];
        $floor = $real_estate['floor'];
        $unit = $real_estate['unit'];
        $cabinets = $real_estate['cabinets'];
        $roof_top = $real_estate['roof_top'];
        $floor_covering = $real_estate['floor_covering'];
        $parking = $real_estate['parking'];
        $elevator = $real_estate['elevator'];
        $pool = $real_estate['pool'];
        $warehouse = $real_estate['warehouse'];
        $cooler = $real_estate['cooler'];
        $master = $real_estate['master'];
    } else if ($type_build == "villa") {
        $history = $real_estate['history'];
        $foundation = $real_estate['foundation'];
        $room_number = $real_estate['room_number'];
        $input = $real_estate['input'];
        $floor = null;
        $unit = null;
        $cabinets = $real_estate['cabinets'];
        $roof_top = $real_estate['roof_top'];
        $floor_covering = $real_estate['floor_covering'];
        $parking = $real_estate['parking'];
        $elevator = $real_estate['elevator'];
        $pool = $real_estate['pool'];
        $warehouse = $real_estate['warehouse'];
        $cooler = $real_estate['cooler'];
        $master = $real_estate['master'];
    } else if ($type_build == "earth") {
        $history = null;
        $foundation = null;
        $room_number = null;
        $input = null;
        $floor = null;
        $unit = null;
        $cabinets = null;
        $roof_top = null;
        $floor_covering = null;
        $parking = null;
        $elevator = null;
        $pool = null;
        $warehouse = null;
        $cooler = null;
        $master = null;
    }
    //****************************************
    if ($type_transaction == "buy_sell") {
        $price = $_POST['price'];
        $mortgage = null;
        $rent = null;
    } else if ($type_transaction == "mortgage_rent") {
        $price = null;
        $mortgage = $real_estate['mortgage'];
        $rent = $real_estate['rent'];
    } else if ($type_transaction == "exchange") {
        $price = null;
        $mortgage = null;
        $rent = null;
    } else if ($type_transaction == "presell") {
        $price = $real_estate['price'];
        $mortgage = null;
        $rent = null;
    }
    $registrar = $_COOKIE['level'] . $_COOKIE['id'];
    $sql = "UPDATE real_estates SET  title = '$title' ,property_owner = '$property_owner', registrar = '$registrar',
                        type_build = '$type_build' ,type_transaction = '$type_transaction',type_estate = '$type_estate', 
                        type_document = '$type_document' , area = '$area' , street = '$street' , lane = '$lane' ,
                        plaque = '$plaque' , history = '$history' , foundation = '$foundation' , room_number = '$room_number' ,
                        input = '$input' , floor = '$floor' , unit = '$unit' , cabinets = '$cabinets' , roof_top = '$roof_top' , 
                        floor_covering = '$floor_covering' , parking = '$parking' , elevator = '$elevator' , pool = '$pool' ,
                        warehouse = '$warehouse' , cooler = '$cooler' , master = '$master' , price = '$price' , mortgage = '$mortgage' ,
                        rent = '$rent' WHERE id = '$id'";
    $statment = $pdo->prepare($sql);
    $statment->execute();
}

function get_part_real_estates ( $pdo )
{
    $sql = "SELECT id , title , type_build , type_transaction , type_estate , type_document , area , 
       street , foundation , price , mortgage , rent , room_number , master , pool , cooler , elevator ,
       parking , warehouse FROM real_estates";
    $statment = $pdo -> query ($sql);
    $real_estate = $statment -> fetchall (PDO::FETCH_ASSOC);
    return $real_estate;
}

function get_real_estate ( $pdo , $id )
{
    $sql = "SELECT * FROM real_estates WHERE (id = '$id')";
    $statment = $pdo -> query ($sql);
    $real_estate = $statment -> fetchall (PDO::FETCH_ASSOC);
    return $real_estate;
}

function insert_image ( $pdo , $image , $id )
{
    $sql = "SELECT id FROM real_estate_$id";
    $statment = $pdo -> query ($sql);
    $real_estates = $statment -> fetchall (PDO::FETCH_ASSOC);
    $title = $image['title'];
    $type = $image['type'];
    $id_img = (INT) $real_estates[count($real_estates) - 1]['id'] + 1;
    $name = "image"."_"."$id"."_"."$id_img".".jpg";
    $sql = "INSERT INTO real_estate_$id ( title , type , name )
            VALUES ( '$title' , '$type' , '$name')";
    $statment = $pdo -> prepare ($sql);
    $statment -> execute ();
    move_uploaded_file($image['file']['tmp_name'], "image/real_estates/" . $name);
}

function get_images_real_estate ( $pdo , $id )
{
    $sql = "SELECT * FROM real_estate_$id";
    $statment = $pdo -> query ($sql);
    $images = $statment -> fetchall (PDO::FETCH_ASSOC);
    return $images;
}


