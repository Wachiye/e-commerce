<?php
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';
    
    //only server post requests
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //get data
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
                "message" => "Unable to create payment. Some data is missing",
                "success" => false,
            ));
            die();
        }
        else{
            //fill payment object
            $payment->payment_amount = $data->amount;
            $payment->payment_purpose = $data->purpose;
            $payment->payment_transaction_id = $data->transaction_id;
            $payment->payment_checkout_id = $data->checkout_id;
            $payment->payment_user_name = $data->user_name;
            $payment->payment_user_phone = $data->user_phone;
            $payment->payment_user_email = $data->user_email;
            $payment->payment_method_id = $data->method_id;
            //save payment record
            $payment_id = $payment->create();
            if( $payment_id){
                //check if the payment is for order
                if( str_contains( $data->purpose, "ORDER#")){
                    $order_id = explode("#",$data->purpose)[1];
                    //mark order as paid
                    $paid = $order->markAsPaid($order_id, $payment_id);
                    if($paid){
                       http_response_code(200);
                       echo json_encode( array(
                           "success" => true,
                           "message" => "Payment for ORDER#{$order_id} recorded successfully"
                       )); 
                    }
                    else{
                        http_response_code(200);
                        echo json_encode( array(
                            "success" => true,
                            "error" => "ORDER_PAYMENT_UPDATE_ERR",
                            "message" => "Payment for ORDER#{$order_id} recorded successfully but could not update the order."
                        ));
                    }
                }
                else {
                    http_response_code(200);
                    echo json_encode( array(
                        "success" =>true,
                        "error" => null,
                        "payment_id" => $payment_id,
                        "message" => "Payment recorded successfully"
                    ));
                }      
            }
            else{
                http_response_code(500);
                echo json_encode( array(
                    "error" => "CREATE_PAYMENT_ERR",
                    "message" => "Could not create payment at this time. Please try again later",
                    "success" => false,
                ));
            }
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