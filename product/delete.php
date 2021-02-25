<?php
    //common headers and objects
    include_once './common.php';
    //other required headers
    header('Access-Control-Allow-Methods:DELETE');
    header('Access-Control-Max-Age:3600');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With');

    //only serve DELETE requests
    if( $_SERVER['REQUEST_METHOD'] === 'DELETE'){
        //get the product id
        $data = json_decode(file_get_contents("php://input"));
        
        //set the product id to be deleted
        $product->product_id = $data->id;
        //delete the product
        $stmt = $product->delete();
        $num = $stmt->rowCount();

        if($num > 0){
            http_response_code( 200);
            echo json_encode( array(
                "error" => null,
                "success" => true,
                "message" => "Product deleted successfully"
            ));
        }
        else{
            http_response_code( 500);
            echo json_encode( array(
                "error" => $stmt->errorinfo(),
                "message" => "Unable to delete product with id = " . $product->product_id,
                "success" => false
            ));
        }
    }
    else{
        http_response_code( 500);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected DELETE, received " . $_SERVER['REQUEST_METHOD'],
            "success" => false
        ));
    }
?>