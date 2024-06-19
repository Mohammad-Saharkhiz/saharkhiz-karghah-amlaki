<?php
/*
function check_users_for_log ( $pdo , $username , $password )
{
    $sql = "SELECT user_name , password FROM real_estate.managers";
    $statment = $pdo -> query ($sql);
    $users = $statment -> fetchall (PDO::FETCH_ASSOC);
    $check = 0;
    for ( $i = 0; $i < count($users) ; $i++ )
    {
        if ( $users[$i]["user_name"] == $username)
        {
            $check = 1;
            if (password_verify( $password , $users[$i]["password"]))
            {
                $check = 2;
            }
        }
    }
    return $check;
}
*/
function check_managers_for_log ( $pdo , $username , $password )
{
    $sql = "SELECT user_name , password FROM real_estate.managers";
    $statment = $pdo -> query ($sql);
    $users = $statment -> fetchall (PDO::FETCH_ASSOC);
    $check = 0;
    for ( $i = 0; $i < count($users) ; $i++ )
    {
        if ( $users[$i]["user_name"] == $username)
        {
            $check = 1;
            if (password_verify( $password , $users[$i]["password"]))
            {
                $check = 2;
            }
        }
    }
    if ( $check == 0 )
    {
        $sql = "SELECT user_name , password FROM real_estate.main_manager";
        $statment = $pdo -> query ($sql);
        $users = $statment -> fetchall (PDO::FETCH_ASSOC);
        if ( $users[0]["user_name"] == $username)
        {
            $check = 1;
            if (password_verify( $password , $users[0]["password"]))
            {
                $check = 2;
            }
        }
    }
    return $check;
}

function check_users_for_log ( $pdo , $username , $password )
{
    $sql = "SELECT user_name , password , active FROM real_estate.users";
    $statment = $pdo -> query ($sql);
    $users = $statment -> fetchall (PDO::FETCH_ASSOC);
    $check = 0;
    for ( $i = 0; $i < count($users) ; $i++ )
    {
        if ( $users[$i]["user_name"] == $username)
        {
            $check = 1;
            if (password_verify( $password , $users[$i]["password"]))
            {
                $check = 2;
                if ( $users[$i]['active'] == 1 )
                {
                    $check = 3;
                }
            }
            break;
        }
    }
    return $check;
}
/*
function get_users_for_log ( $pdo , $username , $password )
{
    $sql = "SELECT * FROM real_estate.managers WHERE user_name = '$username'";
    $statment = $pdo -> query ($sql);
    $user = $statment -> fetchall (PDO::FETCH_ASSOC);
    $user = $user[0];
    return $user;
}
*/
function get_managers_for_log ( $pdo , $username , $password )
{
    $sql = "SELECT * FROM real_estate.managers WHERE user_name = '$username'";
    $statment = $pdo -> query ($sql);
    $user = $statment -> fetchall (PDO::FETCH_ASSOC);
    $level = 1;
    if ( count($user) == 0 )
    {
        $sql = "SELECT * FROM real_estate.main_manager WHERE user_name = '$username'";
        $statment = $pdo -> query ($sql);
        $user = $statment -> fetchall (PDO::FETCH_ASSOC);
        $level = 0;
    }
    $user = $user[0];
    $user['level'] = $level;
    return $user;
}

function get_users_for_log ( $pdo , $username , $password )
{
    $sql = "SELECT * FROM real_estate.users WHERE user_name = '$username'";
    $statment = $pdo -> query ($sql);
    $user = $statment -> fetchall (PDO::FETCH_ASSOC);
    $level = 2;
    $user = $user[0];
    $user['level'] = $level;
    return $user;
}














