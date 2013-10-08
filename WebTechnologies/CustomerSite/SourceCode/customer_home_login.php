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


mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("relancer") or die (mysql_error());

$sql = mysql_query("SELECT c.ProductImage FROM special_sales s inner join cakes c on c.ProductID = s.ProductID ");

$nr = mysql_num_rows($sql); 
if (isset($_GET['pn'])) 
{ 
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); 
    
} 
else 
{ 
    $pn = 1;
} 
 
$itemsPerPage = 5; 

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
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
}

$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 

$sql2 = mysql_query("SELECT c.ProductID,c.ProductImage FROM special_sales s inner join cakes c on c.ProductID = s.ProductID $limit"); 

$paginationDisplay = ""; 

if ($lastPage != "1"){
    
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"> Back</a> ';
    } 
    
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
   
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> Next</a> ';
    } 
}
$outputList = '';
$var = 0;
$outputList .= "<table border ='0' align='center' class='first'> <tr>"; 
while($row = mysql_fetch_array($sql2))
{ 
     $ProductID = $row["ProductID"];
    $Image = $row["ProductImage"];
    $outputList .= "<td class='first'  align='center' style='width:160px;height:160px'>". "<a href='details.php?id=".$ProductID."'><img src='". $Image."'/></a>".'&nbsp &nbsp&nbsp &nbsp &nbsp&nbsp &nbsp &nbsp&nbsp </td>';
	$var++;
    
} 
while($var < 5)
{
   $outputList .= "<td class='first'  style='width:160px'>&nbsp &nbsp&nbsp &nbsp &nbsp&nbsp &nbsp &nbsp&nbsp </td>";
   $var++;
}
$outputList .= "</tr></table>";
?>
<html>
<head>
<title>Frosted Fantasies</title>
<style>
table.first { border: 1px solid #FFF0F0  ; }
table.second { border: 1px solid violet; }
td.first { border: 1px  solid white; }
td.second { border: 1px  solid white; }</style>
<style type="text/css">



ul.menu 
{
  display: block;
  position: absolute;
  top: 40px;
  right: -250px;
  height: 50px;
  width: 800px;
  z-index: 10000;
}
.menu li 
{
  float: left;
  position: relative;
  z-index: 10000;
}
.menu li a 
{
  display: block;
  text-indent: -9999px;
  height: 50px;
}
.menu li a.menu-01 { background: url(nav_main.jpg) 0 0 no-repeat; width: 180px; }
.menu li a.menu-02 { background: url(nav_main.jpg) -195px 0 no-repeat; width: 195px; }

.menu li a.menu-01:hover 
{ 
  background-position: 0 -50px; 

}
.menu li a.menu-02:hover 
{ 
background-position: -195px -50px; 
	
}



</style>
</head>
<body background="Temp.png">
                 
                <div style="position:absolute;left:5.7in;top:0in;height:0in;width:10in;display:block;">
				<?PHP echo $nologinvar ?>	
				</div > 
       <!-- Top Menu-->     
				<ul id="main-menu" class="menu">
				  <li>
					<a href="product_display.php" class="menu-01">Regular Sale</a>   									
				  </li>
				  <li>
					<a href="sale_product_display.php" class="menu-02">Special Sale</a>  
				  </li>
			  
				</ul>
		
		<!--Image Div-->
				 
                 <table align='center' border="0">
				 <tr><td style="height:140px"></td></tr>
				 <tr><td style="height:300px;width:820px;overflow:auto;background:  url(sales2.jpg) no-repeat;align:center"></tr></td>
				 </table>
				 <div >
				 <table align='center'border="0">
				  <tr><td style="width:820px;"><div align='right'><?php echo $paginationDisplay; ?></div></td></tr>
                  </table>
				 </div> 
                 <div><?php echo $outputList; ?></div>
				 
                
</body>

</html>