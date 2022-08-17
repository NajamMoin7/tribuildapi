<?php
    class Project{
      // Connection
      private $conn;
      // Table
      private $db_table = "project";
      // Columns
      public $pid;
      public $uid;
      public $pname;
      public $pdes;
      public $pfiles;
      public $pstartdate;
      public $penddate;
     
      // Db connection
      public function __construct($db){
          $this->conn = $db;
      }
      // GET ALL
      public function getRoles(){
          $sqlQuery = "SELECT `pid`, `uid`, `pname`, `pdes`,`pfiles` ,  `pstartdate`, `penddate` FROM " . $this->db_table . "";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->execute();
          return $stmt;
      }
        // CREATE
        public function createRoles(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    uid= :uid, 
                    pname = :pname, 
                    pdes = :pdes, 
                    pfiles = :pfiles,
                    pstartdate = :pstartdate,
                    penddate = :penddate";
                   
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
          
            $this->uid=htmlspecialchars(strip_tags($this->uid));
            $this->pname=htmlspecialchars(strip_tags($this->pname));
            $this->pdes=htmlspecialchars(strip_tags($this->pdes));
            $this->pfiles=htmlspecialchars(strip_tags($this->pfiles));
            $this->pstartdate=htmlspecialchars(strip_tags($this->pstartdate));
            $this->penddate=htmlspecialchars(strip_tags($this->penddate));
        
            // bind data
           
            $stmt->bindParam(":uid", $this->uid);
            $stmt->bindParam(":pname", $this->pname);
            $stmt->bindParam(":pdes", $this->pdes); 
            $stmt->bindParam(":pfiles", $this->pfiles); 
            $stmt->bindParam(":pstartdate", $this->pstartdate); 
            $stmt->bindParam(":penddate", $this->penddate); 
          
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleProject(){
            $sqlQuery = "SELECT
                       `pid`, `uid`, `pname`, `pdes`,`pfiles`, `pstartdate`, `penddate`
                      FROM
                       ". $this->db_table ."
                    WHERE 
                    pid  = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->pid);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->uid = $dataRow['uid'];
            $this->pname = $dataRow['pname'];
            $this->pdes = $dataRow['pdes'];
            $this->pfiles = $dataRow['pfiles'];
            $this->pstartdate = $dataRow['pstartdate'];
            $this->penddate = $dataRow['penddate'];
        }        
        // UPDATE
        public function updateRoles(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET  
                    
                        uid =  :uid,
                        pname = :pname, 
                        pdes = :pdes, 
                        pfiles = :pfiles, 
                        pstartdate = :pstartdate,
                        penddate = :penddate
                    WHERE 
                        pid = :pid";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->uid=htmlspecialchars(strip_tags($this->uid));
            $this->pname=htmlspecialchars(strip_tags($this->pname));
            $this->pdes=htmlspecialchars(strip_tags($this->pdes));
            $this->pfiles=htmlspecialchars(strip_tags($this->pfiles));
            $this->pstartdate=htmlspecialchars(strip_tags($this->pstartdate));
            $this->penddate=htmlspecialchars(strip_tags($this->penddate));
            $this->pid=htmlspecialchars(strip_tags($this->pid));
        
            // bind data
            $stmt->bindParam("uid:", $this->uid);
            $stmt->bindParam("pname:", $this->pname);
            $stmt->bindParam("pdes:", $this->pdes);
            $stmt->bindParam("pfiles:", $this->pfiles);
            $stmt->bindParam("pstartdate:", $this->pstartdate);
            $stmt->bindParam("penddate:", $this->penddate);
            $stmt->bindParam("pid:", $this->pid);
   
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteRoles(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE pid = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->pid=htmlspecialchars(strip_tags($this->pid));
        
            $stmt->bindParam(1, $this->pid);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
