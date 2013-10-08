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

.tabdivheadercolor

{

	background-color:006699;

	Color:White;

	text-align=center;

}

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

function onsubmitform(a,b)
{
   // alert("Edit_Pro_Cat.php?ID="+a+"&Type="+b);
    document.body.action ="Edit_Pro_Cat.php?ID="+a+"&Type="+b;
   	
   return true;
}
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
      window.location="SpecialSales.php";
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
<tr><td width="60px"><td></td>
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
<td></td></tr>

</table>
</div>


<div id="div1" style="position:absolute;left:5.1in;top:2.17in;height:0in;width:10in;display:block;">
<table border="0">
<tr>
<td width="105px"><label for="submit" id="em" style="color:white">Category Info</label></td>

<td width="100px"><label for="submit" id="em1" style="color:white;" align="center">Product Info</label></td>

<td width="110px"><label for="submit" id="em2" style="color:white;" align="center" >Special Sales Info</label></td>

</tr>
</table>
</div>



</form>
<?php

$username="root";

$password="";

$database="relancer";



mysql_connect("localhost",$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM product_category ";

$result=mysql_query($query);



$num=mysql_numrows($result);



mysql_close();

?>
<form name ="body" method="POST" >

<div id="div1" style="position:absolute;left:3.8in;top:3in;height:0in;width:10in;display:block;">
<table >
<td colspan="2"><input type="submit" name="back"  style="color:blue;" name="Add" onclick="onsubmitform('','add')" value="Add Product Category" ></td></tr>
</table>
<table border="1" cellspacing="2" cellpadding="2" id="UserInformation">

<tr style="bgcolor:blue">

<td  Class="tabdivheadercolor">Category ID</td>

<td  Class="tabdivheadercolor">Category Name</td>

<td  Class="tabdivheadercolor">Category Description</td>

<td  Class="tabdivheadercolor">Edit Info</td>

<td  Class="tabdivheadercolor">Delete Info</td>

</tr>



<?php

$i=0;



while ($i < $num) {



$f2=mysql_result($result,$i,"CategoryID");

$f3=mysql_result($result,$i,"ProductCategory");

$f4=mysql_result($result,$i,"ProductDescription");



?>



<tr>

<td><?php echo $f2; ?></td>

<td><?php echo $f3; ?></td>

<td><?php echo $f4; ?></td>

<td  ><input type="submit" name="edit" onclick="onsubmitform('<?php echo $f2; ?>','edit')" value="Edit" /></td>

<td  ><input type="submit" name="delete" onclick="onsubmitform('<?php echo $f2; ?>','delete')"  value="Delete" /></td>





</tr>



<?php

$i++;

}

?>





</div>


</form>


</body>
</html>

