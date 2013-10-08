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
$page ="user";
if(array_key_exists("action", $_GET))
{
      $page = $_GET['action'];
}
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

function validatedate(ctl) {
    var dateval, objDate, mSeconds, day, month, year, datearr
    dateval = document.getElementById(ctl).value;
    //alert(dateval);
    if (dateval.length > 0) {
        datearr = dateval.split("/");
        month = parseInt(datearr[0] - 1);
        day =  parseInt(datearr[1]);
        year = parseInt(datearr[2]); 

        if (year < 1000 || year > 3000) {
            alert('Date entered is invalid, Please enter a valid date !');
            document.getElementById(ctl).value = "";
            document.getElementById(ctl).focus();
        } else {
            mSeconds = (new Date(year, month, day)).getTime();
            objDate = new Date();
            objDate.setTime(mSeconds);
            if (objDate.getFullYear() !== year || objDate.getMonth() !== month || objDate.getDate() !== day) {
                alert('Date entered is invalid, Please enter a valid date !');
                document.getElementById(ctl).value = "";
                document.getElementById(ctl).focus();
            }
        }
    }
}

function getsearchframe(str) {
    //alert (str);
    var url = "search_frame.php?frame=" + str
    xmlHttp = GetXmlHttpObject(populatesearchframe)
    xmlHttp.open("GET", url, true)
    xmlHttp.send(null)
}

function populatesearchframe() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        var sResp;
        sResp = xmlHttp.responseText;
        //alert(sResp);
		document.getElementById('search_contents').innerHTML  = sResp;
		document.getElementById('divresults').innerHTML  = "";
    }
}


function getspecialsalesresults() {
    var productname = document.getElementById('productname').value
	var salefrom = document.getElementById('salefrom').value
	var saleto = document.getElementById('saleto').value
	var pricefrom = document.getElementById('pricefrom').value
	var priceto = document.getElementById('priceto').value
	var productcategory = document.getElementById('productcategory')
	var productcategory_value = productcategory.options[productcategory.options.selectedIndex].value
	var sql ="";
	sql ="Select ProductName,ProductPrice,ProductQuantity, ProductCategory, C.ProductDescription, Discount, StartDate,EndDate from special_sales S inner join cakes C on C.ProductId = S.ProductId inner Join product_category pc ON pc.CategoryID = C.CategoryID where 1 = 1 ";
	if (productname.length > 0) { sql = sql + " and ProductName like '%" + productname + "%'";}
	if (salefrom.length > 0) { sql = sql + " and StartDate >= '" + salefrom + "'";}
	if (saleto.length > 0) { sql = sql + " and EndDate <= '" + saleto + "'";}
	if (productcategory_value.length > 0) { sql = sql + " and C.CategoryId = '" + productcategory_value + "'";}
	if (pricefrom.length > 0) { sql = sql + " and productprice >=  " + pricefrom + "";}
	if (priceto.length > 0) { sql = sql + " and productprice <= " + priceto + "";}
	//alert (sql);
    getsearchresults (sql);
}

function getproductsearchresults() {
    var productname = document.getElementById('productname').value
	var productdesc = document.getElementById('productdesc').value
	var pricefrom = document.getElementById('pricefrom').value
	var priceto = document.getElementById('priceto').value
	var productcategory = document.getElementById('productcategory')
	var productcategory_value = productcategory.options[productcategory.options.selectedIndex].value
	var sql ="";
	sql ="Select ProductName,ProductPrice,ProductQuantity, ProductCategory, C.ProductDescription from cakes C Inner Join product_category pc ON pc.CategoryId = C.Categoryid where 1 = 1 ";
	if (productname.length > 0) { sql = sql + " and ProductName like '%" + productname + "%'";}
	if (productdesc.length > 0) { sql = sql + " and ProductDescription like '%" + productdesc + "%'";}
	if (productcategory_value.length > 0) { sql = sql + " and C.CategoryId = '" + productcategory_value + "'";}
	if (pricefrom.length > 0) { sql = sql + " and productprice >= " + pricefrom + "";}
	if (priceto.length > 0) { sql = sql + " and productprice <= " + priceto + "";}
	//alert (sql);
    getsearchresults (sql);
}

