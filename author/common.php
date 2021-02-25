<?php
    header("Content-Type: application/json; charset=UTF-8");
    
    //include the author object file
    include_once '../objects/author.php';
    //include database
    include_once '../config/database.php';

    //instantiate and initialize the database  and author object
   $GLOBALS["db"] =new Database();
    // $db_conn = ect();
    $author = new Author();
?>