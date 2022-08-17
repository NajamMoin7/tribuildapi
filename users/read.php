<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../class/user.php';
    include_once '../config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new User($db);
    $stmt = $items->getUsers();
    $itemCount = $stmt->rowCount(); 
    
    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $UsersArr = array();
        $UsersArr["body"] = array();
        $UsersArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "uid" => $uid,
                "uname" => $uname,
                "ufullname" => $ufullname,
                "uemail" => $uemail,
                "upassword" => $upassword,
                "roleid" => $roleid
            );
            array_push($UsersArr["body"], $e);
        }
        echo json_encode($UsersArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>