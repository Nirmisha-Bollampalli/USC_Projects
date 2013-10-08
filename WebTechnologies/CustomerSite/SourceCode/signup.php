<?php
           session_start();
		   if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
			session_destroy();  
			session_unset();  
             printf("<script>location.href='customer_home_nologin.php'</script>");			
		   } 
		    $_SESSION['LAST_ACTIVITY'] = time(); 
		    $nologinvar='';


            if(isset($_SESSION['cartlength']))
			{
			  $cartlength = $_SESSION['cartlength'];
			}
			else
			  $cartlength = 0;

            
			$nologinvar  .= "<TABLE>";
			$nologinvar	 .= "<TR><TD width='381.5px' ></TD>";
			$nologinvar	 .= "<TD width='60px' ><a href='customer_home_nologin.php'><p style='color:white'><u>Home</u></p></a></TD>";
			$nologinvar	 .= "<TD width='60px' ><a href='signup.php'><p style='color:white'><u>Sign In</u></p></a></TD>";
			$nologinvar	 .=	 "<TD width='60px'><a href='register.php'><p style='color:white'><u>Register</u></p></a></TD>";
			$nologinvar	 .=	 "<TD width='120px'><a href='viewcart.php'><p style='color:white'><u>ShoppingCart[".$cartlength."]</u></p></a></TD>";
			$nologinvar	 .=	 "<TD><a href='checkout.php'><p style='color:white'><u>CheckOut</u></p></a></TD></TR>";
			$nologinvar	 .=	" </TABLE>";





	$login_error = "";
	$uname = '';
	$pword = '';
	$errorUname='';
	$errorPass='';
	$parenterror='';
	

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	$uname = $_POST['uname'];
	$pword = $_POST['pword'];
	
	if (!preg_match("/^[a-z0-9_]+$/i", $uname) )
	{
	   
		$errorUname = "Please Enter Proper UserName";
	}
	if (!preg_match("/^[a-z0-9]+$/i", $pword) )
	{
	    
		$errorPass = "Please Enter Proper Password";
	}
	
	if ($errorUname == '' && $errorPass == '' ) 
	{
		
		include ('connect.php');
		
		$result = mysql_query("SELECT * FROM registration WHERE UserName = '" . mysql_real_escape_string($_POST['uname']) . "' and Password = '" . mysql_real_escape_string($_POST['pword']) . "'");
		
		
		if (mysql_num_rows($result) > 0) 
		{
				
				$user_record = mysql_fetch_array($result, MYSQL_ASSOC);
				
				$_SESSION['username'] = $_POST['uname'];
				
				if(isset($_SESSION['cart']))
				{
				   
					$insert =1;
					$cart_length = (sizeOf($_SESSION['cart'])); 
					//echo "CartLength".$cart_length;
				    for ($i = 1 ;$i <= $cart_length;$i++)
					{
                        echo "i".$i;					    
						$isvalid =1;
					   // echo $_SESSION['cart'][$i];
						$cart_item = $_SESSION['cart'][$i];
						$Productid = $cart_item->Productid;
						$qty = $cart_item->Quantity;
						//echo "PID".$Productid;
						//echo "Quantity".$qty;
						$query="select CustomerID from registration where UserName='$_POST[uname]' ";
						//echo $query;
						$result = mysql_query($query);
						$row = mysql_fetch_array($result);
						
						$query3 = "select ProductID from shopping_cart where ProductID = '$Productid' and CustomerID='$row[CustomerID]' ";
						//echo $query3;
						$result3 = mysql_query($query3);
						
						if(mysql_num_rows($result3) > 0)
						{
                                     $row2 = mysql_fetch_array($result3); 						            
									$query5 = "select ProductQuantity from shopping_cart where ProductID='$row2[ProductID]' and  CustomerID='$row[CustomerID]'";
									// echo $query5;
									 $result5 = mysql_query($query5);
									 $row5 = mysql_fetch_array($result5);
									 $qty = $qty+$row5['ProductQuantity'];
									 //echo "quantity:".$qty;
									 $query4 = "Update shopping_cart set ProductQuantity = '$qty' where ProductID='$row2[ProductID]' and CustomerID='$row[CustomerID]'";
									 //echo $query4;"Update1";
									 $result4 = mysql_query($query4);
									 $query8 = "select * from shopping_cart where CustomerID='$row[CustomerID]'";
										//echo $query8;
										$result8 = mysql_query($query8);
										if(mysql_num_rows($result8) > 0)
										{
										  $num = mysql_num_rows($result8);
										  $_SESSION['cartlength'] = $num;
										}
										
						}
						else
						{
									
									$query1 = "Insert into shopping_cart values('$row[CustomerID]','$Productid','$qty')";
									$result1 = mysql_query($query1);
									//echo $query1;
									$result4 = mysql_query($query4);
									 $query8 = "select * from shopping_cart where CustomerID='$row[CustomerID]'";
										//echo $query8;
										$result8 = mysql_query($query8);
										if(mysql_num_rows($result8) > 0)
										{
										  $num = mysql_num_rows($result8);
										  $_SESSION['cartlength'] = $num;
										}
						}
					}	
					
				}
				else 
				{
				        $query="select CustomerID from registration where UserName='$_POST[uname]' ";
						//echo $query;
						$result = mysql_query($query);
						$row = mysql_fetch_array($result);
						$query8 = "select * from shopping_cart where CustomerID='$row[CustomerID]'";
						//echo $query8;
						$result8 = mysql_query($query8);
				        if(mysql_num_rows($result8) > 0)
						{
						  $num = mysql_num_rows($result8);
						  $_SESSION['cartlength'] = $num;
						}
				
				
				}
				$_SESSION['CustomerID'] = $user_record["CustomerID"];
				$_SESSION['firstname'] = $user_record["FirstName"];
				$_SESSION['lastname'] = $user_record["LastName"];
				
				if(isset($_SESSION['redirect']))
				{
				 printf("<script>location.href='viewcart.php'</script>");
				}
				else
				{
				printf("<script>location.href='customer_home_login.php'</script>");
				}
				
	
		}
		else
		{
					$parenterror = " Invalid User Name or Password " ;
	    }	
		
	} 
	
}

