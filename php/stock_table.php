<?php
	$limit=$_REQUEST["limit"];
	$cmp=$_REQUEST["cmp"];
	if($cmp=="outofstock"){
		$qpart=" stock=0";
	}elseif($cmp=="uplimit"){
		$qpart=" `stock`>".$limit;
	}elseif($cmp=="lowlimit"){
		$qpart=" `stock` between 1 and ".$limit;
	}
		$conn = new mysqli("localhost", "root","" , "vijay");
		$qry="SELECT name, price, stock FROM `products` WHERE".$qpart.";";
		$result=$conn->query($qry);
		if($result->num_rows>0){?>
			<table border=1px style="margin-left:10%;" class="res1">
			<tr><th class="th">Name</th><th class="th">Price</th><th class="th">On Stock</th></tr>
<?php 
			while($row=$result->fetch_assoc()){?>			
				<tr><td  class="td"><?php echo $row["name"];?></td><td  class="td"><?php echo $row["price"];?></td><td  class="td"><?php echo $row["stock"];?></td></tr>
<?php
			}		
		}
?>