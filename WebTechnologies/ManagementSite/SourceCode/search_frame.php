<?php

if(array_key_exists("frame", $_GET)) { 
$frame = $_GET['frame'];

$username="root";
$password="";
$database="relancer";
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query = "";
$drop_down = "";
if ( $frame == "user")
{
	$query = "Select distinct Role, Role from user_table";
	$drop_down = '<select id ="userrole">';
} 
if ( $frame == "product" || $frame == "specialsales")
{
	$query = "Select categoryid, ProductCategory from product_category";
	$drop_down = '<select id ="productcategory">';
}

$drop_down = $drop_down. '<option value="">Select</option>';
if (strlen($query) > 0 ) {

	$result = mysql_query($query);
	$rows = mysql_numrows($result);
	$i = 0;
	while ($i < $rows) {
		$drop_down = $drop_down. '<option value="'.mysql_result($result, $i, 0) .'">'.mysql_result($result, $i, 1) .'</option>';
		$i++;
	}
}
$drop_down = $drop_down. '</select>';
$postback_str = "";
if ( $frame == "user")
{
		$postback_str = $postback_str .'<table border="0" cellspacing="2" cellpadding="0"  width="70%">';
		$postback_str = $postback_str . '<tr><td Class="tabdivheadercolor"> First Name</td> <td> <input type="text" id ="firstname" name="firstname" /> </td> <td Class="tabdivheadercolor"> Last Name</td> <td> <input type="text" id ="lastname" name="lastname" /> </td> </tr>';
		$postback_str = $postback_str . '<tr><td Class="tabdivheadercolor"> Salary Range</td> <td > <input type="text" id ="salfrom" name="salfrom" /> &nbsp; to &nbsp;</td> <td> <input type="text" id = "salto" name="salto" /></td> <td> </td> </tr>';
		$postback_str = $postback_str . '<tr> <td Class="tabdivheadercolor"> User Role</td> <td colspan="3" >'.$drop_down.'</td></tr>';
		$postback_str = $postback_str . '<tr height="15px"> <td> </td> </tr>';
		$postback_str = $postback_str . '<tr> <td colspan="4"> <div align="left"> <input type="button" style="color:blue;width:80px;height:25px" name="usersearch" value="Search" onclick="getusersearchresults()" ></div></td></tr>';
		$postback_str = $postback_str . '</table>';
	}
if ( $frame == "product")
{
		$postback_str = $postback_str .'<table border="0" cellspacing="2" cellpadding="0"  width="70%">';
		$postback_str = $postback_str . '<tr><td Class="tabdivheadercolor"> Product Name</td> <td> <input type="text" id ="productname" name="productname" /> </td> <td Class="tabdivheadercolor"> Product Description</td> <td> <input type="text" id ="productdesc" name="productdesc" /> </td> </tr>';
		$postback_str = $postback_str . '<tr><td Class="tabdivheadercolor"> Price Range</td> <td > <input type="text" id ="pricefrom" name="pricefrom" /> &nbsp; to &nbsp;</td> <td> <input type="text" id = "priceto" name="priceto" /></td> <td> </td> </tr>';
		$postback_str = $postback_str . '<tr> <td Class="tabdivheadercolor"> Product Category</td> <td colspan="3" >'.$drop_down.'</td></tr>';
		$postback_str = $postback_str . '<tr height="15px"> <td> </td> </tr>';
		$postback_str = $postback_str . '<tr> <td colspan="4"> <div align="left"> <input type="button" style="color:blue;width:80px;height:25px" name="productsearch" value="Search" onclick="getproductsearchresults()" ></div></td></tr>';
		$postback_str = $postback_str . '</table>';
}	
if ( $frame == "specialsales")
{
		$postback_str = $postback_str .'<table border="0" cellspacing="2" cellpadding="0"  width="80%">';
		$postback_str = $postback_str . '<tr> <td Class="tabdivheadercolor"> Product Name</td><td> <input type="text" id ="productname" name="productname" /> </td> <td colspan="2" Class="tabdivheadercolor"> Sale Date from &nbsp; <input type="text" id ="salefrom" name="salefrom" /> &nbsp; to <input type="text" id ="saleto" name="saleto" /> </td> 		</tr>';
		$postback_str = $postback_str . '<tr><td Class="tabdivheadercolor"> Price Range</td> <td > <input type="text" id ="pricefrom" name="pricefrom" /> &nbsp; to &nbsp;</td> <td> <input type="text" id = "priceto" name="priceto" /></td> <td> </td> </tr>';
		$postback_str = $postback_str . '<tr> <td Class="tabdivheadercolor"> Product Category</td> <td colspan="3" >'.$drop_down.'</td></tr>';
		$postback_str = $postback_str . '<tr height="15px"> <td> </td> </tr>';
		$postback_str = $postback_str . '<tr> <td colspan="4"> <div align="left"> <input type="button" style="color:blue;width:80px;height:25px" name="specialsalessearch" value="Search" onclick="getspecialsalesresults()" ></div></td></tr>';
		$postback_str = $postback_str . '</table>';
}


		
//$postback_str = $drop_down;
//mysql_close();

echo $postback_str;
 
 
 }
?>