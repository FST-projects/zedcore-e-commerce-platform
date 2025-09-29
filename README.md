# Zedcore E-Commerce Platform

Zedcore is a full-featured e-commerce web application built with PHP, JavaScript, and CSS. It supports user and admin management, product listings, shopping cart, order processing, chat, and more.

## Features

- User registration, login, and profile management
- Product catalog with search and filtering
- Shopping cart and wishlist functionality
- Order history and invoice generation
- Seller account management and product addition
- Admin panel for managing users, products, orders, and reports
- Chat and support system
- Password reset and email notifications (via PHPMailer)
- Responsive design using Semantic UI, Bootstrap, and custom CSS
- Animations and interactive UI components

## Project Structure

```
├── aboutUs.php
├── accset.php
├── addproduct.php
├── admin.php
├── adminlogin.php
├── adminPasswordReset.php
├── cart.php
├── Chat.php
├── contact.php
├── fotter.php
├── header.php
├── index.php
├── invoice.php
├── loading.php
├── myproduct.php
├── order-history.php
├── pay.php
├── pending-Purchase.php
├── productView.php
├── questionChat.php
├── report.php
├── searchresult.php
├── signin.php
├── style.css
├── tophead.css
├── updateproduct.php
├── wishlist.php
├── Animations/
│   ├── accset.js
│   ├── bootstrap.bundle.js
│   ├── bootstrap.js
│   └── ...
├── database/
│   └── ...
├── homeProcess/
│   └── ...
├── Process/
│   ├── addProduct.js
│   ├── addProductProcess.php
│   ├── admin.js
│   ├── adminAdminSearch.php
│   ├── adminResetSearch.php
│   ├── accSetProcess.php
│   ├── changeOrderStatus.php
│   ├── connection.php
│   ├── myproductProcess.js
│   ├── pay.js
│   ├── PHPMailer.php
│   ├── POP3.php
│   ├── OAuth.php
│   ├── resetPasswordSendProcess.php
│   ├── sendShopAlerts.php
│   ├── SMTP.php
│   ├── upProductProcess.php
│   ├── updateAdminProfile.php
│   ├── updateCategoryContentStatus.php
│   ├── updateCategorySlideImg.php
│   └── wishProcess.js
├── ProductPic/
│   └── ...
├── profilepic/
│   └── ...
├── resourses/
│   └── ...
├── Styles/
│   ├── addproduct.css
│   ├── admin.css
│   ├── cart.css
│   ├── contact.css
│   ├── font-awesome.min.css
│   ├── home.css
│   ├── invoice.css
│   ├── loading.css
│   ├── myproduct.css
│   ├── pending-purchase.css
│   ├── productView.css
│   ├── searchresult.css
│   ├── semantic.min.css
│   ├── signin.css
│   └── wishlist.css
```

## Setup Instructions

1. **Clone the repository**  
   `git clone <your-repo-url>`

2. **Database Setup**  
   - Import the database schema from the `database/` folder.
   - Update `Process/connection.php` with your database credentials.

3. **Configure Email**  
   - Set up SMTP credentials in `Process/SMTP.php` and `Process/PHPMailer.php` for email notifications.

4. **Run the Application**  
   - Place the project in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Access the site via `http://localhost/project/index.php`.

## Dependencies

- PHP 7+
- MySQL/MariaDB
- [Semantic UI](https://semantic-ui.com/)
- [Bootstrap](https://getbootstrap.com/)
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- jQuery

## Notes

- For development, use XAMPP/LAMP/WAMP stack.
- Make sure `ProductPic/` and `profilepic/` folders are writable for image uploads.
- Admin features are accessible via `admin.php` after login.

## License

## License

This project is licensed for **educational and personal use only**. (./LICENSE)
Commercial use, redistribution, or selling of this project or its code is **not permitted**.



