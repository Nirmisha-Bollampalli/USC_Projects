<?php
session_start();
if (strlen($_SESSION['username']) == 0 || $_SESSION['userrole'] != 'Admin')
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
function Display(value)
{
  switch(value)
   {
   case "home" :
      window.location="Admin_Home.php";
	  break;
   case "submit":
   
      window.location="User_Info.php";
	  break;
   
   case "submit1":
      window.location="Add_User.php";
	  break;
   case "submit2":
      window.location="Delete_User.php";
	  break;
   case "submit3":
      window.location="Update.php";
	  break;	  
    }	    

}
</script>
</head>
<body background="Img.png">
<form name ="header">
<p style="color:white; text-align: center"> Welcome <?php echo $_SESSION['firstname'] .' '.$_SESSION['lastname']; ?> &nbsp; <a href="loginEx.php"> [Logout] </a> </p>

<div id="div1" style="position:absolute;left:4.2in;top:1.5in;height:0in;width:10in;display:block;">

<table border="0">
<tr><td><input type="button" id="home" class="myclass4" style="border: 1px solid black ;width:63;height:63" onmouseover="document.getElementById('em_home').style.color='blue'" onmouseout="document.getElementById('em_home').style.color='white'" name="home" value="" onclick="Display(this.name)"/></td>
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
<td><input type="button" id="userinfo" class="myclass" style="border: 1px dotted blue;width:63;height:63" onmouseover="document.getElementById('em').style.color='blue'" onmouseout="document.getElementById('em').style.color='white'" name="submit" value="" onclick="Display(this.name)"/></td>
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
<td><input type="button" class="myclass1" style="border: 1px solid black ;width:63;height:63" onmouseover="document.getElementById('em1').style.color='blue'" onmouseout="document.getElementById('em1').style.color='white'" name="submit1" value="" onclick="Display(this.name)"/></td>
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


<div id="div1" style="position:absolute;left:4.3in;top:2.17in;height:0in;width:10in;display:block;">
<table border="0">
<tr><td><label for="home" id="em_home" style="color:white">Home</label></td>
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

<td><label for="submit" id="em" style="color:white">User Info</label></td>
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
<td><label for="submit" id="em1" style="color:white;" align="center">Add User</label></td>
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
<td><label for="submit" id="em2" style="color:white;" align="center" >Delete User</label></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

<td><label for="submit" id="em3" style="color:white;" align="center">Update User</label></td></tr>
</table>
</div>


</form>
<?php

$username="root";

$password="";

$database="relancer";



mysql_connect("localhost",$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM user_table";

$result=mysql_query($query);



$num=mysql_numrows($result);



mysql_close();

?>
<form name ="body" >

<div id="div1" style="position:absolute;left:3.5in;top:3in;height:0in;width:10in;display:block;">

<table border ="1">
<tr style="bgcolor:blue">

<td Class="tabdivheadercolor" width="635px" align = "center" Style="color:white;font-size:20px">User Information</td></tr>
<tr><td colspan="6" align = "center" Style="color:white"></td></tr>
</table>
<table border="1" cellspacing="2" cellpadding="2" id="UserInformation">



<tr style="bgcolor:blue">

<td  Class="tabdivheadercolor">UserID</td>

<td  Class="tabdivheadercolor">User Name</td>

<td  Class="tabdivheadercolor">Password</td>

<td  Class="tabdivheadercolor">First Name</td>

<td  Class="tabdivheadercolor">Last Name</td>

<td  Class="tabdivheadercolor">Address</td>

<td  Class="tabdivheadercolor">Phone Number</td>

<td  Class="tabdivheadercolor">Role</td>

</tr>



<?php

$i=0;



while ($i < $num) {



$f1=mysql_result($result,$i,"UserID");

$f2=mysql_result($result,$i,"UserName");

$f3=mysql_result($result,$i,"Password");

$f4=mysql_result($result,$i,"FirstName");

$f5=mysql_result($result,$i,"LastName");

$f6=mysql_result($result,$i,"Address");

$f7=mysql_result($result,$i,"PhoneNo");

$f8=mysql_result($result,$i,"Role");

?>



<tr>

<td><?php echo $f1; ?></td>

<td><?php echo $f2; ?></td>

<td><?php echo $f3; ?></td>

<td><?php echo $f4; ?></td>

<td><?php echo $f5; ?></td>

<td><?php echo $f6; ?></td>

<td><?php echo $f7; ?></td>

<td><?php echo $f8; ?></td>



</tr>



<?php

$i++;

}

?>





</div>


</form>


</body>
</html>

