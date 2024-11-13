<?php
session_start();
require_once('./config/Config.php');



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $crsId = filter_input(INPUT_GET,'crs_id',FILTER_VALIDATE_INT);
    if($crsId){
        $db = getDbInstance();
        $cours = $db->where('id',$crsId)->getOne('courses');
        if($cours){
            $userId = $_SESSION['user_id'];
            $courseId = $cours['id'];
           $success =  $db->insert('user_courses',['user_id'=>$userId,'course_id'=>$courseId]);
           if($success){
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