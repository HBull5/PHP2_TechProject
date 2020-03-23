<?php  
class Database {
    private $db;
    private $dsn = 'mysql:host=localhost;dbname=tech_support';
    private $username = 'root';
    private $password = '';

    public function __construct() {
        try {
            $this->db =  new PDO($this->dsn, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }
    
    public function getDB() {
        return $this->db;
    }

    public static function display_db_error($error) {
        $error_message = $error;
        include('../error/database_error.php');
        exit();
    }

}
?>