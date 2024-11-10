<?php
session_start();
require_once('./../config/Config.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = filter_input(INPUT_POST,'name');
    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    $type = filter_input(INPUT_POST,'type');
    $password = filter_input(INPUT_POST,'password');
  
    if($name && $email && $type && $password){

        $db = getDbInstance();
        $user = $db->where('email',$email)->getOne('users');
        if($user){
            $_SESSION['info'] = "this email already have choose another email.";
            header("Location: add_student.php");
            exit();
        }
        $arr = array(
            // 'ssss',
            $name,
            $email,
            $type,
            password_hash($password,PASSWORD_DEFAULT)
        );

        try{
            var_dump($arr);
            $db->rawQuery("INSERT INTO users(`name`,`email`,`type`,`password`) VALUES(?,?,?,?)",$arr);
            header("Location: students.php");
            exit();
            // $_SESSION['success'] = "successfully added";
            // header("Location: students.php");
            // exit();

        }catch(Exception $e){
            $_SESSION['failure'] = $e->getMessage();
            header("Location: add_student.php");
            exit();

        }

    }else{
        $_SESSION['info'] = "You need to fillup all input file";
            header("Location: add_student.php");
            exit();
    }
    
}













?>