<?php
    //headers
    header("Access-Control-Allow-Methods:PUT");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    //include the common file
    include_once './common.php';

    //server only PUT request
    if($_SERVER['REQUEST_METHOD'] === 'PUT'){
        //GET DATA
        $data = json_decode( file_get_contents( "php://input"));
        //validate data
        if( empty( $data->amount) || empty( $data->purpose) ||
            empty( $data->method_id) || empty( $data->transaction_id) ||
            empty( $data->checkout_id) || empty( $data->user_name) ||
            empty( $data->user_phone) || empty( $data->user_email))
        {
            http_response_code(400);
            echo json_encode( array(
                "error" => "INCOMPLETE_DATA_ERR",
                "message" => "Unable to update payment. Some data is missing",
                "success" => false,
            ));
            die();
        }
        $payment->payment_amount = $data->amount;
        $payment->payment_purpose = $data->purpose;
        $payment->payment_transaction_id = $data->transaction_id;
        $payment->payment_checkout_id = $data->checkout_id;
        $payment->payment_user_name = $data->user_name;
        $payment->payment_user_phone = $data->user_phone;
        $payment->payment_user_email = $data->user_email;
        $payment->payment_method_id = $data->method_id;
        $payment->payment_id = $_GET['id'] ?? $data->id;
        $updated = null;

        if((isset($_GET['id']) && !empty( $_GET['id'])) && !empty( $data->id)){
            //update payment record
            $updated = $payment->update();
        }
        if((isset($_GET['order_id']) && !empty( $_GET['order_id'])) && empty( $data->order_id)){
            //update payment record
            $order_id = $_GET['order_id'] ?? $data->order_id;
            $updated = $payment->updateByOrderID($order_id);
        }

        
        if($updated['success'] = true){
            http_response_code( 200);
            echo json_encode( array(
                "success" => true,
                "error" => null,
                "message" => "{$updated['count']} Payment records updated successfully"
            ));
        }
        else{
            http_response_code( 500);
            echo json_encode( array(
                "success" => false,
                "error" =>$updated['error'] ,
                "message" => "Could not update payment records. Try again later"
            ));
        }
    }
    else{
        http_response_code(400);
        echo json_encode( array(
            "success" => false,
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad Request Method. Expected PUT, received " . $_SERVER['REQUEST_METHOD']
        ));
    }
?>