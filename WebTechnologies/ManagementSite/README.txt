Website Description: 
             Website Name : Frosted Fantasies
             Website Purpose : To maintain the administrative part of the website.
             Website Capabilities : 
					?	Add or Delete Or Modify User Information by Administrators
					?	Add or Delete Or Modify Product Information by Sales Managers.
					?	Search or View information by Managers.
Admin Login Credentials:
	UserName: nirmisha
	Password :nirmisha

Admin Functionality:
	Home Button : Shows User credentials.
	User info Button : Shows all user information.
	Add User Button : It is used in adding users.
	Delete User Button : It is used to delete users.
	Update User Button : It can be used to Update Users.
Sales Manager Functionality:
	Category Info Button : Takes the user to the category page where he can add,delete or update categories.
	ProductInfo Button : Takes users to the product page where he can view or add a product.Clicking on view product takes him to a page where he can edit or delete products under a particular category.

SpecialSalesInfo:Lets the user add product to the special sales using Add Product Category Button.The special sales info can also be edited or deleted.

Manager Functionality:
	Search Users : Lets the manager search all the user information.Clicking simply on search will get him all the information about users.
	Search Products :Lets the manager search all the product information based on the provided search criteria. Clicking simply on search will get him all the information about Products.
	Search Special Sales:Lets the manager search the special sales information based on the provided search criteria. Clicking simply on search will get him all the information about Special Sales.

View user Info Button : Lets the manager view all user information.

View Products Button : Lets the manager view information about products and product categories using the View product Category and View Product Buttons.

PHP Script Files (functionality):
            
	loginEx.php :  
	?	Lets users login as Admin or as Sales Managers  or  as Managers.
	?	Starts a session for each user.
    
   	product_category_info.php :
	?	Lets the Sales Manager to add or delete or edit product categories using the subscript Edit_pro_cat.php.

    Product.php:
	?	Lets the sales manager view the Products using Product_view.php,edit the products using Update_Populate_form.php,delete the product using Delete_Product.php and add products using Add_Product.php and uploader.php.
    
	SpecialSales.php:
	?	Lets the sales manager add,delete or edit product under special sales using Edit_Special_Sales.php.
    
	Admin_Home.php : Display his credentials or rights.

	User_Info.php : Displays the user profile information to Admin.

	Add_User.php & Add_User_Data.php : Lets the Admin add a user.

	Update.php &populate_form.php &Update_Data.php : Lets admin update the user information.

	Delete_User.php:Lets admin Delete a user.

	Manager_View_User_Info.php : lets manager view user information.

	Manager_Product_Info.php    :Lets manager view product categories and products using M_product_category_info.php and M_Product.php

	Manager.php : It allows manager to search/view products/specialsales and employees/users(it does an AJAX CALL to searchframe.php to paint the search parameters  depending on user selection(SearchUsers/SearchProduct/Search Special Sales)).It does AJAX CALL to search.php  to paint the search results.     

Database Description:
User Table : Contains User Profile Information.
CREATE TABLE IF NOT EXISTS `user_table` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `PhoneNo` int(11) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Salary` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

Special Sales Table : Contains Special sales Product Information.
CREATE TABLE IF NOT EXISTS `special_sales` (
  `ProductID` int(11) NOT NULL,
  `SpecialSalesID` int(11) NOT NULL AUTO_INCREMENT,
  `Discount` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `ProductImage` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`SpecialSalesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 

Product Category Table : Contains product categories and their descriptions.
CREATE TABLE IF NOT EXISTS `product_category` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductCategory` varchar(200) NOT NULL,
  `ProductDescription` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 .
Product Table : Contains product information.
CREATE TABLE IF NOT EXISTS `cakes` (
  `CategoryID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(100) NOT NULL,
  `ProductQuantity` int(11) NOT NULL,
  `ProductPrice` int(11) NOT NULL,
  `ProductDescription` varchar(500) DEFAULT NULL,
  `ProductImage` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 .

            -----------------------------------------------------------------------------------
