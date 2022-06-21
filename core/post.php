<?php
class Post
{
    //db
    private $conn;
    private $table = "posts";

    //post properties
    public $id;
    public $category_id; //fk
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_date;

    //constructor with db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //getting posts from db
    public function read()
    {
        //query
        $query = "SELECT 
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_date
            FROM
            " . $this->table . " p
            LEFT JOIN 
                categories c on p.category_id = c.id
                ORDERED BY p.created_at DESC";

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;
    }
}
