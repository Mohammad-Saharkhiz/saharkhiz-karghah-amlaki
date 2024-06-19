<?php


function create_manager ( $pdo , $manager )
{
    $username = $manager['username'];
    $option = [
        "cost" => "10"
    ];
    $password = password_hash($manager['password'] , PASSWORD_BCRYPT , $option);
    $fname = $manager['fname'];
    $lname = $manager['lname'];
    $national_code = $manager['national_code'];
    $birthday = $manager['birthday'];
    $gender = $manager['gender'];
    $phone = $manager['phone'];
    $sql = "INSERT INTO managers (user_name , password , national_code , first_name , last_name , birthday , gender , phone )
            VALUES ( '$username' , '$password' , '$national_code' , '$fname' , '$lname' , '$birthday' , '$gender' , '$phone')";
    $statment = $pdo -> prepare ($sql);
    $statment -> execute ();
}

function get_managers ( $pdo )
{
    $sql = "SELECT id , first_name , last_name , phone FROM real_estate.managers";
    $statment = $pdo -> query ($sql);
    $managers = $statment -> fetchall (PDO::FETCH_ASSOC);
    return $managers;
}

function create_user ( $pdo , $user )
{
    require ('libraries/jdf.php');
    $date = jdate('Y/m/d');
    if ( $_COOKIE['level'] == 0 )
    {
        $id_registrar = '0';
    }
    else
    {
        $id_registrar = $_COOKIE['id'];
    }
    $username = $user['username'];
    $option = [
        "cost" => "10"
    ];
    $password = password_hash($user['password'] , PASSWORD_BCRYPT , $option);
    $fname = $user['fname'];
    $lname = $user['lname'];
    $gender = $user['gender'];
    $phone = $user['phone'];

    $sql = "INSERT INTO users (user_name , password , first_name , 
                   last_name , gender , phone , date_registration , 
                   id_registrar )
            VALUES ( '$username' , '$password' , '$fname' , '$lname' , 
                    '$gender' , '$phone' , '$date' , '$id_registrar')";
    $statment = $pdo -> prepare ($sql);
    $statment -> execute ();
}

function get_users ( $pdo )
{
    $sql = "SELECT id , first_name , last_name , phone FROM real_estate.users";
    $statment = $pdo -> query ($sql);
    $users = $statment -> fetchall (PDO::FETCH_ASSOC);
    return $users;
}
















