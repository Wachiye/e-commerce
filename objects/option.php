<?php
    class Option{
        private $db_conn;

        //attributes
        public $option_id;
        public $option_name;
        public $created_at;
        public $updated_at;

        
        //create option
        function create(){
            $query = "INSERT INTO options(option_name)
            VALUES(?)";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->option_name]);

            if($stmt->rowCount() > 0){
                $this->option_id = $GLOBALS['db']->getInsertId()();
                return $this->option_id;
            }
            return false;
        }
        //get option by id
        function read($id){
            $query = "SELECT option_id, option_name, created_at
            FROM options
            WHERE option_id = ?";
            //sanitize
            $id = $GLOBALS["db"]->sanitize($id);
            //execute
            $stmt = $GLOBALS["db"]->runQuery($query, [$id]);
            return $stmt;
        }
        //get all options
        function readAll(){
            $query = "SELECT option_id, option_name, created_at
            FROM options";

            $stmt = $GLOBALS["db"]->runQuery($query, null);
            return $stmt;
        }
        //update
        function update(){
            $query = "UPDATE options  SET option_name = ?
            WHERE option_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [
                $this->option_name, $this->option_id]);

            if($stmt->rowCount() > 0){
               return true;
            }
            return false;
        }
        //delete option by id
        function delete(){
            $query = "DELETE FROM options 
            WHERE option_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->option_id]);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        //delete all options
        function deleteAll(){
            $query = "DELETE FROM options";

            $stmt = $GLOBALS["db"]->runQuery($query,null);

            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        
    }
?>