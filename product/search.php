<?php
    //required headers
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Request-Methods:GET');
    include_once './common.php';
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        //check  for the $_GET request
        if(!isset($_GET) || !is_array($_GET) || empty($_GET)){
            //query products
            $stmt = $product->readAll();   
        }
        if(isset($_GET['search'])){
            $stmt = $product->search($_GET['search']);
        }
        $num = $stmt->rowCount();

        //check some records ar found
        if($num > 0){
            //products array
            $products = array();

            //retrieve table contents
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                //reduce $row['name'] to $name
                extract($row);
                $product_item = array(
                    "id" => $product_id,
                    "name" => $product_name,
                    "category_id" => $category_id,
                    "category_name" =>  $category_name,
                    "category_tags" =>  $category_tags,
                    "tags" => $product_tags,
                    "short_description" => $short_desc,
                    "cart_description" => $cart_desc,
                    "long_description" => $long_desc,
                    "usage" => $product_usage,
                    "price" =>  $unit_price,
                    "on_offer" => $on_offer == 1 ? true : false,
                    "discount" => $discount,
                    "stock" =>  $product_stock,
                    "supplier_company" => $supplier,
                    "region" => $region_name,
                    "gender" => $gender,
                    "weight" => $weight,
                    "weight_unit" => $weight_unit,
                    "dimension_unit" => $dimension_unit,
                    "length" => $length,
                    "width" => $width,
                    "height" => $height,
                    "display_image" => $display_image,
                    "images" => $images,
                    "features" => $product->getProductFeatures($product_id),
                    "reviews" => $product->getReviews($product_id),
                    "shipping_hours" => $shipping_hours,
                    "created_at" => $created_at
                );
                //add product item to products records
                array_push($products, $product_item);
            }

            //set response code = 200 OK
            http_response_code( 200);
                echo json_encode( array( 
                    "error" => null,
                    "products" => $products,
                    "success" => true
                ));
        }
        else{
            //set reSponse code to 404
            http_response_code( 404);
            //send message
            echo json_encode( array(
                "error" => "NULL_DATA",
                "success" => false,
                "message" => "No products found."
            ));
        }
    }
    else{
        http_response_code( 500);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected DELETE, received " . $_SERVER['REQUEST_METHOD'],
            "success" => false
        ));
    }
?>