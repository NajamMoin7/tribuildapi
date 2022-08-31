<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../class/asspro.php';
    include_once '../config/database.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Asspro($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->asspid = $data->asspid;
    
    // users values
    $item->managerid = $data->managerid;
    $item->employeeid = $data->employeeid;
    $item->adminid = $data->adminid;
    $item->pid = $data->pid;
    
    if($item->updateRoles()){
        echo json_encode("Employee data updated.");
        
    } else{
        echo json_encode("Data could not be updated");
      
    }
?>