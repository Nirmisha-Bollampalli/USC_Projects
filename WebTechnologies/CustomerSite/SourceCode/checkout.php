<?PHP

session_start();
//echo $_SESSION['LAST_ACTIVITY'];
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
    session_destroy();  
    session_unset();   
   // printf("<script>alert('time out');</script>");	
	 printf("<script>location.href='customer_home_nologin.php'</script>");
} 
$_SESSION['LAST_ACTIVITY'] = time(); 


include ("connect.php");
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
	

     $line1 = '';
	  $line2 = '';
	  $city ='';
	  $state = '';
	  $country = '';
	  $zipcode = '';
    $line11 = '';
	  $line22 = '';
	  $city1 ='';
	  $state1 = '';
	  $country1 = '';
	  $zipcode1 = '';
    $email ='';
	$erroremail ='';
	$parenterror='';
	$question ='';
	$errornumber='';
	$question='';
	$number ='';
	$errorEmpty = "";
	$errorNumeric = "";
	$errorEmpty1 = "";
	$errorEmpty2 = "";
	$cardnumber='';
	$codenumber ='';
	$errorline='';
	$errorcode = "";
	$errorcard = "";
	$error='';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$line11 = $_POST['line11'];
	$line22 = $_POST['line22'];
	$city1 = $_POST['city1'];
	$state1 = $_POST['state1'];
	$country1 = $_POST['country1'];
	$zipcode1 = $_POST['zipcode1'];
	$email = $_POST['email'];
	$number = $_POST['number'];
	$line1 = $_POST['line1'];
	$line2 = $_POST['line2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$zipcode = $_POST['zipcode'];
	$cardnumber = $_POST['cardnumber'];
	$codenumber = $_POST['codenumber'];
	
	if(!is_numeric($cardnumber))
	{
	  $errorcard = "*";
	  $error='*';
	}
	if((strlen($cardnumber) < 16))
	{
	  $errorcard = "*";
	  $error='*';
	}
	if(!is_numeric($codenumber))
	{
	  $errorcode = "*";
	  $error='*';
	}
	if((strlen($codenumber) < 3))
	{
	  $errorcode = "*";
	  $error='*';
	}
	if(empty($line11))
	{
	  $errorline = "*";
	  $error='*';
	}
	if(is_numeric($state1) || empty($state1) )
	{
	  $errorEmpty = "*";
	  $error='*';
	}
	if( is_numeric($city1) || empty($city1))
	{
	  $errorEmpty1 = "*";
	  $error='*';
	}
	if(is_numeric($country1) || empty($country1))
	{
	  $errorEmpty2 = "*";
	  $error='*';
	}
	if(!is_numeric($zipcode1))
	{
	  $errorNumeric = "*";
	  $error='*';
	}
    if((strlen($zipcode1) < 5))
	{
	  $errorNumeric = "*";
	  $error='*';
	}
	
	if(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/i",$email))
	{
	    $erroremail = "*";
	    $error='*';
	}
	if(!preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $number) ) 
	{
	    $errornumber ="*";   
        $error='*';		
    }
	if($error == '')
	{
       include ("connect.php");
	  $orderdate = date('Y-m-d');
	  $date = strtotime(date("Y-m-d", strtotime($orderdate)) . " +1 month");
      $deldate = date('Y-m-d', $date);
	  
	  $cusid= mysql_query("select CustomerID from registration where UserName='$_SESSION[username]'");
      $rowcusid = mysql_fetch_array($cusid);
	  
	  $orderquery = "INSERT INTO saveorder VALUES ('$rowcusid[CustomerID]',  '',  '$orderdate',  '$deldate','$line11','$line22','$city1','$state1','$country1','$zipcode1')";
	
		

		
	  $orderqueryex = mysql_query($orderquery);
	  //echo $orderquery;
	  if($orderqueryex)
	  {
	   
	   $sql = '';
		$sql = $sql."INSERT INTO order_product SELECT (Select Max(OrderID) FROM saveorder WHERE CustomerId = ". $rowcusid['CustomerID'] .") OrderId, C.ProductID, C.ProductQuantity , ";
		$sql = $sql."CASE  WHEN Discount IS NULL THEN ProductPrice ELSE ProductPrice - (ProductPrice * Discount/100) END Dicounted_price, S.SpecialSalesID ";
		$sql = $sql."FROM shopping_cart C INNER JOIN cakes P ON P.ProductID = C.ProductID LEFT JOIN special_sales S On S.ProductID = C.ProductID ";
		$sql = $sql."WHERE CustomerID = " .$rowcusid['CustomerID'];
	   //echo $sql;
	   $return = mysql_query($sql);
	    
	  }
	  $emptycart ="Delete from shopping_cart where CustomerID = '$rowcusid[CustomerID]'";
      $execute = mysql_query($emptycart);	
	  $_SESSION['cartlength'] =0;
	  unset($_SESSION['cart']);
	 
   	  printf("<script>location.href='ordersummary.php'</script>");
	}
	
	
}
else
{

 $line1 = '';
  $line2 = '';
  $city ='';
  $state = '';
  $country = '';
  $zipcode = '';
if(isset($_SESSION['username']))
{

$CID = mysql_query("select CustomerID from registration where UserName='$_SESSION[username]'");
$row = mysql_fetch_array($CID);
$shopcart = "select * from shopping_cart where CustomerID='$row[CustomerID]' ";
//echo $shopcart;
$rowshopcart = mysql_query($shopcart);
	if(mysql_num_rows($rowshopcart) > 0)
	{

			$populate = "select line1,line2,city,state,country,zipcode from registration where CustomerID='$row[CustomerID]'" ;
			$row2 = mysql_query($populate);
			
			if(mysql_num_rows($row2) > 0)
			{
			  
			  $row3 = mysql_fetch_array($row2);
			  
			  $line1 = $row3['line1'];
			  $line2 = $row3['line2'];
			  $city = $row3['city'];
			  $state = $row3['state'];
			  $country = $row3['country'];
			  $zipcode = $row3['zipcode'];
			  

			}
			 
	}
		else
		{
		  printf("<script>location.href='empty.php'</script>");
		 
		}
}
else
{
    $_SESSION['redirect'] = '1';
	printf("<script>location.href='signup.php'</script>");
	
}	
}

