<?php
if(isset($_GET["name"]) ){
	echo $_GET["name"];
}else {echo "error";}
//INSERT INTO  `vijay`.`a` (`id` ,`name`)VALUES ('1',  "vijay");
// Create connection
$conn = new mysqli("localhost", "root", "", "vijay");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = 'INSERT INTO  `vijay`.`a` (`name`)VALUES (  "'.$_GET["name"].'");';

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>