# amandasapi

For Systemutveckling PHP, Medieinstitutet 10/4-2020
<br><br>

<h2>CREATING API FOR E-COMMERCE</h2>
<br><br>

The API is made with PHP and SQL. There is an database dump included with testdata. There is a V1 with endpoints, to be able to make 
V2 or more in future if updates are coming.
<br><br>

<h4>What you can do with the API:</h4>

Userhandler: Create new users, log in as user (admin or user)
Producthandler: Add new products, delete products, update products, list single or all products
Carthandler: Add products to cart, remove products from cart, check out cart


When you log in, a session (token) starts, which is valid for 20 minutes.


<br><br>

<h4>Coding style</h4>

All functions and names are in camelcase (addToCart, fetchAllCarts etc). Classnames are singular standard ("User, Product, Cart").

<br><br>


<h4>Testdata:</h4>

Username: Admin<br>
Password: helloadmin<br>
Email: helloadmin@php.com<br>

Username: User<br>
Password: hellouser<br>
Email: hellouser@php.com

<br><br>



<H4>Endpoints in V1</h4>
<br>


Users:

addUser.php<br>
Inserts user to database if username & e-mail is not taken and no fields are empty.

userLogin.php<br>
If no field is empty and user exists in database, you will be logged in.

<br><br>

Products:

addProduct.php<br>
If user is admin, token is valid, no fields are empty - product will be added to database.

deleteProduct.php<br>
Deletes from DB if token and id is not empty.

getAllProducts.php<br>
Show all products if token is valid.

getProducts.php<br>
Show single product if product_id is typed in.

updateProduct.php<br>
If token is valid, update product in database.

<br><br>


Cart

addToCart.php<br>
Add product to cart and DB if no fields are empty and token is vaildated.

checkOutCart.php<br>
Checking out cart, change status in DB to 'checked out' if token is valid.

deleteFromCart.php<br>
Remove product from DB in cart where token is.

getAllCarts.php<br>
Gets all products in cart where the token is set.


