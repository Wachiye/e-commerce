<?php
    class Order{

        private $db_conn;

        //attributes
        public $order_id;
        public $user_id;
        public $user_details;
        public $order_items;
        public $order_details;
        public $order_amount;
        public $order_sales_tax;
        public $order_type_id;
        public $order_type_name;
        public $order_region_id;
        public $order_region_name;
        public $order_status;
        public $order_recipient_name;
        public $order_recipient_id;
        public $order_recipient_phone;
        public $order_recipient_email;
        public $order_billing_address;
        public $order_shipping_address;
        public $order_shipper_id;
        public $order_shipper_details;
        public $order_required_date;
        public $order_shipping_date;
        public $order_delivery_date;
        public $order_paid;
        public $order_payment_id;
        public $order_payment_details;
        public $created_at;
        public $updated_at;

        //read order query
        private $read_query = "SELECT orders.order_id as order_id,
        order_user_id as user_id,order_items as items,
        order_amount as amount,order_status as status,
        order_recipient_id as recipient_id,order_recipient_name as recipient_name,
        order_recipient_phone as recipient_phone,
        order_recipient_email as recipient_email, order_billing_address as billing_address, 
        order_shipping_address as shipping_address,
        order_sales_tax as sales_tax, order_paid as paid, 
        order_required_date as required_date, order_shipping_date as shipping_date, 
        order_delivery_date as delivery_date,
        orders.created_at as created_at, orders.updated_at as updated_at,
        order_payment_id as payment_id, order_shipper_id as shipper_id,
        order_region_id as region_id,region_name,order_type_id as type_id,type_name
        FROM orders
        LEFT JOIN regions
        ON orders.order_region_id = regions.region_id
        LEFT JOIN order_types
        ON orders.order_type_id = order_types.type_name";

        
        //create a new order
        function create(){
            $query = "INSERT INTO orders(order_user_id,order_items,
            order_amount,order_status,order_type_id,order_region_id,
            order_recipient_id,order_recipient_name,order_recipient_phone,
            order_recipient_email, order_billing_address, order_shipping_address,
            order_sales_tax, order_paid, order_payment_id, order_shipper_id,
            order_required_date, order_shipping_date, order_delivery_date)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            //execute query
            $stmt = $GLOBALS["db"]->runQuery($query, [
                $this->order_user_id, $this->order_items,
                $this->order_amount, $this->order_status, $this->order_type_id, $this->order_region_id,
                $this->order_recipient_id, $this->order_recipient_name, $this->order_recipient_phone,
                $this->order_recipient_email, $this->order_billing_address, $this->order_shipping_address,
                $this->order_sales_tax, $this->order_paid, $this->order_payment_id, $this->order_shipper_id,
                $this->order_required_date, $this->order_shipping_date, $this->order_delivery_date
            ]);
            
            if($stmt->rowCount() > 0){
                $this->order_id = $GLOBALS['db']->getInsertId();
                return $this->order_id;
            }else{
                return false;
            }
        }

        
        //read single order
        function read($id){
            $query = $this->read_query . " 
            WHERE orders.order_id = ?";
            $id = $GLOBALS["db"]->sanitize($id);
            $stmt = $GLOBALS["db"]->runQuery($query, [$id]);
            return $stmt;
        }

        //read all orders
        function readAll(){
            $query = $this->read_query . " 
            ORDER BY orders.created_at DESC";
            $stmt = $GLOBALS["db"]->runQuery($query, null);
            return $stmt;
        }

        //orders of given user_id
        function readByUserID($user_id){
            $query = $this->read_query . " 
            WHERE orders.order_user_id = ?
            ORDER BY orders.created_at DESC";
            $user_id = $GLOBALS["db"]->sanitize($user_id);
            $stmt = $GLOBALS["db"]->runQuery($query, [$user_id]);
            return $stmt;
        }

        //read by region id
        function readByRegion($region_id){
            $query = $this->read_query . " 
            WHERE orders.order_region_id = ?
            ORDER BY orders.created_at DESC";
            $region_id = $GLOBALS["db"]->sanitize($region_id);
            $stmt = $GLOBALS["db"]->runQuery($query, [$region_id]);
            return $stmt;
        }
        //read by status
        function readByStatus($status){
            $query = $this->read_query . " 
            WHERE orders.order_status = ?
            ORDER  BY orders.created_at DESC";
            $status = $GLOBALS["db"]->sanitize($status);
            $stmt = $GLOBALS["db"]->runQuery($query, [$status]);
            return $stmt;
        }
        //update 
        function update(){
           $query = "UPDATE orders SET order_user_id =?,order_items=?,
           order_amount=?,order_status=?,order_type_id=?,order_region_id=?,
           order_recipient_id=?,order_recipient_name=?,order_recipient_phone=?,
           order_recipient_email=?, order_billing_address=?, order_shipping_address=?
           order_sales_tax=?, order_paid=?, order_payment_id=?, order_shipper_id=?,
           order_required_date=?, order_shipping_date=?, order_delivery_date=?
           updated_at = NOW()
           WHERE order_id =?";
           
           $stmt = $GLOBALS["db"]->runQuery($query, [
            $this->order_user_id, $this->order_items,
            $this->order_amount, $this->order_status, $this->order_type_id, $this->order_region_id,
            $this->order_recipient_id, $this->order_recipient_name, $this->order_recipient_phone,
            $this->order_recipient_email, $this->order_billing_address, $this->order_shipping_address,
            $this->order_sales_tax, $this->order_paid, $this->order_payment_id, $this->order_shipper_id,
            $this->order_required_date, $this->order_shipping_date, $this->order_delivery_date,
            $this->order_id
           ]);

           $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count" =>$num,
                    "success" =>true
                );
            }
            return array(
                "count"=>$num,
                "error"=>$stmt->errorinfo(),
                "success"=> false
            );
        }
        //mark as paid
        function markAsPaid($order_id, $payment_id){
            $query = "UPDATE orders SET order_paid = 1,
            order_payment_id = ?
            WHERE order_id = ?";
            $stmt = $GLOBALS['db']->runQuery($query, [
                $payment_id, $order_id
            ]);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        //delete order with given id
        function delete(){
          $query = "DELETE FROM orders
          WHERE order_id = ?";

          $stmt = $GLOBALS["db"]->runQuery($query, [$this->order_id]);
          
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
        //delete all orders
        function deleteAll(){
            $query = "DELETE FROM orders";
            $stmt = $GLOBALS["db"]->runQuery($query, null);
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