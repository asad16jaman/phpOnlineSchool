<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']){
    header("Location: login.php");
    exit();
};
require_once('./config/Config.php');



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $crsId = filter_input(INPUT_GET,'crs_id',FILTER_VALIDATE_INT);
    $amount = filter_input(INPUT_POST,'amount');
    $course_name = filter_input(INPUT_POST,'course_name');

    $arr = Array(
        'user_id' => $_SESSION['user_id'],
        'course_id' => $crsId,
        'course_name' => $course_name,
        'unique_id' => uniqid(),
        'amount' => $amount
    );

    if($crsId){
        $db = getDbInstance();
        $cours = $db->where('id',$crsId)->getOne('courses');
        if($cours){
            $userId = $_SESSION['user_id'];
            $courseId = $cours['id'];
           $neworder =  $db->insert('orders',$arr);
           $success =  $db->insert('user_courses',['user_id'=>$userId,'course_id'=>$courseId]);
           if($success && $neworder){
                header("Location: /profile/index.php");
                exit();
           }else{
            header("Location: index.php");
            exit();
           }

        }else{
          
            header("Location: index.php");
            exit();
        }

    }else{
      
        header("Location: index.php");
        exit();
    }
    

}else{
    
    header("Location: index.php");
    exit();
}




?>