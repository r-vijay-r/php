<html>
<head>
<title>Product details</title>
<style>
select,.txt{
	width:157px;
}
td{
	padding-bottom:2%;
	padding-top:2%;
}
.res{background-color:black;}
.res1{background-color:buttonface;}
.th{background-color:orange;height:30px; width:100px;}
.td{background-color:cyan;}
</style>
</head>
<body>
<table width=100%>
<tr><td>
<div>
<form action="product_show.php" method="post" name="ins">
<fieldset style="width:25%; float:left; margin-left:10%;">
    <legend></legend>
<table>
<tr><td>Limit</td><td>: <input type="text" name="limit" id="limit" placeholder="Stock quantity" class="txt"></td></tr>
<tr><td></td><td><input type="submit" name="set" value="Set Limit" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
</div>
</td></tr>
</table>
<?php 
if(isset($_POST["set"])){
	if($_POST["limit"]!=""){ 
?>			
<table style="margin-left:10%;" class="res">
<tr>
<td><input id="os" type="submit" style="height:200%;" name="set" value="Out of stock" onclick="checkstock('outofstock')"></td>
<td><input id="low" type="submit" name="set" value="Less than limit" onclick="checkstock('lowlimit')"></td>
<td><input id="up" type="submit" name="set" value="Greater than limit" onclick="checkstock('uplimit')"></td>
</tr>
</table>
<div id="details">
</div>
		<script>
			document.getElementById("limit").value=<?php echo $_POST["limit"]; ?>;
			function checkstock(cmp) {
				if(cmp=="outofstock"){
				document.getElementById("os").style.height="200%";
				document.getElementById("up").style.height="150%";
				document.getElementById("low").style.height="150%";
					
				}
				if(cmp=="uplimit"){
				document.getElementById("up").style.height="200%";
				document.getElementById("os").style.height="150%";
				document.getElementById("low").style.height="150%";
					
				}
				if(cmp=="lowlimit"){
				document.getElementById("low").style.height="200%";
				document.getElementById("os").style.height="150%";
				document.getElementById("up").style.height="150%";
					
				}
				var svalue=document.getElementById("limit").value;
				if (svalue == "select") {
					return;
				} else { 
					if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
				// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("details").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET","stock_table.php?limit="+svalue+"&cmp="+cmp,true);
					xmlhttp.send();
				}
			}
			checkstock("outofstock");
		</script>
<?php	

	}
}

?>

</body>
</html>