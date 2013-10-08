
<?php
session_start();
include ('connect.php');

if(isset($_GET['uname']))
{
$uname = $_GET['uname'];
}
else
$uname ='';

$query = "select * from registration where UserName='$uname'";
$row = mysql_query($query);
$num = mysql_num_rows($row);

if($num > 0)
echo "User Name already taken";
else
echo "";


?>