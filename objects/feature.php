<?php
    class Feature {
        private $db_conn;

        public $feature_id;
        public $product_id;
        public $group_id;
        public $group_name;
        public $option_id;
        public $option_name;

        public $insert_query = 
            "INSERT INTO features( product_id, option_group_id, option_id)
            VALUES(?, ?, ?)";

        
       
        //create a new feature
        function create(){
            $stmt = $GLOBALS["db"]->runQuery($this->insert_query,[
                $this->product_id, $this->option_group_id, $this->option_id
            ]);
            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        //get on feature by id
        function readOne($id){
            $query = "SELECT feature_id, product_id, product_name, 
            features.option_group_id as group_id, option_group_name as group_name,
             features.option_id as option_id , features.created_at as created_at, features.updated_at as updated_at
            FROM features
            LEFT JOIN option_groups
            ON features.option_group_id = option_groups.option_group_id
            LEFT JOIN options
            ON features.option_id = options.option_id
            WHERE feature_id = ?";
            //sanitize
            $id = $GLOBALS["db"]->sanitize($id);
            //execute query
            $stmt = $GLOBALS["db"]->runQuery($query, [$id]);
            return $stmt;
        }
        //get all features
        function readAll(){
            $query = "SELECT feature_id, product_id, product_name, 
            features.option_group_id as group_id, option_group_name as group_name,
             features.option_id as option_id , features.created_at as created_at, features.updated_at as updated_at
            FROM features
            LEFT JOIN option_groups
            ON features.option_group_id = option_groups.option_group_id
            LEFT JOIN options
            ON features.option_id = options.option_id";
            $stmt = $GLOBALS["db"]->runQuery($query, null);
            return $stmt;
        }
        //update feature
        function update($id, $product_id, $group_id, $option_id){
            $query = "UPDATE features SET option_group_id = ? ,
            option_id = ?
            WHERE product_id = ? AND feature_id = ?";
            //sanitize
            $id = $GLOBALS["db"]->sanitize($id);
            $product_id = $GLOBALS["db"]->sanitize($product_id);
            $group_id = $GLOBALS["db"]->sanitize($group_id);
            $option_id = $GLOBALS["db"]->sanitize($option_id);

            $stmt = $GLOBALS["db"]->runQuery($query, [
                $group_id, $option_id, $product_id, $id
            ]);
            
            if($stmt->rowCount() > 0){
                return true;
            }
            
            return false;
        }
        //Delete one
        function delete($id){
            $query = "DELETE FROM features
            WHERE feature_id = ?";
            $id = $GLOBALS["db"]->sanitize($id);
             //execute query
             $stmt = $GLOBALS["db"]->runQuery($query, [$id]);
             if($stmt->rowCount() > 0){
                 return true;
             }
             return false;
        }
        //Delete all
        function deleteAll(){
            $query = "DELETE FROM features";
            $stmt = $GLOBALS["db"]->runQuery($query, null);
            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        
    }
?>