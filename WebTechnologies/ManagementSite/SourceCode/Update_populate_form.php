<?php
session_start();
if (strlen($_SESSION['username']) == 0 || $_SESSION['userrole'] != 'Sales Manager')
{
	//Invalid session
	header('Location: loginEx.php');
	exit;
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
    session_destroy();  
    session_unset();    
} 
$_SESSION['LAST_ACTIVITY'] = time(); 

?>
<?php
$ProductCategory = $_GET['Category'];
$username="root";

$password="";

$database="relancer";

mysql_connect("localhost",$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * from cakes WHERE ProductID = '$_GET[ID]'";


$result=mysql_query($query);
$row = mysql_fetch_array($result);

?>
<html>
<head>

<style type="text/css">
.myclass {
background: url(User_Info_1.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}
.myclass:hover {
background: url(User_Info_After.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}

.myclass1 {
background: url(Add_User.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}
.myclass1:hover {
background: url(Add_User_After.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}

.myclass2 {
background: url(Delete_User.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}
.myclass2:hover {
background: url(Delete_User_After.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}

.myclass3 {
background: url(Update.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}
.myclass3:hover {
background: url(Update_After.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}
.myclass4 {
background: url(Home.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}
.myclass4:hover {
background: url(Home_After.png)  no-repeat; border: none;
width: 63px;
height: 63px;
}

</style>
<script type="text/javascript" >
function Display(value)
{
  switch(value)
   {
   case "home" :
      window.location="Admin_Home.php";
	  break;
   case "submit":
   
      window.location="product_category_info.php";
	  break;
   
   case "submit1":
      window.location="Product.php";
	  break;
   case "submit2":
      window.location="SpecialSales.php";
	  break;
   case "submit3":
      window.location="Update.php";
	  break;	  
    }	 
}
</script>
</head>
<body background="Img2.png">
<form name ="header">
<p style="color:white; text-align: center"> Welcome <?php echo $_SESSION['firstname'] .' '.$_SESSION['lastname']; ?> &nbsp; <a href="loginEx.php"> [Logout] </a> </p>

<div id="div1" style="position:absolute;left:4.2in;top:1.5in;height:0in;width:10in;display:block;">

<table border="0">
<tr><td width="60px"></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td><input type="button" id="userinfo" class="myclass" style="border: 1px solid black  ;width:63;height:63" onmouseover="document.getElementById('em').style.color='blue'" onmouseout="document.getElementById('em').style.color='white'" name="submit" value="" onclick="Display(this.name)"/></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td><input type="button" class="myclass1" style="border: 1px dotted blue;width:63;height:63" onmouseover="document.getElementById('em1').style.color='blue'" onmouseout="document.getElementById('em1').style.color='white'" name="submit1" value="" onclick="Display(this.name)"/></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td><input type="button" id="delete" class="myclass2" style="border: 1px solid Black;width:63;height:63" name="submit2" value="" onclick="Display(this.name)" onmouseover="document.getElementById('em2').style.color='blue'" onmouseout="document.getElementById('em2').style.color='white'"/></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</div>


<div id="div1" style="position:absolute;left:4.5in;top:2.17in;height:0in;width:10in;display:block;">
<table border="0">
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

<td><label for="submit" id="em" style="color:white">Category Info</label></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

<td><label for="submit" id="em1" style="color:white;" align="center">Product Info</label></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

<td><label for="submit" id="em2" style="color:white;" align="center" >Special Sales Info</label></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

</tr>
</table>
</div>


</form>










<?php


        
		    
			//echo "<script language=javascript>alert('User  Exist')</script>";
            echo "<form name='add_product' method = 'Post' action='Update_Product_Data.php'>";
			echo "<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'>";
			echo "<p Style='color:red'><b></b>Please Enter ProductID And ProductName For any Updations(Mandatory)<b></b></p>";
			echo  "	<fieldset style='width:450px'> ";
			echo  "  <table > ";
			echo "<tr><td style='color:blue'></td><td><input type='text' hidden name='Category' value='";
			echo $ProductCategory;
			echo "'></td><td>";
			//echo $errorUname;
			echo " </td></tr>";
			echo "<tr><td style='color:blue'></td><td><input type='text' hidden name='CategoryID' value='";
			echo $row[0];
			echo "'></td><td>";
			//echo $errorUname;
			echo " </td></tr>";
			echo "<tr><td style='color:blue'></td><td><input type='text' hidden name='ProductID' value='";
			echo $row[1];
			echo"'></td><td>";
			//echo $errorUname;
			echo"</td></tr><tr><td style='color:blue'>Product Name: </td><td><input type='text' name='ProductName' value='";
			echo $row[2];
			echo"'></td><td>";
			//echo $errorPass;
			echo "<td></tr>";
			echo "<tr><td style='color:blue'>Product Quantity :</td><td><input type='text' name='ProductQuantity' value='";
			echo $row[3];
			echo"'></td><td>";
			//echo $errorFname;
			echo "<td></tr>";
			echo "<tr><td style='color:blue'>Product Price: </td><td><input type='text' name='ProductPrice' value='";
			echo $row[4];
			echo"'></td><td>";
			//echo $errorLname;
			echo "<td></tr>";
			echo "<tr><td style='color:blue'>Product Description: </td><td><input type='text' name='ProductDescription' value='";
			echo $row[5];
			echo"'></td><td>";
			//echo $errorLname;
			echo "<td></tr>";
			echo  " <tr><td style='color:blue'>Product Image : </td><td><input name='uploadedfile' type='file' />";
		    echo  "	</td></tr>";
			echo "<tr><td></td></tr>";
			echo "<tr><td></td></tr>";
			echo "<tr><td></td></tr>";
			echo "<tr><td style='color:blue'><input type='submit' name='submit' value='Save' style='color:blue'></td></tr>";
			echo "</table>";
			echo "</fieldset>";
			echo "</div>";
			echo "</form>";
		


		
?>
</body>
</html>