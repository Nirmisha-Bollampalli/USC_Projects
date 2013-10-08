<?php
session_start();
if (strlen($_SESSION['username']) == 0 || $_SESSION['userrole'] != 'Manager')
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
		//alert(b+'hello');
		// alert("Edit_Pro_Cat.php?ID="+a+"&Type="+b);
		if(b == 'category')
		window.location="M_product_category_info.php";
		else if(b == 'product')
		window.location="M_Product.php";
	   //return true;
	}
function Display(value)
{
  
 switch(value)
   {
   case "user" :
      window.location="manager.php?action=user";
	  //alert('hello');
	  break;
   case "product":
   
      window.location="manager.php?action=products";
	  break;
   
   case "specialsales":
      window.location="manager.php?action=specialsales";
	  break;
   case "submit2":
      window.location="Manager_View_User_Info.php";
	  break;
   case "submit3":
      window.location="Manager_Product_Info.php";
	  break;	  
    }	  	    

}
</script>
</head>
<body background="Img.png">
<form name ="header">
<p style="color:white; text-align: center"> Welcome <?php echo $_SESSION['firstname'] .' '.$_SESSION['lastname']; ?> &nbsp; <a href="loginEx.php"> [Logout] </a> </p>

<div id="div1" style="position:absolute;left:4.1in;top:1.5in;height:0in;width:10in;display:block;">

<table border="0">
<tr><td><input type="button" id="home" class="myclass4" style="border: 1px solid black ;width:63;height:63" onmouseover="document.getElementById('em_home').style.color='blue'" onmouseout="document.getElementById('em_home').style.color='white'" name="user" value="" onclick="Display(this.name)"/></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

<td><input type="button" id="userinfo" class="myclass" style="border: 1px dotted blue;width:63;height:63" onmouseover="document.getElementById('em').style.color='blue'" onmouseout="document.getElementById('em').style.color='white'" name="product" value="" onclick="Display(this.name)"/></td>
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
<td><input type="button" class="myclass1" style="border: 1px solid black ;width:63;height:63" onmouseover="document.getElementById('em1').style.color='blue'" onmouseout="document.getElementById('em1').style.color='white'" name="specialsales" value="" onclick="Display(this.name)"/></td>
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


<div id="div1" style="position:absolute;left:4in;top:2.17in;height:0in;width:10in;display:block;">
<table border="0">
<tr><td><label for="home" id="em_home" style="color:white">Search Users</label></td>


<td></td>
<td></td>
<td></td>



<td><label for="submit" id="em" style="color:white">Search Products</label></td>
<td></td>
<td></td>
<td><label for="submit" id="em1" style="color:white;" align="center">Search SpecialSales</label></td>
<td></td>
<td></td>

<td></td>

<td><label for="submit" id="em2" style="color:white;" align="center" >View Users</label></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

<td><label for="submit" id="em3" style="color:white;" align="center">View Products</label></td></tr>
</table>
</div>


</form>
        

<form name="add_user" method = "Post" >
<div id="div1" style="position:absolute;left:4.3in;top:3in;height:0in;width:10in;display:block;">
<p Style="color:blue"><b></b>VIEW PRODUCT INFORMATION<b></b></p>
<fieldset style="width:450px ;height:50px">
<table >
<tr><td  style="color:blue">View Product Category:</td  ><td  ><input type="button" name="category" onclick="onsubmitform('','category')" value="View Product Category" /></td></tr>

<tr><td  style="color:blue">View Products:</td  ><td><input type="button" name="product" onclick="onsubmitform('','product')"  value="View Products" /></td></tr>

</table>
</fieldset>
</div>
</form>



</body>
</html>

