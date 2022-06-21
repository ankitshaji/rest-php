<?php 
//GET Request - All

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

//include initialize.php - all files
include_once("../core/initialize.php");

//instantiate category +conncet db
$category = new Category($db);

//execute query - GET
$result = $category->read();

//get row count
$num = $result->rowCount();

if($num > 0){
    //array that takes arrays
    $category_arr = array();
    $category_arr["data"] = array();
    
    //iterate through records
    //GET request to database
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        //seperate values
        extract($row);
        //item array
        $category_item = array(
            "id" =>$id,
            "name"=> $name,
            "create_date"=>$created_date
        );

        //category_arr has arrays of category items
        array_push($category_arr["data"],$category_item);
    }
    //convert to JSON and output
    echo json_encode($category_arr);
}else{
        echo json_encode(array("message" => "No posts found"));
}
