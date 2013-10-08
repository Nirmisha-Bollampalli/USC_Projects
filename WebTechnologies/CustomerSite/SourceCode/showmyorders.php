<?PHP
include ('session.php');
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
			session_destroy();  
			session_unset(); 
            printf("<script>location.href='customer_home_nologin.php'</script>");					
			} 
			$_SESSION['LAST_ACTIVITY'] = time(); 
 if(isset($_GET['pn']))
	{
	  $pn = $_GET['pn'];
	  
	}
	else
	{
	  $pn =0;
	}
 $nologinvar ='';
 if(isset($_SESSION['cartlength']))
{
  $cartlength = $_SESSION['cartlength'];
}
else
  $cartlength = 0;
if (isset($_SESSION['username']))
{
	        $nologinvar  .= "<TABLE>";
			$nologinvar	 .= "<TR>";
			$nologinvar	 .= "<TD width='350px' > <p style='color:white'>";
			$nologinvar	 .=  "Welcome";
			$nologinvar	 .=  $_SESSION['firstname'] .' '.$_SESSION['lastname']; 
			$nologinvar	 .= "&nbsp; <a href='customer_home_nologin.php?action=logout' style='color:white'> [Logout] </a> </p></TD>";
            $nologinvar	 .=	"<TD width='80px'><a href='customer_home_login.php'><p style='color:white'><u>MyHome</u></p></a></TD>";
			$nologinvar	 .=	 "<TD width='80px'><a href='myorders.php'><p style='color:white'><u>MyOrders</u></p></a></TD>";
			$nologinvar	 .=	"<TD width='80px' ><a href='myprofile.php'><p style='color:white'><u>MyProfile</u></p></a></TD>";
			$nologinvar	 .=	 "<TD width='120px'><a href='viewcart.php'><p style='color:white'><u>ShoppingCart[".$cartlength."]</u></p></a></TD>";
			$nologinvar	 .=	 "<TD><a href='checkout.php'><p style='color:white'><u>CheckOut</u></p></a></TD></TR>";
			
			$nologinvar	 .=	" </TABLE>";
}

else
{
            
			$nologinvar  .= "<TABLE>";
			$nologinvar	 .= "<TR><TD width='381.5px' ></TD>";
			$nologinvar	 .= "<TD width='60px' ><a href='customer_home_nologin.php'><p style='color:white'><u>Home</u></p></a></TD>";
			$nologinvar	 .= "<TD width='60px' ><a href='signup.php'><p style='color:white'><u>Sign In</u></p></a></TD>";
			$nologinvar	 .=	 "<TD width='60px'><a href='register.php'><p style='color:white'><u>Register</u></p></a></TD>";
			$nologinvar	 .=	 "<TD><a href='viewcart.php'><p style='color:white'><u>ShoppingCart[".$cartlength."]</u></p></a></TD></TR>";
			$nologinvar	 .=	" </TABLE>";


}
	

	
	include('connect.php');
    $orderop ='';
    $OrderID = $_GET['id'];
    $cusid= mysql_query("select CustomerID from registration where UserName='$_SESSION[username]'");
	$rowcusid = mysql_fetch_array($cusid);
    $query="select * from saveorder where CustomerID = '$rowcusid[CustomerID]' and OrderID = '$OrderID'";
	$result=mysql_query($query);
    $sql = "select * from order_product where OrderID = '$OrderID' ";
 
    $sqlex = mysql_query($sql);
    
    $totalprice = '';
  
	$array = mysql_fetch_array($result);  
    $orderop .= "<table>";
   	$orderop .= "<tr><td><p style='color:blue;font-size:15px'>Order Date :</p></td><td>". $array['OrderDate']."</td></tr>";
    $orderop .= "<tr><td><p style='color:blue;font-size:15px'>Delivery Date :</p></td><td>". $array['DelDate']."</td></tr>";
	
	
	$orderop .= "<table style='border : 1px solid black'><TR><TD width='100px'>Product</TD><TD width='100px'>Quantity</TD><TD>Price Per Product</TD>" ;
	while($sqlex1 = mysql_fetch_array($sqlex))
	{
	  
	  $ProductID = $sqlex1['ProductID'];
	  $ProductQuantity = $sqlex1['ProductQuantity'];
	  $ProductPrice = $sqlex1['ProductPrice'];
	  $totalprice += $ProductQuantity * $ProductPrice ; 
	  
	  $Image = "select ProductImage from cakes c where ProductID='$ProductID'";
	  $eximage = mysql_query($Image);
	  $eximage1 = mysql_fetch_array($eximage);
	  $orderop .= "<TR><TD><img src='". $eximage1['ProductImage']."'/></TD><TD>".$ProductQuantity."</TD><TD>".$ProductPrice."$</TD></TR>"  ;
	 }
	 $orderop .= "<TR> <TD><input style='color:blue' type='button' name='view'  value='Back to Orders' onclick='show(".$pn.")' /></TD></TR></Table>";
     $orderop .= "<TABLE><TR><TD> <p style='color:blue;font-size:15px'>Total Price:</p></TD> <TD>".$totalprice."$</TD></TR></Table>";
      
?>

<html>
<head>
<script type="text/javascript">

function show(b)
{
  var b =b;
  window.location = "myorders.php?pn="+b;
}
</script>
</head>
<body background='Temp.png'>

     <div style="position:absolute;left:5.7in;top:0in;height:0in;width:10in;display:block;">
				<?PHP echo $nologinvar ?>	
	</div> 
    <div style="position:absolute;left:5in;top:1.8in;height:0in;width:10in;display:block;">
        <table > <tr><td><p style="color:blue;font-size:20px">Your Order Details</p></td></tr></table>  
	</div>	
    <div id="div1" style="position:absolute;left:3.8in;top:2.3in;height:0in;width:10in;display:block;">  
		
        <?PHP echo $orderop?>		
    </div>
	<div  style="position:absolute;left:3.8in;top:4.5in;height:0in;width:10in;display:block;">  
	   		
    </div>



</body>
</html>