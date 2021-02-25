<?php
    class Author{

        public $author_id;
        public $author_user_id;
        public $author_title;
        public $author_company_name;
        public $author_bio;
        public $created_at;
        public $updated_at;

        private $read_query ="SELECT author_id as id, author_user_id as user_id,
        author_title as title, author_company_name as company_name, author_bio as bio,
        authors.created_at as created_at, authors.updated_at as updated_at,
        user_name, user_email, user_phone
        FROM authors
        LEFT JOIN users
        ON authors.author_user_id = users.user_id";

        //create author
        function create(){
            $query = "INSERT INTO authors(author_user_id,
            author_title, author_company_name, author_bio)
            VALUES(?,?,?,?)";
            $stmt = $GLOBALS['db']->runQuery( $query, [
                $this->author_user_id, $this->author_title,
                $this->author_company_name, $this->author_bio
            ]);
            return $stmt;
        }

        //read author
        function read($author_id){
            $query = $this->read_query . " WHERE author_id = ?";
            $stmt = $GLOBALS['db']->runQuery( $query, [$author_id]);
            return $stmt;
        }
        //read author
        function readAll(){
            $query = $this->read_query . " ORDER BY authors.created_at DESC";
            $stmt = $GLOBALS['db']->runQuery( $query, null);
            return $stmt;
        }
        //update author
        function update(){
            $query = "UPDATE authors SET author_title = ?,
            author_company_name =?, author_bio =?, updated_at = NOW()
            WHERE author_id = ?";
            $stmt = $GLOBALS['db']->runQuery( $query, [
                $this->author_title,
                $this->author_company_name,
                $this->author_bio,
                $this->author_id
            ]);
            return $stmt;
        }
        //delete author
        function delete(){
            $query = "DELETE FROM authors WHERE author_id = ?";
            $stmt = $GLOBALS['db']->runQuery( $query, [$author_id]);
            return $stmt;
        }
        //delete all authors
        function deleteAll(){
            $query = "DELETE FROM authors ";
            $stmt = $GLOBALS['db']->runQuery( $query, [$author_id]);
            return $stmt;
        }
    }

?>