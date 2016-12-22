var divid = "cache"; // el div que quieres actualizar!
var objetoAJAX;

/*Selecciona la imagen de Velocidad mas adecuada entre las disponibles*/
function queImagenSpeed(speed){
	if(speed%5 == 0){
		return speed;
	}else if(speed%5 == 1){
		return (parseInt(speed)-1);
	}else if(speed%5 == 2){
		return (parseInt(speed)-2);
	}else if(speed%5 == 3){
		return (parseInt(speed)+2);
	}else if(speed%5 == 4){
		return (parseInt(speed)+1);
	}
}

/*Selecciona la imagen de RPM mas adecuada entre las disponibles*/
function queImagenRPM(rpm){
	var cociente = (parseInt(rpm))/125;
	var floor = Math.floor(cociente);
	var ceil = Math.ceil(cociente);
	if((rpm - floor) > (ceil - rpm)){
		return ceil*125;
	}else{
		return floor*125;
	}
}

/*Selecciona la imagen de Acelerador mas adecuada entre las disponibles*/
function queImagenThrotle(throtle){
        if(parseInt(throtle) < 12.5){
                return (0);
        }else if(parseInt(throtle) >= 12.5 && parseInt(throtle) < 25){
                return ("12,5");
        }else if(parseInt(throtle) >= 25 && parseInt(throtle) < 37.5){
                return (25);
	}else if(parseInt(throtle) >= 37.5 && parseInt(throtle) < 50){
                return ("37,5");
	}else if(parseInt(throtle) >= 50 && parseInt(throtle) < 62.5){
                return (50);
	}else if(parseInt(throtle) >= 62.5 && parseInt(throtle) < 75){
                return ("62,5");
	}else if(parseInt(throtle) >= 75 && parseInt(throtle) < 87.5){
                return (75);
	}else if(parseInt(throtle) >= 87.5 && parseInt(throtle) < 100){
                return ("87,5");
	}else{
                return 100;
	}


}

function keyDownTextField(e) {
	if(e.which == 27){
		document.location.href = "./index.php";
	}
}

function crearObjetoAjax(){
	objetoAjax=new XMLHttpRequest();
}

/*Refresca el contenido del div cache cada 10 ms*/
function refresca(){
	var url = "cache.php";
	
	document.addEventListener("keydown", keyDownTextField, false);
	
	objetoAjax.onreadystatechange=function(){
		// Si esta listo para recibir de nuevo la pagina, la refresca
		if(objetoAjax.readyState== 4 && objetoAjax.readyState != null){
			document.getElementById(divid).innerHTML=objetoAjax.responseText;
			setTimeout('refresca()',10);
		}
	}
	
	if(document.getElementById("speed")!=null){
		var speed = document.getElementById("speed").innerHTML;
		speed2 = queImagenSpeed((parseInt(speed*1.60934))); //Se pasa primero a KPH (viene en MPH)
		document.getElementById("RellenoSpeed").src="./Images/RellenosVelocidad/"+speed2+".png";
		if(speed<10){
			document.getElementById("NumeroSpeedActual").style.left = "395px";
		}else if(speed<100){
			 document.getElementById("NumeroSpeedActual").style.left = "368px";
		}else{
			 document.getElementById("NumeroSpeedActual").style.left = "345px";
		}
		document.getElementById("NumeroSpeedActual").innerHTML = parseInt(speed);
	}

	if(document.getElementById("rpm")!=null){
		var rpm = document.getElementById("rpm").innerHTML;
		rpm2 = queImagenRPM(rpm);
		document.getElementById("RellenoRPM").src="./Images/RellenosRPM/"+rpm2+".png";
		if(rpm<1000){
			 document.getElementById("NumeroRPMActual").style.left = "1160px";
			 document.getElementById("NumeroRPMActual").style.top = "175px";
		}else{
			 document.getElementById("NumeroRPMActual").style.left = "1137px";
			 document.getElementById("NumeroRPMActual").style.top = "175px";
			 document.getElementById("NumeroRPMActual").style.fontSize = "50px";
		}
		document.getElementById("NumeroRPMActual").innerHTML = rpm;
	}

	if(document.getElementById("throtle")!=null){
                var throtle = document.getElementById("throtle").innerHTML;
                throtle2 = queImagenThrotle(throtle);
                document.getElementById("ThrotleSpeed").src="./Images/BarraCentral/"+throtle2+".png";
		document.getElementById("ThrotleRPM").src="./Images/BarraCentral/"+throtle2+".png";

	
	}

	objetoAjax.open("GET",url,true);
	objetoAjax.send(null);
}
	 
window.onload = function(){
	crearObjetoAjax();
	refresca();	
}


