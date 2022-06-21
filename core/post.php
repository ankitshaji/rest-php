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
                ORDER BY p.created_date DESC";

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;
    }

    //getting single post from db
    public function readSingle()
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
                WHERE p.id = ? LIMIT 1";

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //bind param to ?
        $stmt->bindParam(1, $this->id);
        //execute query
        $stmt->execute();

        //Get Request to database - returns array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->title =  $row["title"];
        $this->body = $row["body"];
        $this->author = $row["title"];
        $this->category_id = $row["category_id"];
        $this->category_name = $row["category_name"];
    }
}
