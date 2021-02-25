<?php
    //required headers
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Request-Method:GET');
    include_once './common.php';
    
    //check  for the $_GET request
    if(!isset($_GET) || !is_array($_GET) || empty($_GET)){
        //query users
        $stmt = $user->readAll();   
    }
    if(isset($_GET['search'])){
        $stmt = $user->search($_GET['search']);
    }
    $num = $stmt->rowCount();

    //check some records ar found
    if($num > 0){
        //users array
        $users = array();
        $users['records'] = array();

        //retrieve table contents
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
            array_push( $users["records"], $data);
        }
        //set response code = 200 OK

        http_response_code(200);
        echo json_encode($users);
    }
    else{
        //set reSponse code to 404 NOT FOUND
        http_response_code(404);
        //send message
        echo json_encode(
            array("message" => "No users found.")
        );
    }
?>