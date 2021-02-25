<?php
    //headers
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    //only server POST request
    if($_SERVER['REQUEST_METHOD'] === 'PUT'){
        $data = json_decode(file_get_contents("php://input"));
        //validate data
        if(empty($data->items) || empty($data->amount) ||
            empty($data->user_id) || empty($data->order_details) || 
            empty( $data->type_id) || empty($data->region_id) ||
            empty( $data->shipping_address) || empty( $data->billing_address) ||
            empty( $data->expected_date) || empty( $sales_tax)){

            http_response_code(400);
            echo json_encode( array(
                "error" => "INCOMPLETE_DATA_ERR",
                "message" => "Could not create order. Some data is missing"
            ));
            die();
        }

        $order->order_user_id = $data->user_id;
        $order->order_items = $data->order_items;
        $order->order_region_id = $data->user_id;
        $order->order_type_id = $data->user_id;
        $order->order_shipping_address = $data->user_id;
        $order->order_billing_address = $data->user_id;
        $order->order_sales_tax = $data->user_id;
        $order->order_expected_date = $data->user_id;
        $order->order_recipient_id = $data->recipient_id ?? "";
        $order->order_recipient_name = $data->recipient_name ?? "";
        $order->order_recipient_phone = $data->recipient_phone ?? "";
        $order->order_recipient_email = $data->recipient_email ?? "";
        $order->order_payment_id = $data->payment_id ?? "";
        $order->order_shipper_id = $data->shipper_id ?? "";
        $order->order_shipping_date = $data->shipping_date ?? "";
        $order->order_delivery_date = $data->delivery_date ?? "";
        
        //update order
        $updated = $order->update();
        if( $updated['success'] = true){   
            http_response_code(200);
            echo json_encode( array(
                "error" => null,
                "message" => "Order updated successfully ",
                "success" => true
            ));
        }
        else{
            http_response_code(500);
            echo json_encode( array(
                "error" => "UPDATE_ORDER_ERR",
                "message" => "Sorry but we are unable to update your order at this time. Try again later. "
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