<?php
	$resultq=$_REQUEST["resultq"];
	if($_GET["resultq"]!=""){
		$conn = new mysqli("localhost", "root","" , "vijay");
		$qry="SELECT name, gender, age, mark FROM `mark` WHERE ".$resultq.";";
		$result=$conn->query($qry);
		if($result->num_rows>0){	
			echo "<table border=1px>";
			echo "<tr><th>Name</th><th>Gender</th><th>Age</th><th>Mark</th></tr>";
			while($row=$result->fetch_assoc()){			
			echo "<tr><td>".$row["name"]."</td><td>".$row["gender"]."</td><td>".$row["age"]."</td><td>".$row["mark"]."</td></tr>";
			}
			echo "</table>";
		}else{echo "No results found..";}
	}else{echo "noting to display";}
?>