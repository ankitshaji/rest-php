<?php
class Category
{
    //db
    private $conn;
    private $table = "categories";

    //category properties
    public $id;
    public $name;
    public $created_date;

    //constructor with db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET from database - ALL POSTS
    public function read()
    {
        //query
        $query = "SELECT 
            *
            FROM
            " . $this->table . " c 
            ORDER BY c.created_date DESC";

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
}
