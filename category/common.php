<?php  
    //header
    header("Access-Control-All-Origin:*");
    header("Content-Type: application/json; charset=UTF-8");
    
    //include the product object file
    include_once '../objects/category.php';
    //include database
    include_once '../config/database.php';

    //instantiate and initialize the database  and product object
   $GLOBALS["db"] =new Database();
    $category = new Category();
?>