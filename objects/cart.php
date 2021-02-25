<?php
    class Cart{
        private $db;

        //attributes
        public $cart_id;
        public $cart_items;
        public $cart_details;
        public $cart_status;
        public $created_on;
        public $updated_on;


        //check if cart exists or create new cart
        function checkCreateCart($cart_id){
            //check cart id
            $query = "SELECT cart_id from cart where cart_id = ?";
            $stmt = $GLOBALS['db']->runQuery($query, $cart_id);
            if($stmt->rowCount() > 0){
                return true;
            }
            //create new cart
            $query = "INSERT INTO cart(cart_items, cart_amount)
            VALUES(?,?)";
            $stmt = $GLOBALS['db']->runQuery($query, 
                [$this->cart_items, $this->cart_amount]
            );
            if($stmt->rowCount() > 0){
                $this->cart_id = $GLOBALS['db']->getInsertId();
                return $this->cart_id;
            }
            else
                return false;
        }


        //get total amount of cart items
        function getTotalAmount($cart_id){
            $query = "SELECT cart.product_id as product_id, quantity,product_unit_price as price,
            product_sale_tax as tax, product_discount as discount
            FROM cart
            LEFT JOIN products
            ON products.product_id = cart.product_id
            WHERE cart.cart_id =?";

            $stmt = $GLOBALS['db']->runQuery($query, [$cart_id]);
            $amount = array(
                "total_price" => 0,
                "total_discount" => 0,
                "total_sales_tax" => 0,
                "amount_payable" => 0
            );
            if($stmt->rowCount() > 0){
                while($row = $stmt->FETCH(PDO::ASSOC)){
                    extract(row);
                    $amount["total_price"] += $price;
                    $amount["total_discount"] += $discount;
                    $amount["total_sales_tax"] += $sales_tax;
                    $amount["amount_payable"] += ($quantity * ( $price - $discount)) + $sales_tax;
                }
            }
            
            return amount;
        }

        //save whole cart for later
        function saveCartForLater($cart_id){
            $query = "UPDATE cart 
            SET status = ?, updated_at = NOW()
            WHERE cart_id = ?";
            $stmt = $GLOBALS['db']->runQuery($query,
                ['saved',$cart_id]
            );
            if( $stmt->rowCount() > 0){
                return true;
            }
            return false;
        }

        //get carts
        function getCarts(){
            $query = "SELECT cart_id as id, cart_items as items,
            cart_amount as amount, cart_status as status,
            created_at, updated_at
            FROM cart";

            $stmt = $GLOBALS['db']->runQuery($query, null);
            return $stmt;
        }


        //remove all products from cart 
        function emptyCart(){
            $query = "DELETE FROM cart_details 
            WHERE cart_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->cart_id]);
            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
                    "success"=> true
                );
            }
            return array(
                "count"=>0,
                "error" => $stmt->errorinfo(),
                "success"=> false
            );
        }
        //delete cart 
        function deleteCart($cart_id){
            $query = "DELETE FROM cart 
            WHERE cart_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->cart_id]);
            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
                    "success"=> true
                );
            }
            return array(
                "count"=>0,
                "error" => $stmt->errorinfo(),
                "success"=> false
            );
        }

        //delete all carts
        function deleteAllCarts(){
            $query = "DELETE FROM cart";

            $stmt = $GLOBALS["db"]->runQuery($query, null);
            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
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