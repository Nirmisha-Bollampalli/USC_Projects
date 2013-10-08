<?php
    
	
	include ('session.php');
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
			session_destroy();  
			session_unset(); 
            printf("<script>location.href='customer_home_nologin.php'</script>");					
			} 
			$_SESSION['LAST_ACTIVITY'] = time(); 
	
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
	
	//include ('session.php');
	$login_error = "";
	$uname = '';
	$pword = '';
	$newpword = '';
	$errorPassnew='';
	$errorPassconfirm='';
	$confirmpword = '';
	$errorUname='';
	$errorPass = '';
	$fname='';
	$lname ='';
	$address='';
	$answer ='';
	$errorAns='';
	$erroremail ='';
	$email ='';
	$parenterror='';
	$question ='';
	$errornumber='';
	$question='';
	$number ='';
	$line1 ='';
	$line2 ='';
	$city='';
	$state='';
	$country='';
	$zipcode='';
	$errorEmpty = "";
	$errorNumeric = "";
	$errorEmpty1 = "";
	$errorEmpty2 = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$newpword = $_POST['password'];
	$confirmpword = $_POST['cpassword'];
	$uname = $_SESSION['username']; 
	$pword = $_POST['pword'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	
	$answer = $_POST['answer'];
	$email = $_POST['email'];
	$question = $_POST['question'];
	$number = $_POST['number'];
	$line1 = $_POST['line1'];
	$line2 = $_POST['line2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$zipcode = $_POST['zipcode'];
	if(is_numeric($state) )
	{
	  $errorEmpty = "*";
	}
	if( is_numeric($city) )
	{
	  $errorEmpty1 = "*";
	}
	if(is_numeric($country))
	{
	  $errorEmpty2 = "*";
	}
	if((strlen($zipcode) > 0) && !is_numeric($zipcode))
	{
	  $errorNumeric = "*";
	}
    if((strlen($zipcode) > 0) &&(strlen($zipcode) < 5))
	{
	  $errorNumeric = "*";
	}
	
	if (!preg_match("/^[a-z0-9_]+$/i", $uname) )
	{
	   
		$errorUname = "*";
	}
	
	if(!empty($newpword))
	{
	if (!preg_match("/^[a-z0-9]+$/i", $newpword) )
	{
	    
		$errorPassnew = "*";
		$pword = $newpword;
	}
	if (!preg_match("/^[a-z0-9]+$/i", $confirmpword) )
	{
	    
		$errorPassconfirm = "*";
	}
	}
	
	if (!preg_match("/^[a-z0-9]+$/i", $answer) )
	{
	    
		$errorAns = "*";
	}
	if(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/i",$email))
	{
	    $erroremail = "*";
	
	}
	if( (strlen($number) > 0) && !preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $number) ) 
	{
	    $errornumber ="*";    
    }
	if($errorUname == '' && $errorPass == '' && $errorAns == '' && $erroremail == '' && $errorEmpty == '' && $errorEmpty1 == '' && $errorEmpty2 == '' && $errorNumeric== '' )
	{
	
	include ('connect.php');
	
	$query = "UPDATE registration SET FirstName='$fname',LastName='$lname',line1='$line1',line2='$line2',city='$city',state='$state',country='$country',zipcode='$zipcode',EmailID='$email',ContactNumber='$number',Password='$pword',question='$question',answer='$answer' where UserName='$uname'";
	    if(mysql_query($query))
		{
		printf("<script>location.href='customer_home_login.php'</script>");
		//echo $query;
		}
		else
		{
			printf("<script>alert('error')</script>"); 
			//echo $query;
		}	
		
	}
	else
	{
	    $parenterror = "Please Fill In Proper Values In Fields marked By *";
	 
	}
}
else
{
  
  $uname = $_SESSION['username']; 
  include ('connect.php');
  $query = "select * from registration where UserName = '$uname'";
  if(mysql_query($query))
  {
    $result=mysql_query($query);
    $row = mysql_fetch_array($result);
	$fname = $row["FirstName"];
	$lname = $row["LastName"];
	$number = $row["ContactNumber"];
	$line1 = $row["line1"];
	$line2 = $row["line2"];
	$city = $row["city"];
	$state = $row["state"];
	$country = $row["country"];
	$zipcode = $row["zipcode"];
	$question = $row["question"];
	$answer = $row["answer"];
	$email = $row["EmailID"];
	$pword = $row["Password"];
	
  }
  
 

}
?>

<html>
<head>
<script type="text/javascript">

function check()
{
  password = document.getElementById('new');
  cpassword =document.getElementById('confirm');
  if (password.value != cpassword.value) { 
   alert("Your password and confirmation password do not match.");
   cpassword.value ='';
  return false; 
}

}
function show() 
{
var divstyle = document.getElementById('new').style.display;

if ( divstyle =="block")
{
	divstyle ="none";
} 
else 
{
	divstyle ="block";
}

document.getElementById('new').style.display = divstyle ;
document.getElementById('confirm').style.display = divstyle;
document.getElementById('newlabel').style.display = divstyle ;
document.getElementById('confirmlabel').style.display = divstyle;


}

</script>
</head>

<body style="background: url(profile.jpg) no-repeat">
                   
				    <div style="position:absolute;left:5.7in;top:0in;height:0in;width:10in;display:block;">
					<?PHP echo $nologinvar ?>	
					</div> 
                    <div style="position:absolute;left:2.5in;top:2.5in;height:0in;width:10in;display:block;">
					
					<form name="Login" METHOD ="POST" >
					         <p style="font-size:15px;color:red"><?PHP echo $parenterror?></p>
							<TABLE border="0">
								
								<TR>
                                      <TD ><p style="color:blue;font-size:14px">First Name:</p></TD>
									  <TD height="20px"><input type="text" name="fname" value="<?PHP echo $fname ?>"></TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Last Name:</p></TD>
									  <TD height="20px"><input type="text" name="lname" value="<?PHP echo $lname ?>"></TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">User Name:</p></TD>
									  <TD height="20px"><input type="text" name="uname" disabled value="<?PHP echo $uname ?>" ></TD><TD><p style="font-size:15px;color:red"><?PHP echo $errorUname?></p></TD>
                                       
								</TR>
															
								
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Email ID:</p></TD>
									  <TD height="20px"><input type="text" name="email" value="<?PHP echo $email ?>"></TD><TD><p style="font-size:15px;color:red"><?PHP echo $erroremail?></p></TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Street:</p></TD>
									  <TD><input type="text" name="line1" value="<?PHP echo $line1 ?>"></TD> 
									  <TD><p style="font-size:15px;color:red"><?PHP ?></p></TD></TR>
                                <TR>  <TD></TD><TD height="20px"><input type="text" name="line2" value="<?PHP echo $line2 ?>"></TD>
									  <TD><p style="font-size:15px;color:red"><?PHP ?></p></TD> </TR>
                                <TR> <TD><p style="color:blue;font-size:14px">City:</p></TD>
									  <TD height="20px"><input type="text" name="city" value="<?PHP echo $city ?>">
									  </TD><TD><p style="font-size:15px;color:red"><?PHP echo $errorEmpty1?></p></TD>  </TR> 
                                <TR> <TD><p style="color:blue;font-size:14px">State:</p></TD>
									  <TD height="20px"><input type="text" name="state" value="<?PHP echo $state ?>">
									  </TD><TD><p style="font-size:15px;color:red"><?PHP echo $errorEmpty?></p></TD> </TR> 
                                <TR> <TD><p style="color:blue;font-size:14px">Country:</p></TD>
									  <TD height="20px"><input type="text" name="country" value="<?PHP echo $country ?>"></TD>  
									  <TD><p style="font-size:15px;color:red"><?PHP echo $errorEmpty2?></p></TD></TR>
                                <TR> <TD><p style="color:blue;font-size:14px">Zip Code:</p></TD>
									  <TD height="20px"><input type="text" name="zipcode" maxlength='5' value="<?PHP echo $zipcode ?>"></TD>
									  <TD><p style="font-size:15px;color:red"><?PHP echo $errorNumeric?></p></TD></TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Contact Number:</p></TD>
									  <TD height="20px"><input type="text" name="number" value="<?PHP echo $number ?>"></TD><TD><p style="font-size:15px;color:red"><?PHP echo $errornumber?></p></TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Security Question:</p></TD>
									  <TD height="20px">
									  <select name="question">
									  <option><?PHP echo $question?></option>
									  <option>What is the name of your first pet</option>
									  <option>Who was your favorite teacher</option>
									  </select>
									  </TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Answer:</p></TD>
									  <TD height="20px"><input type="password" name="answer" value="<?PHP echo $answer ?>">(Please donot enter special characters)</TD><TD><p style="font-size:15px;color:red"><?PHP echo $errorAns?></p></TD>

								</TR>
								<TR>
                                      <TD><label onclick="show()"><p style="color:blue;font-size:14px"><u>Change Password:</u></p></label></TD>
									  
								</TR>
								
								<TR>
                                    
									  <TD><label id="newlabel" hidden><p style="color:blue;font-size:14px">New Password:</p></label></TD>
									  <TD><input type="password" id="new" hidden name="password" value="<?PHP echo $newpword ?>"></TD><TD><p style="font-size:15px ;color:red"><?PHP echo $errorPassnew?></p></TD>
                                <TR>
								
								</TR>
                                      <TD><label id="confirmlabel" hidden><p style="color:blue;font-size:14px">Confirm Password:</p></label ></TD>
									  <TD><input type="password" hidden id="confirm" name="cpassword" onblur="check()" value="<?PHP echo $confirmpword ?>"></TD><TD><p style="font-size:15px ;color:red"><?PHP echo $errorPassconfirm?></p></TD>
								</TR>
								
								<TR>
                                      
									  <TD height="20px"><input style="color:blue;font-size:15px;width:70px" type="Submit" name="save" value="Save"></TD>

								</TR>
								<TR>
                                      
									  <TD height="20px"><input type="text" name="pword"  hidden value="<?PHP echo $pword ?>"></TD><TD><p style="font-size:15px;color:red"><?PHP echo $errorUname?></p></TD>
                                       
								</TR>
								
							</TABLE>

					</form>
					</div>

</body>
</html> 