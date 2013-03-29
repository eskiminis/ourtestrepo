<html>
<head>
<link href="../css/sge-easy/core.css" rel="stylesheet" type="text/css" />
<title>Error</title>
<script type="text/javascript">
<!-- 
var tmc=9;
function countd() {
	if(tmc!=0){
		tmc--;
		document.getElementById("count").innerHTML=tmc;
	}
	if(tmc==0){document.location.href="../index.php";}
	else{ setTimeout("countd();",1000); }
}
// -->
</script>
<style type="text/css">
.er {
	color: #F00;
	font-size: 18px;
}
</style>
</head>
<body onload="countd();"><div class="intro">
  <div align="center" class="er"><?=$lang['install-error'];?></div>
</div>
</body>
</html>
