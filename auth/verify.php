<?php
    function verifyUser($user_id){
        
        ///include the user object file
        include_once '../objects/user.php';
        //include database
        include_once '../config/database.php';

        //instantiate and initialize the database  and product object
        $GLOBALS["db"] =new Database();
        $user = new User();

        //get user information
        $user_data = $user->read($user_id);
        
        $data = $user_data->FETCH(PDO::FETCH_ASSOC);

        //extract user data
        extract($data);
        //check if email is verified

        if($email_verified == 1 || $email_verified == true){
            return true;
        }
        return false;
    }
    
?>