# Shopping Cart Web Application
This project involves adding dynamic functionalities to a web page by integrating JavaScript and HTML knowledge from previous exercises with PHP. The application uses PHP, MySQL, JavaScript, HTML, and CSS, running on a local server environment provided by XAMPP.

## Getting Started with PHP, MySQL, JavaScript, HTML, and CSS Using XAMPP
To set up your development environment and start working with PHP, MySQL, and front-end technologies, follow these steps:
1. Download and install XAMPP from the official website.
2. Launch XAMPP and start the Apache and MySQL services.
3. Create a new project folder inside the htdocs directory located in the XAMPP installation folder.

## Integrating PHP, MySQL, and HTML
To build a dynamic web application, you can follow this workflow:
1. Create an HTML file in your project folder and add your HTML and CSS code.
2. Create a JavaScript file in your project folder and add your JavaScript code.
3. Create a PHP file in your project folder and add your PHP code.
4. In your PHP file, connect to the MySQL database using the mysqli_connect() function.
5. Write SQL queries to interact with your MySQL database using the mysqli_query() function.
6. Use PHP to generate dynamic content on your web page by querying the database and outputting the results.

## Suggested Project Structure
shoppingcart/
│
├── functions.php       # Contains all necessary functions for the shopping cart system (template header, footer, and database connection functions)
├── index.php           # Main template file with header, footer, and basic routing to include other pages
├── home.php            # Homepage featuring a highlighted image and 4 recently added products
├── products.php        # Displays all products with basic pagination
├── product.php         # Shows a single product (based on GET request) with a form to change quantity and add to cart
├── cart.php            # Shopping cart page listing all added products with quantities, total prices, and subtotals
├── placeorder.php      # Confirmation page displayed after order submission
├── admin.php           # Admin login page
├── dashboard.php       # Admin dashboard interface
├── style.css           # Stylesheet for the shopping cart website
└── imgs/               # Folder containing all images for the shopping cart system (featured images, product images, etc.)

## Shopping Cart Application Features and Instructions

- [x] **Admin Functionality - File: `admin.php`**  
  **Admin login:**  
  - Email: [admin@admin.com](mailto:admin@admin.com)  
  - Password: admin123

  - The administrator must log in to the page (predefined credentials must exist in the database as specified above).
  - After successful login, the admin is redirected to the admin interface at **/dashboard.php**, which contains a menu: Home, Products, Orders, and Logout.

  - [x] If the admin closes the page and later revisits the dashboard URL, they are automatically logged in as long as the active cookie persists.
  - The admin must not be able to access the dashboard URL without prior authentication.
  - The admin password in the database must be encrypted (MD5 or SHA256).

- [x] **Product Management in Dashboard**

  - When the admin clicks **Products** in the menu, a list of all currently created products (if any) is displayed, showing the product image, name, price, and available quantity. Products are fetched from the database table.
  - When the admin selects the option to add a product (by clicking "Add New Product"), a new page opens for entering product details. The admin confirms the entry by clicking the confirmation button.
  - After confirmation, the admin is returned to the previous page where the new product appears in the product list.
  - If a user or admin visits the homepage, the newly added product is shown in the "New Arrivals" section (products are dynamically fetched from the database).

  - [x] If there are products in the "Products" interface, the admin can click the "Update Product" button, which leads to a new interface (similar to adding a product) but with pre-filled information from the database.
    - [x] The first option is to confirm and update the product information, after which the admin returns to the previous page and sees the updated data.
    - [x] The second option is to delete the product by clicking the "Delete Product" button, after which the admin returns to the previous page and the deleted product is no longer displayed.
    - (Note: All changes in the product section must be immediately reflected on the homepage product display.)

- [x] **User Cart Functionalities**

  - The user can add items to the cart by clicking the buy button, remove items from the cart, and see the total price. Adding multiple quantities of the same item is supported.
    - [x] When the user adds products to the minicart and clicks "Buy Now," they are redirected to the cart page where all details are shown (name, price, quantity, etc.).
    - In addition to the cart display, the user also has an order form and a summary of the total order price with a large "Confirm Purchase" button.
    - The purchase button is disabled until all form fields are validated and completed.

    - [x] When the user fills in all required data and clicks the order button:
      - If the requested product quantities are in stock, the user is redirected to a success page where the order details are displayed.
      - If there are not enough products in stock, a message is shown on the cart page indicating that the requested quantity is unavailable.
      - After each order, the available quantity (QTY) of ordered products must be decreased accordingly (test and verify in the "Products" section).

- [x] **Cart Purchase Functionality**

  - The purchase process displays a message confirming a successful purchase and automatically empties the cart.
  - Prevent purchases from an empty cart and similar edge cases.
  - The cart button dynamically displays the number of items in the cart.

- [x] **Order Management (Admin)**

  - After a user places an order, the administrator can view the order in the "Orders" section of the dashboard.
  - Customer information is displayed (name, surname, phone, address, etc.) and ordered products are shown in text format under the appropriate column, e.g.:  
    - 1x Banana, 2x Apples, Total Price: xxxx
