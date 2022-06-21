<?php
//DELETE Request

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");

//include initialize.php - all files
include_once("../core/initialize.php");

//instantiate post + conncet db
$post = new Post($db);

//get raw post data
$data = json_decode(file_get_contents("php://input"));
//getting id
$post->id = $data->id;

//execute query - DELETE
if ($post->delete()) {
    echo json_encode(array("message" => "Post Deleted"));
} else {
    echo json_encode(array("message" => "Post not Deleted"));
}
