<?php
    class OrderDetail{
        private $db_conn;

        //attributes
        public $detail_id;
        public $detail_order_id;
        public $detail_product_id;
        public $detail_price;
        public $detail_quantity;
        public $detail_processed;
        public $detail_on_offer;
        public $detail_discount;
        public $created_at;
        public $updated_at;

        private $read_query ="SELECT detail_id, detail_product_id as product_id,
            detail_price as price,detail_quantity as quantity, 
            detail_on_offer as on_offer,detail_discount as discount,
            detail_processed as processed,
            product_name, product_short_desc as product_description, product_image
            FROM order_details
            LEFT JOIN products
            ON order_details.detail_product_id = products.product_id";
        
        //save order details
        function create(){
            $query = "INSERT INTO order_details(detail_order_id,
            detail_product_id, detail_price, detail_quantity,
            detail_on_offer, detail_discount)
            VALUES(?, ?,?,?,?,?)";
            $stmt = $GLOBALS["db"]->runQuery($query, [
                $this->detail_order_id,
                $this->detail_product_id, $this->detail_price, $this->detail_quantity,
                $this->detail_on_offer, $this->detail_discount
            ]);
            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        //get Order Details for given order id
        function readByOrderID($order_id){
            $query = $this->read_query . "
            WHERE order_details.detail_order_id = ?";

            $order_id = $GLOBALS["db"]->sanitize($order_id);
            $stmt = $GLOBALS["db"]->runQuery($query, [$order_id]);

            $details = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                extract($row);

                $detail= array(
                    "product_id"=> $product_id,
                    "product_name" => $product_name,
                    "product_description" => $product_description,
                    "price" => $price,
                    "on_offer" => $on_offer,
                    "quantity" => $quantity,
                    "processed" => $processed == 1 ? true : false,
                    "image" => $product_image
                );

                array_push($details,$detail);
                
            }

            return $details;
        }

        //update details
        function update(){
            $query = "UPDATE order_details SET = detail_price, 
            detail_quantity = ?,detail_on_offer = ?,
            detail_discount = ?, detail_processed = ?
            WHERE detail_id = ?";
            
            $stmt = $GLOBALS["db"]->runQuery($query,[
                $this->detail_price,
                $this->detail_quantity, $this->detail_on_offer,
                $this->detail_discount, $this->detail_processed,
                $this->detail_id
            ]);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }

        function updateProductInOrderID($order_id,$product_id){
            $query = "UPDATE order_details SET = detail_price, 
            detail_quantity = ?,detail_on_offer = ?,
            detail_discount = ?, detail_processed = ?
            WHERE detail_order_id = ?
            AND detail_product_id = ?";
            
            $order_id = $GLOBALS["db"]->sanitize($order_id);
            $product_id = $GLOBALS["db"]->sanitize($product_id);

            $stmt = $GLOBALS["db"]->runQuery($query,[
                $this->detail_price,
                $this->detail_quantity, $this->detail_on_offer,
                $this->detail_discount, $this->detail_processed,
                $this->order_id, 
                $this->product_id
            ]);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }

        //delete order details
        function delete(){
            $query = "DELETE FROM order_details
            WHERE detail_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query,[
                $this->detail_id
            ]);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }

        function deleteAll(){
            $query = "DELETE FROM order_details";
            $stmt = $GLOBALS["db"]->runQuery($query,null);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }

        function deleteProductInOrderID($order_id, $product_id){
            $query = "DELETE FROM order_details
            WHERE detail_order_id = ?
            AND detail_product_id = ?";
            
            $order_id = $GLOBALS["db"]->sanitize($order_id);
            $product_id = $GLOBALS["db"]->sanitize($product_id);

            $stmt = $GLOBALS["db"]->runQuery($query,[$order_id,$product_id]);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }

        function deleteAllWithOrderID($order_id){
            $query = "DELETE FROM order_details
            WHERE detail_order_id = ?";
            
            $order_id = $GLOBALS["db"]->sanitize($order_id);;

            $stmt = $GLOBALS["db"]->runQuery($query,[$order_id]);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }

        
    }
?>