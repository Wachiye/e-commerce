<?php
    header("Content-Type: application/json; charset=UTF-8");
    
    //include the required object files
    
    include_once '../objects/payment.php';
    include_once '../objects/order.php';
    include_once '../config/database.php';

    //instantiate and initialize the database  and order  and other object
    $GLOBALS["db"] = new Database();
    $order = new Order();
    
    $payment = new Payment();
?>