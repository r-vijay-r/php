<html>
<head>
<title>Purchase</title>
<style>
select,.txt{
	width:157px;
}
td{
	padding-bottom:2%;
	padding-top:2%;
}
.res{background-color:black;}
.th{background-color:orange;height:30px; width:100px;}
.td{background-color:cyan;}
#dialogoverlay{
	display: none;
	opacity: .8;
	position: fixed;
	top: 0px;
	left: 0px;
	background: #FFF;
	width: 100%;
	z-index: 10;
}
#dialogbox{
	display: none;
	position: fixed;
	background: black;
	border-radius:10px; 
	width:550px;
	z-index: 10;
}
#dialogbox > div{ background:#FFF; margin:1px; }
#dialogbox > div > #dialogboxhead{
	border-color:black;
	border-left:1px;
	border-right:1px;
	border-top:1px;
	border-radius:10px 10px 0px 0px;
	background: #f2f2f2;
	font-size:19px;
	padding:11px;
	color:black;
	}
#dialogbox > div > #dialogboxbody{ background:#f2f2f2; padding:20px; color:black; }
#dialogbox > div > #dialogboxfoot{border-radius:0px 0px 10px 10px; background: #f2f2f2; padding:10px; text-align:right; }
</style>
</head>
<body>
<table width=100%>
<tr><td>
<div>
<form action="purchase.php" method="post" name="ins">
<fieldset style="width:30%; float:left; margin-left:10%;">
    <legend>Purchase:</legend>
<table>
<tr><td>Product Name</td><td>: <select name="product" id="product" onchange="checkstock()">
									<option value="select">--Select--</option>
									<?php
									$conn = new mysqli("localhost", "root","" , "vijay");
									$qry="SELECT pid, name FROM `products` where `stock`>0;";
									$result=$conn->query($qry);
									if($result->num_rows>0){
										while($row=$result->fetch_assoc()){
											echo '<option value="'.$row["pid"].'">'.$row["name"].'</option>';
										}
									}
									?>
								</select></td></tr>
<tr><td>Price</td><td>: <input type="text" name="price" id="price" placeholder="Price" class="txt" readonly style="border-width: 0px;"></td></tr>
<tr><td>Quantity</td><td>: <input type="text" name="quantity" id="quantity" placeholder="Quantity" class="txt"></td></tr>
<tr><td></td><td><input type="submit" name="buy" value="Buy" onclick="buy()" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
</div>
</td></tr>
</table>
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div style="border-radius:9px;">
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
  </div>
</div>
<script>
var Id="";
document.getElementById("product").focus();
function checkstock() {
	var pid=document.getElementById("product").value;
    if (pid == "select") {
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
                document.getElementById("price").value = "Rs."+this.responseText;
				document.getElementById("quantity").focus();
            }
        };
        xmlhttp.open("GET","price_details.php?pid="+pid,true);
        xmlhttp.send();
    }
}
//Alert.render customise
function Alert(dialog){
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "200px";
        dialogbox.style.display = "block";
        document.getElementById('dialogboxhead').innerHTML = "Alert!";
        document.getElementById('dialogboxbody').innerHTML = dialog;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="ok()" autofocus>OK</button>';
    }
	function ok(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		document.getElementById(Id).focus();
	}
</script>
<?php 
if(isset($_POST["buy"])){
	if($_POST["product"]!="select" && $_POST["price"]!=""){
		if($_POST["quantity"]!="" && $_POST["quantity"]>0){
			
			$conn = new mysqli("localhost", "root","" , "vijay");
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			else{
				$qry="SELECT stock FROM `products` WHERE pid=".$_POST["product"].";";
				$result=$conn->query($qry);
				if($result->num_rows>0){
					$row=$result->fetch_assoc();
					if($row["stock"]==0){
						echo '<script> 
								Id="product";
								Alert("Selected item out-of-stock...");</script>';
						
					}elseif($row["stock"]<$_POST["quantity"]){
						echo '<script>Id="quantity";
								Alert("Available quantity : '.$row["stock"].'");
								document.getElementById("quantity").value="'.$row["stock"].'";
								document.getElementById("product").value="'.$_POST["product"].'";
								document.getElementById("price").value="'.$_POST["price"].'";
								</script>';
					}else{
						$qry="UPDATE `products` SET `stock` = `stock`-'".$_POST["quantity"]."' WHERE `products`.`pid` = ".$_POST["product"].";";
						if($result=$conn->query($qry)){
							$qry="select name from products where pid=".$_POST["product"].";";
							$result=$conn->query($qry);
							$row=$result->fetch_assoc();
							echo '<script>Id="product";
									Alert("Successfully purchased '.$row["name"].' (Nos.'.$_POST["quantity"].')...");</script>';
						}else{
							echo '<script>Alert("Transaction cancelled...");</script>';
						}
			
					}
		
				}
			}
		}else{
			echo '<script>Id="quantity";
					Alert("Enter quantity to buy...");
					document.getElementById("product").value="'.$_POST["product"].'";
					document.getElementById("price").value="'.$_POST["price"].'";
					</script>';
		}
	}else{
		echo '<script>
				Id="product";
				Alert("Select a product to buy...");</script>';
	}
	$conn->close();
}

?>

</body>
</html>