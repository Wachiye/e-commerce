<?php
    //headers
    header("Access-Control-Allow-Methods:PUT");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    //only server PUT request
    if($_SERVER['REQUEST_METHOD'] === 'PUT'){
        //get inputs
        $data = json_decode(file_get_contents("php://input"));
        
        if(empty($data) || (!isset($_GET['id']) && empty($data->id)) || empty($data->name) || empty($data->description) || empty($data->default_tags)){
            echo json_encode(array(
                "error"=>"INCOMPLETE_DATA_ERR",
                "message" => "Unable to update category with id undefined",
                "success" => false
            ));
            die();
        }
        $category->category_id = $data->id ?? $_GET['id'];
        $category->category_name = $data->name;
        $category->category_desc = $data->description;
        $category->category_default_tags = $data->default_tags;
        
        //other relevant data
        $category->category_active = $data->active ?? 0;
        //upload image before setting it here
        $category->category_image = $data->image ?? "";

        //update the category
        $updated = $category->update();
        if($updated["success"] = true){
            http_response_code(200);
            echo  json_encode(array(
                "message" => "{$updated['count']} Categories updated successfully",
                "success" => true
            ));
        }
        else{
            http_response_code(500);
            echo json_encode(array(
                "error" => $updated['error'],
                "message" => "Sorry but could not update category.",
                "success" => false
            ));
        }
    }
    else {
        http_response_code(400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected PUT, received " . $_SERVER['REQUEST_METHOD']
        ));
    }
?>