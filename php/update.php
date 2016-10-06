<html>
<head>
<title>Admin</title>
<style>
legend{text-align:center; background-color:#e6e6e6 ; border-radius:5px;}
body{
	background-color:#cccccc;
}
fieldset{ border-radius:10px; background-color:#f2f2f2;}
.container{
	margin:25%;
	margin-top:10%;
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
.table{
	background-color:black;
	border-radius:10px 10px 0px 0px;
}
th{
	background-color:orange;
}
td.td{
	background-color:lightgreen;
}
</style>
</head>
<body>
<div class="logout">
<?php
	session_start();
	if(!isset($_GET["eid"])){header('Location:admin.php');}
	if(!isset($_SESSION["admin_id"])){header('Location:std_reg_login.php');}
	$conn = new mysqli("localhost", "root","" , "vijay");
	$qry='select name from stdexamdet where id="'.$_SESSION["admin_id"].'";';
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
<?php 
	$qry='select * from questions where qid="'.$_GET["eid"].'";';
	$result=$conn->query($qry);
	if($result->num_rows>0){
		$row=$result->fetch_assoc();
	}

?>
<fieldset>
<legend>Edit Questions</legend>
<form action="update.php" method="POST">
<input type="text" name="id" value='<?php echo $row["qid"]; ?>' readonly hidden>
<table>
<tr><td>Level </td><td><select name="level" id="level" class="txt">
							<option value="beginer" <?php if(isset($row["level"])){if($row["level"]=="beginer"){echo "selected";}}  ?> >Beginer</option>
							<option value="medium" <?php if(isset($row["level"])){if($row["level"]=="medium"){echo "selected";}}  ?> >Medium</option>
							<option value="expert" <?php if(isset($row["level"])){if($row["level"]=="expert"){echo "selected";}}  ?> >Expert</option>
						</select> </td></tr>
<tr><td>Question</td><td> <input type="text" name="question" placeholder="Question" class="txt" value="<?php echo $row["question"]; ?>"></td></tr>
<tr><td>Option 1</td><td> <input type="text" name="op1" id="op1" placeholder="Option 1" class="txt"  value="<?php echo $row["op1"]; ?>"></td></tr>
<tr><td>Option 2</td><td> <input type="text" name="op2" id="op2" placeholder="Option 2" class="txt" value="<?php echo $row["op2"]; ?>"></td></tr>
<tr><td>Option 3</td><td> <input type="text" name="op3" id="op3" placeholder="Option 3" class="txt" value="<?php echo $row["op3"]; ?>"></td></tr>
<tr><td>Option 4</td><td> <input type="text" name="op4" id="op4" placeholder="Option 4" class="txt" value="<?php echo $row["op4"]; ?>"></td></tr>
<tr><td>Answer</td><td> <select name="ans" id="ans" class="txt" onfocus="get()">
							<option value="">--select--</option>
						</select></td></tr>
<tr><td>Mark</td><td> <input type="text" name="mark" id="mark" placeholder="Mark" class="txt" value="<?php echo $row["mark"]; ?>"></td></tr>
<tr><td></td><td><input type="Submit" name="update" value="Update" style="margin-left:5%;"></td></tr>
</table>

</form>
</fieldset>
<div>
<script>
	function get(){
		var op1=document.getElementById("op1").value;
		var op2=document.getElementById("op2").value;
		var op3=document.getElementById("op3").value;
		var op4=document.getElementById("op4").value;
		var str='<option value="">--select--</option>';
		if(op1!=""){
		str+='<option value="'+op1+'">'+op1+'</option>';
		}
		if(op2!=""){
		str+='<option value="'+op2+'">'+op2+'</option>';
		}
		if(op3!=""){
		str+='<option value="'+op3+'">'+op3+'</option>';
		}
		if(op4!=""){
		str+='<option value="'+op4+'">'+op4+'</option>';
		}
		document.getElementById("ans").innerHTML=str;
		
	}
</script>
<?php
	$conn = new mysqli("localhost", "root","" , "vijay");
	if(isset($_POST["update"]) && $_POST["question"]!="" && $_POST["ans"]!=""){
		$qry='UPDATE  `vijay`.`questions` SET  `question` =  'Lion is the king of :',`op1` =  'House ',`op2` =  'Forest ',`op3` =  'Dogs ',`op4` =  'Hens ',`answer` =  'Forest ',`mark` =  '11',`level` =  'beginer' WHERE  `questions`.`qid` =3 VALUES ("'.$_POST["question"].'", "'.$_POST["op1"].'", "'.$_POST["op2"].'", "'.$_POST["op3"].'", "'.$_POST["op4"].'", "'.$_POST["ans"].'", '.$_POST["mark"].', "'.$_POST["level"].'");';
		if($result=$conn->query($qry)){
			echo '<script>alert("Added successful...!");</script>';
		}else{ echo '<script>alert("Added successful...!");</script>';}
	}
	$conn->close();	
?>
</body>
</html>