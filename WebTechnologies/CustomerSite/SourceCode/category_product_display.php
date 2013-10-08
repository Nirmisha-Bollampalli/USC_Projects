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
			$nologinvar	 .=	 "<TD width='120px'><a href='viewcart.php'><p style='color:white'><u>ShoppingCart[".$cartlength."]</u></p></a></TD>";
			$nologinvar	 .=	 "<TD><a href='checkout.php'><p style='color:white'><u>CheckOut</u></p></a></TD></TR>";
			$nologinvar	 .=	" </TABLE>";


}	

mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("relancer") or die (mysql_error());

$ID = 0;
$ID = $_GET['ID'];
$currentdate = date("Y-m-d");
$sql = mysql_query("SELECT c.ProductID,c.ProductName,c.ProductImage,c.ProductPrice,s.Discount FROM  cakes c LEFT JOIN special_sales s on s.ProductID = c.ProductID and s.EndDate >= '$currentdate' where CategoryID ='$_GET[ID]'");

if(mysql_num_rows($sql))
{
$nr = mysql_num_rows($sql); 
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
 
$itemsPerPage = 4; 

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
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&ID='.$ID.'">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&ID='.$ID.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '&ID='.$ID.'">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&ID='.$ID.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&ID='.$ID.'">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '&ID='.$ID.'">' . $add2 . '</a> &nbsp;';
}
 else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&ID='.$ID.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&ID='.$ID.'">' . $add1 . '</a> &nbsp;';
}

$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 

$sql2 = mysql_query("SELECT c.ProductID,c.ProductName,c.ProductImage,c.ProductPrice,s.Discount FROM  cakes c LEFT JOIN special_sales s on s.ProductID = c.ProductID and s.EndDate >= '$currentdate' where CategoryID ='$_GET[ID]' $limit"); 

$paginationDisplay = ""; 

if ($lastPage != "1"){
    
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous .'&ID='.$ID. '"> Back</a> ';
    } 
    
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
   
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '&ID='.$ID.'"> Next</a> ';
    } 
}

$outputList = '';
$nooftd = 0;

while($row = mysql_fetch_array($sql2))
{ 
    $ProductID = $row["ProductID"];
    $Image = $row["ProductImage"];
	$Name = $row["ProductName"];
	$Price = $row["ProductPrice"];
	$Discount = $row["Discount"];
	
	if(empty($Discount))
	$Discount = "0";
    $outputList .= "<table class='first' border ='0' align='center'> <tr> <td class = 'second' align='center' style='width:160px;height:160px'>" . "<img src='". $Image."'/> </td>";
	$outputList .=  "<td style='width:370px;height:160px'><TABLE class = '' border='0'><TR><td class='first' style='width:160px;'>Product Name:</td><td >".$Name.'</td></TR>';
    $outputList .=   "<TR><td class='first' style='width:160px;'>Product Price:</td><td>".$Price.'$</td></TR>';  
    $outputList .=   "<TR><td class='first' style='width:160px;'>Product Quantity:</td><td><input type='text' id='quantity_".$ProductID."' maxlength='5'/></td></TR>";  
    $outputList .=   "<TR><td class='first' style='width:160px;'>Product Discount:</td><td>".$Discount.'%</td></TR>';  	
	$outputList .= "</TABLE></td>";
	$outputList .=  "<td style='height:160px'>" . "<input type=button id='cart' style='color:blue;width:110px;height:30px' value ='Add To Cart' onclick=addtocart('".$ProductID."')>". "</td></tr>";
	$outputList .= "</table>";
	
	
	
     
} 

	
?>
<?php

mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("relancer") or die (mysql_error());

$sql = mysql_query("SELECT c.ProductImage FROM  cakes c,special_sales s where c.ProductID=s.ProductID and s.EndDate >= '$currentdate' and CategoryID ='$_GET[ID]'");

if(mysql_num_rows($sql))
{
$nr = mysql_num_rows($sql); 
}
else
{
$nr =  1;

}
if (isset($_GET['pn1'])) 
{ 
    $pn1 = preg_replace('#[^0-9]#i', '', $_GET['pn1']); 
    
} 
else 
{ 
    $pn1 = 1;
} 
 
$itemsPerPage = 3; 

$lastPage = ceil($nr / $itemsPerPage);

if ($pn1 < 1) 
{ 
    $pn1 = 1; 
} 
else if ($pn1 > $lastPage) 
{ 
    $pn1 = $lastPage; 
} 

$centerPages = "";
$sub1 = $pn1 - 1;
$sub2 = $pn1 - 2;
$add1 = $pn1 + 1;
$add2 = $pn1 + 2;
if ($pn1 == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn1 . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $add1 . '&ID='.$ID.'">' . $add1 . '</a> &nbsp;';
} else if ($pn1 == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $sub1 . '&ID='.$ID.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn1 . '</span> &nbsp;';
} else if ($pn1 > 2 && $pn1 < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $sub2 . '&ID='.$ID.'">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $sub1 . '&ID='.$ID.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn1 . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $add1 . '&ID='.$ID.'">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $add2 . '&ID='.$ID.'">' . $add2 . '</a> &nbsp;';
}
 else if ($pn1 > 1 && $pn1 < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $sub1 . '&ID='.$ID.'">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $add1 . '&ID='.$ID.'">' . $add1 . '</a> &nbsp;';
}

$limit = 'LIMIT ' .($pn1 - 1) * $itemsPerPage .',' .$itemsPerPage; 

