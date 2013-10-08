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
<tr><td><input type="button" id="home" class="myclass4" style="border: 1px solid black  ;width:63;height:63" onmouseover="document.getElementById('em_home').style.color='blue'" onmouseout="document.getElementById('em_home').style.color='white'" name="home" value="" onclick="Display(this.name)"/></td>
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
//$ID = $_POST[UserID];
$Uname = $_POST['Uname'];
$Password = $_POST['Pass'] ;
$Fname= $_POST['fname'];
$Lname =$_POST['lname'];
$Address = $_POST['address'];
$number= $_POST['number'];
$Age = $_POST['age'];
$salary= $_POST['salary'];
$Role = $_POST['Role'];


if (empty ($Uname))
    $errorUname = "*";
else if(is_numeric($Uname))
    $errorUname = "*";	
else
    $errorUname = "";	
if (empty ($Password))
    $errorPass = "*";
else
    $errorPass = "";
if (empty ($Fname))
    $errorFname = "*";
else if(is_numeric($Fname))
    $errorFname = "*";		
else
    $errorFname = "";
if (empty ($Lname))
    $errorLname = "*";
else if(is_numeric($Lname))
    $errorLname = "*";		
else
    $errorLname = "";
if (empty ($Address))
    $errorAddr = "*";
else
    $errorAddr = "";
if (empty ($number))
    $errorNo = "*";
else if(!is_numeric($number))
    $errorNo = "*";		
else
    $errorNo = "";
/*if (empty ($Role))
    $errorRole = "*";
else
    $errorRole = "";	
	*/

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("relancer", $con);

if($errorUname=="" && $errorPass=="" && $errorFname=="" && $errorLname=="" && $errorAddr=="" && $errorNo=="" )
{
		
		  
		    // echo "<script language=javascript>alert('Error')</script>";
			 $sql="UPDATE user_table SET UserName='$_POST[Uname]',Password='$_POST[Pass]', FirstName ='$_POST[fname]',LastName ='$_POST[lname]' ,Address = '$_POST[address]' ,PhoneNo='$_POST[number]' ,Age='$_POST[age]',Salary='$_POST[salary]',Role='$_POST[Role]' where UserID='$_POST[UserID]' ";
			 //echo $sql;
              $res1 = mysql_query($sql,$con);
			
			 if (!$res1)
			  {
			  //die('Error: ' . mysql_error());
			  echo "<script language=javascript>alert('Error')</script>";
			  }
			  else
			  {
		           //  header ('Location : Update.php');
			 //After data gets inserted
			 
			   echo "<form name='add_user' method = 'Post' action='populate_form.php'>";
				echo "<div id='div1' style='position:absolute;left:4.3in;top:3in;height:0in;width:10in;display:block;'>";
				echo "<p Style='color:blue'>Please Enter A First Name To Proceed(Mandatory)</p>";
				echo "<fieldset style='width:450px'>";
				echo "<table ><tr><td style='color:blue'></td><td ><input class='textbox' hidden type='text' name='UserID' value='";
				echo "";
				echo "'></td><td></td><td>";
				//echo $errorID;
				echo "<td></tr>";
				echo "<tr><td style='color:blue'>First Name :</td><td><input type='text' name='fname' value='";
				echo "";
				echo "'></td><td>";
				echo $errorFname;
				echo "</td><tr><td style='color:blue'><input type='Submit' name='continue' value='Continue' style='color:blue'></td></tr>";
				echo "</table>";
				echo "</fieldset>";
				echo "</div>";
				echo "</form>";
				echo "<script language=javascript>alert('Updation Complete')</script>";
			}	
						 
}
else
{

echo "<form name='add_user' method = 'Post' action='Update_Data.php'>";
echo "<div id='div1' style='position:absolute;left:4.3in;top:3in;height:0in;width:10in;display:block;'>";

echo "<fieldset style='width:450px'>";
echo "<legend style='color:blue'>UPDATE USER</legend>";
echo "<table > <tr> <td style='color:blue'></td><td ><input class='textbox' hidden type='text' name='UserID' value='";
//echo $ID;
echo "'></td><td></td><td>";
//echo $errorID;
echo "<td></tr>";
echo "<tr><td style='color:blue'>User Name :</td><td><input type='text' name='Uname' value='";
echo $Uname;
echo"'></td><td>";
echo $errorUname;
echo"</td></tr><tr><td style='color:blue'>Password : </td><td><input type='text' name='Pass' value='";
echo $Password;
echo"'></td><td>";
echo $errorPass;
echo "<td></tr>";
echo "<tr><td style='color:blue'>First Name :</td><td><input type='text' name='fname' value='";
echo $Fname;
echo"'></td><td>";
echo $errorFname;
echo "<td></tr>";
echo "<tr><td style='color:blue'>Last Name : </td><td><input type='text' name='lname' value='";
echo $Lname;
echo"'></td><td>";
echo $errorLname;
echo "<td></tr>";
echo "<tr><td style='color:blue'>Address : </td><td><input type='text' name='address' value='"; 
echo $Address; 
echo"'></td><td>";
echo $errorAddr;
echo "<td></tr>";
echo "<tr><td style='color:blue'>Contact Number : </td><td><input type='text' name='number' value='";
echo $number;
echo"'></td><td>";
echo $errorNo;
echo "<td></tr>";
echo "<tr><td style='color:blue'>Age : </td><td><input type='text' name='age' value='";
echo $Age;
echo"'></td><td>";
echo $salary;
echo "<td></tr>";
echo "<tr><td style='color:blue'>Salary : </td><td><input type='text' name='salary' value='";
echo $number;
echo"'></td><td>";
echo $errorNo;
echo "<td></tr>";
echo "<tr><td style='color:blue'>Role: </td><td><select name = 'Role' ><option value='";
echo $Role;
echo "'>";
echo $Role;
echo "-<option><option value='Admin'>Admin<option><option value='Sales Manager'>Sales Manager<option><option value='Manager'>Manager<option></select></td><td>";
//echo $errorRole;
echo "<td></tr>";
echo "<tr><td></td></tr>";
echo "<tr><td></td></tr>";
echo "<tr><td></td></tr>";
echo "<tr><td style='color:blue'><input type='submit' name='submit' value='Save' style='color:blue'></td></tr>";
echo "</table>";
echo "</fieldset>";
echo "</div>";
echo "</form>";
echo "<script language=javascript>alert('Please Fill In All Fields With Proper Values')</script>";
}
mysql_close($con);
?>
</body>
</html>