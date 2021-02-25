<?php
    //required headers
    header("Access-Control-Allow-Methods:POST");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    //include the common file
    include_once './common.php';

    include_once '../objects/feature.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //get input data
        $data = json_decode(file_get_contents("php://input"));

        //validate data
        if(empty($data->name) || empty($data->category_id) || empty($data->tags)
        || empty($data->short_description) || empty($data->purchase_price) 
        || empty($data->unit_price) || empty($data->min_stock) || empty($data->stock)
        || empty($data->max_stock) || empty($data->supplier_id) || empty($data->gender_id)
        || empty($data->shipping_hours) || empty($data->region_id)
        || empty($data->weight_unit) || empty($data->weight)){
            echo json_encode(array("message"=>"Unable to create product. Data is incomplete"));
            die();
        }

        //set product property values
        $product->product_name = $data->name;
        $product->product_tags = $data->tags;
        $product->product_short_desc = $data->short_description;
        $product->product_purchase_price = $data->purchase_price;
        $product->product_unit_price = $data->unit_price;
        $product->product_min_stock = $data->min_stock;
        $product->product_stock = $data->stock;
        $product->product_max_stock = $data->max_stock;
        $product->product_weight_unit = $data->weight_unit;
        $product->product_weight = $data->weight;
        $product->product_shipping_hours = $data->shipping_hours;
        $product->product_category_id = $data->category_id;
        $product->product_region_id = $data->region_id;
        $product->product_gender_id = $data->gender_id;
        $product->product_supplier_id = $data->supplier_id;

        //check for any other relevant data supplied
        $product->product_sku = $data->sku ?? "";
        $product->product_cart_desc = $data->cart_description ?? "";
        $product->product_long_desc = $data->long_description ?? "";
        $product->product_usage = $data->usage ?? "";
        $product->product_dimension_unit = $data->dimension_unit ?? "";
        $product->product_length = $data->length ?? 0;
        $product->product_width = $data->width ?? 0;
        $product->product_height = $data->height ?? 0;
        $product->product_sales_tax = $data->sales_tax ?? 0;
        $product->product_on_offer = $data->on_offer ?? 0;
        $product->product_discount = $data->discount ?? 0;

        //variable to hold error and message
        $error = array();
        $message  = array();
        //upload images if supplied
        

        //save product
        $stmt = $product->create();
        $num = $stmt->rowCount();

        if($num > 0){ //product id will be the last insert id on the transaction
            $product->product_id = $GLOBALS['db']->getInsertId();
            $message =[
                "message" => "Product created successfully"
            ];
            //save features if supplied
            if($data->features){
                $features = $data->features;
                $feature = new Feature($db_conn);
                foreach($features as $feat){
                    $feature->product_id = $product->product_id;
                    $feature->option_group_id = $feat->group_id;
                    $feature->option_id = $feat->option_id;
                    if(!$feature->create()){
                        $message .= "Error: Could not save product feature:" . $feat->group_name ?? $feat->group_id . " With value:" . $feat->option_name ?? $feat->option_id;
                    }
                }
                
            }
        }
        else{
            $error["CREATE_PRODUCT_ERR"]="Unable to create product";
        }

        //return response
        if(count($error) > 0){
            http_response_code( 500);
            echo json_encode(array(
                "error" => $error,
                "success" => false,
            ));
        }
        else{
            http_response_code(200);
            echo json_encode(array(
                "product_id" => $product->product_id,
                "success" => true,
                "message" => $message
            ));
        }
    }
    else {
        http_response_code(503);
        echo json_encode( array(
            "error" => "BAD_REQUEST_METHOD",
            "message" => "Bad request method. Expected POST, received " . $_SERVER['REQUEST_METHOD']
        ));
    }
?>