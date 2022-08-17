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
    $item->roleid = isset($_GET['roleid']) ? $_GET['roleid'] : die();
  
    $item->getSingleRoles();
    if($item->adminid != null){
        // create array
        $emp_arr = array(
            "roleid" =>  $item->roleid,
            "adminid" => $item->adminid,
            "managerid" => $item->managerid,
            "clientid" => $item->clientid,
            "employeeid" => $item->employeeid,
            
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>