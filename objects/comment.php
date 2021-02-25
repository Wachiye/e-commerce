<?php
    class Comment{
        //attributes
        public $comment_id;
        public $comment_type;
        public $comment_message;
        public $comment_user_id;
        public $comment_rate;
        public $comment_status;
        public $comment_published;
        public $created_at;
        public $updated_at;

        private $read_query ="SELECT comment_id as id,
        comment_message as message, comment_user_id as user_id, comment_rate as rate,
        comment_post_id as post_id, 
        comment status as status, comment_published as published, 
        comments.created_at as created_at, comments.updated_at as updated_at,
        user_name, user_email, user_phone
        FROM comments
        LEFT JOIN users 
        on comments.comment_user_id = users.user_id";


        //create new comment
        function create(){
            $query = "INSERT INTO comments(comment_type,
            comment_message, comment_user_id, comment_rate)
            VALUES(?, ?, ?, ?)";
            $stmt = $GLOBALS['db']->runQuery( $query, [
                $this->comment_type, $this->comment_message,
                $this->comment_user_id, $this->comment_rate
            ]);
            return $stmt;
        }
        //read single comment
        function read($comment_id){
            $query = $this->read_query . " WHERE comment_id = ?
            ORDER BY comments.created_at DESC";
            $stmt = $GLOBALS['db']->runQuery( $query, [ $comment_id]);
            return $stmt;
        }
        //read all comments
        function readAll($type){
            $query = $this->read_query . " WHERE comment_type = ?
            ORDER BY comments.created_at DESC";
            $stmt = $GLOBALS['db']->runQuery( $query, [ $type]);
            return $stmt;
        }
        //read by post_id
         function readByPostId($post_id){
            $query = $this->read_query . " WHERE comment_post_id = ?
            ORDER BY comments.created_at DESC";
            $stmt = $GLOBALS['db']->runQuery( $query, [ $post_id]);
            return $stmt;
        }
        //mark comments as read
        function markAsRead($all){
            $query = "UPDATE comments SET comment_status = 'read'
                WHERE comment_status = 'unread'";
            $stmt = null;
            if(!$all){
               $query .= " AND comment_id = ?";
            }
            $stmt = $GLOBALS['db']->runQuery( $query, $all ? [  $this->comment_id] : null);
            
            return $stmt;
        }
        //publish comments
        function publish(){
            $query = "UPDATE comments SET published = 1
            WHERE comment_id =?";
            $stmt = $GLOBALS['db']->runQuery( $query, [  $this->comment_id]);
            return $stmt;
        }
        //delete comment
        function delete(){
            $query = "DELETE FROM comments
            WHERE comment_id = ?";
            $stmt = $GLOBALS['db']->runQuery( $query, [ $this->comment_id]);
            return $stmt;
        }
        function deleteAll(){
            $query = "DELETE FROM comments";
            $stmt = $GLOBALS['db']->runQuery( $query, null);
            return $stmt;
        }
        function deleteAllByPostID($post_id){
            $query = "DELETE FROM comments WHERE comment_post_id = ?";
            $stmt = $GLOBALS['db']->runQuery( $query, [ $post_id]);
            return $stmt;
        }
    }
?>