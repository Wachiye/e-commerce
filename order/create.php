<?php
    //headers
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';
    include_once '../auth/verify.php';
    //only server POST request
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents("php://input"));
        //validate data
        if(empty($data->items) || empty($data->amount) ||
            empty($data->user_id) || count($data->order_details) < 0 || 
            empty( $data->type_id) || empty($data->region_id) ||
            empty( $data->shipping_address) || empty( $data->billing_address) ||
            empty( $data->required_date) || empty( $data->sales_tax)){

            http_response_code(400);
            echo json_encode( array(
                "error" => "INCOMPLETE_DATA_ERR",
                "message" => "Could not create order. Some data is missing",
                "data" => $data
            ));
            die();
        }
        //verify that user email was verified
        if(verifyUser($data->user_id)){

            $order->order_user_id = $data->user_id;
            $order->order_items = $data->items;
            $order->order_amount = $data->amount;
            $order->order_region_id = $data->region_id;
            $order->order_type_id = $data->type_id;
            $order->order_shipping_address = $data->shipping_address;
            $order->order_billing_address = $data->billing_address;
            $order->order_sales_tax = $data->sales_tax;
            $order->order_required_date = $data->required_date;
            $order->order_recipient_id = $data->recipient_id ?? "";
            $order->order_recipient_name = $data->recipient_name ?? "";
            $order->order_recipient_phone = $data->recipient_phone ?? "";
            $order->order_recipient_email = $data->recipient_email ?? "";

            //create order
            $order_id = $order->create();
            if($order_id){
                //save order details
                $details = $data->order_details;
                foreach($details as $item){
                    $order_detail->detail_order_id = $order_id;
                    $order_detail->detail_product_id = $item->id;
                    $order_detail->detail_price = $item->price;
                    $order_detail->detail_quantity = $item->quantity;
                    $order_detail->detail_on_offer = $item->on_offer == true ? 1 : 0;
                    $order_detail->detail_discount = $item->discount;

                    if(!$order_detail->create()){
                    echo json_encode(array(
                            "error" => "CREATE_ORDER_ERROR",
                            "message" => "Unable to add items to order"
                        ));
                        die();
                    }
                }
                
                http_response_code(200);
                echo json_encode( array(
                    "success" => true,
                    "error" => null,
                    "message" => "Order received. Please be patient while we process your order. Your order shall be dispatched upon payment."
                ));
                //send email about the order
            }
            else{
                http_response_code(500);
                echo json_encode( array(
                    "error" => "CREATE_ORDER_ERR",
                    "success" => false,
                    "message" => "Sorry but we are unable to create your order at this time. Try again later. "
                ));
            }
        }
        else{
            http_response_code(401);
            echo json_encode( array(
                "error" => "ACCOUNT_ERR",
                "message"=>"User account associated with this order request is not verified. Please check your email for a verification link."
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