<?php
    header("Content-Type: application/json; charset=UTF-8");
    
    //include the product object file
    include_once '../objects/product.php';
    //include database
    include_once '../config/database.php';

    //instantiate and initialize the database  and product object
    $GLOBALS["db"] = new Database();
    $product = new Product();
?>