<?php 
//GET Request - All

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

//include initialize.php - all files
include_once("../core/initialize.php");

//instantiate post +conncet db
$post = new Post($db);

//execute query - GET
$result = $post->read();

//get row count
$num = $result->rowCount();

if($num > 0){
    //array that takes arrays
    $post_arr = array();
    $post_arr["data"] = array();
    
    //iterate through records
    //GET request to database
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        //seperate values
        extract($row);
        //item array
        $post_item = array(
            "id" =>$id,
            "title"=> $title,
            "body"=>html_entity_decode($body),
            "author"=>$author,
            "category_id"=>$category_id,
            "category_name"=>$category_name
        );

        //post_arr has arrays of post items
        array_push($post_arr["data"],$post_item);
    }
    //convert to JSON and output
    echo json_encode($post_arr);
}else{
        echo json_encode(array("message" => "No posts found"));
}
