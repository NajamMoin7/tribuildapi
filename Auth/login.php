<?php
include_once '../config/database.php';
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$uemail = '';
$upassword = '';

$databaseService = new Database();
$conn = $databaseService->getConnection();



$data = json_decode(file_get_contents("php://input"));

$uemail = $data->uemail;
$upassword = $data->upassword;

$table_name = 'Users';

$query = "SELECT * FROM " . $table_name . " WHERE uemail = ? LIMIT 0,1";

$stmt = $conn->prepare( $query );
$stmt->bindParam(1, $uemail);
$stmt->execute();
$num = $stmt->rowCount();

if($num > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $uid = $row['uid'];
    $uname = $row['uname'];
    $ufullname = $row['ufullname'];
    $roleid = $row['roleid'];
    $upassword2 = $row['upassword'];
    
    if(password_verify($upassword, $upassword2))
    {
        $secret_key = "YOUR_SECRET_KEY";
        $issuer_claim = "THE_ISSUER";
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = 1356999524; // issued at
        $notbefore_claim = 1357000000; //not before
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "data" => array( 
                "uid" => $uid,
                "uname" => $uname,
                "ufullname" => $ufullname,
                "uemail" => $uemail,
                "roleid" => $roleid
        ));
 
        http_response_code(200);
 
        $jwt = JWT::encode($token, $secret_key);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            ));
    }
    else{
        
        http_response_code(401);
        echo json_encode(array("message" => "Login failed.", "password" => $upassword, "password2" => $upassword2));
    }
}
?>


