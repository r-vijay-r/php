<style type="text/css">
	td{
		width: 100%;
	}
	tr{
		width: 100%;
	}
	table.container{
		width:100%;
	}
	table.content{
		width: 50%;
	}
</style>
<?php 
session_start();
include_once('../controller/user.php');
	if(!isset($_SESSION['id'])){
?>
<table class="container">
	<tr>
		<td>	
			<table class="content">
				<form action="login.php" method="POST" name="regForm">
					<tr>
						<td>
							First Name					
						</td>					
						<td>					
							<input type="text" name="fName" placeholder="First Name">
						</td>
					</tr>
					<tr>
						<td>
							Last Name					
						</td>					
						<td>					
							<input type="text" name="lName" placeholder="Last Name">
						</td>
					</tr>
					<tr>
						<td>
							Gender
						</td>					
						<td>					
							<input type="radio" name="gender" value="Male"> Male 
							<input type="radio" name="gender" value="Female"> Female
						</td>
					</tr>
					<tr>
						<td>
							City					
						</td>					
						<td>					
							<input type="text" name="city" placeholder="City">
						</td>
					</tr>
					<tr>
						<td>
							State					
						</td>					
						<td>					
							<input type="text" name="state" placeholder="State">
						</td>
					</tr>
					<tr>
						<td>
							Country					
						</td>					
						<td>					
							<input type="text" name="country" placeholder="Country">
						</td>
					</tr>
					<tr>
						<td>
							Mobile					
						</td>					
						<td>					
							<input type="text" name="mob" placeholder="Mobile Number">
						</td>
					</tr>
					<tr>
						<td>
							Email					
						</td>					
						<td>					
							<input type="text" name="email" placeholder="Email">
						</td>
					</tr>
					<tr>
						<td>
							Username					
						</td>					
						<td>					
							<input type="text" name="userName" placeholder="Username">
						</td>
					</tr>
					<tr>
						<td>
							Password					
						</td>					
						<td>					
							<input type="password" name="passWord" placeholder="Password">
						</td>
					</tr>
					<tr>
						<td>
						</td>					
						<td>					
							<input type="submit" name="reg" value="Register">
						</td>
					</tr>
				</form>
			</table>
		</td>
		<td>
			<table class="content">
				<form action="login.php" method="POST" name="loginForm">
					<tr>
						<td>
							<input type="text" name="userName" placeholder="Username" style="float:left;">
							<input type="password" name="passWord" placeholder="Password" style="float:left;">
						</td>
						<td>
							<input type="submit" name="login" value="Login">
						</td>
					</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
<?php
	}else{
		$currentUser=new User();
		$currentUserFullName=$currentUser->getUserDetails($_SESSION['id']);
		echo $currentUserFullName['fname']." ".$currentUserFullName['lname']." is logged in ";
		echo " <a href='login.php?logout=yes'><button>Logout</button></a>";
	}
	if(isset($_POST["login"])){
		$user= new User();
		$userId=$user->setUser($_POST['userName'],$_POST['passWord']);	
		$_SESSION['id']=$userId['id'];
		header('Location:login.php');
	}
	if(isset($_POST["reg"])){
		$newUser= new User();
		$userReg = array("fname"=>$_POST['fName'], "lname"=>$_POST['lName'], "gender"=>$_POST['gender'], "city"=>$_POST['city'], "state"=>$_POST['state'], "country"=>$_POST['country'], "mob"=>$_POST['mob'], "email"=>$_POST['email'], "uname"=>$_POST['userName'], "password"=>$_POST['passWord']);
		if($newUser->addNewUser($userReg)){
			echo "User added successfully";
		}else{
			echo "Cannot add user";
		}
	}
	if(isset($_GET['logout'])){
		session_destroy();
		header('Location:login.php');
	}
?>