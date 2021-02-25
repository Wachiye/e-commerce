<?php
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';
    
    //only server DELETE requests
    if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        //get data
        $data = json_decode( file_get_contents( "php://input"));

        $deleted = null;
        if(isset($_GET) && !empty($_GET)){
            //get by payment id
           if(!empty($_GET['id']) || !empty($data->id)){
                $id = $_GET['id'] ?? $data->id;
                $payment->payment_id = $id;
                $deleted= $payment->delete();
            }
        }
        else{
            $deleted = $payment->deleteAll();
        }

        if($deleted['success'] = true){
            http_response_code(200);
            echo json_encode( array(
                "error" => null,
                "message" => "{$deleted['count']} Payments deleted successfully",
                "success" => true,
            ));
        }else{
            http_response_code(500);
            echo json_encode( array(
                "error" => $deleted['error'],
                "message" => "Could not delete payments",
                "success" => false,
            )); 
        }
    }
    else{
        http_response_code(400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected DELETE, received " . $_SERVER['REQUEST_METHOD'],
            "success" => false,
        ));
    }
?>