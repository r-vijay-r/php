<!DOCTYPE html>
<html>
<body>

<form action="test.php" id="examform">
First name:<br>
<input type="text" id="firstname" name="firstname">
<br>
<input type="submit">
</form>
<a href="test.php?distroy=destroy">destroy</a>
<a href="test.php">refresh</a>
<script>
window.onbeforeunload=function myFunction() {
 //document.getElementById("examform").submit();
 var qry="test.php?firstname="+document.getElementById("firstname").value;
  myWindow = window.open(qry, "myWindow", "width=200, height=100"); 
    return false;
   // return document.getElementById("examform").submit();
}
</script>
<?php 
session_start();
	echo $_SESSION["firstname"];
if(isset($_GET["firstname"])){
	$_SESSION["firstname"]=$_GET["firstname"];
}
if(isset($_GET["distroy"])){
	session_destroy();
}
?>
<p>Note that the form itself is not visible.</p>
<p>Also note that the default width of a text field is 20 characters.</p>

</body>
</html>

