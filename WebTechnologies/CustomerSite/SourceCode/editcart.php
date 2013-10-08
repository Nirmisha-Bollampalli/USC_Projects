<?PHP 
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
    session_destroy();  
    session_unset(); 
    printf("<script>location.href='customer_home_nologin.php'</script>");		
} 
$_SESSION['LAST_ACTIVITY'] = time(); 
include ('connect.php');
$qty='';
$Type = $_GET['Type'];
if($Type!='empty1' && $Type!='empty')
{
$qty=$_GET['ProductQuantity'];
$ProductID=$_GET['ProductID'];
//$Type = $_GET['Type'];	
}


if(!isset($_SESSION['username']))
{
		
		if($Type == 'edit')	
		{
			if($qty == '' or $qty == '0')
			  echo "Please Enter a Proper Value";
			else
			{
				$cart_length = (sizeOf($_SESSION['cart']));
				for ($i = 1 ;$i <= $cart_length;$i++)
				{
				   $cart_item = $_SESSION['cart'][$i];
				  
					  if($cart_item->Productid == $_GET['ProductID'])
					  {
						
						 $cart_item->Quantity = $qty;
						 $_SESSION['cart'][$i] = $cart_item;  
						 echo "Item Updated";
						 exit;
					  }
				}
			 }	
		}
		else if($Type == 'delete')
		{
			$cart_length = (sizeOf($_SESSION['cart']));
				for ($i = 1 ;$i <= $cart_length;$i++)
				{
				   $cart_item = $_SESSION['cart'][$i];
				  
					  if($cart_item->Productid == $_GET['ProductID'])
					  {
						
						 $cart_item->Quantity = 0;
						 $cart_item->Productid =0;
						 $_SESSION['cart'][$i] = $cart_item;  
						 $_SESSION['cartlength'] -= 1;
						 echo "Item Removed";
						 //session_unset();
						
						 exit;
					  }
				}
		}	
		else
		{
		  $cart_length = (sizeOf($_SESSION['cart']));
				for ($i = 1 ;$i <= $cart_length;$i++)
				{
					 $cart_item = $_SESSION['cart'][$i];
					 $cart_item->Quantity = '';
					 $cart_item->Productid ='';
					 $_SESSION['cart'][$i] = $cart_item;  
								
				}
		 $_SESSION['cartlength'] = 0;
		 unset($_SESSION['cart']);
		 echo "Cart Empty";
		}
}
else
{
        $query="select CustomerID from registration where UserName='$_SESSION[username]' ";
		//echo $query;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result); 
		
		 
    if($Type == 'edit')	
		{
			//echo "hello";
			//echo $qty;
			if($qty == '')
			  echo "";
			else
			{
			   $sql_pro_exists = "select ProductID from shopping_cart where ProductID='$_GET[ProductID]' and CustomerID = '$row[CustomerID] '";
              // echo $sql_pro_exists;
              $res_pro_exists = mysql_query($sql_pro_exists);
			  $row2 = mysql_fetch_array($res_pro_exists); 						            
			  $query5 = "select ProductQuantity from shopping_cart where ProductID='$row2[ProductID]' and CustomerID = '$row[CustomerID]'";
			// echo $query5;
			  $result5 = mysql_query($query5);
			  $row5 = mysql_fetch_array($result5);
			  $row5['ProductQuantity'] =$qty; 
			  $qty = $row5['ProductQuantity'] ;
			  $updatecart = "Update shopping_cart set ProductQuantity = '$qty' where ProductID='$row2[ProductID]' and CustomerID = '$row[CustomerID] '";
			 // echo $updatecart;
			  $result4 = mysql_query($updatecart);
			  $query81 = "select * from shopping_cart where CustomerID = '$row[CustomerID] '";
			  $result81 = mysql_query($query81);
				if(mysql_num_rows($result81) > 0)
				{
				  $num1 = mysql_num_rows($result81);
				  $_SESSION['cartlength'] = $num1;
				}
				echo "Item Updated";
			   exit;
		
			}
		
         }
		 else if($Type == 'delete')
		{
		       $sql_pro_exists = "select ProductID from shopping_cart where ProductID='$_GET[ProductID]' and CustomerID = '$row[CustomerID] '";
              // echo $sql_pro_exists;
              $res_pro_exists = mysql_query($sql_pro_exists); 
			  $row2 = mysql_fetch_array($res_pro_exists); 		
			  $query5 = "select ProductQuantity from shopping_cart where ProductID='$row2[ProductID]' and CustomerID = '$row[CustomerID]'";
			 // echo $query5;
			  $result5 = mysql_query($query5);
			  $row5 = mysql_fetch_array($result5);
		      $delete = "Delete from shopping_cart where ProductID='$row2[ProductID]' and CustomerID = '$row[CustomerID]'";
			  //echo $delete;
			  mysql_query($delete);
			  $query81 = "select * from shopping_cart where CustomerID = '$row[CustomerID] '";
			  $result81 = mysql_query($query81);
				if(mysql_num_rows($result81) > 0)
				{
				  $num1 = mysql_num_rows($result81);
				  $_SESSION['cartlength'] = $num1;
				}
				else
				  $_SESSION['cartlength'] = 0;
				echo "Item Deleted";
			   exit;
			  
		}
		else
		{
		     
			  
		      $delete = "Delete from shopping_cart where  CustomerID = '$row[CustomerID]'";
			  //echo $delete;
			  mysql_query($delete);
			  $_SESSION['cartlength'] = 0;
		      unset($_SESSION['cart']);
				echo "Cart Empty";
			   exit;
		}



}
?>