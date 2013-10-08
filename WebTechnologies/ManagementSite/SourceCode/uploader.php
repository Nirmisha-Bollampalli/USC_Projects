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
<tr>

<td width="40px"></td>
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
<td><input type="button" class="myclass3" style="border: 1px solid Black;width:63;height:63" name="submit3" value="" onclick="Display(this.name)" onmouseover="document.getElementById('em3').style.color='blue'" onmouseout="document.getElementById('em3').style.color='white'"/></td></tr>

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

<td><label for="submit" id="em" style="color:white">Category Info</label></td>
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




</body>
</html>

<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("relancer", $con);
			
$CategoryID = $_POST['CategoryID'];
$ProductName = $_POST['ProductName'];
$ProductQuantity = $_POST['ProductQuantity'] ;
$ProductPrice= $_POST['ProductPrice'];


if(true)
{
if (empty ($ProductName) )
    $errorID1 = "*";
else if(is_numeric($ProductName))
    $errorID1 = "*";
else
    $errorID1 = "";

if (empty ($ProductQuantity) )
    $errorID = "*";
else if(!is_numeric($ProductQuantity))
    $errorID = "*";
else
    $errorID = "";	
if (empty ($ProductPrice) )
    $errorID2 = "*";
else if(!is_numeric($ProductPrice))
    $errorID2 = "*";
else
    $errorID2 = "";
	


if(  strlen($_FILES['uploadedfile']['name'])  == 0){ 
       $errorID3 = "*";   
    }
else
{	
        $errorID3 = "";
}


	


if($errorID == "" && $errorID1 == "" && $errorID2 == "" && $errorID3 == "" && $errorID3 == "")
{
			$target_path = "uploads/";
			$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

					if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
					{
						//echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
						//" has been uploaded";
					} 
					else
					{
						echo "There was an error uploading the file, please try again!";
					}
			$imagename = basename( $_FILES['uploadedfile']['name']);
			
			
			$sql = "Insert into cakes Values('$_POST[CategoryID]','','$_POST[ProductName]','$_POST[ProductQuantity]','$_POST[ProductPrice]','$_POST[ProductDescription]','$target_path')"; 
			
			
			//"INSERT INTO User_Table (UserID,UserName,Password,FirstName,Lastname,Address,PhoneNo,Role)VALUES
				 //('$_POST[UserID]','$_POST[Uname]','$_POST[Pass]','$_POST[fname]','$_POST[lname]','$_POST[address]','$_POST[number]','$_POST[Role]')";
		//	echo $sql;
			$insert = mysql_query($sql);
				  
				  if(!($insert))
				  {
				        echo  "<form enctype='multipart/form-data'  name='add_product' method = 'Post' action='uploader.php'>";
						echo  "	<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'> ";

						echo  "	<fieldset style='width:450px'> ";
						echo  "     <table > ";
						
						echo  "	<tr><td style='color:blue'></td><td><input type='text' hidden name='CategoryID' value='";
						echo $CategoryID;
						echo "'></td><td>";
						//echo  $errorID1;
						echo  "</td></tr>";					
						
						echo  "	<tr><td style='color:blue'>Product Name :</td><td><input type='text' name='ProductName' value=''></td><td>";
						//echo  $errorID1;
						echo  "</td></tr>";
						echo  "	<tr><td style='color:blue'>Product Quantity : </td><td><input type='text' name='ProductQuantity' value=''></td><td>";
						//echo  $errorID;
						echo  "</td></tr>";
						echo  "	<tr><td style='color:blue'>Product Description : </td><td><input type='text' name='ProductDescription' value=''></td><td>";
						//echo  $errorID;
						echo  "</td></tr>";
						echo  "	<tr><td style='color:blue'>Product Price :</td><td><input type='text' name='ProductPrice' value=''></td></tr>";
						echo  "    <tr><td style='color:blue'>Product Image : </td><td><input name='uploadedfile' type='file' />";
						echo  "	</td></tr>";
								
						echo  "	<tr><td style='color:blue'><input type='submit' name='submit' value='Save' style='color:blue'></td></tr>";
						echo  "	</table>";
						echo  "	</fieldset>";
						echo  "	</div>";
						echo  "   </form>";
					  echo "<script language=javascript>alert('SQl Error Contact Admin')</script>";
				  }	  
				  else
				  {
					 echo "<script language=javascript>alert('Product Added')</script>";
					 //header('Location:Product.php');
					 printf("<script>location.href='Product.php'</script>");
					  
				  }
				  
				  
				  
}
else
{
    echo  "<form enctype='multipart/form-data'  name='add_product' method = 'Post' action='uploader.php'>";
	echo  "	<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'> ";

	echo  "	<fieldset style='width:450px'> ";
	echo  "     <table > ";
    echo  "	<tr><td style='color:blue'></td><td><input type='text' hidden name='CategoryID' value='";
	echo $CategoryID;
	echo "'></td><td>";
	//echo  $errorID1;
	echo  "</td></tr>";	
	echo  "	<tr><td style='color:blue'>Product Name :</td><td><input type='text' name='ProductName' value=''></td><td>";
	echo  $errorID1;
	echo  "</td></tr>";
	echo  "	<tr><td style='color:blue'>Product Quantity : </td><td><input type='text' name='ProductQuantity' value=''></td><td>";
	echo  $errorID;
	echo  "</td></tr>";
	echo  "	<tr><td style='color:blue'>Product Price :</td><td><input type='text' name='ProductPrice' value=''></td></tr>";
    echo  "    <tr><td style='color:blue'>Product Image : </td><td><input name='uploadedfile' type='file' />";
	echo  "	</td></tr>";
	echo  "	<tr><td style='color:blue'>Product Description : </td><td><input type='text' name='ProductDescription' value=''></td><td>";
	//echo  $errorID;
	echo  "</td></tr>";		
	echo  "	<tr><td style='color:blue'><input type='submit' name='submit' value='Save' style='color:blue'></td></tr>";
	echo  "	</table>";
	echo  "	</fieldset>";
	echo  "	</div>";
    echo  "   </form>";
			echo "<script language=javascript>alert('Please Fill In All Fields With Proper Values')</script>";




}	
}	
else
{
 echo  "<form enctype='multipart/form-data'  name='add_product' method = 'Post' action='uploader.php'>";
						echo  "	<div id='div1' style='position:absolute;left:2.2in;top:3.8in;height:0in;width:10in;display:block;'> ";

						echo  "	<fieldset style='width:450px'> ";
						echo  "     <table > ";
						
						echo  "	<tr><td style='color:blue'></td><td><input type='text' hidden name='CategoryID' value='";
						echo $CategoryID;
						echo "'></td><td>";
						//echo  $errorID1;
						echo  "</td></tr>";					
						
						echo  "	<tr><td style='color:blue'>Product Name :</td><td><input type='text' name='ProductName' value=''></td><td>";
						//echo  $errorID1;
						echo  "</td></tr>";
						echo  "	<tr><td style='color:blue'>Product Quantity : </td><td><input type='text' name='ProductQuantity' value=''></td><td>";
						//echo  $errorID;
						echo  "</td></tr>";
						echo  "	<tr><td style='color:blue'>Product Description : </td><td><input type='text' name='ProductDescription' value=''></td><td>";
						//echo  $errorID;
						echo  "</td></tr>";
						echo  "	<tr><td style='color:blue'>Product Price :</td><td><input type='text' name='ProductPrice' value=''></td></tr>";
						echo  "    <tr><td style='color:blue'>Product Image : </td><td><input name='uploadedfile' type='file' />";
						echo  "	</td></tr>";
								
						echo "<tr><td style='color:blue'>Special Sales:</td><td><input type='CheckBox' name='SpecialSales' value='1'></td></tr>";
						echo "	<tr><td style='color:blue'>Start Date :(Applicable only if Product Is on Special Sales)</td><td><input type='text' name='StartDate' value=''></td></tr>";
						echo "	<tr><td style='color:blue'>End Date :(Applicable only if Product Is on Special Sales)</td><td><input type='text' name='EndDate' value=''></td></tr>";
						echo  "	<tr><td style='color:blue'><input type='submit' name='submit' value='Save' style='color:blue'></td></tr>";
						echo  "	</table>";
						echo  "	</fieldset>";
						echo  "	</div>";
						echo  "   </form>";
					  echo "<script language=javascript>alert('SQl Error Contact Admin')</script>";


}		  
?>


