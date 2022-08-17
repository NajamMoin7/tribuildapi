<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/AssPro.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Asspro($db);
    $item->asspid = isset($_GET['asspid']) ? $_GET['asspid'] : die();
   
    $item->getSingleRoles();
    if($item->managerid != null){
        // create array
        $emp_arr = array(
            "asspid" => $item->asspid,
            "managerid" => $item->managerid,
            "employeeid" => $item->employeeid,
            "adminid" => $item->adminid,
            "pid" => $item->pid
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);

    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>