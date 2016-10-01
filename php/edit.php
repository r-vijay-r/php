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
	if(isset($_SESSION["uname"])){
		
		$conn = new mysqli("localhost", "root", "", "vijay");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		else{
			$qry="select fname, lname, gender, city, state, country, mob, email from details where uname='".$_SESSION["uname"]."';";
			$result=$conn->query($qry);
			$row=$result->fetch_assoc();
		}
	
?>
<form action="edit.php" method="post" name="edit">
<fieldset style="width:30%; float:left; margin-left:10%;">
    <legend>Update details:</legend>
<table>
<tr><td>First Name </td><td>: <input type="text" name="fname" placeholder="First Name" class="txt" value="<?php echo $row["fname"]; ?>"></td></tr>
<tr><td>Last Name </td><td>: <input type="text" name="lname" placeholder="Last Name" class="txt" value="<?php echo $row["lname"]; ?>"></td></tr>
<tr><td>Gender </td><td>: <input type="radio" name="gender" value="Male" <?php if($row["gender"]=="Male"){echo 'checked';}?>>Male<input type="radio" name="gender" value="Female"<?php if($row["gender"]=="Female"){echo 'checked';}?>>Female</td></tr>
<tr><td>City </td><td>: <select name="city"><option value="">--Select--</option>
<option value="Thiruvananthapuram" <?php if($row["city"]=="Thiruvananthapuram"){echo 'selected';}?>>Thiruvananthapuram</option>
<option value="Peroorkada" <?php if($row["city"]=="Peroorkada"){echo 'selected';}?>>Peroorkada</option>
<option value="Keshavadasapuram" <?php if($row["city"]=="Keshavadasapuram"){echo 'selected';}?>>Keshavadasapuram</option></select></td></tr>
<tr><td>State </td><td>: <select name="state"><option value="">--Select--</option><option value="Kerala" <?php if($row["state"]=="Kerala"){echo 'selected';}?>>Kerala</option></select></td></tr>
<tr><td>Country </td><td>: <select name="country"><option value="">--Select--</option><option value="India" <?php if($row["country"]=="India"){echo 'selected';}?> >India</option></select></td></tr>
<tr><td>Mobile </td><td>: <input type="text" name="mob" placeholder="Mobile Number" class="txt" value="<?php echo $row["mob"]; ?>"></td></tr>
<tr><td>Email </td><td>: <input type="text" name="email" placeholder="Email" class="txt"  value="<?php echo $row["email"]; ?>"></td></tr>
<tr><td>Username </td><td>: <input type="text" name="uname" placeholder="Username" class="txt" readonly value="<?php echo $_SESSION["uname"]; ?>"></td></tr>
<tr><td>Password </td><td>: <input type="password" name="pword" placeholder="Password" class="txt"></td></tr>
<tr><td><a href="edit.php?logout=1">Logout</a></td><td><input type="Submit" name="update" value="Update" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
<?php
		if(isset($_POST["update"])){
		$conn = new mysqli("localhost", "root","" , "vijay");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		else{
			$qry="select id from login where uname='".$_POST["uname"]."';";
			$result=$conn->query($qry);
			if($result->num_rows==1){
				$qry="update details set fname='".$_POST["fname"]."', lname='".$_POST["lname"]."', gender='".$_POST["gender"]."', city='".$_POST["city"]."', state='".$_POST["state"]."', country='".$_POST["country"]."', mob=".$_POST["mob"].", email='".$_POST["email"]."' where uname='".$_SESSION["uname"]."';";
				$conn->query($qry);
				if($_POST["pword"]!=""){
				$qry="update login set password='".$_POST["pword"]."' where uname='".$_SESSION["uname"]."';";
				$conn->query($qry);
				}
				header('Location:reg_login.php');
			}
		}
		}
	$conn->close();
	}else{header('Location:reg_login.php');}
?>
</body>
</html>