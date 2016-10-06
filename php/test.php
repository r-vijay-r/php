<script>
var starttoday = new Date();
var start = starttoday.getSeconds();
function startTime() {
    var today = new Date();
    var s = today.getSeconds();
    s = checkTime(s);
	var sec=20+(start-s);
    sec = checkTime(sec);
    document.getElementById('txt').innerHTML =
    "00" + ":" + "00" + ":" + sec;
	if(sec==0){document.getElementById('txt').innerHTML ="Time Out !!";
	return;}
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}
</script>

<body onload="startTime()">

<div id="txt"></div>

</body>

