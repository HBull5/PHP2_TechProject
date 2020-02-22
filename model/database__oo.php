<?php  
class Database {
    private $db;
    private $dsn = 'mysql:host=localhost;dbname=tech_support';
    private $username = 'root';
    private $password = '';

    public function __construct() {
        try {
            $this->db =  new PDO($this->dsn, $this->username, $this->password);
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }
    
    public function getDB() {
        return $this->db;
    }

}
?>