<?php 
class TechnicianDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function getTechs() {
        $query = 'SELECT * FROM technicians';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $technicians = $statement->fetchAll();
        $statement->closeCursor();
        return $technicians;
    }

    public function deleteTech($techID) {
        $query = 'DELETE FROM technicians WHERE techID = :techID';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':techID', $techID);
        $statement->execute();
        $statement->closeCursor();
    }

    public function addTech($fName, $lName, $email, $phone, $pass) {
        $query = 'INSERT INTO technicians (firstName, lastName, email, phone, `password`)
                  VALUES (:fName, :lName, :email, :phone, :pass)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':fName', $fName);
        $statement->bindValue(':lName', $lName);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':pass', $pass);
        $statement->execute();
        $statement->closeCursor();
    }

}
?>