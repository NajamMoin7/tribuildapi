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
    
    $item->pid = isset($_GET['pid']) ? $_GET['pid']  : die();
  
    $item->getSingleProject();
 
    if($item->pname != null){
        // create array
        $emp_arr = array(
            "pid" =>  $item->pid,
            "uid" =>  $item->uid,
            "pname" => $item->pname,
            "pdes" => $item->pdes,
            "pfiles" => $item->pfiles,
            "pstartdate" => $item->pstartdate,
            "penddate" => $item->penddate,
        );
      
        http_response_code(200);
       
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>