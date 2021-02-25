<?php
    class CartDetails{
        private $db;

        //attributes
        public $detail_id;
        public $cart_id;
        public $product_id;
        public $initial_quantity;
        public $purchased_quantity;
        public $removed_quantity;
        public $buy_now;
        public $added_on;

        //add product detail
        function addProduct(){
            $query = "INSERT INTO cart_details(cart_id, product_id,
            initial_quantity,initial_price,initial_discount, quantity, features)
            ";
            $stmt = $GLOBALS['db']->runQuery( $query, [
                $this->cart_id, $this->product_id, $this->initial_quantity,
                $this->initial_price, $this->initial_discount, $this->quantity,
                $this->features
            ]);
            
            return $stmt;
        }


        //update product quantity
        function updateQuantity($cart_id,$product_id,$quantity){
            $query = "UPDATE cart_details SET quantity = ?
            WHERE cart_id =? AND product_id =?";
            //sanitize products
            $cart_id = $GLOBALS['db']->sanitize($cart_id);
            $product_id = $GLOBALS['db']->sanitize($product_id);
            $quantity = $GLOBALS['db']->sanitize($quantity);

            $stmt = $GLOBALS['db']->runQuery( $quantity, [
                $quantity, $cart_id, $product_id
            ]);

            $num = $stmt->rowCount();
            
            if(num > 0){
                return ( array(
                    "error" => null,
                    "success" => true,
                    "count" => $num
                ));
            }
            return ( array(
                "error" => $stmt->errorinfo(),
                "success" => false,
                "count" => 0
            ));
        }
        //get all products
        function getAllDetails($cart_id){
            $query = "SELECT item_id, cart_id, 
            cart_details.product_id as product_id,
            initial_price, quantity, initial_discount,
            features, saved, ordered,added_on,
            product_name as name, product_slug as slug, 
            product_display_image as display_image,
            product_price as price, product_discount as discount, product_short_desc as short_description,
            product_cart_desc as cart_description
            FROM cart_details
            LEFT JOIN products
            ON cart_details.product_id = products.product_id
            WHERE cart_id = ?
            ORDER BY added_on ASC";
            
            //sanitize
            $cart_id = $GLOBALS['db']->sanitize($cart_id);
            $stmt = $GLOBALS['db']->runQuery( $query, [ $cart_id]);
            return $stmt;
        }

        //save product for later
        function saveProductForLater($cart_id,$product_id){
            $query = "UPDATE cart_details
            SET saved = 1
            WHERE cart_id =? and product_id=?";
            $cart_id = $GLOBALS['db']->sanitize($cart_id);
            $product_id = $GLOBALS['db']->sanitize($product_id);
            $stmt = $GLOBALS['db']->runQuery( $query, [ $cart_id, $product_id]);
            return $stmt;
        }
        //remove item
        function removeProduct($cart_id, $product_id){
            $query = "DELETE FROM cart_details
            WHERE cart_id =? and product_id=?";
            $cart_id = $GLOBALS['db']->sanitize($cart_id);
            $product_id = $GLOBALS['db']->sanitize($product_id);
            $stmt = $GLOBALS['db']->runQuery( $query, [ $cart_id, $product_id]);
            
            $num = $stmt->rowCount();
            
            if(num > 0){
                return ( array(
                    "error" => null,
                    "success" => true,
                    "count" => $num
                ));
            }
            return ( array(
                "error" => $stmt->errorinfo(),
                "success" => false,
                "count" => 0
            ));
            
        }
    }
?>