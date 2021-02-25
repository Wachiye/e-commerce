<?php
    //headers
    header("Access-Control-Allow-Methods:GET");

    include_once './common.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $stmt = null;
        //read all posts
        if( empty($_GET)){
            $stmt = $post->readAll();
        }
        //read single post
        if( isset( $_GET['id'])){
            $stmt = $post->read( $_GET['id']);
        }
        //read posts by category name
        if( isset( $_GET['category'])){
            $stmt = $post->readByCategory( $_GET['category']);
        }
        //read posts by tag
        if( isset( $_GET['tag'])){
            $stmt = $post->readByTag( $_GET['tag']);
        }

        $num = $stmt->rowCount();
        $categories = $post->getCategories();
        if($num > 0){
            $posts = array();
            
            while($row = $stmt->FETCH( PDO::FETCH_ASSOC)){
                //make $row['name'] to $name
                extract($row);
                //create post data from extracted data
                $data = array(
                    "id" => $id,
                    "title" => $title,
                    "subtitle" => $subtitle,
                    "slug" => $slug,
                    "excerpt" => $excerpt,
                    "content" => $content,
                    "author_id" => $author_id,
                    "image" => $image,
                    "views" => $views,
                    "likes" => $likes,
                    "author_details" => $post->getAuthor($author_id),
                    "comments" => $post->getComments($id)
                );
                array_push( $posts, $data);
            }
            
            http_response_code( 200);
            echo  json_encode( array(
                "error" => null,
                "posts" => $posts,
                "categories" => $categories,
                "success" => true
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