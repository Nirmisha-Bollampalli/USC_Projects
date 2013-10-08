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
	$line1 = $_POST['line1'];
	$line2 = $_POST['line2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$zipcode = $_POST['zipcode'];
	$uname = $_POST['uname'];
	$pword = $_POST['password'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$answer = $_POST['answer'];
	$email = $_POST['email'];
	$question = $_POST['question'];
	$number = $_POST['number'];
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
	if (!preg_match("/^[a-z0-9]+$/i", $pword) )
	{
	    
		$errorPass = "*";
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
	
	$query = "Insert into registration values('','$email','$_POST[fname]','$_POST[lname]','$_POST[line1]','$_POST[line2]','$_POST[city]','$_POST[state]','$_POST[country]','$_POST[zipcode]','$_POST[number]','$_POST[uname]','$_POST[password]','$_POST[question]','$_POST[answer]')";
	if(mysql_query($query))
		printf("<script>location.href='signup.php'</script>");
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
?>

<html>
<head>
<script type="text/javascript">

function getsearchresults(str) {
    //alert (str);
    var url = "checkuname.php?uname=" + str
    xmlHttp = GetXmlHttpObject(populatesearchresults)
    xmlHttp.open("GET", url, true)
    xmlHttp.send(null)
}

function populatesearchresults() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        var sResp;
        sResp = xmlHttp.responseText;
       // alert(sResp.length);
		document.getElementById('divresults').innerHTML  = sResp;
		if(ltrim(sResp)!='')
		 {
		// alert(sResp);
		 document.getElementById('uname').value='';
		 }
		
    }
}
function GetXmlHttpObject(handler) {
    var objXmlHttp = null
    if (navigator.userAgent.indexOf("Opera") >= 0) {
        alert("Opera not supported...")
        return;
    }
    if (navigator.userAgent.indexOf("MSIE") >= 0) {
        var strName = "Msxml2.XMLHTTP"
        if (navigator.appVersion.indexOf("MSIE 5.5") >= 0) {
            strName = "Microsoft.XMLHTTP"
        }
        try {
            objXmlHttp = new ActiveXObject(strName)
            objXmlHttp.onreadystatechange = handler
            return objXmlHttp
        }
        catch (e) {
            alert("Error. Scripting for ActiveX might be disabled")
            return
        }
    }
    if (navigator.userAgent.indexOf("Mozilla") >= 0) {
        objXmlHttp = new XMLHttpRequest()
        objXmlHttp.onload = handler
        objXmlHttp.onerror = handler
        return objXmlHttp
    }
}
</script>
</head>

<body style="background: url(register.jpg) no-repeat">
                   <div style="position:absolute;left:5.7in;top:0in;height:0in;width:10in;display:block;">
				<?PHP echo $nologinvar ?>	
				</div > 
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
									  <TD height="20px"><input type="text" id="uname" name="uname" value="<?PHP echo $uname ?>" onblur="getsearchresults(this.value)">(Please donot use Special Characters)</TD><TD><p id="divresults"style="font-size:15px;color:red"><?PHP echo $errorUname?></p></TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:14px">Password:</p></TD>
									  <TD height="20px"><input type="password" name="password" value="<?PHP echo $pword ?>">(Please donot use Special Characters)</TD><TD><p style="font-size:15px ;color:red"><?PHP echo $errorPass?></p></TD>

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
                                      
									  <TD height="20px"><input style="color:blue;font-size:15px;width:70px" type="Submit" name="save" value="Save"></TD>

								</TR>
							</TABLE>

					</form>
					</div>

</body>
</html> 