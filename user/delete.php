<?php
    //required headers
    header("Access-Control-Request-Methods:DELETE");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    include_once '../objects/user.php';

    if( $_SERVER['REQUEST_METHOD'] === 'DELETE'){
        //get input data
        $data = json_decode( file_get_contents("php://input"));

        //validate data
        $stmt = null;
        if( empty( $data->id) && empty($_GET['id'])){
            $stmt = $user->deleteAll();
        }
        else{
            $user->user_id = $_GET['id'] ?? $data->id;
            $stmt = $user->delete();
        }
        
        $num = $stmt->rowCount();

        if($num > 0){
            http_response_code( 200);
            echo  json_encode( array(
                "error" => null,
                "message" => "{$num} users deleted successfully",
                "success" => true
            ));
        }
        else{
            http_response_code(500);
            echo  json_encode( array(
                "error" => $stmt->errorinfo(),
                "message" => "Unable to delete users",
                "success" => false
            ));
        }
    }
    else{
        http_response_code(400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected DELETE, received " . $_SERVER['REQUEST_METHOD'],
            "success" => false
        ));
    }
?>