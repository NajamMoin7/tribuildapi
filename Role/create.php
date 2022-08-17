<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/Role.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Role($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->adminid = $data->adminid;
    $item->managerid = $data->managerid;
    $item->clientid = $data->clientid;
    $item->employeeid = $data->employeeid;
    
    if($item->createRoles()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
       
    }
?>