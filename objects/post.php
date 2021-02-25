<?php
    class Post{
        //attributes
        public $post_id;
        public $post_title;
        public $post_subtitle;
        public $post_excerpt;
        public $post_slug;
        public $post_content;
        public $post_tags;
        public $post_category_id;
        public $post_author_id;
        public $post_image;
        public $post_views;
        public $post_likes;
        public $created_at;
        public $updated_at;

        private $insert_query = "INSERT INTO posts(post_title,
        post_subtitle, post_excerpt, post_slug, post_content, 
        post_image, post_tags,post_category_id, post_author_id)
        VALUES(?,?,?,?,?,?,?,?,?)";

        private $read_query = "SELECT post_id as id, post_title as title,
        post_subtitle as subtitle, post_excerpt as excerpt, 
        post_slug as slug, post_content as content, 
        post_image as image, post_tags as tags,
        post_views as views, post_likes as likes,post_category_id as category_id,
        post_author_id as author_id, posts.created_at as created_at, posts.updated_at as updated_at,
        category_name , category_default_tags as category_tags
        FROM posts
        LEFT JOIN categories
        ON posts.post_category_id = categories.category_id";

        function create(){
            $this->post_slug = strtolower( str_replace(" ", "-", $this->post_title)  ."-" . date("Y-m-d-H-i-s"));

            $stmt = $GLOBALS['db']->runQuery($this->insert_query,[
                $this->post_title, $this->post_subtitle , $this->post_excerpt,
                $this->post_slug,
                $this->post_content, $this->post_image, $this->post_tags,
                $this->post_category_id, $this->post_author_id
            ]);
            return $stmt;
        }
        function read($post_id){
            $query = $this->read_query . " WHERE post_id = ?
            ORDER BY posts.created_at DESC";
            $stmt = $GLOBALS['db']->runQuery( $query, [$post_id]);
            return $stmt;
        }
        function readAll(){
            $query = $this->read_query . " ORDER BY posts.created_at DESC";
            $stmt = $GLOBALS['db']->runQuery( $query, null);
            return $stmt;
        }
        function readByCategory($category_name){
            $query = $this->read_query . " WHERE category_name = ?
            ORDER BY posts.created_at DESC";
            $stmt = $GLOBALS['db']->runQuery( $query, [$category_name]);
            return $stmt;
        }
        function readByTag($tag){
            $query = $this->read_query . " WHERE post_tags LIKE ?
            OR category_default_tags LIKE ?
            ORDER BY posts.created_at DESC";
            $stmt = $GLOBALS['db']->runQuery( $query, [ $tag, $tag]);
            return $stmt;
        }
        //get post comments
        function getComments($post_id){
            $query = "SELECT comment_id as id,
            comment_message as message, comment_user_id as user_id,
            comments.created_at as created_at, comments.updated_at as updated_at,
            user_name, user_email, user_phone
            FROM comments
            LEFT JOIN users 
            on comments.comment_user_id = users.user_id
            WHERE comment_post_id = ? AND comment_published = 1 AND comment_status = 'read'
            ORDER BY comments.created_at DESC";

            $stmt = $GLOBALS['db']->runQuery( $query, [ $post_id]);

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
        //get post author
        function getAuthor($post_id){
            $query = "SELECT author_id as id, author_user_id as user_id,
            author_title as title, author_company_name as company_name, author_bio as bio,
            authors.created_at as created_at, authors.updated_at as updated_at,
            user_name, user_email, user_phone
            FROM authors
            LEFT JOIN users
            ON authors.author_user_id = users.user_id
            WHERE author_id = ?";

            $stmt = $GLOBALS['db']->runQuery( $query, [$post_id]);
            $num = $stmt->rowCount();

            $author = null;

            if( $num > 0){
                while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){
                    //extract the row such that $row["name"] becomes $name
                    extract($row);
                    //create a data array
                    $author = array(
                        "id" => $id,
                        "title" => $title,
                        "user_id" => $user_id,
                        "company_name" => $company_name,
                        "bio" => $bio,
                        "user_name" => $user_name,
                        "user_email" => $user_email,
                        "user_phone" => $user_phone,
                        "created_at" => $created_at,
                        "updated_at" => $updated_at
                    );
                }  
            }
            
            return $author;
        }
        //get categories for posts
        function getCategories(){
            $query = "SELECT category_id, category_name,
            category_default_tags as default_tags,
            category_desc, category_active as active, 
            category_image as image, 
            categories.created_at as created_at,
            categories.updated_at as updated_at,
            COUNT(post_id) as posts
            FROM categories
            LEFT JOIN posts
            ON categories.category_id = posts.post_category_id
            WHERE category_type = 'post'
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
                        "posts" => $posts,
                        "created_at" => $created_at,
                        "updated_at" => $updated_at
                    );
                    //push this data to the records array
                    array_push($categories, $data);
                }
            }

            return $categories;
        }
        function update(){
            $query = "UPDATE posts SET post_title = ?,
            post_subtitle = ?, post_excerpt = ?, post_slug = ?, post_content = ?, 
            post_image = ?, post_tags = ?,post_category_id = ?, post_author_id = ?,
            updated_at = NOW()
            WHERE post_id = ?";
            
            $stmt = $GLOBALS['db']->runQuery( $query,[
                $this->post_title, $this->post_subtile, $this->post_excerpt, $this->post_slug,
                $this->post_content, $this->post_image, $this->post_tags,
                $this->post_category_id, $this->post_author_id,
                $this->post_id
            ]);
            return $stmt;
        }
        function like(){
            $query = "UPDATE posts SET post_likes = posts.post_likes + 1
            WHERE post_id = ?";
            $stmt = $GLOBALS['db']->runQuery( $query,[$this->post_id]);
            return $stmt;
        }
        function delete(){
            $query = "DELETE FROM posts
            WHERE post_id = ?";
            $stmt = $GLOBALS['db']->runQuery( $query, [ $this->post_id]);
            return $stmt;
        }
        function deleteAll(){
            $query = "DELETE FROM posts";
            $stmt = $GLOBALS['db']->runQuery( $query, null);
            return $stmt;
        }
    }
?>