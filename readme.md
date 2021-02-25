# E-COMMERCE WEBSITE REST API

> E-Commerce website REST API built in PHP and MySQL(PDO)

<hr>

## Table of Contents

1. [About this API](#about)
2. [Definitions](#definitions)
3. [Authors & Contributors](#authors)
4. [Languages Used](#languages)
5. [List of Figures](#figures)
6. [API Folder Structure](#structure)
7. [Base URL](#base_url)
8. [Endpoints](#endpoints)
    - [Users](#users)
    - [Products](#products)
    - [Orders](#orders)
    - [Categories](#categories)
    - [Payments](#payments)
    - [Authentication](#authentication)
9. [Getting Started](#getting_started)
10. [Appendix](#appendix)

<a id="about"></a>

## About this API

<a id="definitions"></a>

## Definitions

<a id="authors"></a>

## Authors & Contributors

* Wachiye Jeremiah Siranjofu <siranjofuw@gmail.com>
<a id="languages"></a>

## Languages and Tools Used

- PHP
- MySQL

<a id="figures"></a>

## List of Figures

<a id="structure"></a>

## Folder Structure

> The following is the folder structure as used by this api


<a id="base_url"></a>

## Base URL

    http://localhost/e-commerce/api/

<a id="endpoints"></a>

## Endpoints

<a name="users"></a>

### Users

> Allows CRUD operation on users. Users are of five categories: ***customers***, ***suppliers***, ***shippers***, ***authors***, and ***admins***.

#### User Parameters
s
#### User Endpoints

<a name="products"></a>

### Products

#### Product Parameters

#### Product Endpoints

<a name="orders"></a>

### Orders

#### Order Parameters

#### Order Endpoints

<a name="categories"></a>

### Categories

#### Category Parameters

#### Category Endpoints

<a name="payments"></a>

### Payments

#### Payment Parameters

#### Payment Endpoints

<a id="getting_started"></a>

## Getting Started

<a id="appendix"></a>

## Appendix

### Response Codes

- 200 : Ok
- 400 : Bad Request
- 401 : Unauthorized
- 404 : Not Found
- 500 : Unknown Server Error
- 503 : Service Not Available

### API ERRORS

- DB_CONNECT_ERR : occurs when database connection fails
- CREATE_{X}_ERR : occurs when there was an error creating object X
- INCOMPLETE_DATA : occurs when some required fields are missing during object creating
- UPDATE_{X}_ERR : occurs when there was an error updating object X
- DELETE_{X}_ERR : occurs when there was an error deleting object X
- NULL_DATA : occurs when no data was returned from the database
- BAD_REQUEST_METHOD : occurs when a different request method is received by a particular endpoint

### Success Response Format

```json
{
    "data":[],
    "error":null,
    "message":"X created successfully",
    "success":true,
    "x_id":"holds the last inserted id of object x if on creation"
}
```

### Error Response Format

```json
{
    "error":"DB_CONNECT_ERR",
    "message":"Could not connect to the database",
    "success":false,
}
```

### Sample Data Outputs

#### (GET) : `http://localhost/e-commerce/api/`
