<?php 

session_start();
$mark=0;
$conn = new mysqli("localhost", "root","" , "vijay");
if(isset($_GET["level1"])){
	$i=1;
	while($i<$_SESSION["i"]){
		$qry='SELECT `answer`,`mark` FROM `questions` WHERE `qid`='.$_GET["id".$i].';';
		$result=$conn->query($qry);
		$row=$result->fetch_assoc();
		if($_GET["option".$i] == $row["answer"]){
			$mark=$mark+$row["mark"];
		}
		$i++;
	}
	$qry='UPDATE `stdexamdet` SET `'.$_GET["level1"].'` = '.$mark.' WHERE `stdexamdet`.`id` = '.$_SESSION["student_id"].';';
	$result=$conn->query($qry);
	$_SESSION["i"]=null;
	header('Location:exam.php');
}
if(isset($_GET["level"])){
	$qry='SELECT `'.$_GET["level"].'` FROM `stdexamdet` WHERE `id`='.$_SESSION["student_id"].';';
	$result=$conn->query($qry);
	$row=$result->fetch_assoc();
	if($row[$_GET["level"]]==NULL){
		echo "<legend>".ucfirst($_GET["level"])." Examination</legend>";
		echo '<div id="txt"></div>';
		$qry='SELECT `qid`, `question`,`op1`,`op2`,`op3`,`op4`,`mark` FROM `questions` WHERE `level`="'.$_GET["level"].'";';
		$result=$conn->query($qry);
		?>
		<form action="runexam.php" id="examform">
		<ol>
		<?php
		$_SESSION["i"]=1;
		while($row=$result->fetch_assoc()){
			?>
			<li style="margin-bottom:3%;">
			<?php
			echo $row["question"]." (Score : ".$row["mark"].")<br>";
			?>
			<input type="radio" id="option1<?php echo $_SESSION["i"];?>"" name="option<?php echo $_SESSION["i"];?>" value="<?php echo $row["op1"];?>"><?php echo $row["op1"]; ?>
			<input type="radio" id="option2<?php echo $_SESSION["i"];?>"" name="option<?php echo $_SESSION["i"];?>" value="<?php echo $row["op2"];?>"><?php echo $row["op2"]; ?>
			<input type="radio" id="option3<?php echo $_SESSION["i"];?>"" name="option<?php echo $_SESSION["i"];?>" value="<?php echo $row["op3"];?>"><?php echo $row["op3"]; ?>
			<input type="radio" id="option4<?php echo $_SESSION["i"];?>"" name="option<?php echo $_SESSION["i"];?>" value="<?php echo $row["op4"];?>"><?php echo $row["op4"]; ?>
			<input type="text" id="id<?php echo $_SESSION["i"];?>" name="id<?php echo $_SESSION["i"];?>" value="<?php echo $row["qid"];?>" hidden readonly>
			<br>
			</li>
			<?php
			$_SESSION["i"]++;
		}
		?>
		</ol>
		<input type="text" id="level1" name="level1" value="<?php echo $_GET["level"]; ?>" hidden readonly>
		<input type="submit" value="Finished" name="finished" style="margin-left:40%;">
		</form>
		<?php
	}else{
		echo "<legend>".ucfirst($_GET["level"])." Examination Result</legend>";
		echo "Total score obtained for ".$_GET["level"]." level exam is ".$row[$_GET["level"]];
		echo '<a href="exam.php" style="float:right; margin:5%; margin-bottom:1%;"><input type="submit" value="OK" autofocus></a>';
	}
}
?>

