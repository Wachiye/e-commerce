<?php
    //required headers
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Allow-Methods:GET');

    include_once './common.php';
    //only server GET request
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $stmt = null;
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $stmt = $category->read($_GET['id']);
        }else{
            $stmt = $category->readAll(); 
        }

        $num = $stmt->rowCount();
        if($num > 0){
            $categories = array();
            $categories['records'] = array();

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
                array_push($categories["records"], $data);
            }
            http_response_code(200);
            echo json_encode($categories);
        }
        else{
            http_response_code(500);
            echo json_encode(array(
                "message" => "No records found"
            ));
        }
    }
    else{
        http_response_code(400);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected GET, received " . $_SERVER['REQUEST_METHOD']
        ));
    }
?>