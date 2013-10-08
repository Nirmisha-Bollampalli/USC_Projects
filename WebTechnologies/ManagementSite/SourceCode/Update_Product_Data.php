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
<body background="Add_User_Temp.png">
<form name ="header">
<p style="color:white; text-align: center"> Welcome <?php echo $_SESSION['firstname'] .' '.$_SESSION['lastname']; ?> &nbsp; <a href="loginEx.php"> [Logout] </a> </p>

<div id="div1" style="position:absolute;left:4.2in;top:1.5in;height:0in;width:10in;display:block;">

<table border="0">
<tr>
<td width="60px"></td>
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


<div id="div1" style="position:absolute;left:4.3in;top:2.17in;height:0in;width:10in;display:block;">
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

<td><label for="submit" id="em" style="color:white">Category Info</label></td>
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
<td><label for="submit" id="em1" style="color:white;" align="center">Product Info</label></td>
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

</tr></table>
</div>


</form>









<?php
$ID = $_POST['ProductID'];
$ProductName = $_POST['ProductName'];
$ProductQuantity = $_POST['ProductQuantity'] ;
$ProductPrice= $_POST['ProductPrice'];
$ProductDescription= $_POST['ProductDescription'];


//Validation Code
if (empty ($ProductQuantity) )
    $errorID = "*";
else if(!is_numeric($ProductQuantity))
    $errorID = "*";
else
    $errorID = "";

if (empty ($ProductPrice) )
    $errorID1 = "*";
else if(!is_numeric($ProductPrice))
    $errorID1 = "*";
else
    $errorID1 = "";
	
if (empty ($ProductName))
    $errorID2 = "*";
else if(is_numeric($ProductName))
    $errorID2 = "*";	
else
    $errorID2 = "";	
	
	

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("relancer", $con);

if($errorID=="" && $errorID1 == "" && $errorID2 =="" )
{
		
		  
		    // echo "<script language=javascript>alert('Error')</script>";
			 $sql="UPDATE cakes SET ProductName='$_POST[ProductName]', ProductQuantity ='$_POST[ProductQuantity]',ProductPrice ='$_POST[ProductPrice]' ,ProductDescription= '$_POST[ProductDescription]' where ProductID='$_POST[ProductID]' ";
			 echo $sql;
              $res1 = mysql_query($sql,$con);
			
			 if (!$res1)
			  {
			  //die('Error: ' . mysql_error());
			  echo "<script language=javascript>alert('Error')</script>";
			  }
			  else
			  {
		        echo "<script language=javascript>alert('Product Added')</script>";
			  // header('Location:Product.php');
			  printf("<script>location.href='Product.php'</script>");
			  }	
						 
}
else
{
            
            echo "<form name='add_product' method = 'Post' action='Update_Product_Data.php'>";
			echo "<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'>";
			echo "<p Style='color:red'><b></b>Please Enter ProductID And ProductName For any Updations(Mandatory)<b></b></p>";
			echo  "	<fieldset style='width:450px'> ";
			echo  "  <table > ";
			
			echo "<tr><td style='color:blue'></td><td><input type='text' hidden name='ProductID' value='";
			echo $ID;
			echo"'></td><td>";
			//echo $errorUname;
			echo"</td></tr><tr><td style='color:blue'>Product Name: </td><td><input type='text' name='ProductName' value='";
			echo $ProductName;
			echo"'></td><td>";
			echo $errorID2;
			echo "<td></tr>";
			echo "<tr><td style='color:blue'>Product Quantity :</td><td><input type='text' name='ProductQuantity' value='";
			echo $ProductQuantity;
			echo"'></td><td>";
			echo $errorID;
			echo "<td></tr>";
			echo "<tr><td style='color:blue'>Product Price: </td><td><input type='text' name='ProductPrice' value='";
			echo $ProductPrice;
			echo"'></td><td>";
			echo $errorID1;
			echo "<td></tr>";
			echo "<tr><td style='color:blue'>Product Description: </td><td><input type='text' name='ProductDescription' value='";
			echo $ProductDescription;
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
			echo "<script language=javascript>alert('Please Fill in Values marked by *')</script>";
}
mysql_close($con);
?>
</body>
</html>