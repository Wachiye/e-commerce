<?php
    //headers
    header("Access-Control-Allow-Methods:POST");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';
  
    //only server POST request
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //get inputs
        $data = json_decode(file_get_contents("php://input"));
        
        if(empty($data->name) || empty($data->description) || empty($data->default_tags)){
            echo json_encode(array(
                "message" => "Unable to create new category. Data is incomplete"
            
            ));
            die();
        }

        $category->category_name = $data->name;
        $category->category_desc = $data->description;
        $category->category_default_tags = $data->default_tags;
        
        //other relevant data
        $category->category_active = $data->active ?? 0;
        //upload image before setting it here
        $category->category_image = $data->image ?? "";
        $category->category_type = $data->type ?? "post";
        //create/save the category
        $stmt = $category->create();
        $num = $stmt->rowCount();
       
        if($num > 0){
            $category->category_id = $GLOBALS['db']->getInsertId();
            http_response_code( 200);
            echo  json_encode( array(
                "error" => null,
                "message" => "Category created successfully",
                "category_id" => $category->category_id,
                "success" => true
            ));
        }
        else{
            http_response_code(500);
            echo json_encode(array(
                "error" => $stmt->errorinfo(),
                "message" => "Sorry but we are unable to create category",
                "success" => false
            ));
        }
    }
    else{
        http_response_code(400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected POST, received " . $_SERVER['REQUEST_METHOD']
        ));
    }
?>