<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in'] || $_SESSION['admin_type'] != "admin"){
    header("Location: /index.php");
    exit();
};
require_once('./../config/Config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = filter_input(INPUT_POST,'name');
    $course_name = filter_input(INPUT_POST,'course_name');
    $description = filter_input(INPUT_POST,'description');
    $more = filter_input(INPUT_POST,'end');
    $crs = filter_input(INPUT_GET,'crs');

    $video = $_FILES['video'];

    if($name && $course_name && $description && $crs && $video['name']!=''){
        $arr = Array(
            $name,
            $course_name,
            $description,
            $crs
        );
        $db  = getDbInstance();

        try{
            $extention = pathinfo($video['name'])['extension'];
            $videoName = time().'.'.$extention;
            move_uploaded_file($video['tmp_name'],'_assets/crs_video/'.$videoName);
            $arr[] = $videoName;
            $db->rawQuery("INSERT INTO lessons(name,course_name,description,course_id,video) VALUES(?,?,?,?,?)",$arr);
            $_SESSION['success'] = "successfully add lesson";
            header("Location: add_lessons.php?crs=$crs");
            exit();

        }catch(Exception $e){
            header("Location: add_lessons.php?crs=$crs");
            exit();

        }

       
    }else{
        header("Location: add_lessons.php?crs=$crs");
        exit();

    }

}else{
    header("Localhost: courselist.php");
    exit();
}

















?>