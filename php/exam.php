<html>
<head>
<title>Exam</title>
<style>
legend{text-align:center; background-color:#e6e6e6 ; border-radius:5px;}
body{
	background-color:#cccccc;
}
fieldset{ border-radius:10px; background-color:#f2f2f2;}
.container{
	margin:25%;
	margin-top:15%;
	margin-bottom:0%;
	width:50%;
}
.selector{
	float:left;
	margin:12%;
}
button{
	border-width:0px;
	background-color:#00b33c;
	border-radius:20px;
	broder-color:green;
	padding:6px;
}
button:hover {
    background-color: yellow;
	box-shadow: 0px 0px 5px 5px #888888;
}
.logout{
	margin-right:15%;
	float:right;
	position: fixed;
    top: 10%;
    right: 0;
}
.exit{
	margin-left:15px;
	margin-right:10px;
	background-color:red;
	color:white;
	border-radius:20px;
	padding:5px 10px 5px 10px;
}
.exit:hover{
	box-shadow: 0px 0px 5px 5px #888888;
	background-color:red;
}
</style>
</head>
<body>
<div class="logout">
<?php
	session_start();
	if(!isset($_SESSION["student_id"])){header('Location:std_reg_login.php');}
	$conn = new mysqli("localhost", "root","" , "vijay");
	$qry='select name from stdexamdet where id="'.$_SESSION["student_id"].'";';
	$result=$conn->query($qry);
	if($result->num_rows>0){
		$row=$result->fetch_assoc();
		echo $row["name"];
	}
	if(isset($_GET["e"])){
		session_unset();
		session_destroy();
		header('Location:std_reg_login.php');
	}
?>
<a href="exam.php?e=1"><button class="exit" ><b>!</b></button>Logout</a>
</div>
<div class="container">
<fieldset id="changer">
<legend>Exam Types</legend>
<div class="selector"><button onclick='exam("beginer")'><b>Beginer</b></button></div>
<div class="selector"><button onclick='exam("medium")'><b>Medium</b></button></div>
<div class="selector"><button onclick='exam("expert")'><b>Expert</b></button></div>
</fieldset>
<div>
<script>
function exam(level){
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
	// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("changer").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","runexam.php?level="+level,true);
	xmlhttp.send();
}
function ans(i,val){
	var answ="ans"+i;
	document.getElementByID(answ).value=val;
}
</script>
</body>
</html>