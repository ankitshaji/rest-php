<?php 
    $db_user = "root";
    $db_password = "";
    $db_name = "restphp";
    
    //creating database connection
    $db = new PDO("mysql:host=127.0.0.1;dbname=".$db_name.";charset=utf8",$db_user,$db_password);

    //set db attributes
    //:: scope resolution operator
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    define("APP_NAME","REST PHP");
