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

    //GET from database - ALL POSTS
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

    //GET from database - SINGLE POST
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

    //POST to database - CREATE
    public function create()
    {
        //create query
        $query = "INSERT INTO `" . $this->table . "` SET title = :title, body = :body, author = :author, category_id = :category_id";

        //prepare statment
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //binding params
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);

        //execute query
        if ($stmt->execute()) {
            return true;
        }
        //catch error

        printf("Error %s \n", $stmt->error);
        return false;
    }

    //PUT to database - UPDATE
    public function update()
    {
        //create query
        $query = "UPDATE `" . $this->table . "` SET title = :title, body = :body, author = :author, category_id = :category_id
        WHERE id = :id";

        //prepare statment
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //binding params
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":id", $this->id);

        //execute query
        if ($stmt->execute()) {
            return true;
        }
        //catch error

        printf("Error %s \n", $stmt->error);
        return false;
    }

    //DELETE from database - DELETE
    public function delete()
    {
        //create query
        $query = "DELETE FROM `" . $this->table . "` 
         WHERE id = :id";

        //prepare statment
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //binding params
        $stmt->bindParam(":id", $this->id);

        //execute query
        if ($stmt->execute()) {
            return true;
        }
        //catch error
        printf("Error %s \n", $stmt->error);
        return false;

    }
}
