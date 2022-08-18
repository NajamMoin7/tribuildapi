<?php
class Role
{
    // Connection
    private $conn;
    // Table
    private $db_table = "role";
    // Columns
    public $roleid;
    public $adminid;
    public $managerid;
    public $clientid;
    public $employeeid;

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // GET ALL
    public function getRoles()
    {
        $sqlQuery = "SELECT `roleid`, `adminid`, `managerid`, `clientid`, `employeeid` FROM " . $this->db_table . "";
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
                    adminid= :adminid, 
                    managerid = :managerid, 
                    clientid = :clientid, 
                    employeeid = :employeeid";


        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize

        $this->adminid = htmlspecialchars(strip_tags($this->adminid));
        $this->managerid = htmlspecialchars(strip_tags($this->managerid));
        $this->clientid = htmlspecialchars(strip_tags($this->clientid));
        $this->employeeid = htmlspecialchars(strip_tags($this->employeeid));

        // bind data

        $stmt->bindParam(":adminid", $this->adminid);
        $stmt->bindParam(":managerid", $this->managerid);
        $stmt->bindParam(":clientid", $this->clientid);
        $stmt->bindParam(":employeeid", $this->employeeid);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // READ single
    public function getSingleRoles()
    {
        $sqlQuery = "SELECT
                       `roleid`, `adminid`, `managerid`, `clientid`, `employeeid`
                      FROM
                       " . $this->db_table . "
                    WHERE 
                    roleid  = ?
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->roleid);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->adminid = $dataRow['adminid'];
        $this->managerid = $dataRow['managerid'];
        $this->clientid = $dataRow['clientid'];
        $this->employeeid = $dataRow['employeeid'];
    }
    // UPDATE
    public function updateRoles()
    {
        $sqlQuery = "UPDATE
            " . $this->db_table . "
        SET
            adminid = :adminid, 
            managerid = :managerid, 
            clientid = :clientid, 
            employeeid = :employeeid 
        WHERE 
            roleid = :roleid";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->adminid = htmlspecialchars(strip_tags($this->adminid));
        $this->managerid = htmlspecialchars(strip_tags($this->managerid));
        $this->clientid = htmlspecialchars(strip_tags($this->clientid));
        $this->employeeid = htmlspecialchars(strip_tags($this->employeeid));
        $this->roleid = htmlspecialchars(strip_tags($this->roleid));

        // bind data
        $stmt->bindParam(":adminid", $this->adminid);
        $stmt->bindParam(":managerid", $this->managerid);
        $stmt->bindParam(":clientid", $this->clientid);
        $stmt->bindParam(":employeeid", $this->employeeid);
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
    
        $this->id=htmlspecialchars(strip_tags($this->roleid));
    
        $stmt->bindParam(1, $this->id);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
