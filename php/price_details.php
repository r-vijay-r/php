<?php
	$id=$_REQUEST["pid"];
	if($id!=""){
		$conn = new mysqli("localhost", "root","" , "vijay");
		$qry="SELECT price FROM `products` WHERE `pid`=".$id.";";
		$result=$conn->query($qry);
		if($result->num_rows>0){
			$row=$result->fetch_assoc();		
			echo $row["price"];
		}
	}
?>