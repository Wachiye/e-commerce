<?php
    header("Content-Type: application/json; charset=UTF-8");
    
    //include the user object file
    include_once '../objects/user.php';
    //include database
    include_once '../config/database.php';

    //instantiate and initialize the database  and user object
   $GLOBALS["db"] =new Database();
    // $db_conn = ect();
    $user = new User();
?>