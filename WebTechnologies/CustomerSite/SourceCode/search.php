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
$sub_total = 0;
$sub_qty = 0;
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
		if ( mysql_field_name($result,$j) == "TotalSales")
		{
			$sub_total = $sub_total + mysql_result($result, $i, $j);
		}
		if ( mysql_field_name($result,$j) == "QuantitySold")
		{
			$sub_qty = $sub_qty + mysql_result($result, $i, $j);
		}
		$postback_str = $postback_str.'<td>'.mysql_result($result, $i, $j) .'</td>';
		$j++;
	}
$postback_str = $postback_str.'</tr>';
$i++;
}
if ($sub_total > 0)
{
	$postback_str = $postback_str.'<tr> <td></td><td Class="tabdivheadercolor"> Total </td> <td>'. $sub_qty .'</td> <td> '.$sub_total.' </td></tr>';
}
$postback_str = $postback_str.'</table>';
//$postback_str = $postback_str.'<div style="heigth:50px"></div>';
//mysql_close();

echo $postback_str;
 
 
 }
?>