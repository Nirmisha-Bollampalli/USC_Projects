<?php
	session_start();
	$login_error = "";
	$uname = '';
	$pword = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	if (strlen($uname) > 0 && strlen($pword) >0 )
	{
		//echo "User Name: ".$uname;
		//include('Connect.php');
		$conn = mysql_connect("localhost", "root" , "" ) or die('cannot connect to server') ;
		$conn_db = mysql_select_db( 'relancer', $conn) or die('cannot connect');
		// Retrieve username and password from database according to user's input
		$result = mysql_query("SELECT * FROM user_table WHERE UserName = '" . mysql_real_escape_string($_POST['username']) . "' and Password = '" . mysql_real_escape_string($_POST['password']) . "'");
	//	echo "SELECT * FROM user_table WHERE UserName = '" . mysql_real_escape_string($_POST['username']) . "' and Password = '" . mysql_real_escape_string($_POST['password']) . "'";
		// Check username and password match
		if (mysql_num_rows($result) > 0) {
				//$user_record = mysql_fetch_field($result, 0);
				$user_record = mysql_fetch_array($result, MYSQL_ASSOC);
				//session_start();
				// Set username session variable
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['firstname'] = $user_record["FirstName"];;
				$_SESSION['lastname'] = $user_record["LastName"];;
				$_SESSION['userrole'] = $user_record["Role"];
				// Jump to secured page
				if ($_SESSION['userrole'] == 'Admin')
				{
					header('Location: Admin_Home.php');
					exit;
				} else if ($_SESSION['userrole'] == 'Manager')
				{
					header('Location: manager.php');
					exit;
				} else if ($_SESSION['userrole'] == 'Sales Manager')
				{
					header('Location: product_category_info.php');
					exit;
				}
				//header('Location: admin.php');
				$login_error = "Valid Login :-> ". $_SESSION['userrole']  ;
		}
		else {
					$login_error = " Invalid User Name or Password " ;
			}
	} else
	{
		if(strlen($uname) ==0 && strlen($pword) ==0 )
			{ $login_error = " Please enter User name and Password ";}
		else if (strlen($uname) ==0	)
		{
			{ $login_error = " Please enter User name";}
		} else
		 { $login_error = $login_error . " Please enter Password";}
	}
}

?>

<html>
<form name="Login" METHOD ="POST" >
<body background="Login.png">
<table width="100%" height="100%" border="0">
	<tr height="10%"> <td> </td> </tr>
	<tr >
		<td> <div align="center">
			<table valign="top" name="login_table" border = "0" height="350" width="400" background="login_bg.jpg" >
				<tr><td height="30%" colspan="3" style="color: red; text-align: center"> <?php echo $login_error; ?> </td></tr>
				<tr><td width="30%"> </td><td><div>User Name:</div><div> <input type="text" name="username" value="<?php echo $uname; ?>"> </div></td><td width="30%"> </td></tr>
				<tr><td width="30%"> </td><td><div>Password:</div><div> <input type="password" name="password" value="<?php echo $pword; ?>"></div></td><td width="30%"> </td></tr>
				<tr><td colspan="2" ><div align="right"> <input type="submit" name="Submit" Value="Login"></div></td><td width="30%"> </td></tr>
				<tr><td height="30%" colspan="3" ></td></tr>
			</table>
			</div>

		</td>
	</tr>
	<tr height="50%"> <td> </td> </tr>
</table>


</body>
</form>
</html>