function getusersearchresults() {
    var fname = document.getElementById('firstname').value
	var lname = document.getElementById('lastname').value
	var salfrom = document.getElementById('salfrom').value
	var salto = document.getElementById('salto').value
	var userrole = document.getElementById('userrole')
	var userrole_value = userrole.options[userrole.options.selectedIndex].value
	var sql ="";
	sql ="Select * from user_table where 1 = 1 ";
	if (fname.length > 0) { sql = sql + " and FirstName like '%" + fname + "%'";}
	if (lname.length > 0) { sql = sql + " and LastName like '%" + lname + "%'";}
	if (userrole_value.length > 0) { sql = sql + " and Role = '" + userrole_value + "'";}
	if (salfrom.length > 0) { sql = sql + " and Salary >= " + salfrom + "";}
	if (salto.length > 0) { sql = sql + " and Salary <= " + salto + "";}
	//alert (sql);
    getsearchresults (sql);
}

function getsearchresults(str) {
    //alert (str);
    var url = "search.php?searchstr=" + encodeURIComponent(str)
    xmlHttp = GetXmlHttpObject(populatesearchresults)
    xmlHttp.open("GET", url, true)
    xmlHttp.send(null)
}

function populatesearchresults() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        var sResp;
        sResp = xmlHttp.responseText;
        //alert(sResp);
		document.getElementById('divresults').innerHTML  = sResp;
    }
}
function GetXmlHttpObject(handler) {
    var objXmlHttp = null
    if (navigator.userAgent.indexOf("Opera") >= 0) {
        alert("Opera not supported...")
        return;
    }
    if (navigator.userAgent.indexOf("MSIE") >= 0) {
        var strName = "Msxml2.XMLHTTP"
        if (navigator.appVersion.indexOf("MSIE 5.5") >= 0) {
            strName = "Microsoft.XMLHTTP"
        }
        try {
            objXmlHttp = new ActiveXObject(strName)
            objXmlHttp.onreadystatechange = handler
            return objXmlHttp
        }
        catch (e) {
            alert("Error. Scripting for ActiveX might be disabled")
            return
        }
    }
    if (navigator.userAgent.indexOf("Mozilla") >= 0) {
        objXmlHttp = new XMLHttpRequest()
        objXmlHttp.onload = handler
        objXmlHttp.onerror = handler
        return objXmlHttp
    }
}

function Display(value)
{
  //alert(value);
 switch(value)
   {
   case "user" :
      window.location="manager.php?action=user";
	 // alert('hello');
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
<body background="Img.png" onload="getsearchframe('<?PHP echo $page?>')">
<form name ="header">
<p style="color:white; text-align: center"> Welcome <?php echo $_SESSION['firstname'] .' '.$_SESSION['lastname']; ?> &nbsp; <a href="loginEx.php"> [Logout] </a> </p>
<div id="div1" style="position:absolute;left:4in;top:1.5in;height:0in;width:10in;display:block;">

<table border="0">
<tr><td><input type="button" id="home" class="myclass4" style="border: 1px dotted blue ;width:63;height:63" onmouseover="document.getElementById('em_home').style.color='blue'" onmouseout="document.getElementById('em_home').style.color='white'" name="user" value="" onclick="getsearchframe(this.name)"/></td>
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
<td><input type="button" id="userinfo" class="myclass" style="border: 1px solid black ;width:63;height:63" onmouseover="document.getElementById('em').style.color='blue'" onmouseout="document.getElementById('em').style.color='white'" name="product" value="" onclick="getsearchframe(this.name)"/></td>
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
<td><input type="button" class="myclass1" style="border: 1px solid black;width:63;height:63" onmouseover="document.getElementById('em1').style.color='blue'" onmouseout="document.getElementById('em1').style.color='white'" name="specialsales" value="" onclick="getsearchframe(this.name)"/></td>
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


<div id="search_contents" style="position:absolute;left:3.2in;top:3.7in;height:0in;width:10in;display:block;"></div>
<div id ="divresults" style="position:absolute;left:3.2in;top:5.5in;height:0in;width:10in;display:block;">	</div>


</form>



</body>
</html>

