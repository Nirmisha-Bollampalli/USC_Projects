Login Credentials : Please Register to login.
Browser Compatibility : Google Chrome

Home Page : customer_home_nologin.php.

	Purpose    :  
	->  This login page is displayed before the user logs in.Session starts here and session timeout also redirects the user to this page.
	-> From this page user can access the following php’s
                    -> signup.php : lets the user sign into his account.
					->reset_pass.php : Lets the user view his username and password                after he provides answer for his security question and his email ID.
					->register.php :Lets the user register to the site if he has already not  registered.An ajax call will be made to checkuname.php to check if the username entered exists or not,if it does then it says UserName exists and the username textbox is cleared if it doednot the username textbox retains its value.
					-> product_display.php : This php is displayed when the Regular sale button is clicked .Inside this page left panel contains buttons to choose a specific category.Clicking on any of these buttons will take the user to category_product_display.php.This page displays specials sales in that particular category on top and products on regular and special sale at the bottom.
					->sale_product_display.php : This php is displayed when Special Sale Button is Clicked.Inside the page left panel contains buttons to choose a specific category.Clicking on any of these buttons will take the user to  sale_category_display.php.This page displays special sales in that particular category if any.

Shopping Cart :
        ->When the user views products  he’ll have a link at the top that displays the number of items in his shopping cart  and  if he clicks on that link he’ll be taken to viewcart.php.This page lets him view the items he had added to his cart,edit the quantity of a particular item or delete a particular item or empty the entire cart.
        ->When the user is not logged in ,his items in cart will be stored in his session.Once he logs in his items in session will get added to his cart in database and once  he checks out and places his order his items will be deleted from the shopping cart in the database and the ordered items will get stored in order_product table in the database and his order details like orderID and delivery Date will get stored in saveorder table.
 
Check Out :
		->If the user in not logged in ,then clicking on checkout link will take him to the sign in page ,where he has options to either sign in or register.Once he sign’s in he will be taken to the viewcart.php where he can view all his ordered items and finalize his checkout.
		->If the user has no items in his shopping cart then the user will be taken to empty.php where he will be prompted that his cart is empty.

MyOrders:
		->When the user logs in he will have an option to view all his orders using the Myorders link displayed at the top panel.Clicking on myorders will take the user to myorders.php.In this page his orders will be listed in the order of his order date.Clicking on view order  button will take him to showmyorders.php where he can view the details of a particular order he clicked on.
MyProfile:
		->When the user logs in he will have an option to view or edit his profile including the password using the Myprofile link at the top panel.Clicking on this link will take him to myprofile.php .

Add to Cart:
        ->When the user clicks on add to cart button while viewing the products an ajax request will be made to addtocart.php and the item will be added to shopping cart session if the user is not logged in or to the shopping cart in the database if the user has logged in.
        ->After the item gets added to cart the user will be taken to extracredit.php page where he can view the item he currently added to cart and also the items other customers bought along with this item in their orders.
		
Edit Cart:
		->When the user is in viewcart.php,and when he tries to edit the quantity or delete the item or empty cart ,all these actions are made possible by making an ajax request from viewcart.php to editcart.php.

details.php & details2.php :
        ->Clicking on image links displayed in category_product_display.php takes the user to details.php where he can view the full description of the product.Clicking on image links in extracredit.php will take the user to the details2.php page to view the description of the product.
session.php & connect.php  : 
	   ->session.php checks if the session has been set for a particular user or not .If the session is not set then the user will be redirected to customer_home_nologin.php .connect.php  is used in other php’s to fetch or insert or update files in the database.
                        
Database Reference:
Tables:
?	shopping_cart(  CustomerID  int(11) NOT NULL,  ProductID int(11) NOT  NULL,  ProductQuantity  int(11) NOT NULL )      
?	order_product (  OrderID  int(11) NOT NULL, ProductID  int(11) NOT NULL,  ProductQuantity  int(11) NOT NULL, ProductPrice  int(11) NOT NULL,  SpecialSalesID  int(11) NOT NULL)
?	registration ( CustomerID int(11) NOT NULL AUTO_INCREMENT,
  EmailID  varchar(500) DEFAULT NULL,FirstName  varchar(100) DEFAULT NULL,  LastName  varchar(100) DEFAULT NULL, line1  varchar(10000) DEFAULT NULL,  line2  varchar(10000) DEFAULT NULL,city  varchar(10000) DEFAULT NULL,  state  varchar(10000) DEFAULT NULL,country   varchar(10000) DEFAULT NULL,  zipcode  int(11) DEFAULT NULL,ContactNumber  varchar(20) DEFAULT NULL, UserName varchar(500) NOT NULL, Password varchar(500) NOT NULL,   question varchar(1000) NOT NULL, answer  varchar(1000) NOT NULL,  PRIMARY KEY (`CustomerID`))
?	saveorder( CustomerID  int(11) NOT NULL, OrderID  int(11) NOT NULL AUTO_INCREMENT, OrderDate  date NOT NULL, DelDate  date NOT NULL,  line1  mediumtext NOT NULL, line2  mediumtext NOT NULL,city  mediumtext NOT NULL, state mediumtext NOT NULL, country longtext NOT NULL,   zipcode  int(11) NOT NULL,  PRIMARY KEY  OrderID)
     
