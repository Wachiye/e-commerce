<?php
    //headers
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    //only server POST request
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //get data
        $data = json_decode( file_get_contents( "php://input"));

        $deleted = null;

        if((isset($_GET['id']) && !empty($_GET['id'])) || !empty($data->id)){
            $id = $_GET['id'] ?? $data->id;
            $order->order_id = $order->db->sanitize($id);

            $deleted = $order->delete();
        }
        else{
          $deleted = $order->deleteAll();  
        }
        if($deleted['success'] = true){
            http_response_code( 200);
            echo json_encode( array(
                "error" => null,
                "message" => "{$deleted['count']} orders deleted successfully",
                "success" => true
            ));
        }
        else{
            http_response_code( 500);
            echo json_encode( array(
                "error" => $deleted['error'],
                "message" => "Unable to delete orders",
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