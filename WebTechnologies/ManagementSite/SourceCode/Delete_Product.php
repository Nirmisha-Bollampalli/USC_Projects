<?php
       //$ProductCategory = $_GET['ID'];
	   $username="root";

		$password="";

		$database="relancer";

		mysql_connect("localhost",$username,$password);

		@mysql_select_db($database) or die( "Unable to select database");
	   $query_delete = "DELETE FROM cakes WHERE ProductID='$_GET[ID]'";
       mysql_query($query_delete);
	   header('Location:Product.php');
?>