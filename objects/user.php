<?php
    class User{
        private $db_conn;

        //attributes
        public $user_id;
        public $user_name;
        public $user_email;
        public $user_phone;
        public $user_address;
        public $user_type_id;
        public $user_region_id;
        public $user_password;
        public $user_verification_code;
        public $user_email_verified;
        public $user_billing_address;
        public $user_shipping_address;
        public $created_at;
        public $updated_at;

        //read query
        private $read_query = "SELECT user_id, user_name, user_email, user_phone,
        user_address  as address, user_region_id as region_id, region_name,
        user_email_verified as email_verified, 
        user_type_id as type_id, type_name as type_name,
        user_billing_address as billing_address, 
        user_shipping_address as shipping_address, 
        users.created_at as created_at, users.updated_at as updated_at
        FROM users
        LEFT JOIN regions
        ON users.user_region_id = regions.region_id
        LEFT JOIN user_types
        ON users.user_type_id = user_types.type_id";

        

        //create user
        function create(){
            $query = "INSERT INTO users(user_name, user_email, user_phone,
            user_address, user_region_id, user_password, user_type_id,
            user_shipping_address, user_billing_address, user_verification_code)
            VALUES(?, ?, ?, ?, ?, md5(?), ?, ?, ?, ?)";

            //generate a code for email verification
            $string_range = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $this->user_verification_code = substr(str_shuffle($string_range),16);

            //save user
            $stmt = $GLOBALS["db"]->runQuery($query, 
            [$this->user_name, $this->user_email, $this->user_phone, $this->user_address,
            $this->user_region_id, $this->user_password, $this->user_type_id,
            $this->user_shipping_address, $this->user_billing_address, $this->user_verification_code]);

            return $stmt;
        }
        //get user by id
        function read($id){
            $query = $this->read_query ." WHERE user_id = ?
            ORDER BY users.created_at DESC";
            //sanitize
            $id = $GLOBALS["db"]->sanitize($id);
            //execute
            $stmt = $GLOBALS["db"]->runQuery($query, [$id]);
            return $stmt;
        }
        //get all users
        function readAll(){
            $query = $this->read_query ."
            ORDER BY users.created_at DESC";
            $stmt = $GLOBALS["db"]->runQuery($query, null);
            return $stmt;
        }
        //read by type
        function readByTypeName($type_name){
            $query = $this->read_query ."
            WHERE type_name = ?
            ORDER BY users.created_at DESC";
            $type_name = $GLOBALS["db"]->sanitize($type_name);

            $stmt = $GLOBALS["db"]->runQuery($query, [$type_name]);
            return $stmt;
        }
        //read created today
        function readToday(){
            $query = $this->read_query ."
            WHERE DATEDIFF(NOW(),users.created_at) < 2
            ORDER BY users.created_at DESC";

            $stmt = $GLOBALS["db"]->runQuery($query, NULL);
            return $stmt;
        }
        //search
        function search($keywords){
            $query = $this->read_query ." 
            WHERE 
            MATCH(user_name, user_email,user_phone,
            user_billing_address,user_shipping_address) 
            AGAINST(? IN BOOLEAN MODE) OR
            MATCH(region_name) 
            AGAINST(?  IN BOOLEAN MODE)
            ORDER BY 
            MATCH(user_name, user_email,user_phone,
            user_shipping_address,user_billing_address) 
            AGAINST(? IN BOOLEAN MODE) > 0 DESC,
            users.created_at DESC";
            
            $keywords = $GLOBALS["db"]->sanitize($keywords);
            
            
            $results = $GLOBALS["db"]->runQuery($query,[
                $keywords, $keywords, $keywords 
            ] );
            return $results;
        }
        //update
        function update(){
            $query = "UPDATE users SET user_name = ?,
            user_address = ?, user_region_id = ?, user_type_id = ?,
            user_billing_address = ?, 
            user_shipping_address = ?, updated_at = NOW()
            WHERE user_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [
                $this->user_name,
                $this->user_address,
                $this->user_region_id,
                $this->user_type_id,
                $this->user_billing_address,
                $this->user_shipping_address,
                $this->user_id
                ]);

            return $stmt;
        }
        //delete user by id
        function delete(){
            $query = "DELETE FROM users 
            WHERE user_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->user_id]);
            return $stmt;
        }
        //delete all users
        function deleteAll(){
            $query = "DELETE FROM users";

            $stmt = $GLOBALS["db"]->runQuery($query,null);
            return $stmt;
        }
        
    }
?>