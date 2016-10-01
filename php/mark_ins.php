<html>
<head>
<title>Insert Details</title>
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
<form action="mark_ins.php" method="post" name="ins">
<fieldset style="width:30%; float:left; margin-left:10%;">
    <legend>Insert Details:</legend>
<table>
<tr><td>Full Name</td><td>: <input type="text" name="name" placeholder="Full Name" class="txt"></td></tr>
<tr><td>Gender</td><td>: <input type="radio" name="gender" value="Male">Male<input type="radio" name="gender" value="Female">Female</td></tr>
<tr><td>Age</td><td>: <input type="text" name="age" placeholder="Age" class="txt"></td></tr>
<tr><td>Mark</td><td>: <input type="text" name="mark" placeholder="Mark" class="txt"></td></tr>
<tr><td></td><td><input type="Submit" name="insert" value="Insert" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
<form action="result.php" method="post" name="login">
<div style="width:25%; float:right; margin-right:20%;">
<table style="
    margin-top: 3px;
">
<tr><td><input type="text" name="search" placeholder="Search"></td><td><select name="sfeild" style="width:70px;padding-top: 1px;padding-bottom: 1px;background-color: buttonface;"><option value="name">Name</option><option value="gender">Gender</option><option value="age">Age</option><option value="mark">Mark</option><select><input type="submit" name="sear" value="Search"></td></tr>
</table>
</div>
</form>
<?php 
if(isset($_POST["insert"])){
	if($_POST["name"]!="" && $_POST["gender"]!="" && $_POST["age"]!="" && $_POST["mark"]!=""){
		$conn = new mysqli("localhost", "root","" , "vijay");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		else{
				$qry="insert into mark (name, gender, age, mark) values ('".$_POST["name"]."','".$_POST["gender"]."',".$_POST["age"].",".$_POST["mark"].");";
				$conn->query($qry);
				header('Location:mark_ins.php');

		}
	}else{
		header('Location:mark_ins.php');
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
		$qry="SELECT name, gender, age, mark FROM `mark` ;";
		$result=$conn->query($qry);
		if($result->num_rows>0){	
			?>
<table border=1px style="margin-left:10%;" class="res">
<tr><th class="th">Name</th><th class="th">Gender</th><th class="th">Age</th><th class="th">Mark</th></tr>
<?php 
		while($row=$result->fetch_assoc()){
?>			
<tr><td  class="td"><?php echo $row["name"];?></td><td  class="td"><?php echo $row["gender"];?></td><td  class="td"><?php echo $row["age"];?></td><td  class="td"><?php echo $row["mark"];?></td></tr>
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