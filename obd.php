<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>OBD</title>
<link href="./estilosOBD.css" rel="stylesheet" type="text/css">
<script src="./js/ajaxObd.js"></script>
<script type="text/javascript" src="./js/jquery-3.0.0.min.js"></script>

<script>
		$(document).ready(function() {
			$( "#Derecha" ).click(function(){
				var pos = $("html").scrollLeft();
				$("html, body").animate({scrollLeft:pos+800}, 800);
			});
		});

		$(document).ready(function() {
			$( "#Izquierda" ).click(function(){
				var pos = $("html").scrollLeft();
				$("html, body").animate({scrollLeft:pos-800}, 800);
			});
		});

</script>
</head>

<body>
<?php
	exec("sudo rfcomm bind 0 00:0D:18:28:26:40");
	sleep(10);
	exec("sudo -u www-data /usr/bin/python /var/www/html/carputer/python/instantaneo.py");
	//sleep(10);
	//shell_exec("sudo python ./python/instantaneo.py");
	//sleep(10);
	//shell_exec("sudo python ./python/instantaneo.py");
?>


<div id=cache></div>

	<img id="FondoSpeed" src="./Images/FondoSpeed.png">
	<img id="RellenoSpeed" src="./Images/RellenosVelocidad/0.png">
	<img id="NumerosSpeed" src="./Images/NumerosSpeed.gif">
	<img id="ThrotleSpeed" src="./Images/BarraCentral/50.png">
	<div id="NumeroSpeedActual"></div>
	<a  href="http://localhost/carputer/index.php"><img id="Cerrar1" src="./Images/Cerrar.png"></a>
	<div id="Derecha"></div>
	
	<img id="FondoRPM" src="./Images/FondoRPM.png">
	<img id="RellenoRPM" src="./Images/RellenosRPM/0.png">
	<img id="NumerosRPM" src="./Images/NumerosRPM.gif">
	<img id="ThrotleRPM" src="./Images/BarraCentral/50.png">
	<div id="NumeroRPMActual"></div>
	<a href="http://localhost/carputer/index.php"><img id="Cerrar2" src="./Images/Cerrar.png"></a>
	<div id="Izquierda"></div>
	
</body>
</html>
