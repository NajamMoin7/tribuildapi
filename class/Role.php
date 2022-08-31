<?php
class Role
{
    // Connection
    private $conn;
    // Table
    private $db_table = "role";
    // Columns
    public $roleid;
    public $name; 

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // GET ALL
    public function getRoles()
    {
        $sqlQuery = "SELECT `roleid`, `name` FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createRoles()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                    name= :name";


        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize

        $this->name = htmlspecialchars(strip_tags($this->name)); 
        // bind data

        $stmt->bindParam(":name", $this->name);
         
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // READ single
    public function getSingleRoles()
    {
        $sqlQuery = "SELECT
                       `roleid`, `name`
                      FROM
                       " . $this->db_table . "
                    WHERE 
                    roleid  = ?
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->roleid);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $dataRow['name']; 
    }
    // UPDATE
    public function updateRoles()
    {
        $sqlQuery = "UPDATE
            " . $this->db_table . "
        SET
            name = :name  
        WHERE 
            roleid = :roleid";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->roleid = htmlspecialchars(strip_tags($this->roleid));

        // bind data
        $stmt->bindParam(":name", $this->name); 
        $stmt->bindParam(":roleid", $this->roleid);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // DELETE
    function deleteRoles()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE roleid = ?";
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->roleid=htmlspecialchars(strip_tags($this->roleid));
    
        $stmt->bindParam(1, $this->roleid);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
