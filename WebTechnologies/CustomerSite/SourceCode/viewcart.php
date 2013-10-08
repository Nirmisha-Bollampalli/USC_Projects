<?php
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
if (isset($_SESSION['username']))
{	
mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("relancer") or die (mysql_error());

$CID = mysql_query("SELECT CustomerID FROM registration where UserName='$_SESSION[username]'");
if(mysql_num_rows($CID)>0)
{
			$rowCID = mysql_fetch_array($CID);
			$sql = mysql_query("SELECT c.ProductImage,s.ProductID, c.ProductName, s.ProductQuantity, c.ProductPrice, sp.Discount FROM shopping_cart s INNER JOIN cakes c ON s.ProductID = c.ProductID LEFT JOIN special_sales sp ON sp.ProductID = c.ProductID where CustomerID = '$rowCID[CustomerID]' ");
		

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
			}
			 else if ($pn > 1 && $pn < $lastPage) {
				$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
				$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
				$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
			}

			$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 

			$sql2 = mysql_query("SELECT c.ProductImage,s.ProductID, c.ProductName, s.ProductQuantity, c.ProductPrice, sp.Discount FROM shopping_cart s INNER JOIN cakes c ON s.ProductID = c.ProductID LEFT JOIN special_sales sp ON sp.ProductID = c.ProductID where CustomerID = '$rowCID[CustomerID]' $limit");
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
			$nooftd = 0;
			
			    
			$outputList .= "<table align='center'><tr><td height='50px' align='center'><p style='color:blue;font-size:18px'>Your Cart<p></td></tr><tr><td width='700px' height='50px'></td><td width='100px'><label onclick='deletecart1()'>"."<p style='color:blue'><u>Empty Cart</u></p></label></td><td width='100px'><label onclick='checkout()'>"."<p style='color:blue'><u>Check Out</u></p></label></td></td></tr></table>";
            $outputList .= "<table class='second' border ='0' align='center'> <tr> <td style='width:100px'>Product Image</td><td style='width:100px'>Product Name</td><td style='width:100px'>Product Price</td>";
            $outputList .= "<td  style='width:100px'>Quantity</td><td style='width:100px'>Discount</td><td style='width:105px'>Discounted Price</td></tr>"; 
            while($row = mysql_fetch_array($sql2))
			{ 
				$Image = $row["ProductImage"];
				$ProductID = $row["ProductID"];
				$Quantity = $row["ProductQuantity"];
				$Name = $row["ProductName"];
				$Price = $row["ProductPrice"];
				$Discount = $row["Discount"];
				if($Discount !=0)
				$DiscountedPrice = $Price - $Price*($Discount/100);
				else
				$DiscountedPrice = $Price;
				
				if(empty($Discount))
				$Discount = "0";
				$outputList .= "<tr><td ><img src='". $Image."'/></td>";
				$outputList .=  "<td >".$Name.'</td>';
				$outputList .=   "<td>".$Price.'$</td>';  
				$outputList .=    "<td>".$Quantity.'</td>';   
				$outputList .=   "<td>".$Discount.'%</td>'; 
				$outputList .=   "<td>".$DiscountedPrice .'$</td>';
				$outputList .=   "<td ><input style='width:40px' type='text' id='quantity_".$ProductID."' maxlength='4'/></td><td style='width:200px;height:160px'><label onclick=editcart1('".$ProductID."')><p style='color:blue'><u>Edit Quantity</p></u></label>". "</td>";  	
				$outputList .=   "<td width='100px'><label onclick=deletecartitem1('".$ProductID."')><p style='color:blue'><u>Delete</p></u></label></td></TR>";
				$outputList .=   "<td ><input style='width:40px' type='text' hidden id='PID' maxlength='4' value='".$ProductID."' /></td>";	
			    
				
				
				
				 
			} 
			$outputList .= "</table>";
}
else
{

}
}
else
{   
        $paginationDisplay = ""; 
        $nr ='';
		//echo "hello";
		mysql_connect("localhost","root","") or die (mysql_error());
		mysql_select_db("relancer") or die (mysql_error());


		if (isset($_GET['pn'])) 
		{ 
			$pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); 
			
		} 
		else 
		{ 
			$pn = 1;
		} 
		if(isset($_SESSION['cartlength']))
		     $nr = $_SESSION['cartlength']; 
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
		}
		 else if ($pn > 1 && $pn < $lastPage) {
			$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
			$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
			$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
		}

		$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 



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
		$outputList ='';
		$outputList .= "<table align='center'><tr><td height='50px' align='center'><p style='color:blue;font-size:18px'>Your Cart<p></td></tr><tr><td width='700px' height='50px'></td><td width='100px'><label onclick='deletecart()'>"."<p style='color:blue'><u>Empty Cart</u></p></label></td></td></tr></table>";
        $outputList .= "<table class='second' border ='0' align='center'> <tr> <td style='width:100px'>Product Image</td><td style='width:100px'>Product Name</td><td style='width:100px'>Product Price</td>";
        $outputList .= "<td  style='width:100px'>Quantity</td><td style='width:100px'>Discount</td><td style='width:105px'>Discounted Price</td></tr>"; 
        if(isset($_SESSION['cart']))
		{
		
		$cart_length = (sizeOf($_SESSION['cart']));
		}
		else
		{
		 $cart_length =0;
		}

		for ($i = 1 ;$i <= $cart_length;$i++)
		{
		   $cart_item = $_SESSION['cart'][$i];
		   $ProductID = $cart_item->Productid;
		   $Quantity = $cart_item->Quantity;
		    $sql = "select c.ProductImage,c.ProductName,c.ProductPrice,s.Discount from cakes c LEFT JOIN special_sales s on s.ProductID = c.ProductID where c.ProductID ='$ProductID '";
			//echo $sql;
		   $shopcart =mysql_query( "select c.ProductImage,c.ProductName,c.ProductPrice,s.Discount from cakes c LEFT JOIN special_sales s on s.ProductID = c.ProductID where c.ProductID ='$ProductID '");
			$shopcart1 = mysql_fetch_array($shopcart);
			$Image = $shopcart1["ProductImage"];
			$Name = $shopcart1["ProductName"];
			$Price = $shopcart1["ProductPrice"];
			$Discount = $shopcart1["Discount"];
			if($Discount !=0)
			$DiscountedPrice = $Price - $Price*($Discount/100);
			else
			$DiscountedPrice = $Price;
			
			if(empty($Discount))
			$Discount = "0";
			if($Name == '')
			{
			 $outputList .='';
			 //$_SESSION['cartlength'] =0;
			}
			else
			{
			$outputList .= "<tr><td ><img src='". $Image."'/></td>";
			$outputList .=  "<td >".$Name.'</td>';
			$outputList .=   "<td>".$Price.'$</td>';  
			$outputList .=    "<td>".$Quantity.'</td>';   
			$outputList .=   "<td>".$Discount.'%</td>'; 
			$outputList .=   "<td>".$DiscountedPrice .'$</td>';
			$outputList .=   "<td ><input style='width:40px' type='text' id='quantity_".$ProductID."' maxlength='4'/></td><td style='width:200px;height:160px'><label onclick=editcart('".$ProductID."')><p style='color:blue'><u>Edit Quantity</p></u></label>". "</td>";  	
				$outputList .=   "<td width='100px'><label onclick=deletecartitem('".$ProductID."')><p style='color:blue'><u>Delete</p></u></label></td></TR>";
				$outputList .=   "<td ><input style='width:40px' type='text' hidden id='PID' maxlength='4' value='".$ProductID."' /></td>";	
			    }
		}
