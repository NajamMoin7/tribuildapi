<?php
    class Asspro{
      // Connection
      private $conn;
      // Table
      private $db_table = "assignproject";
      // Columns
      public $asspid; 
      public $managerid;
      public $employeeid;
      public $adminid;
      public $pid;
     
      // Db connection
      public function __construct($db){
          $this->conn = $db;
      }
      // GET ALL
      public function getRoles(){
          $sqlQuery = "SELECT `asspid`, `managerid`, `employeeid`, `adminid`, `pid` FROM " . $this->db_table . "";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->execute();
          return $stmt;
      }
        // CREATE
        public function createAssPro(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET  
                    managerid = :managerid, 
                    employeeid = :employeeid, 
                    adminid = :adminid,
                    pid = :pid";
                   
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
          
            
            $this->managerid=htmlspecialchars(strip_tags($this->managerid));
            $this->employeeid=htmlspecialchars(strip_tags($this->employeeid));
            $this->adminid=htmlspecialchars(strip_tags($this->adminid));
            $this->pid=htmlspecialchars(strip_tags($this->pid));
        
            // bind data
           
           
            $stmt->bindParam(":managerid", $this->managerid);
            $stmt->bindParam(":employeeid", $this->employeeid); 
            $stmt->bindParam(":adminid", $this->adminid); 
            $stmt->bindParam(":pid", $this->pid); 
          
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleRoles(){
            $sqlQuery = "SELECT
                        managerid,
                        employeeid,
                        adminid,
                        pid
                      FROM
                       ". $this->db_table ."
                    WHERE 
                    asspid = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->asspid);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->managerid = $dataRow['managerid'];
            $this->employeeid = $dataRow['employeeid'];
            $this->adminid = $dataRow['adminid'];
            $this->pid = $dataRow['pid'];
        }        
        // UPDATE
        public function updateRoles(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET 
                        managerid = :managerid, 
                        employeeid = :employeeid, 
                        adminid = :adminid, 
                        pid = :pid
                    WHERE 
                        asspid = :asspid";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->managerid=htmlspecialchars(strip_tags($this->managerid));
            $this->employeeid=htmlspecialchars(strip_tags($this->employeeid));
            $this->adminid=htmlspecialchars(strip_tags($this->adminid));
            $this->pid=htmlspecialchars(strip_tags($this->pid));
            $this->asspid=htmlspecialchars(strip_tags($this->asspid));
        
            // bind data
            $stmt->bindParam("managerid:", $this->managerid);
            $stmt->bindParam("employeeid:", $this->employeeid);
            $stmt->bindParam("adminid:", $this->adminid);
            $stmt->bindParam("pid:", $this->pid);
            $stmt->bindParam("asspid:", $this->asspid);
    
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteUsers(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE asspid = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->asspid=htmlspecialchars(strip_tags($this->asspid));
        
            $stmt->bindParam(1, $this->asspid);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
