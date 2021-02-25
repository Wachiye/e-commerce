<?php
    //required headers
    header("Access-Control-Allow-Methods:POST");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    include_once '../objects/user.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //get input data
        $data = json_decode(file_get_contents("php://input"));

        //validate data
        if( empty( $data->name) || empty( $data->email) ||
        empty( $data->phone) || empty( $data->type_id) ||
        empty( $data->region_id) || empty( $data->password)){
            http_response_code(400);
            echo json_encode(array(
                "error" => "INCOMPLETE_DATA_ERR",
                "message" => "Could not create user. Some fields are missing"
            ));
            die();
        }

        $user->user_name = $data->name;
        $user->user_email = $data->email;
        $user->user_phone = $data->phone;
        $user->user_type_id = $data->type_id;
        $user->user_region_id = $data->region_id;
        $user->user_address = $data->address;
        $user->user_billing_address = $data->billing_address ?? "";
        $user->user_shipping_address = $data->shipping_address ?? "";
        $user->password = $data->password ;
        
        //save user
        $user_id = $user->create();
        if($user_id){
            http_response_code(200);
            echo  json_encode( array(
                "error" => null,
                "message" => "User created successfully",
                "success" => true,
                "user_id" => $user_id
            ));
        }
        else{
            http_response_code(500);
            echo  json_encode( array(
                "error" => "CREATE_USER_ERR",
                "message" => "Sorry but we are unable to create user",
                "success" => false
            ));
        }
    }
    else{
        http_response_code(400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected POST, received " . $_SERVER['REQUEST_METHOD']
        ));
    }
?>