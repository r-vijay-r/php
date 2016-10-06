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
	margin:30%;
	margin-top:10%;
	margin-bottom:0%;
	width:30%;
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
	margin:25%;
	margin-top:5%;
	margin-bottom:0px;
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
<fieldset>
<legend>Add Questions</legend>
<form action="admin.php" method="POST">
<table>
<tr><td>Level </td><td><select name="level" id="level" class="txt">
							<option value="beginer" <?php if(isset($_POST["level"])){if($_POST["level"]=="beginer"){echo "selected";}}  ?> >Beginer</option>
							<option value="medium" <?php if(isset($_POST["level"])){if($_POST["level"]=="medium"){echo "selected";}}  ?> >Medium</option>
							<option value="expert" <?php if(isset($_POST["level"])){if($_POST["level"]=="expert"){echo "selected";}}  ?> >Expert</option>
						</select> </td></tr>
<tr><td>Question</td><td> <input type="text" name="question" placeholder="Question" class="txt"></td></tr>
<tr><td>Option 1</td><td> <input type="text" name="op1" id="op1" placeholder="Option 1" class="txt"></td></tr>
<tr><td>Option 2</td><td> <input type="text" name="op2" id="op2" placeholder="Option 2" class="txt"></td></tr>
<tr><td>Option 3</td><td> <input type="text" name="op3" id="op3" placeholder="Option 3" class="txt"></td></tr>
<tr><td>Option 4</td><td> <input type="text" name="op4" id="op4" placeholder="Option 4" class="txt"></td></tr>
<tr><td>Answer</td><td> <select name="ans" id="ans" class="txt" onfocus="get()">
							<option value="">--select--</option>
						</select></td></tr>
<tr><td>Mark</td><td> <input type="text" name="mark" id="mark" placeholder="Mark" class="txt"></td></tr>
<tr><td></td><td><input type="Submit" name="add" value="Add" style="margin-left:5%;"></td></tr>
</table>

</form>
</fieldset>
</div>
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
	if(isset($_POST["add"]) && $_POST["question"]!="" && $_POST["ans"]!=""){
		$qry='INSERT INTO `questions` (`question`, `op1`, `op2`, `op3`, `op4`, `answer`, `mark`, `level`) VALUES ("'.$_POST["question"].'", "'.$_POST["op1"].'", "'.$_POST["op2"].'", "'.$_POST["op3"].'", "'.$_POST["op4"].'", "'.$_POST["ans"].'", '.$_POST["mark"].', "'.$_POST["level"].'");';
		if($result=$conn->query($qry)){
			echo '<script>alert("Added successful...!");</script>';
		}else{ echo '<script>alert("Added successful...!");</script>';}
	}
	$qry='SELECT * FROM `questions` ORDER BY `level`;';
	$result=$conn->query($qry);
	if($result->num_rows > 0){
		echo '<table class="table">';
		echo '<tr><th style="border-radius:10px 0px 0px 0px;">Question</th><th>Options</th><th>Answer</th><th>Mark</th><th>Level</th><th style="border-radius:0px 10px 0px 0px;">Edit</th></tr>';
		while($row=$result->fetch_assoc()){
		echo '<tr><td class="td">'.$row["question"].'</td><td class="td">'.$row["op1"].', '.$row["op2"].', '.$row["op3"].', '.$row["op4"].'</td><td class="td">'.$row["answer"].'</td><td class="td">'.$row["mark"].'</td><td class="td">'.$row["level"].'</td><td class="td"><a href="update.php?eid='.$row["qid"].'">Edit</a> <a href="update.php?did='.$row["qid"].'">Delete</a></td></tr>';
		}
		echo '</table>';
	}else{echo "No questions added yet...";}
	$conn->close();	
?>
</body>
</html>