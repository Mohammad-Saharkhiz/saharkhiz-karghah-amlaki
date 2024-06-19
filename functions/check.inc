<?php

function check_username ( $pdo , $username , $level , $id )
{
    if ( $level == '0' || $level == '1' )
    {
        $sql = "SELECT user_name , id FROM real_estate.managers";
        $statment = $pdo -> query ($sql);
        $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
        $sql = "SELECT user_name , id FROM real_estate.main_manager";
        $statment = $pdo -> query ($sql);
        $user_t_t = $statment -> fetchall (PDO::FETCH_ASSOC);
        array_push( $user_t , $user_t_t[0] );
    }
    elseif ( $level == '2' )
    {
        $sql = "SELECT user_name , id FROM real_estate.users";
        $statment = $pdo -> query ($sql);
        $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    }
    $check = true;
    for ( $i = 0; $i < count($user_t); $i++ )
    {
        if ( $username == $user_t[$i]['user_name'] && $id != $user_t[$i]['id'] )
        {
            $check = false;
        }
    }
    return $check;
}

function check_phone ( $pdo , $phone, $level , $id )
{
    if ( $level == '0' || $level == '1' )
    {
        $sql = "SELECT phone , id FROM real_estate.managers";
        $statment = $pdo -> query ($sql);
        $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
        $sql = "SELECT phone , id FROM real_estate.main_manager";
        $statment = $pdo -> query ($sql);
        $user_t_t = $statment -> fetchall (PDO::FETCH_ASSOC);
        array_push( $user_t , $user_t_t[0] );
    }
    elseif ( $level == '2' )
    {
        $sql = "SELECT phone , id FROM real_estate.users";
        $statment = $pdo -> query ($sql);
        $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    }
    $check = true;
    for ( $i = 0; $i < count($user_t); $i++ )
    {
        if ( $phone == $user_t[$i]['phone'] && $id != $user_t[$i]['id'] )
        {
            $check = false;
        }
    }
    return $check;
}

