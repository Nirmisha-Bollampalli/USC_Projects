<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
    session_destroy();  
    session_unset(); 
    printf("<script>location.href='customer_home_nologin.php'</script>");		
} 
$_SESSION['LAST_ACTIVITY'] = time(); 
include('connect.php');

$cusid= mysql_query("select CustomerID from registration where UserName='$_SESSION[username]'");
$rowcusid = mysql_fetch_array($cusid);
$get = "select s.DelDate,s.line1,s.line2,s.city,s.state,s.zipcode,s.country from saveorder s where OrderID = (select max(OrderID) from saveorder where CustomerID='$rowcusid[CustomerID]')";

$getex = mysql_query($get);
$getex1 = mysql_fetch_array($getex);
//echo $getex1['DelDate'];
$DelDate = $getex1['DelDate'];
$get1 = "select ProductID,ProductQuantity,ProductPrice from order_product where OrderID = (select max(OrderID) from saveorder where CustomerID='$rowcusid[CustomerID]')";
//echo $get1;
$get1ex = mysql_query($get1);
//$get1ex1 = mysql_fetch_array($get1ex);
$totalprice = '';
$outputtable = "<table style='border : 1px solid black'><TR><TD width='100px'>Product</TD><TD width='100px'>Quantity</TD><TD>Price Per Product</TD>" ;
while($get1ex1 = mysql_fetch_array($get1ex))
{
  
  $ProductID = $get1ex1['ProductID'];
 // echo $ProductID;
  $ProductQuantity = $get1ex1['ProductQuantity'];
  $ProductPrice = $get1ex1['ProductPrice'];
  $totalprice += $ProductQuantity * $ProductPrice ; 
  
  $Image = "select ProductImage from cakes c where ProductID='$ProductID'";
  $eximage = mysql_query($Image);
  $eximage1 = mysql_fetch_array($eximage);
  $outputtable .= "<TR><TD><img src='". $eximage1['ProductImage']."'/></TD><TD>".$ProductQuantity."</TD><TD>".$ProductPrice."</TD></TR>"  ;
 }
 $outputtable .= " </Table>";
  $outputtable .= "<TABLE><TR><TD> <p style='color:blue;font-size:15px'>Total Price:</p></TD> <TD>".$totalprice."$</TD></TR></Table>";
 $outputtable .= "<Table><TR> <TD><input style='color:blue' type='button' name='view'  value='Ok' onclick='show()' /></TR></table>";
unset( $_SESSION['orderid']);
?>
<html>
<head>
<script type="text/javascript">
function show()
{
  window.location = 'customer_home_login.php';
}
</script>
</head>
<body Background="Temp.png">
<div style="position:absolute;left:6.5in;top:1.8in;height:0in;width:10in;display:block;">
        <table > <tr><td><p style="color:blue;font-size:20px">Order Summary</p></td></tr></table>  
</div>	
<div style="position:absolute;left:3in;top:5in;height:0in;width:10in;display:block;">
  <?PHP echo $outputtable?>
</div>
<div style="position:absolute;left:3in;top:4.5in;height:0in;width:10in;display:block;">
  <table sty1e='background-color:Grey'>
   <TR><TD><p style="color:blue;font-size:14px">Your Product Details :</p></TD></TR> 
  </table>
</div>
<div style="position:absolute;left:3in;top:2.4in;height:0in;width:10in;display:block;">
  <table sty1e='background-color:Grey'>
  <TR><TD><p style="color:blue;font-size:14px">Your Delivery Date:</p></TD> <TD><?PHP echo $DelDate?></TD></TR>
  <TR><TD><p style="color:blue;font-size:14px">Your Billing Address :</p></TD></TR> 
  </table>
</div>
<div style="position:absolute;left:3in;top:2.9in;height:0in;width:10in;display:block;">
					 <TABLE style="border:0 solid grey;">
					            <TR>
                                      
									  <TD><?PHP echo $getex1['line1']?></TD> 
									  
							   </TR>
									  
                                <TR>  
									 <TD><?PHP echo $getex1['line2']?></TD>
     							 </TR>
                                <TR> 
								    <TD><?PHP echo $getex1['city']?></TD>
								</TR> 
                                <TR> 
                                    <TD><?PHP echo $getex1['state']?></TD> 
								</TR> 
                                <TR> 
								   <TD><?PHP echo $getex1['country']?></TD>
								</TR>
                                <TR> 
								   <TD><?PHP echo $getex1['zipcode']?></TD>
								</TR>
					 </TABLE>
					 

</div>
</body>
</html>