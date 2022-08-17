<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/user.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new User($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->uname = $data->uname;
    $item->ufullname = $data->ufullname;
    $item->uemail = $data->uemail;
    $item->upassword = $data->upassword;
    $item->roleid = $data->roleid;
    
    if($item->createUsers()){
        echo 'Employee created successfully.';
        echo print_r($item);
    } else{
        echo 'Employee could not be created.';
        echo var_dump($item);
        
    }
?>

