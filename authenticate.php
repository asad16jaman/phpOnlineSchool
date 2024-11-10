<?php
session_start();
require_once('./config/Config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST,'password');
    $remember = filter_input(INPUT_POST,'remember');

    if($email && $password){

        $db = getDbInstance();
        $ob = $db->where('email',$email)->getOne('users');
   
        if($ob){

            if(password_verify($password,$ob['password'])){
                   
                $_SESSION['user_logged_in'] = TRUE;
			    $_SESSION['admin_type'] = $ob['type'];
			    $_SESSION['user_id'] = $ob['id'];
			    $_SESSION['email'] = $ob['email'];
                
               if($remember){
                $expiry_time = date('Y-m-d H:i:s', strtotime(' + 30 days'));
				$expires = strtotime($expiry_time);

                $serial_id = randomString(12);
                $token = uniqid();
                $arr = Array(
                    'serial_id' => $serial_id,
                    'remember_token' => password_hash($token,PASSWORD_DEFAULT),
                    'expires' => $expiry_time
                );
                try{
                   
                    $upd=$db->where('id',$ob['id'])->update('users',$arr);
                    if($upd){
                        setcookie("series_id",$serial_id,$expires,'/');
                        setcookie("remember_token",$token,$expires,'/');
                    }

                   
                }catch(Exception $e){
                    header("Location: login.php");
                    exit();
                }
               }

                
               header("Location: index.php");
               exit();
               



            }else{
                
                header("Location: login.php");
                exit();
            }

        }else{
            header("Location: login.php");
            exit();
        }
    }else{
        header("Location: login.php");
        exit(); 
    }
}else{
    header("Location: login.php");
    exit();
}








?>