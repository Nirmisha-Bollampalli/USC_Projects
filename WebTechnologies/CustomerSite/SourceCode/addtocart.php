<?PHP
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
    session_destroy();  
    session_unset(); 
    printf("<script>location.href='customer_home_nologin.php'</script>");		
} 
$_SESSION['LAST_ACTIVITY'] = time(); 
include('connect.php');
$qty='';
$qty=$_GET['ProductQuantity'];
if($qty == '0')
{

  $qty = '1';
}
$item->Productid = $_GET['ProductID'];
$item->Quantity = $_GET['ProductQuantity'];
$cart_length ='';
if(!isset($_SESSION['username']))
{
if(isset($_SESSION['cart']))
{
 //echo "cart session";
$cart_length = (sizeOf($_SESSION['cart']));

for ($i = 1 ;$i <= $cart_length;$i++)
{
   $cart_item = $_SESSION['cart'][$i];
  
  if($cart_item->Productid == $item->Productid)
  {
       
      $item->Quantity  = $item->Quantity + $cart_item->Quantity;
	  $_SESSION['cart'][$i] = $item;
	   
	    for ($i = 1 ;$i <= $cart_length;$i++)
		{
		$p = $_SESSION['cart'][$i];
			//print_r($p);
			

		}
		echo $cart_length;
		$qty =  $item->Quantity;
		$_SESSION['cartlength'] = $cart_length;
		$_SESSION['currentPID'] =$_GET['ProductID'];
        $_SESSION['currentQTY'] = $qty;
	exit;
	 
  }
 
}
 $cart_length = (sizeOf($_SESSION['cart']))+1;
 $_SESSION['cart'][$cart_length] = $item;
//  echo $_SESSION['cart'][$cart_length];

}
else
{
 //echo $cart_length;
 $cart_length =1;
 $_SESSION['cart'][$cart_length] = $item;

}
}

for ($i = 1 ;$i <= $cart_length;$i++)
{
$p = $_SESSION['cart'][$i];
	//print_r($p);
	

}
$_SESSION['cartlength'] = $cart_length;

if(isset($_SESSION['username']))
{
   //echo "user session";
 // echo "<script type='text/javascript'>alert('hello');</script>";
  $queryCID="select CustomerID from registration where UserName='$_SESSION[username]' ";

	$resultCID = mysql_query($queryCID);
	$rowCID = mysql_fetch_array($resultCID);
  $sql_pro_exists = "select ProductID from shopping_cart where ProductID='$_GET[ProductID]' and CustomerID = '$rowCID[CustomerID] '";
 // echo $sql_pro_exists;
  $res_pro_exists = mysql_query($sql_pro_exists);
  if( mysql_num_rows($res_pro_exists) > 0)
  {
		
		$row2 = mysql_fetch_array($res_pro_exists); 						            
		$query5 = "select ProductQuantity from shopping_cart where ProductID='$row2[ProductID]' and CustomerID = '$rowCID[CustomerID]'";
		// echo $query5;
		 $result5 = mysql_query($query5);
		 $row5 = mysql_fetch_array($result5);
		 $qty = $qty+$row5['ProductQuantity'];
		// echo "quantity:".$qty;
		 $query4 = "Update shopping_cart set ProductQuantity = '$qty' where ProductID='$row2[ProductID]' and CustomerID = '$rowCID[CustomerID] '";
		 echo $query4;"Update1";
		 $result4 = mysql_query($query4);
		 $query81 = "select * from shopping_cart where CustomerID = '$rowCID[CustomerID] '";
		//echo $query3;
		$result81 = mysql_query($query81);
		if(mysql_num_rows($result81) > 0)
		{
		  $num1 = mysql_num_rows($result81);
		  $_SESSION['cartlength'] = $num1;
		}
		
  }  
  else
  {
         $query="select CustomerID from registration where UserName='$_SESSION[username]' ";
		//echo $query;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
        $query1 = "Insert into shopping_cart values('$row[CustomerID]','$_GET[ProductID]','$qty')";
		$result1 = mysql_query($query1);
		//echo $query1;
		$query8 = "select * from shopping_cart where CustomerID = '$rowCID[CustomerID] '";
		//echo $query3;
		$result8 = mysql_query($query8);
		if(mysql_num_rows($result8) > 0)
		{
		  $num = mysql_num_rows($result8);
		  $_SESSION['cartlength'] = $num;
		}
        $ProductID = $_SESSION['currentPID'];
        $Quantity = $_SESSION['currentQTY'];
		
  }

}
//echo $_GET['ProductID'];
//echo $_GET['Quantity'];
$_SESSION['currentPID'] =$_GET['ProductID'];
$_SESSION['currentQTY'] =$qty;


?>
