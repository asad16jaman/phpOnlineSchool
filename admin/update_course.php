<?php
session_start();
require_once('./../config/Config.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = filter_input(INPUT_GET,'crs_id');

    $name = filter_input(INPUT_POST,'name');
    $author = filter_input(INPUT_POST,'author');
    $duration = filter_input(INPUT_POST,'duration');
    $price = filter_input(INPUT_POST,'price');
    $sell_price = filter_input(INPUT_POST,'sell_price');
    $description = filter_input(INPUT_POST,'description');

    //handlin img
    

    // $lowExtention = strtolower($extention);

    if($name && $author && $duration && $price && $sell_price && $description){
        $arr = Array(
            "name"=>clean_input($name),
            "description" => clean_input($description),
            "author"=>$author,
            "duration"=>$duration,
           "price"=> $price,
            "sell_price"=>$sell_price
        );
        try{
            $db = getDbInstance();
            $data = $db->where('id',$id)->getOne('courses');
            $img = $_FILES['img'];
            if($img['name'] !="" ){
                $extention = pathinfo($img['name'])['extension'];
                $imgName = time().'.'.$extention;

                //delete previous file
                if(file_exists('_assets/crs_thum/'.$data['img'])){
                    unlink('_assets/crs_thum/'.$data['img']);
                }

                //upload new file
                move_uploaded_file($img['tmp_name'],'_assets/crs_thum/'.$imgName);
                $arr['img'] = $imgName;

            }

            $success = $db->where('id',$id)->update('courses',$arr);
            if($success){
                var_dump('ok');
            }
            
            // $db->rawQuery("INSERT INTO courses(name,description,author,duration,price,sell_price,img) VALUES(?,?,?,?,?,?,?)",$arr);

        }catch(Exception $e){
            var_dump($e->getMessage());
            // header("Location: add_course.php");
            // exit();
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