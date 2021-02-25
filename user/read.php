<?php
    //headers
    header("Access-Control-Allow-Methods:GET");

    include_once './common.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $stmt = null;
        //get all users
        if( empty($_GET)){
            $stmt = $user->readAll(); 
        }
        //get user by id
        if( isset( $_GET['id'])){
            $stmt = $user->read( $_GET['id']);
        }
        //get user by type name
        if( isset( $_GET['type'])){
            $stmt = $user->readByTypeName( $_GET['type']);
        }
        //get user by type name
        if( isset( $_GET['today'])){
            $stmt = $user->readToday();
        }
        
        $num = $stmt->rowCount();

        if( $num > 0){
            $users = array();

            //fetch row by row one at a time
            while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){
                //extract the row such that $row["name"] becomes $name
                extract($row);
                //create a data array
                $data = array(
                    "id" => $user_id,
                    "name" => $user_name,
                    "email" => $user_email,
                    "phone" => $user_phone,
                    "type_id" => $type_id,
                    "type_name" => $type_name,
                    "region_id" => $region_id,
                    "region_name" => $region_name,
                    "address" => $address,
                    "billing_address" => $billing_address,
                    "shipping_address" => $shipping_address,
                    "email_verified" => $email_verified == 1 ? true : false,
                    "created_at" => $created_at,
                    "updated_at" => $updated_at
                );

                //push data to users['records']
                array_push( $users, $data);
            }

            http_response_code( 200);
            echo json_encode( array(
                "error" => null,
                "users" => $users,
                "success" => true,
            ));   
        }
        else{
            http_response_code( 500);
            echo json_encode( array(
                "error" => "NULL_DATA",
                "message" => "No records found",
                "success" => false
            ));
        }
    }
    else{
        http_response_code( 400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected GET, received " . $_SERVER['REQUEST_METHOD'],
            "success" => false
        ));
    }
?>