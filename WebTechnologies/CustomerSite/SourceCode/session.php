<?PHP
session_start();
if (strlen($_SESSION['username']) == 0)
{
	//Invalid session
	header('Location: customer_home_nologin.php?action=logout');
	exit;
}

?>