?>

<html>


<body background="signup.jpg">
               <div style="position:absolute;left:5.7in;top:0in;height:0in;width:10in;display:block;">
				<?PHP echo $nologinvar ?>	
				</div > 
               
				<div style="position:absolute;left:2.2in;top:2in;height:0in;width:10in;display:block;">
					
					<form name="Login" METHOD ="POST" >
					         <p style="font-size:15px;color:red"><?PHP echo $parenterror?></p>
							<TABLE border="0">
								
								<TR>
                                      <TD><p style="color:blue;font-size:18px">User Name:</p></TD>
									  <TD height="50px"><input type="text" name="uname" value="<?PHP echo $uname ?>"></TD><TD><p style="font-size:15px;color:red"><?PHP echo $errorUname?></p></TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:18px">Password:</p></TD>
									  <TD height="50px"><input type="password" name="pword" value="<?PHP echo $pword ?>"></TD><TD><p style="font-size:15px ;color:red"><?PHP echo $errorPass?></p></TD>

								</TR>
								<TR>
                                     <TD></TD> <TD><a href="reset_pass.php"><p style="color:red;font-size:14px">Forgot UserName/Password</p></a></TD>
									  
								</TR>
								
								<TR>
                                      <TD></TD>
									  <TD height="50px"><input style="color:blue;font-size:15px;width:70px" type="Submit" name="login" value="Login"> </TD>
									  <TD height="50px"><a href="register.php"><input style="color:blue;font-size:15px;width:70px" type="button" name="register" value="Register"></a></TD>

								</TR>
							</TABLE>

					</form>
					</div>

 
</body>
</html>