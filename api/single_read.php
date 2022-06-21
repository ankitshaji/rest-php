<?php
//GET Request - Single

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

//include initialize.php - all files
include_once("../core/initialize.php");

//instantiate post + conncet db
$post = new Post($db);

//get id from url
$post->id = isset($_GET["id"]) ? $_GET["id"] : die();

//execute query - GET
$post->readSingle();

$post_arr = array(
    "id" => $post->id,
    "title" => $post->title,
    "body" => $post->body,
    "author" => $post->author,
    "category_id" => $post->category_id,
    "category_name" => $post->category_name,
);

//convert to json and output
print_r(json_encode($post_arr));