<?php

function change_info ( $pdo , $user )
{
    require ('functions/check.inc');
    if ( $_COOKIE['level'] == 0 || $_COOKIE['level'] == 1 )
    {
        $result = 0;
        $check_username = check_username ( $pdo , $user['username'] , $user['level'] , $user['id'] );
        $check_phone = check_phone ( $pdo , $user['phone'] , $user['level'] , $user['id'] );
        if ( !$check_username)
        {
            $result = 1;
        }
        elseif ( !$check_phone)
        {
            $result = 2;
        }
        elseif ( $check_phone && $check_username )
        {
            $fname = $user['fname'];
            $lname = $user['lname'];
            $phone = $user['phone'];
            $gender = $user['gender'];
            $password = $user['password'];
            $username = $user['username'];
            if ( $user['level'] != '2')
            {
                $birthday = $user['birthday'];
                $national_code = $user['national_code'];
            }
            $id = $user['id'];
            if ( $user['level'] == '1' )
            {
                $database = 'managers';
                $birthday = "birthday = '$birthday',";
            }
            elseif ( $user['level'] == '2' )
            {
                $database = 'users';
                $birthday = null;
                $national_code = null;
            }
            if ($password == null )
            {
                if ( $_COOKIE['level'] == 1 && $national_code != null)
                {
                    $sql = "UPDATE $database SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                        $birthday gender = '$gender' ,user_name = '$username',national_code = '$national_code' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
                else
                {
                    $sql = "UPDATE $database SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                        $birthday gender = '$gender' ,user_name = '$username' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
            }
            else
            {
                if ( $_COOKIE['level'] == 0 && $national_code != null)
                {
                    $option = [
                        "cost" => "10"
                    ];
                    $password = password_hash($password , PASSWORD_BCRYPT , $option);
                    $sql = "UPDATE $database SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                        $birthday gender = '$gender' ,password = '$password',national_code = '$national_code' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
                else
                {
                    $option = [
                        "cost" => "10"
                    ];
                    $password = password_hash($password , PASSWORD_BCRYPT , $option);
                    $sql = "UPDATE $database SET  first_name = '$fname' ,last_name = '$lname', phone = '$phone',
                        $birthday gender = '$gender' ,password = '$password' WHERE id = '$id'";
                    $statment = $pdo -> prepare ($sql);
                    $statment -> execute ();
                }
            }
        }
    }
    return $result;
}

function get_user ( $pdo , $id , $level )
{
    if ( $level == 1 )
    {
        $sql = "SELECT id , first_name , last_name , user_name , phone ,gender, birthday, national_code
        FROM real_estate.managers WHERE id = '$id'";
        $statment = $pdo -> query ($sql);
        $user = $statment -> fetchall (PDO::FETCH_ASSOC);
        $user = $user[0];
    }
    elseif ( $level == 2 )
    {
        $sql = "SELECT id , first_name , last_name , user_name , phone ,gender , active
        FROM real_estate.users WHERE id = '$id'";
        $statment = $pdo -> query ($sql);
        $user = $statment -> fetchall (PDO::FETCH_ASSOC);
        $user = $user[0];
    }
    return $user;
}

function condition ( $pdo , $active , $id)
{
    $sql = "UPDATE users SET  active = '$active' WHERE id = '$id'";
    $statment = $pdo -> prepare ($sql);
    $statment -> execute ();
}


















