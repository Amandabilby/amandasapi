# amandasapi

For Systemutveckling PHP, Medieinstitutet 10/4-2020


CREATING API FOR E-COMMERCE

The API is made with PHP and SQL. There is an database dump included with testdata. There is a V1 with endpoints, to be able to make 
V2 or more in future if updates are coming.


What you can do with the API:

Userhandler: Create new users, log in as user (admin or user)
Producthandler: Add new products, delete products, update products, list single or all products
Carthandler: Add products to cart, remove products from cart, check out cart


When you log in, a session (token) starts, which is valid for 20 minutes.



Coding style

All functions and names are in camelcase (addToCart, fetchAllCarts etc). Classnames are singular standard ("User, Product, Cart").



Testdata:

Username: Admin
Password: helloadmin
Email: helloadmin@php.com

Username: User
Password: hellouser
Email: hellouser@php.com




Endpoints in V1


Users:

addUser.php
Inserts user to database if username & e-mail is not taken and no fields are empty.

userLogin.php
If no field is empty and user exists in database, you will be logged in.


Products:

addProduct.php
If user is admin, token is valid, no fields are empty - product will be added to database.

deleteProduct.php
Deletes from DB if token and id is not empty.

getAllProducts.php
Show all products if token is valid.

getProducts.php
Show single product if product_id is typed in.

updateProduct.php
If token is valid, update product in database.



Cart

addToCart.php
Add product to cart and DB if no fields are empty and token is vaildated.

checkOutCart.php
Checking out cart, change status in DB to 'checked out' if token is valid.

deleteFromCart.php
Remove product from DB in cart where token is.

getAllCarts.php
Gets all products in cart where the token is set.


