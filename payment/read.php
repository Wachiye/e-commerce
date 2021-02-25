<?php
    //headers
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    //only server GET request
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $data = json_decode(file_get_contents("php://input"));
        $stmt = null;
        //get by payment id
        if(!empty($_GET['id']) || !empty($data->id)){
            $id = $_GET['id'] ?? $data->id;
            $stmt = $payment->read($id);
        }
        //get by order id
        elseif(!empty($_GET['order_id']) || !empty($data->order_id)){
            $order_id = $_GET['order_id'] ?? $data->order_id;
            $stmt = $payment->readByOrderID($order_id);
        }
        //get by payment method id
        elseif(!empty($_GET['method_id']) || !empty($data->method_id)){
            $method_id = $_GET['method_id'] ?? $data->method_id;
            $stmt = $payment->readByMethodID($method_id);
        }
        //get all records
        else{
            $stmt = $payment->readAll();
        }

        $num = $stmt->rowCount();

        if($num > 0){
            $payments = array();
            $payments['records'] = array();

            while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){
                //extract rows
                extract($row);
                $pay_data = array(
                    "id" => $payment_id,
                    "method_id" => $method_id,
                    "method_name" => $method_name,
                    "amount" => $amount,
                    "purpose" => $purpose,
                    "transaction_id" => $transaction_id,
                    "checkout_id" => $checkout_id,
                    "user_name" => $user_name,
                    "user_email" => $user_phone,
                    "user_phone" => $user_phone,
                    "created_at" => $created_at
                );
                //push pay data to payments records
                array_push($payments['records'], $pay_data);
            }

            http_response_code(200);
            echo json_encode( array(
                "payments" => $payments,
                "success" => true
            ));
        }
        else{
            http_response_code(500);
            echo json_encode( array(
                "success" => false,
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