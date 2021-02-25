<?php
  //headers
  header("Access-Control-Allow-Methods:DELETE");
  header("Access-Control-Max-Age:3600");
  header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
  //include the common file
  include_once './common.php';

  //only server DELETE request
  if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    //get inputs
    $data = json_decode(file_get_contents("php://input"));
    
    $deleted = false;

    if(!isset($_GET['id']) && empty($data->id)){
      $deleted = $category->deleteAll();
    }

    if(!empty($_GET['id']) || !empty($data->id)){
          $category->category_id = $_GET['id'] ?? $data->id;
          $deleted = $category->delete();
    }
    
    if($deleted["success'"] = true){
      http_response_code(200);
      echo json_encode(array(
          "message" => "{$deleted['count']} Categories deleted successfully",
          "success" => true
      ));
    }
    else{
      return array(
          "message"=>"Unable to delete category",
          "success"=> false
      );
    }
  }
  else{
    http_response_code(400);
      echo json_encode( array(
          "error" => "BAD_REQUEST_METHOD",
          "message" => "Bad request method. Expected DELETE, received " . $_SERVER['REQUEST_METHOD']
      ));
  }

?>