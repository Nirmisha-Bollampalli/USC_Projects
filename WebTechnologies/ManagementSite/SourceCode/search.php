<?php

if(array_key_exists("searchstr", $_GET)) { 
$postback_str = $_GET['searchstr'];

$username="root";
$password="";
$database="relancer";
mysql_connect("localhost",$username,$password)or die( "Unable to Connect");
@mysql_select_db($database) or die( "Unable to select database");
$postback_str = "DB Connected";

$query = $_GET['searchstr'];
//echo $query;
$query = str_replace("\'","'",$query);
//echo $query;

$result = mysql_query($query);
$postback_str = "Query Executed";

$rows = mysql_numrows($result);
$fields = mysql_num_fields ($result);
$postback_str = "Rows and fields fetched ".$rows.'-'.$fields;


$postback_str = "";
$i = 0;
$j = 0;
$postback_str = $postback_str.'<table border ="1">';

while ($i < $rows) {
	if ($i ==0 ) {
		//column header
		$postback_str = $postback_str.'<tr style="bgcolor:blue">';
		while ($j < $fields) {
			$postback_str = $postback_str.'<td Class="tabdivheadercolor">'. mysql_field_name($result,$j).'</td>';
			$j++;
		}
		$postback_str = $postback_str.'</tr>';
	}
	$postback_str = $postback_str.'<tr>';
	$j = 0;
	while ($j < $fields) {
		$postback_str = $postback_str.'<td>'.mysql_result($result, $i, $j) .'</td>';
		$j++;
	}
$postback_str = $postback_str.'</tr>';
$i++;
}
$postback_str = $postback_str.'</table>';

//mysql_close();

echo $postback_str;
 
 
 }
?>