<html>
	<head>
		<title>Carputer</title>
        	<link href="./estilos.css" rel="stylesheet" type="text/css">
		<script src="./js/ajaxIndex.js"></script>
		<script type="text/javascript" src="./js/jquery-3.0.0.min.js"></script>
		<script>
		$(document).ready(function() {
			//Al pulsar en el div de obd redirecciona a la pagina correspondiente.
			$( "#botonApagar" ).dblclick(function(){window.location.href = "./exec/shutdown.php";});

			$( "#botonObd" ).dblclick(function(){ window.location.href = "./obd.php";});

			$( "#botonMovil" ).dblclick(function(){ alert("Funcion no disponible por el momento");});

			$( "#botonAplicaciones" ).dblclick(function(){ alert("Funcion no disponible por el momento");});

			$( "#botonMusica" ).dblclick(function(){ window.location.href = "./exec/kodi.php";});

			$( "#botonRadio" ).dblclick(function(){ window.location.href = "./exec/kodi.php";});

			$( "#botonLuces" ).dblclick(function(){ alert("Funcion no disponible por el momento");});

			$( "#botonInternet" ).dblclick(function(){ window.open("http://www.google.es");});

			$( "#botonHome" ).dblclick(function(){ window.location.href = "./exec/minimize.php";});

			//Se tratan los eventos de teclado (flechas derecha e izquierda)
			$("html").on( "keydown", function( event) {
				if(event.keyCode == 39){ //Tecla derecha pulsada
					var cual = $(".seleccionado").attr('id');
					$(".seleccionado").removeClass("seleccionado");
					if(cual == "apagar"){
						$("#obd").addClass("seleccionado");
					}else if(cual == "obd"){
						$("#movil").addClass("seleccionado");
					}else if(cual == "movil"){
						$("#aplicaciones").addClass("seleccionado");
					}else if(cual == "aplicaciones"){
						$("#musica").addClass("seleccionado");
					}else if(cual == "musica"){
						$("#radio").addClass("seleccionado");
					}else if(cual == "radio"){
						$("#luces").addClass("seleccionado");
					}else if(cual == "luces"){
						$("#internet").addClass("seleccionado");
					}else if(cual == "internet"){
						$("#home").addClass("seleccionado");
					}else if(cual == "home"){
						$("#apagar").addClass("seleccionado");
					}
				}else if(event.keyCode == 37){ //Tecla izquierda pulsada
					var cual = $(".seleccionado").attr('id');
					$(".seleccionado").removeClass("seleccionado");
					if(cual == "apagar"){
						$("#home").addClass("seleccionado");
					}else if(cual == "obd"){
						$("#apagar").addClass("seleccionado");
					}else if(cual == "movil"){
						$("#obd").addClass("seleccionado");
					}else if(cual == "aplicaciones"){
						$("#movil").addClass("seleccionado");
					}else if(cual == "musica"){
						$("#aplicaciones").addClass("seleccionado");
					}else if(cual == "radio"){
						$("#musica").addClass("seleccionado");
					}else if(cual == "luces"){
						$("#radio").addClass("seleccionado");
					}else if(cual == "internet"){
						$("#luces").addClass("seleccionado");
					}else if(cual == "home"){
						$("#internet").addClass("seleccionado");
					}
				}else if(event.keyCode == 13){ //Tecla intro pulsada
					var cual =  $(".seleccionado").attr('id');
					if(cual == "apagar"){
						window.location.href = "./exec/shutdown.php";
					}else if(cual == "obd"){
						window.location.href = "./obd.php";
					}else if(cual == "movil"){
						alert("Función no disponible por el momento");
					}else if(cual == "aplicaciones"){
						alert("Función no disponible por el momento");
					}else if(cual == "musica"){
						window.location.href = "./exec/kodi.php";
					}else if(cual == "radio"){
						window.location.href = "./exec/kodi.php";
					}else if(cual == "luces"){
						alert("Función no disponible por el momento");
					}else if(cual == "internet"){
						window.open("http://www.google.es");
					}else if(cual == "home"){
						window.location.href = "./exec/minimize.php";
					}
				}
			});

			//Se tratan los eventos de click sobre las opciones
			$(".opcion").click(function(){
				$(".seleccionado").removeClass("seleccionado");
				$(this).addClass("seleccionado");
			});
		});

		
		</script>

	</head>

    <body>
		<?php
                        //Se auto-inicia el reconocimiento por voz
						exec("sudo modprobe uinput");
                        exec("sudo /usr/bin/pulseaudio --start --log-target=syslog --system=false");
                        exec("sudo export LD_LIBRARY_PATH=/usr/local/lib  ");
                        exec("sudo export PKG_CONFIG_PATH=/usr/local/lib/pkgconfig ");
                        //exec("pocketsphinx_continuous -hmm /usr/local/share/pocketsphinx/model/en-us/en-us -lm 0014.lm -dict 0014.dic -samprate 16000/8000/48000 -inmic yes -adcdev plughw:0,0 2>/dev/null | tee /var/www/html/carputer/words.log");
                        //exec("sudo -u www-data /usr/bin/python /var/www/html/carputer/python/recognition.py");

                ?>

		<div class="opcion" id="apagar"></div>
		<div class="opcion" id="obd"><div class="boton" id="botonObd"></div></div>
		<div class="opcion" id="movil"><div class="boton" id="botonMovil"></div></div>
		<div class="opcion" id="aplicaciones"><div class="boton" id="botonApp"></div></div>
		<div class="opcion seleccionado" id="musica"><div class="boton" id="botonMusica"></div></div>
		<div class="opcion" id="radio"><div class="boton" id="botonRadio"></div></div>
		<div class="opcion" id="luces"><div class="boton" id="botonLuces"></div></div>
		<div class="opcion" id="internet"><div class="boton" id="botonInternet"></div></div>
		<div class="opcion" id="home"><div class="boton" id="botonHome"></div></div>
		<img id="mic" src="./Images/Mic1.png">
		<div id="cache"></div>
    </body>
</html>
