<?php
    class Database{
        //database credentials
        private $_db_host = 'localhost';
        private $_db_user = 'root';
        private $_db_pass = '4sirah@123';
        private $_db_name = 'onlineshop';
        
        //connection object
        public $conn;

        //constructor
        function __construct(){
            $this->conn = $this->connect() ;
        }
        //get database connection
        function connect(){
            $this->conn = null;
            try{
                $options = [
                    PDO::ATTR_EMULATE_PREPARES => false, //turn off emulation mode for 'real' prepared statement
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //make the default fetch to be an associative array
                ];

                $this->conn = new PDO("mysql:host=".$this->_db_host .
                ";dbname=".$this->_db_name , $this->_db_user, $this->_db_pass, $options);
                $this->conn->exec("set names utf8");
            }
            catch(PDOException $exception){
                echo "Connection Error." .$exception->getMessage();
            }
            return $this->conn;
        }

        function sanitize($input){
           $input = htmlspecialchars( strip_tags($input));
           return $input;
        }
        //function to run query
        function runQuery($query,$data){
            $stmt = $this->conn->prepare($query);
            if(!empty($data))
                $stmt->execute($data);
            else
                $stmt->execute();
            return $stmt;
        }

        function getInsertId(){
            return $this->conn->lastInsertId();
        }
    }
?>