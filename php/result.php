<html>
<head>
<title>Search Result</title>
<style>
	th{background-color:orange;}
	td{background-color:cyan;width:10%;}
	table{background-color:black;}
	.s{background-color:white;}
</style>
</head>
<body>
<form action="result.php" method="post" name="login">
<div style="width:25%; float:right; margin-right:20%;">
<table class="s">
<tr><td class="s" colspan=3><input type="text" name="search" placeholder="Search" style="width:50%;" value="<?php echo $_POST["search"];?>"><select name="sfeild" style="width:70px;padding-top: 1px;padding-bottom: 1px;background-color: buttonface;"><option value="name" <?php if($_POST["sfeild"]=="name"){ echo "selected";} ?> >Name</option><option value="gender" <?php if($_POST["sfeild"]=="gender"){ echo "selected";} ?> >Gender</option><option value="age" <?php if($_POST["sfeild"]=="age"){ echo "selected";} ?> >Age</option><option value="mark" <?php if($_POST["sfeild"]=="mark"){ echo "selected";} ?> >Mark</option><select><input type="submit" name="sear" value="Search"></td></tr>
<tr><td class="s"><b>Mark</b></td><td class="s"><b>Age</b></td><td class="s"><b>Gender</b></td></tr>
<tr>
<td class="s" style="border-right: dotted #e6e6e6;">0 to 200<input type="checkbox" name="m0to200" id="m0to200" <?php if(isset($_POST["m0to200"])){ echo "checked"; } ?> onclick="chkbxclkd()"></td>
<td class="s" style="border-right: dotted #e6e6e6;">10 to 20<input type="checkbox" name="a10to20" id="a10to20" <?php if(isset($_POST["a10to20"])){ echo "checked"; } ?> onclick="chkbxclkd()"></td>
<td class="s">Male<input type="checkbox" name="male" id="male" <?php if(isset($_POST["male"])){ echo "checked"; } ?> onclick="chkbxclkd()"></td>
</tr>
<tr>
<td class="s" style="border-right: dotted #e6e6e6;">200 to 300<input type="checkbox" name="m200to300" id="m200to300" <?php if(isset($_POST["m200to300"])){ echo "checked"; } ?> onclick="chkbxclkd()"></td>
<td class="s" style="border-right: dotted #e6e6e6;">20 to 30<input type="checkbox" name="a20to30" id="a20to30" <?php if(isset($_POST["a20to30"])){ echo "checked"; } ?> onclick="chkbxclkd()">
</td>
<td class="s">Female<input type="checkbox" name="female" id="female" <?php if(isset($_POST["female"])){ echo "checked"; } ?> onclick="chkbxclkd()"></td>
</tr>

</table>
</div>
</form>
<div id="txtHint"></div>
<?php
if(isset($_POST["sear"])){
	if($_POST["search"]!=""){
		$ma="";
		$m=0;
		if(isset($_POST["m0to200"])){
			$ma.=" and mark between 0 and 200";
			$m++;
		}
		if(isset($_POST["m200to300"])){
			$ma.=" and mark between 200 and 300";
			$m++;
		}
		if($m>1){
			$ma=" and mark between 0 and 300";
		}
		$aa="";
		$a=0;
		if(isset($_POST["a10to20"])){
			$aa.=" and age between 10 and 20";
			$a++;
		}
		if(isset($_POST["a20to30"])){
			$aa.=" and age between 20 and 30";
			$a++;
		}
		if($a>1){
			$aa=" and age between 10 and 30";
		}
		$ga="";
		$g=0;
		if(isset($_POST["male"])){
			$ga.=" and gender = 'Male'";
			$g++;
		}
		if(isset($_POST["female"])){
			$ga.=" and gender = 'Female'";
			$g++;
		}
		if($g>1){
			$ga=" and gender = 'Male' or gender = 'Female'";
		}
//sssssss
	$sea=$_POST["sfeild"]." like '%".$_POST["search"]."%' ";
	$resultq=$sea.$ma.$aa.$ga;
	}else{header('Location:mark_ins.php');}
}else{header('Location:mark_ins.php');}
	
?>
<script>
function autosearch(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "string error";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getdetails.php?resultq="+str,true);
        xmlhttp.send();
    }
}
function chkbxclkd(){ 
var qry="";
		var ma="";
		var m=0;
		if(document.getElementById("m0to200").checked){
			ma+=" and mark between 0 and 200";
			m++;
		}
		if(document.getElementById("m200to300").checked){
			ma+=" and mark between 200 and 300";
			m++;
		}
		if(m>1){
			ma=" and mark between 0 and 300";
		}
		var aa="";
		var a=0;
		if(document.getElementById("a10to20").checked){
			aa+=" and age between 10 and 20";
			a++;
		}
		if(document.getElementById("a20to30").checked){
			aa+=" and age between 20 and 30";
			a++;
		}
		if(a>1){
			aa=" and age between 10 and 30";
		}
		var ga="";
		var g=0;
		if(document.getElementById("male").checked){
			ga+=" and gender = 'Male'";
			g++;
		}
		if(document.getElementById("female").checked){
			ga+=" and gender = 'Female'";
			g++;
		}
		if(g>1){
			ga=" and gender = 'Male' or gender = 'Female'";
		}
		var sea="<?php echo $sea; ?>";
		
		qry=sea+ma+aa+ga;
autosearch(qry);
}
autosearch("<?php echo $resultq; ?>");
</script>
</body>
</html>