$outputList .= "</table>";
}
	
?>
<html>
<head>
<title>Frosted Fantasies</title>
<script type="text/javascript" >
var isdeletecart =0;
function deletecart()
{
  
    var url = "editcart.php?Type=empty";
	//alert(url);
	xmlHttp = GetXmlHttpObject(populatesearchresults)
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null)

}
function deletecartitem(productid)
{
  ProductID = productid;
  ProductQuantity = document.getElementById('quantity_'+productid).value;
 //alert(ProductQuantity);
    var url = "editcart.php?ProductID=" + ProductID +"&ProductQuantity=" + ProductQuantity+"&Type=delete";
	//alert(url);
	xmlHttp = GetXmlHttpObject(populatesearchresults)
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null)

}
function editcart(productid)
{
  
  ProductID = productid;
  ProductQuantity = document.getElementById('quantity_'+productid).value;
 //alert(ProductQuantity);
    var url = "editcart.php?ProductID=" + ProductID +"&ProductQuantity=" + ProductQuantity+"&Type=edit";
	//alert(url);
	xmlHttp = GetXmlHttpObject(populatesearchresults)
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null)
  
}
function editcart1(productid)
{
  //alert(productid);
  ProductID = productid;
  ProductQuantity = document.getElementById('quantity_'+productid).value;
 // alert(ProductQuantity);
    var url = "editcart.php?ProductID=" + ProductID +"&ProductQuantity=" + ProductQuantity+"&Type=edit";
	//alert(url);
	xmlHttp = GetXmlHttpObject(populatesearchresults)
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null)
  
}
function deletecartitem1(productid)
{
  
  ProductID = productid;
  ProductQuantity = document.getElementById('quantity_'+productid).value;
 // alert(ProductQuantity);
    var url = "editcart.php?ProductID=" + ProductID +"&ProductQuantity=" + ProductQuantity+"&Type=delete";
  
	//alert(url);
	xmlHttp = GetXmlHttpObject(populatesearchresults)
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null)
	
	
  
}
function deletecart1()
{
  
    var url = "editcart.php?Type=empty1";
	//alert(url);
	xmlHttp = GetXmlHttpObject(populatesearchresults)
	xmlHttp.open("GET", url, true)
	xmlHttp.send(null)
	
  
}

function populatesearchresults() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        var sResp;
        sResp = xmlHttp.responseText;
		alert(sResp);
   		if(sResp != '')
		{
		window.location.reload(true);
		//alert("Quantity Updated");
		
		}
		else
		{
         //alert("Please enter a value");
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

function checkout()
{
  window.location = "checkout.php";
}

</script>

<style>
table.first { border: 1px dotted violet; }
table.second { border: 1px solid violet; }
td.first { border: 1px dotted violet; }
td.second { border: 1px solid blue; }</style>
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
				<div style="position:absolute;left:1.5in;top:1in;height:0in;width:10in;display:block;">
				<Table align="center" border="0">
						<tr><td style="height:20px"></td></tr>
						<tr><td></td><td colspan='4' align="right"><div ></div></td></tr>
						<tr><td style="height:50px"></td><td colspan='4' align="right"><div ><?php echo $paginationDisplay?></div></td></tr>
									   </div></td>
					    <td style="width:60px"></td>
					    <td><div><?php echo $outputList; ?></div></td>
					   
						</tr>
				</Table>
				</div>
								
		
				 
                
</body>

</html>