<html>
<head>
<title>Home</title>
<style>
select,.txt{
	width:157px;
}
td{
	width:50%;
	padding-bottom:2%;
	padding-top:2%;
	padding-left:10%;
}
.res{background-color:black;}
.th{background-color:orange;height:30px; width:100px;}
.td{background-color:cyan;}
.register{
	margin-top:150px;
	margin-left:10%;
	float:left;
	width:30%;
}
.login{
	margin-top:150px;
	margin-right:10%;
	float:right;
	width:30%;
}
legend{background-color:#e6e6e6 ; border-radius:5px;}
body{
	background-color:#cccccc;
}
fieldset{ border-radius:10px; background-color:#f2f2f2;}
</style>
</head>
<body>

<div class="register">
<form action="std_reg_login.php" method="post" name="reg">
<fieldset>
<legend>Register</legend>
<table>
<tr><td>Full Name </td><td> <input type="text" name="name" placeholder="Full Name" class="txt"></td></tr>
<tr><td>Gender </td><td> <input type="radio" name="gender" value="Male">Male<input type="radio" name="gender" value="Female">Female</td></tr>
<tr><td>Age </td><td> <input type="text" name="age" placeholder="Age" class="txt"></td></tr>
<tr><td valign="top">Address</td><td valign="top"> <textarea name="address" placeholder="Address" class="txt"></textarea></td></tr>
<tr><td>Mobile</td><td> <input type="text" name="mobile" placeholder="Mobile Number" class="txt"></td></tr>
<tr><td>Email</td><td> <input type="text" name="email" placeholder="Email" class="txt"></td></tr>
<tr><td>Username</td><td> <input type="text" name="username" placeholder="Username" class="txt"></td></tr>
<tr><td>Password</td><td> <input type="password" name="password" placeholder="Password" class="txt"></td></tr>
<tr><td></td><td><input type="Submit" name="register" value="Register" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
</div>
<div class="login">
<form action="std_reg_login.php" method="post" name="log">
<fieldset>
<legend>Login</legend>
<table>
<tr><td>Username</td><td> <input type="text" name="username" placeholder="Username" class="txt"></td></tr>
<tr><td>Password</td><td> <input type="password" name="password" placeholder="Password" class="txt"></td></tr>
<tr><td></td><td><input type="Submit" name="login" value="Login" style="margin-left:5%;"></td></tr>
</table>
</fieldset>
</form>
</div>
</body>
<?php
	session_start();
	if(isset($_SESSION["student_id"])){header('Location:exam.php');}
	if(isset($_SESSION["admin_id"])){header('Location:admin.php');}
	if(isset($_POST["register"]) && $_POST["username"]!=""){
		$conn = new mysqli("localhost", "root","" , "vijay");
		$qry='select name from stdexamdet where uname="'.$_POST["username"].'";';
		$result=$conn->query($qry);
		if($result->num_rows>0){
			echo '<script>alert("Username '.$_POST["username"].' already exists...!");</script>';
		}
		else{
			$qry='INSERT INTO `stdexamdet` (`name`, `gender`, `age`, `address`, `mobile`, `email`, `uname`, `pword`) VALUES ("'.$_POST["name"].'", "'.$_POST["gender"].'", '.$_POST["age"].', "'.$_POST["address"].'", '.$_POST["mobile"].', "'.$_POST["email"].'", "'.$_POST["username"].'", "'.$_POST["password"].'");';
			if($result=$conn->query($qry)){
				echo '<script>alert("Registration successful...!");</script>';
			}else{ echo '<script>alert("Error");</script>';}
		}
		$conn->close();
	}
	if(isset($_POST["login"])){
		$conn = new mysqli("localhost", "root","" , "vijay");
		if($_POST["username"]=="admin"){
			$qry='SELECT `id` FROM `stdexamdet` WHERE `uname` = "'.$_POST["username"].'" and `pword` = "'.$_POST["password"].'"';
		$result=$conn->query($qry);
		if($result->num_rows == 0){
			echo '<script>alert("Username and password not matching...!");window.location.assign("std_reg_login.php");</script>';
		}else{
			$row=$result->fetch_assoc();
			$_SESSION["admin_id"] = $row["id"];
			header('Location:admin.php');
		}
		}else{
		$qry='SELECT `id` FROM `stdexamdet` WHERE `uname` = "'.$_POST["username"].'" and `pword` = "'.$_POST["password"].'"';
		$result=$conn->query($qry);
		if($result->num_rows == 0){
			echo '<script>alert("Username and password not matching...!");</script>';
		}else{
			$row=$result->fetch_assoc();
			$_SESSION["student_id"] = $row["id"];
			header('Location:exam.php');
		}
		}
		$conn->close();
	}
?>
</html>