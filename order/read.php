<?php
    //headers
    header("Access-Allow-Allow-Method:GET");
    
    include_once './common.php';

    $stmt = null;

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(empty($_GET)){
            $stmt = $order->readAll();
        }
        if(isset($_GET['id'])){
            $stmt = $order->read($_GET['id']);
        }
        if(isset($_GET['status'])){
            $stmt = $order->readByStatus($_GET['status']);
        }
        if(isset($_GET['region_id'])){
            $stmt = $order->readByRegion($_GET['region_id']);
        }
        if(isset($_GET['user_id'])){
            $stmt = $order->readByUserID($_GET['user_id']);
        }

        $num = $stmt->rowCount();

        if($num > 0){
            $orders = array();
            $orders['records'] = array();

            while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){
                //extract the order row
                extract($row);

                $data = array(
                    "id" => $order_id,
                    "items" => $items,
                    "order_detail" => $order_detail->readByOrderID($order_id),
                    "amount" => $amount,
                    "sales_tax" => $sales_tax,
                    "status" => $status,
                    "region_id" => $region_id,
                    "region_name" => $region_name,
                    "shipping_address" => $shipping_address,
                    "billing_address" => $billing_address,
                    "required_date" => $required_date,
                    "shipping_date" => $shipping_date,
                    "delivery_date" => $delivery_date,
                    "type_id" => $type_id,
                    "type_name" => $type_name,
                    "paid" => $paid == 1 ? true : false,
                    "payment_id" => $payment_id,
                    "payment_details" => $payment_id != null ? $payment->readByOrderID($order_id) : null,
                    "user_id" => $user_id,
                    "shipper_id" => $shipper_id,
                    "recipient_id" => $recipient_id,
                    "recipient_name" => $recipient_name,
                    "recipient_phone" => $recipient_phone,
                    "recipient_email" => $recipient_email,
                    "created_at" => $created_at
                );

                array_push($orders['records'], $data);
            }

            http_response_code(200);
            echo json_encode( $orders);
        }else{
            http_response_code(500);
            echo json_encode( array(
                "message" => "No records found"
            ));
        }
    }
    else{
        http_response_code(400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected GET, received " . $_SERVER['REQUEST_METHOD']
        ));
    }
    
?>