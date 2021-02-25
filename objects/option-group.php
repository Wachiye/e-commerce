<?php
    class Option_Group{
        private $db_conn;

        //attributes
        public $option_group_id;
        public $option_group_name;
        public $created_at;
        public $updated_at;


        //create option_group
        function create(){
            $query = "INSERT INTO option_groups(option_group_name)
            VALUES(?)";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->option_group_name]);

            if($stmt->rowCount() > 0){
                $this->option_group_id = $GLOBALS['db']->getInsertId()();
                return $this->option_group_id;
            }
            return false;
        }
        //get option_group by id
        function read($id){
            $query = "SELECT option_group_id, option_group_name, created_at
            FROM option_groups
            WHERE option_group_id = ?";
            //sanitize
            $id = $GLOBALS["db"]->sanitize($id);
            //execute
            $stmt = $GLOBALS["db"]->runQuery($query, [$id]);
            return $stmt;
        }
        //get all option_groups
        function readAll(){
            $query = "SELECT option_group_id, option_group_name, created_at
            FROM option_groups";

            $stmt = $GLOBALS["db"]->runQuery($query, null);
            return $stmt;
        }
        //update
        function update(){
            $query = "UPDATE option_groups  SET option_group_name = ?
            WHERE option_group_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [
                $this->option_group_name, $this->option_group_id]);

            if($stmt->rowCount() > 0){
               return true;
            }
            return false;
        }
        //delete option_group by id
        function delete(){
            $query = "DELETE FROM option_groups 
            WHERE option_group_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->option_group_id]);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        //delete all option_groups
        function deleteAll(){
            $query = "DELETE FROM option_groups";

            $stmt = $GLOBALS["db"]->runQuery($query,null);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        
    }
?>