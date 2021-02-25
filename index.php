<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type: application/json; charset=UTF-8");
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $data = array(
        "site_data" => array(
            "name" => "Home Decor Apparel",
            "description" => "Your Favorite Home Decors and Apparels ",
            "keywords" => "home, decor, apparel, business",
            "favicon" => "url of image",
            "contacts" => array( 
                "email" => "homedecor@.homedecor.com",
                "phone" => "254790983123",
                "address" => array(
                    "state" => "Kenya",
                    "city" => "Nakuru",
                    "town" => "Nakuru",
                    "stree_name" => "Egerton",
                    "postal_code" => "536",
                    "zip_code" => "20115",
                ),
            ),
            "social" => array(
                "facebook" => null,
                "twitter" => null,
                "instagram" => null,
                "youTube" => null,
                "whatsApp" => null,
            ),
            "about"=> array(
                "bio" => null,
                "team" => array(
                    "description" => null,
                    "members" => array(),
                ),
                "products" => "we sell beddings, shoes, grocery",
            ),
        ),
        "documentation" => array(
            "base_url"  => "http://localhost:80/e-commerce/api",
            "endpoints" => array(
                "/" => array(
                    "description" => "returns json data about the site and this api documentation",
                    "methods" =>"GET",
                    "url_params" => array(
                        "required" => "none",
                        "optional" => "none",
                    ),
                    "data_params"=>"none",
                    "response"=> array(
                        "success" => array(
                            "code" => 200,
                            "content" => array(
                                "site_data" => [
                                    "name"=>"string",
                                    "description"=>"string",
                                    "favicon" => "url",
                                    "keywords" => "string",
                                    "contacts" => "array of contact details such as email, phone and address",
                                    "social" => "array of social media eg fb",
                                    "about" => "array -- more info about the site",
                                ],
                                "documentation" => "This documentation"
                            )
                        ),
                        "error" => array(
                            "code" => 400,
                            "content" => array( 
                                "error" => "BAD_REQUEST_METHOD",
                                "message" => "Bad request method. Expected GET, received XYX"
                            ),
                        )
                    )
                ),
                "/product/read.php" => array(
                    "description" => "returns json data about products",
                    "methods" =>"GET",
                    "url_params" => array(
                        "maximum" => 1,
                        "required" => "none",
                        "optional" => array(
                            "id" => "fetching a single product. eg url?id =2",
                            "tags" => "fetching products with a given tag url?tags=pillow",
                            "gender" => "fetching products of given gender(male,female) eg url?gender=male",
                            "category" => "fetching products with given category eg url?category=beddings",
                            "on_offer" => "fetching products either on offer or not eg url?on_offer=true will return products that are on offer, otherwise returns products not on offer"
                        ),
                    ),
                    "data_params"=>"none",
                    "response"=> array(
                        "success" => array(
                            "code" => 200,
                            "content" => [
                                "id", "name", "short_description",
                                "cart_description", "long_description",
                                "category_id", "category_name", "category_tags",
                                "product_tags", "usage", "price","on_offer","discount",
                                "stock", "weight_unit","weight","dimension_unit",
                                "length","width","height"
                            ]
                        ),
                        "error" => array(
                            "code" => 400,
                            "content" => array( 
                                "error" => "BAD_REQUEST_METHOD",
                                "message" => "Bad request method. Expected GET, received XYX"
                            ),
                        )
                    )
                ),
            )
        )
    );
    http_response_code(200);
    echo json_encode($data);
}
else{
    http_response_code( 400);
    echo json_encode( array (
        "error" => "BAD_REQUEST_METHOD",
        "message" => "Bad request method. Expected GET, received " . $_SERVER['REQUEST_METHOD']
    ));
}
    
?>