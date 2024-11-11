<?php
session_start();
require_once('./config/Config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'passwdord');

    if ($name && $email && $password) {
        $data = array(
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        );
        try {

            $db = getDbInstance();

            //chackin if email already exists or not
            $old = $db->where('email', $email)->getOne('users');
            if ($old) {
                $_SESSION['info'] = "already have this email";
                header("Location: register.php");
                exit();
            }

            $adduser = $db->insert('users',$data);
            $profile = $db->insert('profiles',["user_id"=>$adduser]);
            $_SESSION['success'] = "Successfully reistared";
            header("Location: login.php");
            exit();
        } catch (Exception $e) {
            $_SESSION['failure'] = $e->getMessage();
            header("Location: register.php");
            exit();
        }

    } else {
        $_SESSION['info'] = "You have to write Name, Email, Password";
        header("Location: register.php");
        exit();
    }


} else {
    header("Location: index.php");
    exit();
}


