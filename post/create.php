<?php
    header("Access-Control-Allow-Methods:POST");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    include_once '../objects/user.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //get data
        $data = json_decode( file_get_contents( "php://input"));

        //validate data
        if(!$data->title || !$data->content || !$data->tags ||
        !$data->category_id || !$data->author_id){
            //return missing fields error
            http_response_code( 400);
            echo json_encode( array (
                "error" => "INCOMPLETE_DATA_ERR",
                "message" => "Unable to create post. Some fields as missing",
                "data" => $data,
                "success" => false
            ));
            die();
        }

        $post->post_title = $data->title;
        $post->post_subtitle = $data->subtitle ?? "";
        $post->post_tags = $data->tags;
        $post->post_excerpt = $data->excerpt ?? "";
        $post->post_content = $data->content;
        $post->post_category_id = $data->category_id;
        $post->post_author_id = $data->author_id;
        $post->post_image = $data->image ?? "";
        
        //create the post
        $stmt = $post->create();
        $num = $stmt->rowCount();

        if( $num > 0){
            //return the insert id
            $post->post_id = $GLOBALS['db']->getInsertId();
            http_response_code( 200);
            echo json_encode( array(
                "error" => null,
                "message" => "Post created successfully",
                "success" => true,
                "post_id" => $post->post_id
            ));
        }
        else{
            //return error
            http_response_code( 500);
            echo json_encode( array(
                "error" => $stmt->errorinfo(),
                "message" => "Unable to create post. Try again later",
                "success" => false
            ));
        }
    }
    else{
        http_response_code( 400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected POST, received " . $_SERVER['REQUEST_METHOD'],
            "success" => true
        ));
    }
?>
