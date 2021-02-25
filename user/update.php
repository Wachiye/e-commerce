<?php
    //required headers
    header("Access-Control-Request-Method:PUT");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Request-Method, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    include_once '../objects/user.php';
    //get input data
    $data = json_decode(file_get_contents("php://input"));

    //validate data
    if(empty( $data->name) || empty( $data->email) ||
    empty( $data->phone) || empty( $data->type_id) ||
    empty( $data->region_id) || empty( $data->password)){
        http_response_code(400);
        echo json_encode(array(
            "error" => "INCOMPLETE_DATA_ERR",
            "message" => "Could not create user. Some fields are missing"
        ));
        die();
    }
    if(empty($_GET['id']) && empty($data->id)){
        http_response_code(400);
        echo json_encode(array(
            "error" => "INCOMPLETE_DATA_ERR",
            "message" => "Could not create user.No user id"
        ));
        die(); 
    }
    $user->user_id = $_GET['id'] ?? $data->id;
    $user->user_name = $data->name;
    $user->user_type_id = $data->type_id;
    $user->user_region_id = $data->region_id;
    $user->user_address = $data->address;
    $user->user_billing_address = $data->billing_address ?? "";
    $user->user_shipping_address = $data->shipping_address ?? "";
    
    //save user
    $user_id = $user->update();
    if($user_id){
        http_response_code(200);
        echo  json_encode( array(
            "error" => null,
            "message" => "User updated successfully",
            "success" => true,
        ));
    }
    else{
        http_response_code(500);
        echo  json_encode( array(
            "error" => "UPDATE_USER_ERR",
            "message" => "Sorry but we are unable to update user",
            "success" => false
        ));
    }
?>