<?php
    header("Access-Control-Allow-Methods:PUT");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    include_once '../objects/post.php';

    if($_SERVER['REQUEST_METHOD'] === 'PUT'){
        //get data
        $data = json_decode( file_get_contents( "php://input"));

        //validate data
        if( empty($_GET['id']) && empty($data->id) ){
            //return missing fields error
            http_response_code( 400);
            echo json_encode( array (
                "error" => "INCOMPLETE_DATA_ERR",
                "message" => "Unable to update post. Some fields as missing",
                "data" => $data,
                "success" => false
            ));
            die();
        }

        $post->post_id = $_GET['id'] ?? $data->id;
        
        //create the post
        $stmt = $post->like();
        $num = $stmt->rowCount();

        if( $num > 0){
            http_response_code( 200);
            echo json_encode( array(
                "error" => null,
                "message" => "Thanks for linking our post.",
                "success" => true
            ));
        }
        else{
            //return error
            http_response_code( 500);
            echo json_encode( array(
                "error" => $stmt->errorinfo(),
                "success" => false
            ));
        }
    }
    else{
        http_response_code( 400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected PUT, received " . $_SERVER['REQUEST_METHOD'],
            "success" => true
        ));
    }
?>
