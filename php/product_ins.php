<html>
<head>
<title>Add Product</title>
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
</style>
</head>
<body>
<table width=100%>
<tr><td>
<div>
<form action="product_ins.php" method="post" name="ins">
<fieldset style="width:30%; float:left; margin-left:10%;">
    <legend>Add products to stock:</legend>
<table>
<tr><td>Product Name</td><td>: <input type="text" name="name" placeholder="Product Name" class="txt"></td></tr>
<tr><td>Price</td><td>: <input type="text" name="price" placeholder="Price" class="txt"></td></tr>
<tr><td>Quantity</td><td>: <input type="text" name="quantity" placeholder="Quantity" class="txt"></td></tr>
<tr><td></td><td><input type="Submit" name="insert" value="Insert" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
<?php 
if(isset($_POST["insert"])){
	if($_POST["name"]!="" && $_POST["price"]!="" && $_POST["quantity"]!=""){
		$conn = new mysqli("localhost", "root","" , "vijay");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		else{
				$qry="insert into products (name, price, stock) values ('".$_POST["name"]."','".$_POST["price"]."',".$_POST["quantity"].");";
				$conn->query($qry);
				header('Location:product_ins.php');

		}
	}else{
		header('Location:product_ins.php');
	}
	$conn->close();
}

?>
</div>
</td></tr>
<tr><td>
<div>
<?php

		$conn = new mysqli("localhost", "root","" , "vijay");
		$qry="SELECT name, price, stock FROM `products` ;";
		$result=$conn->query($qry);
		if($result->num_rows>0){	
			?>
			<table border=1px style="margin-left:10%;" class="res">
			<tr><th class="th">Name</th><th class="th">Price</th><th class="th">On Stock</th></tr>
<?php 
			while($row=$result->fetch_assoc()){
?>			
				<tr><td  class="td"><?php echo $row["name"];?></td><td  class="td"><?php echo $row["price"];?></td><td  class="td"><?php echo $row["stock"];?></td></tr>
<?php	
	}
}
else 
{echo "No results found..";}
?>
</table>
</div>
</td></tr>
</table>
</body>
</html>