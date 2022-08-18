<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../class/Project.php';
    include_once '../config/database.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Project($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->pid = $data->pid;
    
    // employee values
    $item->uid = $data->uid;
    $item->pname = $data->pname;
    $item->pdes = $data->pdes;
    $item->pfiles = $data->pfiles;
    $item->pstartdate = $data->pstartdate;
    $item->penddate = $data->penddate;

    if($item->updateProject()){
        echo json_encode("Employee data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>