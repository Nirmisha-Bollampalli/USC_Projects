<?PHP
include ('session.php');
if(isset($_GET['i']))
  $i = $_GET['i'];
else
$i=0;  
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

include('connect.php');
$cusid= mysql_query("select CustomerID from registration where UserName='$_SESSION[username]'");
$rowcusid = mysql_fetch_array($cusid);
$query="select * from saveorder where CustomerID = '$rowcusid[CustomerID]'";
$result=mysql_query($query);
if(mysql_num_rows($result))
{
$nr = mysql_num_rows($result); 
}
else
{
$nr =  1;

}
if (isset($_GET['pn'])) 
{ 
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); 
    
} 
else 
{ 
    $pn = 1;
} 
 
$itemsPerPage = 2; 

$lastPage = ceil($nr / $itemsPerPage);

if ($pn < 1) 
{ 
    $pn = 1; 
} 
else if ($pn > $lastPage) 
{ 
    $pn = $lastPage; 
} 

$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&i='.$i.'">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&i='.$i.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '&i='.$i.'">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&i='.$i.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&i='.$i.'">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '&i='.$i.'">' . $add2 . '</a> &nbsp;';
}
 else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&i='.$i.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&i='.$i.'">' . $add1 . '</a> &nbsp;';
}

$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 

$paginationDisplay = ""; 

if ($lastPage != "1"){
    
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '&i='.$i. '"> Back</a> ';
    } 
    
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
   
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '&i='.$i. '"> Next</a> ';
    } 
}

	

    $op ='';
    $orderop = '';
    $outputtable='';
    include('connect.php');
	
	$cusid= mysql_query("select CustomerID from registration where UserName='$_SESSION[username]'");
	$rowcusid = mysql_fetch_array($cusid);
	$query="select * from saveorder where CustomerID = '$rowcusid[CustomerID]' $limit";
	$result=mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
	 $num =  mysql_num_rows($result);
	                
				   while ($i < $num) 
				   {
				    $array = mysql_fetch_array($result); 
					$op .= "<table style='border : 1px solid grey'>";
			        $op .= "<tr>"; 
			       $op .= "<td><input type='button' name='view'  value='View Order' onclick='show(".$array['OrderID'].",".$pn.")' /></td>";
			        $op .= "<td><p style='color:blue;font-size:15px'>Order Date :</p></td><td>".  $array['OrderDate']."</td>";
				    $op .= "<td><p style='color:blue;font-size:15px'>Delivery Date :</p></td><td>". $array['DelDate']."</td>";
				    $op .= "</tr>";
		            $op .= "</table>";	
                    $i++;
				   }
    }





?>
<html>
<head>
<script type="text/javascript">

function show(a,b)
{
  //alert(a);
  var OrderID = a;
  var b=b;
  window.location = "showmyorders.php?id="+OrderID+"&pn="+b;
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
		<?PHP echo $paginationDisplay?>
		<?PHP echo $op?>
	  
        	
    </div>



</body>
</html>

