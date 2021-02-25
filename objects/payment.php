<?php
    class Payment{

        private $db_conn;

        //attributes
        public $payment_id;
        public $payment_amount;
        public $payment_purpose;
        public $payment_method_id;
        public $payment_method_name;
        public $payment_transaction_id;
        public $payment_checkout_code;
        public $payment_user_name;
        public $payment_user_phone;
        public $payment_user_email;

        private $read_query = "SELECT payment_id,
        payment_amount as amount, payment_purpose as purpose,
        payment_transaction_id as transaction_id,
        payment_checkout_id as checkout_id,
        payment_user_name as user_name,
        payment_user_phone as user_phone,
        payment_user_email as user_email,
        payment_method_id as method_id,
        payments.created_at as created_at, payments.updated_at as updated_at,
        method_name
        FROM payments
        LEFT JOIN payment_methods
        ON payments.payment_method_id = payment_methods.method_id";

        
        //create payment
        function create(){
            $query = "INSERT INTO payments(payment_amount,
            payment_purpose, payment_method_id, payment_transaction_id,
            payment_checkout_id, payment_user_name,
            payment_user_phone, payment_user_email)
            VALUES(?,?,?,?,?,?,?,?)";

            $stmt = $GLOBALS["db"]->runQuery($query,[
                $this->payment_amount,
                $this->payment_purpose,
                $this->payment_method_id,
                $this->payment_transaction_id,
                $this->payment_checkout_id,
                $this->payment_user_name,
                $this->payment_user_phone,
                $this->payment_user_email
            ]);

            if($stmt->rowCount() > 0){
                $this->payment_id = $GLOBALS['db']->getInsertId();
                return $this->payment_id;
            }
            return false;
        }

        //read by id
        function read($payment_id){
            $query = $this->read_query . " WHERE payment_id = ?
            ORDER BY payments.created_at DESC";
            $payment_id = $GLOBALS["db"]->sanitize($payment_id);
            $stmt = $GLOBALS["db"]->runQuery($query, [$payment_id]);
            return $stmt;
        }
        //read all payment records
        function readAll(){
            $query = $this->read_query . " ORDER BY payments.created_at DESC";
            $stmt = $GLOBALS["db"]->runQuery($query, null);
            return $stmt;
        }
        //read by order id
        function readByOrderID($order_id){
            $query = $this->read_query . "
            WHERE payment_purpose = ?";
            $order_id = $GLOBALS["db"]->sanitize($order_id);
            $stmt = $GLOBALS["db"]->runQuery($query, ['ORDER#' . $order_id]);
            return $stmt;
        }
        //read by order id
        function readByMethodID($method_id){
            $query = $this->read_query . "
            WHERE payment_method_id = ?";
            $method_id = $GLOBALS["db"]->sanitize($method_id);
            $stmt = $GLOBALS["db"]->runQuery($query, [$method_id]);
            return $stmt;
        }

        //update 
        function update(){
            $query = "UPDATE payments SET payment_amount = ?,
            payment_purpose = ?, payment_method_id = ?, 
            payment_transaction_id = ?,
            payment_checkout_id = ?, payment_user_name = ?,
            payment_user_phone = ?, payment_user_email = ?,
            updated_at = NOW()
            WHERE payment_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query,[
                $this->payment_amount,
                $this->payment_purpose,
                $this->payment_method_id,
                $this->payment_transaction_id,
                $this->payment_checkout_id,
                $this->payment_user_name,
                $this->payment_user_phone,
                $this->payment_user_email,
                $this->payment_id
            ]);

            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
                    "error" => null,
                    "success"=> true
                );
            }
            return array(
                "count"=>0,
                "error" => $stmt->errorinfo(),
                "success"=> false
            );
        }
        function updateByOrderID($order_id){
            $query = "UPDATE payments SET payment_amount = ?,
            payment_method_id = ?, payment_transaction_id = ?,
            payment_checkout_id = ?, payment_user_name = ?,
            payment_user_phone = ?, payment_user_email = ?, updated_at = NOW()
            WHERE payment_purpose = ?";

            $stmt = $GLOBALS["db"]->runQuery($query,[
                $this->payment_amount,
                $this->payment_method_id,
                $this->payment_transaction_id,
                $this->payment_checkout_id,
                $this->payment_user_name,
                $this->payment_user_phone,
                $this->payment_user_email,
                'ORDER#'.$this->payment_purpose
            ]);

            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
                    "error" => null,
                    "success"=> true
                );
            }
            return array(
                "count"=>0,
                "error" => $stmt->errorinfo(),
                "success"=> false
            );
        }

        //DELETE
        function delete(){
            $query = "DELETE FROM payments
            WHERE payment_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query,[$this->payment_id]);
            
            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
                    "error" => null,
                    "success"=> true
                );
            }
            return array(
                "count"=>0,
                "error" => $stmt->errorinfo(),
                "success"=> false
            );
        }
        //DELETE
        function deleteByOrderID($order_id){
            $query = "DELETE FROM payments
            WHERE payment_id = ?";

            $order_id = $GLOBALS["db"]->sanitize($order_id);
            $stmt = $GLOBALS["db"]->runQuery($query,[$order_id]);
            
            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
                    "error" => null,
                    "success"=> true
                );
            }
            return array(
                "count"=>0,
                "error" => $stmt->errorinfo(),
                "success"=> false
            );
        }
        //delete all
        //DELETE
        function deleteAll(){
            $query = "DELETE FROM payments";

            $stmt = $GLOBALS["db"]->runQuery($query,null);
            
            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
                    "error" => null,
                    "success"=> true
                );
            }
            return array(
                "count"=>0,
                "error" => $stmt->errorinfo(),
                "success"=> false
            );
        }
    }
?>