<?PHP
session_start();
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
	
?>
<html>
<body background="Temp.png">
 <div style="position:absolute;left:6in;top:0in;height:0in;width:10in;display:block;">
<?PHP echo $nologinvar ?>	
</div >  
<div style="position:absolute;left:6in;top:3in;height:0in;width:10in;display:block;">
<p style="color:blue;font-size:24px">Your Cart Is Empty</p>	
</div > 
</body>
</html>						