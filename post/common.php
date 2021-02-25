<?php  
    //header
    header("Access-Control-All-Origin:*");
    header("Content-Type: application/json; charset=UTF-8");
    
    //include the required object file
    include_once '../objects/post.php';
    //include database
    include_once '../config/database.php';

    //instantiate and initialize the database  and product object
    $GLOBALS["db"] = new Database();
    $post = new Post();
?>