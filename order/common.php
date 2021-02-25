<?php
    header("Content-Type: application/json; charset=UTF-8");
    
    //include the order object file
    include_once '../objects/order.php';
    include_once '../objects/order-detail.php';
    include_once '../objects/payment.php';
    include_once '../objects/user.php';
    //include database
    include_once '../config/database.php';

    //instantiate and initialize the database  and order  and other object
    $GLOBALS["db"] = new Database();
    $order = new Order();
    $order_detail = new OrderDetail();
    $payment = new Payment();
    $user = new User();
?>