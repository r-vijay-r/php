<html>
<head>
<?php session_start(); ?>
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
<body onkeydown="return (event.keyCode != 116)" >
<div class="logout">
<?php
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
</div>

<script>
var qry="";
function markcalc(){
	var u="";
	var count=<?php if(isset($_SESSION["i"])){echo $_SESSION["i"];}else{echo 0;} ?>;
	qry="runexam.php?level1="+document.getElementById("level1").value;
	var i=1;
	while(i<count){
		var j=1;
		qry=qry+"&id"+i+"="+document.getElementById('id'+i).value;
		while(j<5){
			if (document.getElementById('option'+j+i).checked) {
				qry=qry+"&option"+i+"="+document.getElementById('option'+j+i).value;
				u="option"+i;
			}
			j++;
		}
		if(u==""){
			qry=qry+"&option"+i+"="+"Error_exam_on_non_select";
		}
		i++;
		u="";
	}
	return qry;
}
var starttoday;
var start;
function tymer(){
	starttoday = new Date();
	start = starttoday.getSeconds();
	startTime();
}
function startTime() {
    var today = new Date();
    var s = today.getSeconds();
    s = checkTime(s);
	var sec=20+(start-s);
    sec = checkTime(sec);
    document.getElementById('txt').innerHTML =
    "00" + ":" + "00" + ":" + sec+qry;
	if(sec<=0){document.getElementById('txt').innerHTML ="<br>";
	document.getElementById("examform").submit();
	return;
	}else{
		var markk=markcalc();
		window.onbeforeunload = function () {
			myWindow = window.open(markk, "myWindow", "width=1,height=1");
		}
	}
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}

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
			tymer();
		}
	};
	xmlhttp.open("GET","runexam.php?level="+level,true);
	xmlhttp.send();
}
</script>
</body>
</html>