$sql2 = mysql_query("SELECT c.ProductID,c.ProductName,c.ProductImage,c.ProductPrice,s.Discount FROM  cakes c INNER JOIN special_sales s on s.ProductID = c.ProductID and s.EndDate >= '$currentdate' where CategoryID ='$_GET[ID]' $limit"); 

$paginationDisplay1 = ""; 

if ($lastPage != "1"){
    
    $paginationDisplay1 .= 'Page <strong>' . $pn1 . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    
    if ($pn1 != 1) {
        $previous = $pn1 - 1;
        $paginationDisplay1 .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $previous .'&ID='.$ID.'"> Back</a> ';
    } 
    
    $paginationDisplay1 .= '<span class="paginationNumbers">' . $centerPages . '</span>';
   
    if ($pn != $lastPage) {
        $nextPage = $pn1 + 1;
        $paginationDisplay1 .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn1=' . $nextPage . '&ID='.$ID.'"> Next</a> ';
    } 
}
//$paginationDisplay1='';
$outputList1 = '';
$ImageTD ='';
$NameTD ='';
if(mysql_num_rows($sql2)>0)
{

while($row = mysql_fetch_array($sql2))
{ 
    $outputList1 .= "<table class='first1' border ='1' align='left' width='200px'><tr>"; 
    $ProductID = $row["ProductID"];
    $Image = $row["ProductImage"];
	$Name = $row["ProductName"];
	$outputList1 .= "<td><Table style='width:150px;height:150px' ><tr><td align='center' >". "<a href='details.php?id=".$ProductID."'><img src='". $Image."'/></a>"." </td></tr><tr><td style='font-size:14px;color:blue;'>". $Name."</td></tr>";
	$outputList1 .= "</table></td>";
    $outputList1 .= "</tr></table>";
    
} 

}
else
{
  $outputList1 ='';
}	
?>
<html>
<head>
<title>Frosted Fantasies</title>
<script type="text/javascript" >
function addtocart(productid)
{
  //alert(productid);
  ProductID = productid;
  ProductQuantity = document.getElementById('quantity_'+productid).value;
 // alert(ProductQuantity);
 if(ProductQuantity == '' )
 {
    alert('Please Enter a Proper Value');
 }
 else if(isNaN(ProductQuantity))
 {
    alert('Please Enter a Proper Value');
 }
 else
 {
    var url = "addtocart.php?ProductID=" + ProductID +"&ProductQuantity=" + ProductQuantity;
	//alert(url);
	xmlHttp = GetXmlHttpObject(populatesearchresults)
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null)
 }
 
  
}
function populatesearchresults() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        var sResp;
        sResp = xmlHttp.responseText;
   		
		//window.location.reload(true);
		window.location = "extra_credit.php";
		
		
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

<style>
table.first1 { border: 1px #F8F8F8 ; }
table.first { border: 1px solid #F0F0F0 ; }
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
				</div> 
 
       <!-- Top Menu-->  
               <div>	   
				<ul id="main-menu" class="menu">
				  <li>
					<a href="product_display.php" class="menu-01">Regular Sale</a>   									
				  </li>
				  <li>
					<a href="sale_product_display.php" class="menu-02">Special Sale</a>  
				  </li>
				</ul>
		        </div>
		        <!-- Display Categories -->
				<Table align="center" border="0">
				
				<TR><td style="height:110px"></td></TR>
				
				
				
				<tr><td style="height:20px"></td></tr>
				<td valign="top">
				<div id="categorydiv"  >
						<Table  valign="left" Border="0" Id="product_categories">
						            <tr><td style="height:30px"></td></tr>
									<?PHP 
										 include('connect.php');
										 $query = "select ProductCategory,CategoryID from product_category";
										 $result=mysql_query($query);
										 $num=mysql_num_rows($result);
										 $i=0;
												while ($i < $num) 
												{
												$f3=mysql_result($result,$i,"ProductCategory");
												$f4=mysql_result($result,$i,"CategoryID");
									?>
												<TR>
												<td> <a href="category_product_display.php?ID=<?php echo $f4; ?>"><input type="button" style="width:130px;height:30px;color:blue"  value="<?php echo $f3; ?>" /></a></td>
												</TR>
									<?php

												$i++;

												}
 
									 ?>  					

						   

						</Table>
		       </div></td>
			   <td style="width:70px"></td>
			   <td>
			   <Table>
			        <!--<TR><td align="center" style="font-size:20px;color:blue;height:10px">Special Sales</td></TR>-->
			       <?PHP
				   if($outputList1 != '')
				   {
				   echo '<TR><td align="center" style="font-size:18px;color:blue">Special Sale</td></TR>';
				   
				   echo '<tr><td>'.  $outputList1.' </td></tr>';
				   
				   echo '<TR><td align="right" style="color:blue;height:10px"><div ><?php echo $paginationDisplay1; ?></div></td></TR>';
				   
				   echo '<TR><td align="center" style="font-size:20px;color:blue;height:80px"></td></TR>';
				   
				   }
				   ?>
				   
				   
				   
				   <TR><td align="center" style="font-size:18px;color:blue">Regular Sale</td></TR>
				   <TR><td align="right" style="color:blue;height:10px"><div ><?php echo $paginationDisplay; ?></div></td></TR>
				   <tr><td>
				        <div><?php echo $outputList; ?></div>
				   </td></tr>
			   </Table>
			   </td>
               
				</tr>
				</Table>
								

</html>