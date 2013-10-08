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
<?PHP 

if(array_key_exists("ID", $_GET)) { 
 
		  $ID = $_GET['ID'];
		  $Type = $_GET['Type'];
		  
		  
}

$username="root";

$password="";

$database="relancer";

mysql_connect("localhost",$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM product_category where CategoryID='$ID'";


$result=mysql_query($query);
$row = mysql_fetch_array($result);    

if($Type == 'edit')
{    
        echo "<form name='product_edit' method = 'Post' action=''>";
		
		echo "<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'>";
		echo "<fieldset style='width:450px'>";
		echo "<legend>Product Category Updation:</legend>";
		echo "<table >";
		echo "<tr><td style='color:blue'></td><td ><input class='textbox' type='text' hidden name='CategoryID' value='";
		echo $row[0];
		echo "'></td><td>";
		echo "<tr><td style='color:blue'>Product Category:</td><td ><input class='textbox' type='text' name='ProductCategory' value='";
		echo $row[1];
		echo "'></td><td>";
		//echo $errorID;
		echo "<td></tr>";
		echo "<tr><td style='color:blue'>Product Description :</td><td><input type='text' name='ProductDescription' value='";
		echo $row[2];
		echo "'></td><td>";
		//echo $errorFname;
		echo "</td><tr><td style='color:blue'><input type='Submit' name='update' value='Update' style='color:blue'></td></tr>";
		echo "</table>";
		echo "</fieldset>";
		echo "</div>";
		echo "</form>";
}
else if($Type == 'delete')
{
       $query_delete = "DELETE FROM product_category WHERE CategoryID='$_GET[ID]'";
       mysql_query($query_delete);
	   header('Location:product_category_info.php');
}

else
{
        echo "<form name='product_add' method = 'Post' action=''>";
		
		echo "<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'>";
		echo "<fieldset style='width:450px'>";
		echo "<legend>Add Product Category:</legend>";
		echo "<table >";
		echo "<tr><td style='color:blue'></td><td ><input class='textbox' type='text' hidden name='CategoryID' value='";
		echo "";
		echo "'></td><td>";
		echo "<tr><td style='color:blue'>Product Category:</td><td ><input class='textbox' type='text' name='ProductCategory' value='";
		echo "";
		echo "'></td><td>";
		//echo $errorID;
		echo "<td></tr>";
		echo "<tr><td style='color:blue'>Product Description :</td><td><input type='text' name='ProductDescription' value='";
		echo "";
		echo "'></td><td>";
		//echo $errorFname;
		echo "</td><tr><td style='color:blue'><input type='Submit' name='Add' value='Add' style='color:blue'></td></tr>";
		echo "</table>";
		echo "</fieldset>";
		echo "</div>";
		echo "</form>";

}		
if (isset($_POST['update'])) 
{
   $CategoryID = $_POST['CategoryID'];
  // echo  'Category'.$CategoryID;
   $ProductCategory = $_POST['ProductCategory'];
   
   if((empty($ProductCategory))  )
   {
      $errorID="Please Enter a Value";
   }
   else if (is_numeric($ProductCategory))
   {
      $errorID = "*";
   }
   else
   {
      $errorID ="";
   }
   if(mysql_num_rows (mysql_query("select * from product_category where ProductCategory = '$_POST[ProductCategory]' and CategoryID <> '$_POST[CategoryID]'")))
   {
      $error_pro_exists="*";
	  echo "<script language=javascript>alert('Product Category Exists')</script>";
   }
   else
   {
     $error_pro_exists="";
   }
   if($errorID =="" && $error_pro_exists=="")
   {
   
   $query1="UPDATE product_category SET ProductCategory='$_POST[ProductCategory]',ProductDescription='$_POST[ProductDescription]' where CategoryID='$_POST[CategoryID]'";
    //echo $query1;
	mysql_query($query1);
    
   printf("<script>location.href='product_category_info.php'</script>");
  // header('Location:product_category_info.php');
   exit;
   }
   else
   {
     //echo "<script language=javascript>alert('Please Fill In All Fields With Proper Values')</script>";

	 echo "<form name='product_edit' method = 'Post' action=''>";
		
		echo "<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'>";
		echo "<fieldset style='width:450px'>";
		echo "<legend>Product Category Updation:</legend>";
		echo "<table >";
		echo "<tr><td style='color:blue'></td><td ><input class='textbox' type='text' hidden name='CategoryID' value='";
		echo $_POST['CategoryID'];
		echo "'></td><td>";
		echo "<tr><td style='color:blue'>Product Category:</td><td ><input class='textbox' type='text' name='ProductCategory' value='";
		echo $_POST['ProductCategory'];
		echo "'></td><td>";
		echo $errorID;
		echo "<td></tr>";
		echo "<tr><td style='color:blue'>Product Description :</td><td><input type='text' name='ProductDescription' value='";
		echo $_POST['ProductDescription'];
		echo "'></td><td>";
		//echo $errorFname;
		echo "</td><tr><td style='color:blue'><input type='Submit' name='update' value='Update' style='color:blue'></td></tr>";
		echo "</table>";
		echo "</fieldset>";
		echo "</div>";
		echo "</form>";
   
   }
}		
if (isset($_POST['Add'])) 
{
   $CategoryID = $_POST['CategoryID'];
  // echo  'Category'.$CategoryID;
   $ProductCategory = $_POST['ProductCategory'];
   
   if((empty($ProductCategory))  )
   {
      $errorID="Please Enter a Value";
   }
   else if (is_numeric($ProductCategory))
   {
      $errorID = "Please Enter a Proper Value";
   }
   else
   {
      $errorID ="";
   }
   if(mysql_num_rows (mysql_query("select * from product_category where ProductCategory = '$_POST[ProductCategory]' ")))
   {
      $error_pro_exists="*";
	  
   }
   else
   {
    
     $error_pro_exists="";
   }
   if($errorID =="" && $error_pro_exists=="")
   {
    $query_add ="Insert into product_category Values('','$_POST[ProductCategory]','$_POST[ProductDescription]')"; 
	mysql_query($query_add);		
     printf("<script>location.href='product_category_info.php'</script>");
	//header('Location:product_category_info.php');
	exit;
	}
	else
	{
	     echo "<form name='product_edit' method = 'Post' action=''>";
		
		echo "<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'>";
		echo "<fieldset style='width:450px'>";
		echo "<legend>Add Product Category:</legend>";
		echo "<table >";
		echo "<tr><td style='color:blue'></td><td ><input class='textbox' type='text' hidden name='CategoryID' value='";
		echo $_POST['CategoryID'];
		echo "'></td><td>";
		echo "<tr><td style='color:blue'>Product Category:</td><td ><input class='textbox' type='text' name='ProductCategory' value='";
		echo $_POST['ProductCategory'];
		echo "'></td><td>";
		echo $errorID;
		echo "<td></tr>";
		echo "<tr><td style='color:blue'>Product Description :</td><td><input type='text' name='ProductDescription' value='";
		echo $_POST['ProductDescription'];
		echo "'></td><td>";
		//echo $errorFname;
		echo "</td><tr><td style='color:blue'><input type='Submit' name='Add' value='Add' style='color:blue'></td></tr>";
		echo "</table>";
		echo "</fieldset>";
		echo "</div>";
		echo "</form>";
		if( $error_pro_exists=="")
        { 
         echo "<script language=javascript>alert('Product Category Exists')</script>";
		 }
	}
}		
mysql_close();
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
      window.location="SalesManager_Home.php";
	  break;
   case "submit":
   
      window.location="product_category_info.php";
	  break;
   
   case "submit1":
      window.location="Product.php";
	  break;
   case "submit2":
      window.location="Delete_Product.php";
	  break;
   case "submit3":
      window.location="Update_Product.php";
	  break;	  
    }	  

}
</script>
</head>
<body background="Img2.png">
<form name ="header">
<p style="color:white; text-align: center"> Welcome <?php echo $_SESSION['firstname'] .' '.$_SESSION['lastname']; ?> &nbsp; <a href="loginEx.php"> [Logout] </a> </p>

<div id="div1" style="position:absolute;left:4in;top:1.5in;height:0in;width:10in;display:block;">

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
<td><input type="button" id="userinfo" class="myclass" style="border: 1px solid black ;width:63;height:63" onmouseover="document.getElementById('em').style.color='blue'" onmouseout="document.getElementById('em').style.color='white'" name="submit" value="" onclick="Display(this.name)"/></td>
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
<td><input type="button" class="myclass1" style="border: 1px solid black;width:63;height:63" onmouseover="document.getElementById('em1').style.color='blue'" onmouseout="document.getElementById('em1').style.color='white'" name="submit1" value="" onclick="Display(this.name)"/></td>
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


<div id="div1" style="position:absolute;left:5.1in;top:2.17in;height:0in;width:10in;display:block;">
<table border="0">
<tr>
<td width="105px"><label for="submit" id="em" style="color:white">Category Info</label></td>

<td width="100px"><label for="submit" id="em1" style="color:white;" align="center">Product Info</label></td>

<td width="110px"><label for="submit" id="em2" style="color:white;" align="center" >SpecialSales Info</label></td>


</tr>
</table>
</div>


</form>



</body>
</html>


