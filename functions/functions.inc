<?php

function create_cookie ( $user ) {
    setcookie("id" , $user["id"] , time()+86000 );
    setcookie("fname" , $user["first_name"] , time()+86000 );
    setcookie("lname" , $user["last_name"] , time()+86000 );
    setcookie("username" , $user["user_name"] , time()+86000 );
    setcookie("birthday" , $user["birthday"] , time()+86000 );
    setcookie("phone" , $user["phone"] , time()+86000 );
    setcookie("national_code" , $user["national_code"] , time()+86000 );
    setcookie("gender" , $user["gender"] , time()+86000 );
    setcookie("level" , $user["level"] , time()+86000 );
}

function check_log ()
{
    $check = true;
    if ( !isset($_COOKIE['fname']) || !isset($_COOKIE['lname']) || !isset($_COOKIE['id'])
        || !isset($_COOKIE['username']) || !isset($_COOKIE['birthday']) || !isset($_COOKIE['phone'])
        || !isset($_COOKIE['national_code']) || !isset($_COOKIE['gender']) || !isset($_COOKIE['level']) )
    {
        $check = false;
    }
    return $check;
}

function redirect($url)
{
    if (!headers_sent()){
        header("Location: $url");
    }else{
        echo "<script type='text/javascript'>window.location.href='$url'</script>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=$url'/></noscript>";
    }
    exit;
}

function exit_user ()
{
    setcookie("id" , "" , time()-1000 );
    setcookie("fname" , "" , time()-1000 );
    setcookie("lname" , "" , time()-1000 );
    setcookie("username" , "" , time()-1000 );
    setcookie("birthday" , "" , time()-1000 );
    setcookie("phone" , "" , time()-1000 );
    setcookie("national_code" , "" , time()-1000 );
    setcookie("gender" , "" , time()-1000 );
}

function check_username_manager ( $pdo , $username )
{
    $sql = "SELECT user_name FROM real_estate.managers";
    $statment = $pdo -> query ($sql);
    $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    $sql = "SELECT user_name FROM real_estate.main_manager";
    $statment = $pdo -> query ($sql);
    $user_t_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    array_push( $user_t , $user_t_t[0] );
    $check = true;
    for ( $i = 0; $i < count($user_t) ; $i++ )
    {
        if ( $user_t[$i]['user_name'] == $username )
        {
            $check = false;
        }
    }
    return $check;
}

function check_phone_manager ( $pdo , $phone )
{
    $sql = "SELECT phone FROM real_estate.managers";
    $statment = $pdo -> query ($sql);
    $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    $sql = "SELECT user_name FROM real_estate.main_manager";
    $statment = $pdo -> query ($sql);
    $user_t_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    array_push( $user_t , $user_t_t[0] );
    $check = true;
    for ( $i = 0; $i < count($user_t) ; $i++ )
    {
        if ( $user_t[$i]['phone'] == $phone )
        {
            $check = false;
        }
    }
    return $check;
}

function check_username_user ( $pdo , $username )
{
    $sql = "SELECT user_name FROM real_estate.users";
    $statment = $pdo -> query ($sql);
    $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    $check = true;
    for ( $i = 0; $i < count($user_t) ; $i++ )
    {
        if ( $user_t[$i]['user_name'] == $username )
        {
            $check = false;
        }
    }
    return $check;
}

function check_phone_user ( $pdo , $phone )
{
    $sql = "SELECT phone FROM real_estate.users";
    $statment = $pdo -> query ($sql);
    $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    $check = true;
    for ( $i = 0; $i < count($user_t) ; $i++ )
    {
        if ( $user_t[$i]['phone'] == $phone )
        {
            $check = false;
        }
    }
    return $check;
}