<?
    class PaymentMethod{
        private $db_conn;

        //attributes
        public $method_id;
        public $method_name;
        public $method_ac_no;
        public $method_ac_name;
        public $method_desc;
        public $method_image;
        public $method_is_active;
        public $create_at;
        public $updated_at;


        
        //create payment method
        function create(){
            $query = "INSERT INTO payment_methods(method_name,
            method_desc, method_ac_no, method_ac_name,
            method_image, method_is_active)
            VALUES(?,?,?,?,?,?)";

            $stmt = $GLOBALS["db"]->runQuery( $query, [
                $this->method_name,
                $this->method_desc,
                $this->method_ac_no,
                $this->method_ac_name,
                $this->method_image,
                $this->method_is_active
            ]);

            if( $stmt->rowCount() > 0){
                $this->method_id = $GLOBALS['db']->getInsertId();
                return $this->method_id;
            }
            return false;
        }

        //read a single method given id
        function read($method_id){
            $query = "SELECT method_id, 
            method_name, method_desc, method_ac_no as ac_no, 
            method_ac_name as ac_name,method_image, 
            method_is_active as active, created_at, updated_at
            FROM payment_methods
            WHERE method_id = ?
            ORDER BY created_at DESC";

            $method_id = $GLOBALS["db"]->sanitize($method_id);
            $stmt = $GLOBALS["db"]->runQuery($query, [$method_id]);

            return $stmt;
        }

        //read all methods
        function readAll(){
            $query = "SELECT method_id, 
            method_name, method_desc, method_ac_no as ac_no, 
            method_ac_name as ac_name,
            method_image, method_is_active as active, created_at, updated_at
            FROM payment_methods
            ORDER BY created_at DESC";

            $method_id = $GLOBALS["db"]->sanitize($method_id);
            $stmt = $GLOBALS["db"]->runQuery($query, null);

            return $stmt;
        }

        //update
        function update(){
            $query = "UPDATE payment_methods SET method_name = ?,
            method_desc = ? , method_ac_no = ?, method_ac_name = ?,
            method_image = ? , method_is_active = ?,updated_at = NOW()
            WHERE method_id = ?";

            $stmt = $GLOBALS["db"]->runQuery( $query, [
                $this->method_name,
                $this->method_desc,
                $this->method_ac_no,
                $this->method_ac_name,
                $this->method_image,
                $this->method_is_active,
                $this->method_id
            ]);

            if( $stmt->rowCount() > 0){
                return true;
            }
            return false;
        }
        //delete method
        function delete(){
            $query = "DELETE FROM payment_methods
            WHERE method_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->method_id]);

            return $stmt;
        }
        //delete method
        function deleteAll(){
            $query = "DELETE FROM payment_methods";

            $stmt = $GLOBALS["db"]->runQuery($query, null);

            return $stmt;
        }
    }
?>