?>
<html>
<head>
<script type="text/javascript">
function check()
{
  
  var use = document.f1.use;
  if(use.checked)
  {
   
   var line1 = document.f1.line1.value;
   document.f1.line11.value= line1;
   var line2 = document.f1.line2.value;
   document.f1.line22.value= line1;
   var city =document.f1.city.value;
   document.f1.city1.value = city;
   var country =document.f1.country.value;
   document.f1.country1.value = country;
   var state = document.f1.state.value;
   document.f1.state1.value = state;
   var zipcode = document.f1.zipcode.value;
   document.f1.zipcode1.value = zipcode;
  }
  else
  {
    var line1 = document.f1.line1.value;
   document.f1.line11.value= '';
   var line2 = document.f1.line2.value;
   document.f1.line22.value= '';
   var city =document.f1.city.value;
   document.f1.city1.value = '';
   var country =document.f1.country.value;
   document.f1.country1.value = '';
   var state = document.f1.state.value;
   document.f1.state1.value = '';
   var zipcode = document.f1.zipcode.value;
   document.f1.zipcode1.value = '';
  
  }

}
</script>
</head>

<body style="background: url(checkout.jpg) no-repeat">
               <form name="f1" METHOD ="POST" > 
                          <div style="position:absolute;left:6in;top:0in;height:0in;width:10in;display:block;">
						<?PHP echo $nologinvar ?>	
						</div > 
                          					
                          <div style="position:absolute;left:2.5in;top:2.5in;height:0in;width:10in;display:block;">
					         
					         
							<TABLE border="0" style="border:0 solid grey;">
								
								<TR>
                                      <TD width="100px"><p style="color:blue;font-size:14px">Card Type:</p></TD>
									  <TD width="10px" height="20px">
									   <select>
										<option value="Visa">Visa</option>
										  <option value="MasterCard">Master Card</option>
										  <option value="Discover">Discover</option>
									  </select>

									  </TD>

								</TR>  
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Card Number:</p></TD>
									  <TD height="50px"><input type="text" name="cardnumber" maxlength='16' value="<?PHP echo $cardnumber?>">(no spaces)</TD>
									  <TD > <p style="font-size:15px;color:red"><?PHP echo $errorcard?></p></TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Expires:</p></TD>
									  <TD height="20px">
									  <select name=month value=''>Select Month</option>
										<option value='01'>January</option>
										<option value='02'>February</option>
										<option value='03'>March</option>
										<option value='04'>April</option>
										<option value='05'>May</option>
										<option value='06'>June</option>
										<option value='07'>July</option>
										<option value='08'>August</option>
										<option value='09'>September</option>
										<option value='10'>October</option>
										<option value='11'>November</option>
										<option value='12'>December</option>
									 </select>
										
										<select>
										<?PHP
										    $year = date('Y');
											$year10 = $year+10;
											echo $year10;
											for ($i = $year ; $i< $year10 ; $i++)
											{
											echo "<option value='".$i."'>".$i."</option>";
											}
										?>
										  
									    </select>
										</TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Security Code:</p></TD>
									  <TD height="20px"><input type="text" name="codenumber" maxlength='3' value="<?PHP echo $codenumber?>"></TD>
									  <TD><p style="font-size:14px;color:red"><?PHP echo $errorcode?></p></TD>

								</TR>
								
								
								
							</TABLE>
                     </div>
					 <div style="position:absolute;left:2.5in;top:4.1in;height:0in;width:10in;display:block;">
					 <TABLE>
					 <TR>
                            <TD> <p style="color:blue;font-size:14px"><input type="checkbox" name="use" id="useid" value="" onclick="check()">Use this Address</p></TD>
							
						    						
					 </TR>
					 </TABLE>
					 </div>
					 <div style="position:absolute;left:6in;top:4.15in;height:0in;width:10in;display:block;">
					 <TABLE>
					 <TR>						
						    <TD> <p style="color:blue;font-size:14px">Enter New Address :</p></TD> 
							
					 </TR>
					 </TABLE>
					 </div>
					 <div style="position:absolute;left:2.5in;top:4.5in;height:0in;width:10in;display:block;">
					 <TABLE id="table1" style="border:0 solid grey;width:300px">
					            <TR>
                                      <TD><p style="color:blue;font-size:14px">Street:</p></TD>
									  <TD><input type="text" disabled name="line111" value="<?PHP echo $line1?>"></TD> 
									  <TD><input type="text" hidden name="line1" value="<?PHP echo $line1?>"></TD>
									  <TD><p style="font-size:14px;color:red"></p></TD>
							   </TR>
									  
                                <TR>  
								      <TD></TD>
									  <TD><input type="text" disabled name="line211" value="<?PHP echo $line2?>"></TD>
									  <TD><input type="text" hidden name="line2" value="<?PHP echo $line2?>"></TD>
									  <TD><p style="font-size:14px;color:red"></p></TD> </TR>
                                <TR> 
								      <TD><p style="color:blue;font-size:14px">City:</p></TD>
									  <TD height="20px"><input disabled type="text" name="city11" value="<?PHP echo $city?>">
									  <TD height="20px"><input hidden type="text" name="city" value="<?PHP echo $city?>">
									  </TD><TD><p style="font-size:14px;color:red"></p></TD>  
							    </TR> 
                                <TR> <TD><p style="color:blue;font-size:14px">State:</p></TD>
									  <TD height="20px"><input disabled type="text" name="state11" value="<?PHP echo $state?>">
									  <TD height="20px"><input hidden type="text" name="state" value="<?PHP echo $state?>">
									  </TD><TD><p style="font-size:14px;color:red"></p></TD> </TR> 
                                <TR> <TD><p style="color:blue;font-size:14px">Country:</p></TD>
									  <TD height="20px"><input disabled type="text" name="country11" value="<?PHP echo $country?>"></TD>  
									  <TD height="20px"><input hidden type="text" name="country" value="<?PHP echo $country?>"></TD> 
									  <TD><p style="font-size:14px;color:red"></p></TD></TR>
                                <TR> <TD><p style="color:blue;font-size:14px">Zip Code:</p></TD>
									  <TD height="20px"><input disabled type="text" name="zipcode11" maxlength='5' value="<?PHP echo $zipcode?>"></TD>
									  <TD height="20px"><input hidden type="text" name="zipcode" maxlength='5' value="<?PHP echo $zipcode?>"></TD>
									  <TD><p style="font-size:14px;color:red"></p></TD></TR>
					 </TABLE>
					 </div>
					 <div style="position:absolute;left:6in;top:4.5in;height:0in;width:10in;display:block;">
					 
					 <TABLE style="border:0 solid grey;">
					            <TR>
                                      <TD><p style="color:blue;font-size:14px">Street:</p></TD>
									  <TD><input type="text" name="line11" value="<?PHP echo $line11?>"></TD> 
									  <TD><p style="font-size:14px;color:red"><?PHP echo $errorline?></p></TD>
							   </TR>
									  
                                <TR>  <TD></TD><TD><input type="text" name="line22" value="<?PHP echo $line22?>"></TD>
									  <TD><p style="font-size:14px;color:red"></p></TD> </TR>
                                <TR> <TD><p style="color:blue;font-size:14px">City:</p></TD>
									  <TD height="20px"><input type="text" name="city1" value="<?PHP echo $city1?>">
									  </TD><TD><p style="font-size:14px;color:red"><?PHP echo $errorEmpty1?></p></TD>  </TR> 
                                <TR> <TD><p style="color:blue;font-size:14px">State:</p></TD>
									  <TD height="20px"><input type="text" name="state1" value="<?PHP echo $state1?>">
									  </TD><TD><p style="font-size:14px;color:red"><?PHP echo $errorEmpty?></p></TD> </TR> 
                                <TR> <TD><p style="color:blue;font-size:14px">Country:</p></TD>
									  <TD height="20px"><input type="text" name="country1" value="<?PHP echo $country1?>"></TD>  
									  <TD><p style="font-size:14px;color:red"><?PHP echo $errorEmpty2?></p></TD></TR>
                                <TR> <TD><p style="color:blue;font-size:14px">Zip Code:</p></TD>
									  <TD height="20px"><input type="text" name="zipcode1" maxlength='5' value="<?PHP echo $zipcode1?>"></TD>
									  <TD><p style="font-size:14px;color:red"><?PHP echo $errorNumeric?></p></TD></TR>
					 </TABLE>
					 </div>
					 <div style="position:absolute;left:2.5in;top:6.5in;height:0in;width:10in;display:block;">
					 <table>
					 <TR>
						  <TD><p style="color:blue;font-size:14px">Contact Number:</p></TD>
						  <TD height="20px"><input type="text" name="number" value="<?PHP echo $number?>"></TD>
						  <TD><p style="font-size:15px;color:red"><?PHP echo $errornumber?></p></TD>

				    </TR>
					<TR>
						  <TD><p style="color:blue;font-size:14px">Email ID:</p></TD>
						  <TD height="20px"><input type="text" name="email" value="<?PHP echo $email?>"></TD><TD><p style="font-size:15px;color:red"><?PHP echo $erroremail?></p></TD>

				   </TR>
				   <TR><TD height="20px"></TD></TR>
				   <TR>
                                      
					  <TD height="20px"><input style="color:blue;font-size:14px;" type="Submit" name="order" value="Place Your Order"></TD>

				  </TR>
				   </table>
					 </div>
					</form>
					

</body>
</html> 