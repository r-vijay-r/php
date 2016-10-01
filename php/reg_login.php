<html>
<head>
<title>Register Login</title>
<style>
select,.txt{
	width:157px;
}
td{
	padding-bottom:2%;
	padding-top:2%;
}
</style>
</head>
<body>
<?php 
session_start();
	if(isset($_GET["logout"])){
		session_unset(); 
		session_destroy();
		header('Location:reg_login.php');	
	}
if(!isset($_SESSION["uname"])){
		
?>
<form action="reg_login.php" method="post" name="reg">
<fieldset style="width:30%; float:left; margin-left:10%;">
    <legend>Register:</legend>
<table>
<tr><td>First Name </td><td>: <input type="text" name="fname" placeholder="First Name" class="txt"></td></tr>
<tr><td>Last Name </td><td>: <input type="text" name="lname" placeholder="Last Name" class="txt"></td></tr>
<tr><td>Gender </td><td>: <input type="radio" name="gender" value="Male">Male<input type="radio" name="gender" value="Female">Female</td></tr>
<tr><td>City </td><td>: <select name="city"><option value="">--Select--</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Peroorkada">Peroorkada</option><option value="Keshavadasapuram">Keshavadasapuram</option></select></td></tr>
<tr><td>State </td><td>: <select name="state"><option value="">--Select--</option><option value="Kerala">Kerala</option></select></td></tr>
<tr><td>Country </td><td>: <select name="country"><option value="">--Select--</option><option value="India">India</option></select></td></tr>
<tr><td>Mobile </td><td>: <input type="text" name="mob" placeholder="Mobile Number" class="txt"></td></tr>
<tr><td>Email </td><td>: <input type="text" name="email" placeholder="Email" class="txt"></td></tr>
<tr><td>Username </td><td>: <input type="text" name="uname" placeholder="Username" class="txt"></td></tr>
<tr><td>Password </td><td>: <input type="password" name="pword" placeholder="Password" class="txt"></td></tr>
<tr><td></td><td><input type="Submit" name="reg" value="Register" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
<form action="reg_login.php" method="post" name="login">
<fieldset style="width:25%; float:right; margin-right:20%;">
    <legend>Login:</legend>
<table>
<tr><td>Username </td><td>: <input type="text" name="uname" placeholder="Username"></td></tr>
<tr><td>Password </td><td>: <input type="password" name="pword" placeholder="Password"></td></tr>
<tr><td></td><td><input type="Submit" name="login" value="Login" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
<?php 
if(isset($_POST["login"])){
		if($_POST["uname"]!="" && $_POST["pword"]!=""){
			
		$conn = new mysqli("localhost", "root","" , "vijay");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		else{
			$qry="select id from login where uname='".$_POST["uname"]."' and password='".$_POST["pword"]."';";
			$result=$conn->query($qry);
			if($result->num_rows==1){
				$_SESSION["uname"]=$_POST["uname"];
				header('Location:reg_login.php');
			}else{
				header('Location:reg_login.php');
				echo "Invalid username or password";
			}
		}
		$conn->close();		
	}
}
if(isset($_POST["reg"])){
	if($_POST["uname"]!="" && $_POST["pword"]!=""){
		$conn = new mysqli("localhost", "root","" , "vijay");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		else{
			$qry="select id from login where uname='".$_POST["uname"]."';";
			$result=$conn->query($qry);
			if($result->num_rows==0){
				$qry="insert into details (fname, lname, gender, city, state, country, mob, email, uname) values ('".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["gender"]."','".$_POST["city"]."','".$_POST["state"]."','".$_POST["country"]."',".$_POST["mob"].",'".$_POST["email"]."','".$_POST["uname"]."');";
				$conn->query($qry);
				$qry="select id from details where uname='".$_POST["uname"]."';";
				$result=$conn->query($qry);
				$row=$result->fetch_assoc();
				$qry="insert into login (id, uname, password) values ('".$row["id"]."','".$_POST["uname"]."','".$_POST["pword"]."');";
				$conn->query($qry);
				header('Location:reg_login.php');
			}else{
				echo "<font color=red>* username already exist";
			}
		}
	}else{
		header('Location:reg_login.php');
	}
	$conn->close();
}

}
else{
			$conn = new mysqli("localhost", "root","" , "vijay");
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			} 
			$qry="select fname, lname, gender, city, state, country, mob, email from details where uname='".$_SESSION["uname"]."';";
			$result=$conn->query($qry);
			if($row=$result->fetch_assoc())
			{
				
			?>
<fieldset style="width:30%; margin-left:30%;">
    <legend>Details:</legend>
<table>
<tr><td>First Name </td><td>: <?php echo $row["fname"];?></td></tr>
<tr><td>Last Name </td><td>: <?php echo $row["lname"];?></td></tr>
<tr><td>Gender </td><td>: <?php echo $row["gender"];?></td></tr>
<tr><td>City </td><td>: <?php echo $row["city"];?></td></tr>
<tr><td>State </td><td>: <?php echo $row["state"];?></td></tr>
<tr><td>Country </td><td>: <?php echo $row["country"];?></td></tr>
<tr><td>Mobile </td><td>: <?php echo $row["mob"];?></td></tr>
<tr><td>Email </td><td>: <?php echo $row["email"];?></td></tr>
<tr><td><a href="reg_login.php?logout=1">Logout</a></td><td><a href="edit.php">Edit</a></td></tr>
</table>
</fieldset>			
			<?php
			
			}
}	
?>
</body>
</html>