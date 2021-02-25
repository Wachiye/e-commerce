<?php
    
    class Product{
        private $db_conn;
        private $_table_name = "products";

        //product object properties
        public $product_id;
        public $product_sku;
        public $product_name;
        public $product_category_id;
        public $product_category_name;
        public $product_category_default_tags;
        public $product_purchase_price;
        public $product_unit_price;
        public $product_sales_tax ; 
        public $product_weight_unit;
        public $product_weight ;
        public $product_dimension_unit ;
        public $product_dimension ;
        public $product_height ;
        public $product_length ;
        public $product_width ;
        public $product_region_id ;
        public $product_region_name;
        public $product_cart_desc ;
        public $product_short_desc ;
        public $product_long_desc;
        public $product_tags;
        public $product_usage;
        public $product_min_stock;
        public $product_stock;
        public $product_max_stock;
        public $product_image ;
        public $product_images;
        public $product_on_offer;
        public $product_discount ;
        public $product_gender_id ;
        public $product_gender_name;
        public $product_supplier_id ;
        public $product_supplier_name;
        public $product_shipping_hours;
        public $product_features;
        public $created_at ;
        public $updated_at ;

        private $read_query = "SELECT product_id, product_sku as sku, product_name, product_tags, product_short_desc as short_desc,
        product_long_desc as long_desc, product_cart_desc as cart_desc, product_usage, product_unit_price as unit_price, 
        product_weight_unit as weight_unit, product_weight as weight, product_dimension_unit as dimension_unit,
        product_length as length, product_width as width, product_height as height, product_stock,
        product_image as display_image, product_images as images, product_shipping_hours as shipping_hours,
        product_on_offer as on_offer, product_discount as discount, products.created_at as created_at, region_name, gender_name as gender, 
        category_id, category_name, category_default_tags as category_tags, supplier_company as supplier
        FROM products
        LEFT JOIN regions
        ON products.product_region_id = regions.region_id
        LEFT JOIN genders
        ON products.product_gender_id = genders.gender_id
        LEFT JOIN categories
        ON products.product_category_id = categories.category_id
        LEFT JOIN suppliers
        ON products.product_supplier_id = suppliers.supplier_id";

        //create product query
        private $insert_query = "INSERT INTO products(product_sku, product_name, product_short_desc,
        product_long_desc, product_cart_desc, product_usage, product_tags,
        product_purchase_price, product_unit_price, product_sales_tax,
        product_on_offer, product_discount, product_min_stock, product_stock,
        product_max_stock, product_weight_unit, product_weight, 
        product_dimension_unit, product_length, product_width, product_height,
        product_category_id, product_gender_id, product_region_id, product_supplier_id)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        //update product query
        private $update_query = "UPDATE products SET product_sku = ?, product_name = ?, product_short_desc = ?,
        product_long_desc = ?, product_cart_desc = ?, product_usage = ?, product_tags = ?,
        product_purchase_price = ?, product_unit_price = ?, product_sales_tax = ?,
        product_on_offer = ?, product_discount = ?, product_min_stock = ?, product_stock = ?,
        product_max_stock = ?, product_weight_unit = ?, product_weight = ?, 
        product_dimension_unit = ?, product_length = ?, product_width = ?, product_height = ?,
        product_category_id = ?, product_gender_id = ?, product_region_id = ?, product_supplier_id = ?
        updated_at = NOW()
        WHERE product_id = ?";


       
        
        function create(){
            $query = $this->insert_query;
            $stmt = $GLOBALS["db"]->runQuery($query,[
                $this->product_sku,$this->product_name, $this->product_short_desc,
                $this->product_long_desc, $this->product_cart_desc, $this->product_usage, $this->product_tags,
                $this->product_purchase_price, $this->product_unit_price, $this->product_sales_tax,
                $this->product_on_offer, $this->product_discount, $this->product_min_stock, $this->product_stock,
                $this->product_max_stock, $this->product_weight_unit, $this->product_weight,
                $this->product_dimension_unit, $this->product_length, $this->product_width, $this->product_height,
                $this->product_category_id, $this->product_gender_id, $this->product_region_id, $this->product_supplier_id
            ]);
            
            return $stmt;   
        }
        //read products
        function readAll(){
            $query = $this->read_query ." ORDER BY products.created_at DESC";
            $stmt = $GLOBALS["db"]->runQuery($query,null);
            return $stmt;
        }
        //read single product
        function readOne($id){
            //slq query
            $query = $this->read_query ." 
            WHERE product_id = ?
            ORDER BY products.created_at DESC";
            //sanitize input
            $id = htmlspecialchars( strip_tags($id));
            //execute and return
            $stmt = $GLOBALS["db"]->runQuery($query,[$id]);
            return $stmt;
        }

        //read products by category
        function readByCategory($category){
            //sql query
            $query = $this->read_query ." 
            WHERE category_name = ? AND category_type = 'product'
            ORDER BY products.created_at DESC";
            $category = htmlspecialchars( strip_tags($category));
            $stmt = $GLOBALS["db"]->runQuery($query,[$category]);
            return $stmt;
        }
        //read products by tags
        function readByTags($tags){
            $query = $this->read_query ." 
            WHERE 
            category_default_tags LIKE ? OR product_tags LIKE ? OR gender_tags LIKE ?
            ORDER BY products.created_at DESC";
            //sanitize
            $tags = htmlspecialchars( strip_tags($tags));
            $tags = "%{$tags}%";
            $stmt = $GLOBALS["db"]->runQuery($query,[$tags, $tags, $tags]);
            return $stmt;
        }
        //read products on offer
        function readByOffer($on_offer){
            $query = $this->read_query ." 
                WHERE product_on_offer = ?
                ORDER BY products.created_at DESC";
            
            if(!empty($on_offer) || $on_offer == "true" || $on_offer == 1 || $on_offer == 'yes' || $on_offer == 'y') 
                $data = 1;
            if(empty($on_offer) || $on_offer == "false" || $on_offer == 0 || $on_offer == 'no' || $on_offer == 'n' || $on_offer == null)
                $data = 0;
            $stmt = $GLOBALS["db"]->runQuery($query,[$data]);
            return $stmt;
        }

        function readByGender($gender){
            $query = $this->read_query ." 
            WHERE gender_name = ? OR gender_name = 'all'
            ORDER BY products.created_at DESC";
            $gender = htmlspecialchars( strip_tags($gender));
            $stmt = $GLOBALS["db"]->runQuery($query,[$gender]);
            return $stmt;
        }

        function getCategories(){
            $query = "SELECT category_id, category_name,
            category_default_tags as default_tags,
            category_desc, category_active as active, 
            category_image as image, 
            categories.created_at as created_at,
            categories.updated_at as updated_at,
            COUNT(product_id) as products
            FROM categories
            LEFT JOIN products
            ON categories.category_id = products.product_category_id
            WHERE category_type = 'product'
            GROUP BY category_id";

            $stmt = $GLOBALS["db"]->runQuery($query, null);
            $num = $stmt->rowCount();
            $categories = array();

            if($num > 0){
                while($row =$stmt->FETCH(PDO::FETCH_ASSOC)){
                    //make $row["name"] to "name"
                    extract($row);
                    $data = array(
                        "id" => $category_id,
                        "name" => $category_name,
                        "description" => $category_desc,
                        "default_tags" => $default_tags,
                        "active" => $active == 1 ? true : false,
                        "image" => $image,
                        "products" => $products,
                        "created_at" => $created_at,
                        "updated_at" => $updated_at
                    );
                    //push this data to the records array
                    array_push($categories, $data);
                }
            }

            return $categories;
        }
        function getProductFeatures($id){
            $query = "SELECT feature_id, features.option_group_id as group_id, 
            option_group_name as group_name, features.option_id, option_name
            FROM features
            LEFT JOIN option_groups
            ON features.option_group_id = option_groups.option_group_id
            LEFT JOIN options 
            ON features.option_id = options.option_id
            WHERE features.product_id = {$id}";
            
            $stmt = $GLOBALS["db"]->runQuery($query, null);
            $features = array();

            if($stmt->rowCount() > 0){
               
               while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    extract($row);

                    $features["feature_id_{$feature_id}"] = array([
                        "group_id"=> $group_id,
                        "group_name" => $group_name,
                        "option_id" => $option_id,
                        "option_name" => $option_name
                    ]);
                    
                }
            }
            return $features;
        }

        function getReviews($product_id){
            $query = "SELECT comment_id as id,
            comment_message as message, comment_user_id as user_id, comment_rate as rate,
            comments.created_at as created_at, comments.updated_at as updated_at,
            user_name, user_email, user_phone
            FROM comments
            LEFT JOIN users 
            on comments.comment_user_id = users.user_id
            WHERE comment_post_id = ? AND comment_published = 1 AND comment_status = 'read'
            ORDER BY comments.created_at DESC";

            $stmt = $GLOBALS['db']->runQuery( $query, [ $product_id]);

            $comments = array();
            if( $stmt->rowCount() > 0){
                
                while( $row = $stmt->FETCH( PDO::FETCH_ASSOC)){
                    extract( $row);
                    $data = array(
                        "id" => $id,
                        "message" => $message,
                        "user_id" => $user_id,
                        "user_name" => $user_name,
                        "user_email" => $user_email,
                        "user_phone" => $user_phone,
                        "created_at" => $created_at,
                        "updated_at" => $updated_at
                    );

                    array_push( $comments, $data);
                }
            }
            return $comments;
        }

        function search($keywords){
            $query = $this->read_query ." 
            WHERE 
            MATCH(product_sku, product_name,product_tags,
            product_short_desc,product_cart_desc, product_long_desc,
            product_usage) 
            AGAINST(? IN BOOLEAN MODE) OR
            MATCH(category_name, category_default_tags)
            AGAINST(? IN BOOLEAN MODE) OR
            
            MATCH(region_name) 
            AGAINST(?  IN BOOLEAN MODE)
            ORDER BY 
            MATCH(product_sku, product_name,product_tags,
            product_short_desc,product_cart_desc, product_long_desc,
            product_usage) 
            AGAINST(? IN BOOLEAN MODE) > 0 DESC,
            products.created_at DESC";
            
            $keywords = htmlspecialchars( strip_tags($keywords));
            
            
            $results = $GLOBALS["db"]->runQuery($query,[
                $keywords, $keywords,$keywords,$keywords 
            ] );
            return $results;
        }
        function update(){
            $query = $this->update_query;
            $stmt = $GLOBALS["db"]->runQuery($query,[
                $this->product_sku,$this->product_name, $this->product_short_desc,
                $this->product_long_desc, $this->product_cart_desc, $this->product_usage, $this->product_tags,
                $this->product_purchase_price, $this->product_unit_price, $this->product_sales_tax,
                $this->product_on_offer, $this->product_discount, $this->product_min_stock, $this->product_stock,
                $this->product_max_stock, $this->product_weight_unit, $this->product_weight,
                $this->product_dimension_unit, $this->product_length, $this->product_width, $this->product_height,
                $this->product_category_id, $this->product_gender_id, $this->product_region_id, $this->product_supplier_id,
                $this->product_id
            ]);
           return $stmt;
        }
        //delete a product given id
        function delete(){
            $query = "DELETE FROM products where product_id = ?";
            $id = $GLOBALS["db"]->sanitize($this->product_id);
            $stmt = $GLOBALS["db"]->runQuery($query, [$id]);
            
            return $stmt;
        }
        function deleteAll(){
            $query = "DELETE FROM products";
            $stmt = $GLOBALS["db"]->runQuery($query,null);
            return $stmt ;
        }
    }
?>