<?php
    class User{
        // Connection
        private $conn;

        // Table
        private $db_table = "users";
        // Columns
        public $uid;
        public $uname;
        public $ufullname;
        public $uemail;
        public $upassword;
        public $roleid;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getUsers(){
            // $sqlQuery = "SELECT id, name, email, age, designation, created FROM " . $this->db_table . "";
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createUsers(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        uname = :uname, 
                        ufullname = :ufullname, 
                        uemail = :uemail, 
                        upassword = :upassword,
                        roleid = :roleid";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->uname=htmlspecialchars(strip_tags($this->uname));
            $this->ufullname=htmlspecialchars(strip_tags($this->ufullname));
            $this->uemail=htmlspecialchars(strip_tags($this->uemail));
            $this->upassword=htmlspecialchars(strip_tags($this->upassword));
            $this->roleid=htmlspecialchars(strip_tags($this->roleid));
        
            // bind data
            $stmt->bindParam(":uname", $this->uname);
            $stmt->bindParam(":ufullname", $this->ufullname);
            $stmt->bindParam(":uemail", $this->uemail);
            $stmt->bindParam(":upassword", $this->upassword); 
            $stmt->bindParam(":roleid", $this->roleid); 
          
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleUsers(){
            $sqlQuery = "SELECT
                       uname,
                       ufullname,
                       uemail,
                       upassword, 
                       roleid
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       uid = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->uid);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->uname = $dataRow['uname'];
            $this->ufullname = $dataRow['ufullname'];
            $this->uemail = $dataRow['uemail'];
            $this->upassword = $dataRow['upassword'];
            $this->roleid = $dataRow['roleid'];
        }        
        // UPDATE
        public function updateUsers(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    uname = :uname, 
                    ufullname = :ufullname, 
                    uemail = :uemail, 
                    upassword = :upassword,
                    roleid = :roleid
                    WHERE 
                        uid = :uid";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->uname=htmlspecialchars(strip_tags($this->uname));
            $this->ufullname=htmlspecialchars(strip_tags($this->ufullname));
            $this->uemail=htmlspecialchars(strip_tags($this->uemail));
            $this->upassword=htmlspecialchars(strip_tags($this->upassword));
            $this->roleid=htmlspecialchars(strip_tags($this->roleid));
            $this->uid=htmlspecialchars(strip_tags($this->uid));
        
            // bind data
            $stmt->bindParam(":uname", $this->uname);
            $stmt->bindParam(":ufullname", $this->ufullname);
            $stmt->bindParam(":uemail", $this->uemail);
            $stmt->bindParam(":upassword", $this->upassword);
            $stmt->bindParam(":roleid", $this->roleid);
            $stmt->bindParam(":uid", $this->uid);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteUsers(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE uid = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->uid=htmlspecialchars(strip_tags($this->uid));
        
            $stmt->bindParam(1, $this->uid);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
