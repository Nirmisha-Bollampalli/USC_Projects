<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
    session_destroy();  
    session_unset(); 
    printf("<script>location.href='customer_home_nologin.php'</script>");		
} 
$_SESSION['LAST_ACTIVITY'] = time(); 
$nologinvar='';

if (isset($_SESSION['username']))
{
	        $nologinvar  .= "<TABLE>";
			$nologinvar	 .= "<TR>";
			$nologinvar	 .= "<TD width='510px' > <p style='color:white'>";
			$nologinvar	 .=  "Welcome";
			$nologinvar	 .=  $_SESSION['firstname'] .' '.$_SESSION['lastname']; 
			$nologinvar	 .= "&nbsp; <a href='customer_home_nologin.php?action=logout' style='color:white'> [Logout] </a> </p></TD>";

			$nologinvar	 .=	"<TD width='100px' ><a href='myprofile.php'><p style='color:white'><u>MyProfile</u></p></a></TD>";
			$nologinvar	 .=	"<TD width='60px' ><a href='#'><p style='color:white'><u>Cart</u></p></a></TD>";
			$nologinvar	 .=	" </TABLE>";
}

else
{
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
			$nologinvar	 .=	 "<TD><a href='#'><p style='color:white'><u>ShoppingCart[".$cartlength."]</u></p></a></TD></TR>";
			$nologinvar	 .=	" </TABLE>";


}

	$login_error = "";
	$uname = '';
	$pword = '';
	$errorAns='';
	$erroremail='';
	$parenterror='';
    $output ='';
	$email = '';
	$question='';
	$answer='';
	
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	$email = $_POST['email'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	
	if (!preg_match("/^[a-z0-9]+$/i", $answer) )
	{
	    
		$errorAns = "Please give an answer";
	}
	if(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/i",$email))
	{
	    $erroremail = "Please give an EmailID";
	
	}
	if ($errorAns == '' && $erroremail == '' ) 
	{
		
		include ('connect.php');
		
		$result = mysql_query("SELECT UserName,Password FROM registration WHERE EmailID='$email' and question='$question' and answer='$answer'");
		
		
		if (mysql_num_rows($result) > 0) 
		{
				$row = mysql_fetch_array($result);
				$output .= "<fieldset><legend style='color:blue;font-size:18px'>Your Details</legend><table><tr><td>";
				$output .= "<p style='color:blue;font-size:16px'>Your Username : </p></td><td>";
				$output .= $row['UserName']."</td></tr><tr><td>";
				$output .= "<p style='color:blue;font-size:16px'>Your Password :</p></td><td>";
				$output .= $row['Password']."</td></tr></table></fieldset>";
	
		}
		else
		{
					$parenterror = "Your Records Donot Exist" ;
	    }	
		
	} 
	
}

?>

<html>
<head>
<script type="text/javascript" >
function addtocart(productid)
{
  //alert(productid);
  ProductID = productid;
  ProductQuantity = document.getElementById('quantity_'+productid).value;
 // alert(ProductQuantity);
    var url = "addtocart.php?ProductID=" + ProductID +"&ProductQuantity=" + ProductQuantity;
	//alert(url);
	xmlHttp = GetXmlHttpObject(populatesearchresults)
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null)
  
}


function populatesearchresults() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        var sResp;
        sResp = xmlHttp.responseText;
   		if(sResp)
		{
		document.getElementById('cartlength').innerHTML  = "<u>ShoppingCart["+sResp+"]</u>";
		window.location.reload(true);
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

<body background="reset.jpg">
                <div style="position:absolute;left:6.5in;top:0in;height:0in;width:10in;display:block;">
				<?PHP echo $nologinvar ?>	
				</div > 
				<div style="position:absolute;left:2.2in;top:2in;height:0in;width:10in;display:block;">
					
					<form name="Login" METHOD ="POST" >
					         <p style="font-size:15px;color:red"><?PHP echo $parenterror?></p>
							<TABLE border="0">
								<TR>
                                      <TD><p style="color:blue;font-size:18px"><u>Please enter these details..</u></p></TD>
									  
								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:18px">Email ID:</p></TD>
									  <TD height="50px"><input type="text" name="email" value="<?php echo $email?>"></TD><TD><p style="font-size:15px;color:red"><?php echo $erroremail?></p></TD>

								</TR>
								
								<TR>
                                      <TD><p style="color:blue;font-size:18px">Select Your Security Question:</p></TD>
									  <TD height="50px">
									  <select name="question">
									  
									  <option>What is the name of your first pet</option>
									  <option>Who was your favorite teacher</option>
									  </select>
									  </TD>

								</TR>
								<TR>
                                      <TD><p style="color:blue;font-size:18px">Enter Your Answer:</p></TD>
									  <TD height="50px"><input type="password" name="answer" value="<?php echo $answer?>"></TD><TD><p style="font-size:15px;color:red"><?php echo $errorAns ?></p></TD>

								</TR>
								
								
								<TR>
                                      <TD></TD>
									  <TD height="50px"><input style="color:blue;font-size:15px;width:70px" type="Submit" name="login" value="Reset"> </TD>
									  
								</TR>
								
								 <TR>
                                      <TD><?php echo $output ?> </TD>
									  									  
								</TR>
							</TABLE>

					</form>
					</div>

 
</body>
</html>