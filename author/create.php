<?php
    //required headers
    header("Access-Control-Allow-Methods:POST");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    include_once '../objects/author.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //get input data
        $data = json_decode(file_get_contents("php://input"));

        //validate data
        if( empty( $data->user_id) || empty( $data->bio) ||
        empty( $data->title) || empty( $data->company_name)
        ){
            http_response_code(400);
            echo json_encode(array(
                "error" => "INCOMPLETE_DATA_ERR",
                "message" => "Could not create user. Some fields are missing"
            ));
            die();
        }

        $author->author_user_id = $data->user_id;
        $author->author_bio = $data->bio;
        $author->author_title = $data->title;
        $author->author_company_name = $data->company_name;
    
        //save author
        $stmt = $author->create();
        $num = $stmt->rowCount();

        if($num > 0){
            $author->author_id = $GLOBALS['db']->getInsertId();
            http_response_code(200);
            echo  json_encode( array(
                "error" => null,
                "message" => "Author created successfully",
                "success" => true,
                "author_id" => $author->author_id
            ));
        }
        else{
            http_response_code(500);
            echo  json_encode( array(
                "error" => $stmt->errorinfo(),
                "message" => "Sorry but we are unable to create user",
                "success" => false
            ));
        }
    }
    else{
        http_response_code(400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected POST, received " . $_SERVER['REQUEST_METHOD'],
            "success" => false,
        ));
    }
?>