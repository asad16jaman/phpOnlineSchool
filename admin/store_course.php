<?php
session_start();
require_once('./../config/Config.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = filter_input(INPUT_POST,'name');
    $author = filter_input(INPUT_POST,'author');
    $duration = filter_input(INPUT_POST,'duration');
    $price = filter_input(INPUT_POST,'price');
    $sell_price = filter_input(INPUT_POST,'sell_price');
    $description = filter_input(INPUT_POST,'description');

    //handlin img
    $img = $_FILES['img'];
    $extention = pathinfo($img['name'])['extension'];
    $lowExtention = strtolower($extention);

    if($name && $author && $duration && $price && $sell_price && $description && $img['name'] !== ""){
        $arr = Array(
            clean_input($name),
            clean_input($description),
            $author,
            $duration,
           $price,
            $sell_price
        );
        try{
            $imgName = time().'.'.$extention;
            move_uploaded_file($img['tmp_name'],'_assets/crs_thum/'.$imgName);
            $arr[] = $imgName;
            $db = getDbInstance();
            $db->rawQuery("INSERT INTO courses(name,description,author,duration,price,sell_price,img) VALUES(?,?,?,?,?,?,?)",$arr);
            $_SESSION['success'] = "successfully lesson  add.";
            header("Location: courselist.php");
            exit();
        }catch(Exception $e){
            // var_dump($e->getMessage());
            header("Location: add_course.php");
            exit();
        }
    }else{
        header("Location: courselist.php");
        exit();
    }
    
}else{
    header("Location: add_course.php");
    exit();
}













?>