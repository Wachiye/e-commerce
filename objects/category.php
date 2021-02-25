<?php
    class Category{
        private $db_conn;

        //attributes
        public $category_id;
        public $category_name;
        public $category_desc;
        public $category_default_tags;
        public $category_image;
        public $category_active;
        public $category_type;
        public $created_at;
        public $updated_at;

        //create category
        function create(){
            $query = "INSERT INTO categories(category_name,
            category_desc, category_default_tags, category_image,
            category_active, category_type)
            VALUES(?, ?, ?, ?, ?, ?)";

            $stmt = $GLOBALS["db"]->runQuery($query, [
                $this->category_name,
                $this->category_desc,
                $this->category_default_tags,
                $this->category_image,
                $this->category_active,
                $this->category_type
            ]);
            
            return $stmt;
        }
        //get category by id
        function read($id){
            $query = "SELECT category_id, 
            category_name, category_default_tags as default_tags,
            category_desc, category_active as active, category_type as type,
            category_image as image, categories.created_at as created_at, 
            categories.updated_at as updated_at,
            COUNT(product_id) as products
            FROM categories
            LEFT JOIN products
            ON categories.category_id = products.product_category_id
            WHERE category_id = ?
            GROUP BY category_id";
            //sanitize
            $id = $GLOBALS["db"]->sanitize($id);
            //execute
            $stmt = $GLOBALS["db"]->runQuery($query, [$id]);
            return $stmt;
        }
        //get all categories
        function readAll(){
            $query = "SELECT category_id, category_name,
            category_default_tags as default_tags,
            category_desc, category_active as active, category_type as type,
            category_image as image, 
            categories.created_at as created_at,
            categories.updated_at as updated_at,
            COUNT(product_id) as products
            FROM categories
            LEFT JOIN products
            ON categories.category_id = products.product_category_id
            GROUP BY category_id";

            $stmt = $GLOBALS["db"]->runQuery($query, null);
            return $stmt;
        }
        
        //update
        function update(){
            $query = "UPDATE categories  SET category_name = ?,
            category_desc =?, category_default_tags =?,
            category_image=?, category_active=?
            WHERE category_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [
                $this->category_name,
                $this->category_desc,
                $this->category_default_tags,
                $this->category_image,
                $this->category_active,
                $this->category_id
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
            );;
        }
        //delete category by id
        function delete(){
            $query = "DELETE FROM categories 
            WHERE category_id = ?";

            $stmt = $GLOBALS["db"]->runQuery($query, [$this->category_id]);
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
        //delete all categories
        function deleteAll(){
            $query = "DELETE FROM categories";

            $stmt = $GLOBALS["db"]->runQuery($query,null);
            $num = $stmt->rowCount();
            if($num > 0){
                return array(
                    "count"=>$num,
                    "success"=> true
                );
            }
            return array(
                "count"=>0,
                "success"=> false
            );
        }
        
    }
?>