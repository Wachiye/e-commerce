<?php
    //headers
    header("Access-Control-Allow-Methods:GET");

    include_once './common.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $stmt = null;
        //get all authors
        if( empty($_GET)){
            $stmt = $author->readAll(); 
        }
        //get author by id
        if( isset( $_GET['id'])){
            $stmt = $author->read( $_GET['id']);
        }
        
        $num = $stmt->rowCount();

        if( $num > 0){
            $authors = array();

            //fetch row by row one at a time
            while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){
                //extract the row such that $row["name"] becomes $name
                extract($row);
                //create a data array
                $data = array(
                    "id" => $id,
                    "title" => $title,
                    "user_id" => $user_id,
                    "company_name" => $company_name,
                    "bio" => $bio,
                    "user_name" => $user_name,
                    "user_email" => $user_email,
                    "user_phone" => $user_phone,
                    "created_at" => $created_at,
                    "updated_at" => $updated_at
                );

                //push data to authors['records']
                array_push( $authors, $data);
            }

            http_response_code( 200);
            echo json_encode( array(
                "error" => null,
                "authors" => $authors,
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