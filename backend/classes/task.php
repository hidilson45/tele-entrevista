<?php
class Task{
    private $conn;
    private $db_table = 'tasks';

    public $id;
    public $title;
    public $description;

    public function __construct($db){
        $this->conn = $db;


    }

    public function createTask(){
        $sqlQuery = "INSERT INTO ".$this->db_table." SET title = :title, description = :description";
        $statement = $this->conn->prepare($sqlQuery);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':description', $this->description);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getTasks(){
        $sqlQuery = "SELECT id, title, description FROM ".$this->db_table. "";
        $statement = $this->conn->prepare($sqlQuery);
        $statement->execute();
        return $statement;
    }
}
?>