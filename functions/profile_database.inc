<?php


function change_info ( $pdo , $user )
{
    $sql = "SELECT * FROM real_estate.managers";
    $statment = $pdo -> query ($sql);
    $user_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM real_estate.main_manager";
    $statment = $pdo -> query ($sql);
    $user_t_t = $statment -> fetchall (PDO::FETCH_ASSOC);
    array_push( $user_t , $user_t_t[0] );
    $result = 0;
    $check = true;
    for ( $i = 0; $i < count($user_t); $i++ )
    {
        if ( $user['username'] == $user_t[$i]['user_name'] && $user['id'] != $user_t[$i]['id'] )
        {
            $check = false;
        }
    }
    if ( $check )
    {
        for ( $i = 0; $i < count($user_t); $i++ )
        {
            if ( $user['phone'] == $user_t[$i]['phone'] && $user['id'] != $user_t[$i]['id'] )
            {
                $check = false;
            }
        }
        if ( $check )
        {
            $fname = $user['fname'];
            $lname = $user['lname'];
            $phone = $user['phone'];
            $gender = $user['gender'];
            $password = $user['password'];
            $national_code = $user['national_code'];
            $username = $user['username'];
            $birthday = $user['birthday'];
            $id = $user['id'];
            if ($password == null )
            {
                if ( $_COOKIE['level'] == 0)
                {
                    $sql = "UPDATE main_manager SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                    birthday = '$birthday',gender = '$gender' ,user_name = '$username',national_code = '$national_code' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
                elseif ( $_COOKIE['level'] == 1 )
                {
                    $sql = "UPDATE managers SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                    birthday = '$birthday',gender = '$gender' ,user_name = '$username' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
                elseif ( $_COOKIE['level'] == 2 )
                {
                    $sql = "UPDATE users SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                    birthday = '$birthday',gender = '$gender' ,user_name = '$username' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
            }
            else
            {
                if ( $_COOKIE['level'] == 0)
                {
                    $option = [
                        "cost" => "10"
                    ];
                    $password = password_hash($password , PASSWORD_BCRYPT , $option);
                    $sql = "UPDATE main_manager SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                    birthday = '$birthday',gender = '$gender' ,password = '$password',national_code = '$national_code' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
                elseif ( $_COOKIE['level'] == 1 )
                {
                    $option = [
                        "cost" => "10"
                    ];
                    $password = password_hash($password , PASSWORD_BCRYPT , $option);
                    $sql = "UPDATE managers SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                    birthday = '$birthday',gender = '$gender' ,password = '$password' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
                elseif ( $_COOKIE['level'] == 2 )
                {
                    $option = [
                        "cost" => "10"
                    ];
                    $password = password_hash($password , PASSWORD_BCRYPT , $option);
                    $sql = "UPDATE users SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                    birthday = '$birthday',gender = '$gender' ,password = '$password' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
            }
        }
        else
        {
            $result = 2;
        }
    }
    else
    {
        $result = 1;
    }
    return $result;
}

function get_user ( $pdo , $id )
{
    if ( $_COOKIE['level'] == 0 )
    {
        $sql = "SELECT id , first_name , last_name , user_name , phone ,gender, birthday,level, national_code
        FROM real_estate.main_manager WHERE id = '$id'";
        $statment = $pdo -> query ($sql);
        $user = $statment -> fetchall (PDO::FETCH_ASSOC);
        $user = $user[0];
    }
    elseif ( $_COOKIE['level'] == 1 )
    {
        $sql = "SELECT id , first_name , last_name , user_name , phone ,gender, birthday,level, national_code
        FROM real_estate.managers WHERE id = '$id'";
        $statment = $pdo -> query ($sql);
        $user = $statment -> fetchall (PDO::FETCH_ASSOC);
        $user = $user[0];
    }
    elseif ( $_COOKIE['level'] == 2 )
    {
        $sql = "SELECT id , first_name , last_name , user_name , phone ,gender, birthday,level, national_code
        FROM real_estate.users WHERE id = '$id'";
        $statment = $pdo -> query ($sql);
        $user = $statment -> fetchall (PDO::FETCH_ASSOC);
        $user = $user[0];
    }
    return $user;
}