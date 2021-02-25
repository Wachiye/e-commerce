-- categories table
CREATE TABLE IF NOT EXISTS categories(
    category_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    category_name varchar(255) NOT NULL UNIQUE,
    category_type enum("product","post") default "post",
    category_desc varchar(600),
    category_default_tags varchar(255),
    category_image varchar(255),
    category_active tinyint(1),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- option_groups table
CREATE TABLE IF NOT EXISTS option_groups(
    option_group_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    option_group_name varchar(255) NOT NULL UNIQUE,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- product option_groups table
CREATE TABLE IF NOT EXISTS features(
    feature_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    product_id int,
    option_group_id int,
    option_id int,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- option_group table
CREATE TABLE IF NOT EXISTS options(
    option_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    option_name varchar(255) NOT NULL UNIQUE,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- gender table
CREATE TABLE IF NOT EXISTS genders (
    gender_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gender_name varchar(7) NOT NULL UNIQUE ,
    gender_tags varchar(255),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

 -- units table
CREATE TABLE IF NOT EXISTS units(
    unit_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    unit_name varchar(255) NOT NULL UNIQUE,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- regions table
CREATE TABLE IF NOT EXISTS regions(
    region_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    region_name varchar(255) NOT NULL UNIQUE,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- products table
CREATE TABLE IF NOT EXISTS products(
    product_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    product_sku  varchar(255),
    product_name varchar(255) NOT NULL,
    product_slug VARCHAR(255) not null,
    product_category_id int NOT NULL,
    product_purchase_price float NOT NULL DEFAULT 0.0 ,
    product_unit_price float DEFAULT 0.0,
    product_sales_tax float DEFAULT 0.0, 
    product_weight_unit VARCHAR(8),
    product_weight float DEFAULT 0.0,
    product_dimension_unit VARCHAR(8),
    product_dimension float DEFAULT 0.0,
    product_height float DEFAULT 0.0,
    product_length float DEFAULT 0.0,
    product_width float DEFAULT 0.0,
    product_region_id int,
    product_cart_desc varchar(200),
    product_short_desc varchar(700) NOT NULL,
    product_long_desc text,
    product_tags varchar(255),
    product_usage text,
    product_min_stock float DEFAULT 0.0,
    product_stock float DEFAULT 0.0,
    product_max_stock float DEFAULT 0.0,
    product_image varchar(255),
    product_images varchar(255),
    product_on_offer tinyint(1) DEFAULT 0,
    product_discount float DEFAULT 0.0,
    product_gender_id int NOT NULL,
    product_supplier_id int(11) NOT NULL,
    product_shipping_hours int not null DEFAULT 24,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- order type table
CREATE TABLE IF NOT EXISTS order_types(
    type_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type_name varchar(255) NOT NULL UNIQUE,
    type_desc varchar(600),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- orders table
CREATE TABLE IF NOT EXISTS orders(
    order_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    order_items int,
    order_amount float DEFAULT 0.0,
    order_status enum("processing","shipping","complete", "rejected") DEFAULT 'processing',
    order_type_id int,
    order_user_id int(11),
    order_recipient_name varchar(255),
    order_recipient_id int(11),
    order_recipient_phone varchar(15),
    order_recipient_email varchar(100),
    order_billing_address varchar(255),
    order_shipping_address varchar(255),
    order_region_id int,
    order_shipper_id int(11),
    order_paid tinyint(1) default 0,
    order_payment_id int,
    order_required_date datetime ,
    order_shipping_date datetime ,
    order_delivery_date datetime ,
    order_sales_tax float DEFAULT 0.0,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- order details table
CREATE TABLE IF NOT EXISTS order_details(
    detail_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    detail_order_id int(11),
    detail_product_id int(11),
    detail_price int(11),
    detail_quantity float DEFAULT 0.0,
    detail_on_offer tinyint(1) default 0,
    detail_discount float DEFAULT 0.0,
    detail_processed TINYINT(1) DEFAULT 0,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- user types table
CREATE TABLE IF NOT EXISTS user_types(
    type_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type_name varchar(255) NOT NULL UNIQUE,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- suppliers table
CREATE TABLE IF NOT EXISTS suppliers(
    supplier_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    supplier_user_id int(11) DEFAULT 1,
    supplier_company varchar(255),
    supplier_product_type varchar(255),
    supplier_pay_method varchar(26),
    supplier_pay_id int,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- shippers table
CREATE TABLE IF NOT EXISTS shippers(
    shipper_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    shipper_user_id int(11) DEFAULT 1,
    shipper_company varchar(255),
    shipper_product_type varchar(255),
    shipper_max_weight float DEFAULT 0.0,
    shipper_available tinyint(1),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- users table
CREATE TABLE IF NOT EXISTS users(
    user_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(255) NOT NULL,
    user_email varchar(100) NOT NULL UNIQUE,
    user_phone varchar(15) NOT NULL UNIQUE,
    user_address varchar(255),
    user_region_id int NOT NULL,
    user_email_verified tinyint(1) DEFAULT 0,
    user_password varchar(64),
    user_verification_code varchar(255),
    user_type_id int NOT NULL,
    user_billing_address varchar(255),
    user_shipping_address varchar(255),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- payments table
CREATE TABLE IF NOT EXISTS payments(
    payment_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    payment_amount float DEFAULT 0.0,
    payment_purpose varchar(255),
    payment_method_id int(11),
    payment_transaction_id VARCHAR(255),
    payment_checkout_id varchar(255),
    payment_user_name varchar(255),
    payment_user_phone varchar(15),
    payment_user_email varchar(100),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS payment_methods(
    method_id int(11) primary key AUTO_INCREMENT,
    method_name VARCHAR(16) not null,
    method_desc text,
    method_ac_no VARCHAR(255) not null,
    method_ac_name VARCHAR(255) not null,
    method_image VARCHAR(255) not null,
    method_is_active TINYINT(1) DEFAULT 1,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS offers(
    offer_id int(11) PRIMARY KEY AUTO_INCREMENT,
    offer_title VARCHAR(255) NOT NULL,
    offer_description TEXT NOT NULL,
    offer_image varchar(255) NOT NULL,
    offer_start_date datetime DEFAULT CURRENT_TIMESTAMP,
    offer_end_date datetime,
    offer_active TINYINT(1) DEFAULT 1,
    offer_link VARCHAR(255),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS posts(
    post_id int(11) PRIMARY KEY AUTO_INCREMENT,
    post_title VARCHAR(255) NOT NULL,
    post_subtitle VARCHAR(255),
    post_slug VARCHAR(255) NOT NULL,
    post_excerpt VARCHAR(500),
    post_content TEXT NOT NULL,
    post_tags VARCHAR(255) NOT NULL,
    post_category_id int,
    post_author_id int,
    post_image VARCHAR(255),
    post_views int(11) DEFAULT 0,
    post_likes int(11) DEFAULT 0,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS authors(
    author_id int(11) PRIMARY key AUTO_INCREMENT,
    author_user_id int,
    author_title VARCHAR(255),
    author_company_name VARCHAR(255),
    author_bio VARCHAR(500) NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS comments(
    comment_id int(11) PRIMARY key AUTO_INCREMENT,
    comment_type enum("post","product_review", "site_review"),
    comment_message TEXT NOT NULL,
    comment_user_id int,
    comment_post_id int,
    comment_rate enum('1','2','3','4','5'),
    comment_status enum("unread","read"),
    comment_published TINYINT(1) DEFAULT 0,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS cart(
    cart_id int(11) primary key AUTO_INCREMENT,
    cart_items int NOT NUll DEFAULT 0,
    cart_amount FLOAT NOT NULL DEFAULT 0.0,
    cart_status ENUM("active","saved","purchased","abandoned") default "active",
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS cart_details(
    detail_id int(11) primary key auto_increment,
    cart_id int NOT NULL,
    product_id int NOT NULL,
    initial_quantity int NOT NULL default 1,
    initial_price float not null,
    initial_discount float not null default 0,
    quantity int not null default 0,
    features varchar(100) NOT NULL,
    saved tinyint(1) default 0,
    ordered tinyint(1) default 0,
    added_on datetime default current_timestamp
);

ALTER TABLE features ADD FOREIGN KEY(option_group_id) REFERENCES option_groups(option_group_id);
ALTER TABLE features ADD FOREIGN KEY(product_id) REFERENCES products(product_id);
ALTER TABLE features ADD FOREIGN KEY(option_id) REFERENCES options(option_id);

ALTER TABLE products ADD FOREIGN KEY(product_category_id) REFERENCES categories(category_id);
ALTER TABLE products ADD FOREIGN KEY(product_region_id) REFERENCES regions(region_id);
ALTER TABLE products ADD FOREIGN KEY(product_gender_id) REFERENCES genders(gender_id);
ALTER TABLE products ADD FOREIGN KEY(product_supplier_id) REFERENCES suppliers(supplier_id);

ALTER TABLE orders ADD FOREIGN KEY(order_type_id) REFERENCES order_types(type_id);
ALTER TABLE orders ADD FOREIGN KEY(order_user_id) REFERENCES users(user_id);
ALTER TABLE orders ADD FOREIGN KEY(order_payment_id) REFERENCES payments(payment_id);
ALTER TABLE orders ADD FOREIGN KEY(order_shipper_id) REFERENCES shippers(shipper_id);


ALTER TABLE order_details ADD FOREIGN KEY(detail_order_id) REFERENCES orders(order_id);
ALTER TABLE order_details ADD FOREIGN KEY(detail_product_id) REFERENCES products(product_id);

ALTER TABLE suppliers ADD FOREIGN KEY(supplier_user_id) REFERENCES users(user_id);

ALTER TABLE shippers ADD FOREIGN KEY(shipper_user_id) REFERENCES users(user_id);

ALTER TABLE users ADD FOREIGN KEY(user_region_id) REFERENCES regions(region_id);
ALTER TABLE users ADD FOREIGN KEY(user_type_id) REFERENCES user_types(type_id);

ALTER TABLE payments ADD FOREIGN KEY(payment_method_id) REFERENCES payment_methods(method_id);

ALTER TABLE cart_details ADD FOREIGN KEY(cart_id) REFERENCES cart(cart_id);

ALTER TABLE authors ADD FOREIGN KEY(author_user_id) REFERENCES users(user_id);

ALTER TABLE posts ADD FOREIGN KEY(post_author_id) REFERENCES authors(author_id);

ALTER TABLE posts ADD FOREIGN KEY(post_category_id) REFERENCES categories(category_id);

-- make the regions, users, products, categories and genders tables searchable with full text search feature
CREATE FULLTEXT INDEX ft_idx_category
    ON categories (category_name, category_default_tags);

CREATE  FULLTEXT INDEX ft_idx_genders
    ON genders (gender_name, gender_tags);

CREATE FULLTEXT INDEX ft_idx_products
    ON products (product_sku, product_name, product_tags,
    product_short_desc, product_cart_desc, product_long_desc,
    product_usage); 

CREATE FULLTEXT INDEX ft_idx_users
    ON users (user_name, user_email, user_phone, user_billing_address, user_shipping_address);

CREATE FULLTEXT INDEX ft_idx_regions
    ON regions (region_name);

-- DUMP data for categories
INSERT INTO categories(category_id, category_name, category_desc, category_default_tags, category_active, category_type)
VALUES(1, 'Beddings', 'Beds, Bedsheets, Bed covers, Pillows, Nets', 'bed,sheet,bed cover, pillow, net', 1, "product"),
(2, 'Shoes', 'Shoes, Rovas, Snickers, Puma, Sport shoes', 'shoes',1, "product"),
(3, 'Grocery','Fresh Fruits.','grocery, fruit',1, "product");

-- DUMP DATA FOR OPTION_GROUPS TABLE
INSERT INTO option_groups(option_group_id, option_group_name)
VALUES(1,'color'),
(2, 'size'),
(3, 'brand'),
(4, 'material');

-- DUMP DATA FOR options table
INSERT INTO options(option_id, option_name)
VALUES(1, 'black'),
(2, 'white'),
(3, 'green'),
(4, 'red'),
(5, 'blue'),
(6, 'pink'),
(7, 'XS'),
(8, 'S'),
(9, 'M'),
(10, 'L'),
(11, 'XL'),
(12, 'XXL'),
(13, '4'),
(14, '5'),
(15, '6'),
(16, '7'),
(17, '8'),
(18, '9'),
(19, '10'),
(20, '11'),
(21, '12'),
(22, '13'),
(23, '14'),
(24, '14+'),
(25, '6 x 4'),
(26, '6 x 5'),
(27, '6 x 6');

-- DUMP DATA FOR gender 
INSERT INTO genders(gender_id, gender_name, gender_tags)
VALUES(1, 'Male', 'male, man, men, boy, guy'),
(2, 'Female', 'female, woman, girl, women'),
(3, 'All', 'male, man, men, boy, guy, female, woman, girl, women');

-- DUMP DATA FOR units TABLE
INSERT INTO units(unit_id, unit_name)
VALUES(1, 'kg'),
(2, 'g'),
(3, 'ml'),
(4, 'l');

-- DUMP DATA for regions table
INSERT INTO regions(region_id, region_name)
VALUES(1, 'Nakuru'),
(2, 'Eldoret'),
(3, 'Nairobi');

-- DUMP DATA FOR order_types
INSERT INTO order_types(type_id, type_name)
VALUES(1, 'Normal'),
(2, 'Drafted Order');

-- DUMP DATA FOR USER_TYPES TABLE
INSERT INTO user_types(type_id, type_name)
VALUES(1, 'customer'),
(2, 'supplier'),
(3, 'shipper'),
(4, 'author'),
(5, 'admin');

-- DUMP DATA FOR users table
INSERT INTO users(user_id, user_name, user_email, user_phone, user_address, user_region_id, user_billing_address, user_shipping_address, user_password, user_verification_code, user_email_verified, user_type_id)
VALUES(1, 'Wachiye Siranjofu', 'siranjofuw@gmail.com','254790983123','Egerton 536',1,'Egerton 536','Egerton 536', md5('user1'),md5('user112'), 1, 1),
(2, 'Wachiye Sirah', 'wachiye@gmail.com','254790983124','Egerton 536',1,'Egerton 536','Egerton 536', md5('user2'),md5('user113'), 0, 1),
(3, 'Mark Jerry', 'mark@gmail.com','254790983125','Egerton 536',1,'Egerton 536','Egerton 536', md5('user3'),md5('user114'), 0, 1),
(4, 'Admin 1', 'admin1@gmail.com','254790983126','Egerton 536',1,'','', md5('user4'),md5('user114'), 1, 5),
(5, 'Shipper1', 'shipper1@gmail.com','254790983127','Egerton 536',1,'','', md5('user5'),md5('user115'), 1, 3),
(6, 'Shipper2', 'shipper2@gmail.com','254790983128','Eldoret 3003',2,'','', md5('user6'),md5('user116'), 1, 3),
(7, 'Supplier1', 'supplier1@gmail.com','254790983129','Nairobi 234',3,'','', md5('user7'),md5('user117'), 1, 2),
(8, 'Supplier2', 'supplier2@gmail.com','254790983130','Nakuru 457',1,'','', md5('user8'),md5('user118'), 1, 2),
(9, 'Supplier3', 'supplier3@gmail.com','254790983131','Nakuru 457',1,'','', md5('user8'),md5('user119'), 1, 2);

-- DUMP DATA FOR suppliers table
INSERT INTO suppliers(supplier_id, supplier_user_id, supplier_company, supplier_product_type, supplier_pay_method, supplier_pay_id)
VALUES(1,7, 'Bata Shoe Company', 'shoes','mpesa','234456'),
(2,8, ' Elson Groceries', 'grocery','mpesa','302123'),
(3,9, ' Prakur Furniture', 'furniture','mpesa','302123');

-- DUMP DATA FOR shippers table
INSERT INTO shippers(shipper_id, shipper_user_id,shipper_company, shipper_product_type, 
shipper_max_weight, shipper_available)
VALUES(1,5, 'Peri Couriers', 'perishable', 2500, 1),
(2,6, 'G4S','all',1000, 1);


-- DUMP DATA FOR products table
INSERT INTO products(product_id, product_name, product_category_id,
 product_short_desc, product_tags, product_purchase_price,
 product_unit_price, product_min_stock, product_stock, product_max_stock,
 product_gender_id, product_supplier_id, product_shipping_hours, 
 product_weight_unit, product_weight, product_slug)
 VALUES(1, 'Nike Shoes for Men', 2, 
 'Nike shoes','nike, shoes, men',1050,
  1200, 20, 50, 100,
   1, 1, 24, 'Kg', 0.8, 'nike-shoes-for-men-1'),
(2, 'Bristol Shoes', 2, 
 'Formal mens black leather safety shoes that are ideal for office and general industry','nike, shoes, men',1050,
  1200, 20, 50, 100,
   1, 1, 24,'Kg', 0.8, 'bristol-shoes-2'),
(3, 'King storage bed', 1, 
 'Wooden King panel bed with 2 smooth-gliding storage drawers with dovetail construction','nike, shoes, men',184500,
  190000, 10, 10, 50,
   3, 3, 48, 'Kg', 10,'king-storage-bed-3');