<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/Project.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Project($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->uid = $data->uid;
    $item->pname = $data->pname;
    $item->pdes = $data->pdes;
    $item->pfiles = $data->pfiles;
    $item->pstartdate = $data->pstartdate;
    $item->penddate = $data->penddate;
    
    if($item->createRoles()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
       
    }
?>