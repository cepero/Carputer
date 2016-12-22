var divid = "cache"; // el div que quieres actualizar!
var objetoAJAX;

function crearObjetoAjax(){
	objetoAjax=new XMLHttpRequest();
}

/*Refresca el contenido del div cache cada 10 ms*/
function refresca(){
	var url = "cache.php";
	
	objetoAjax.onreadystatechange=function(){
		// Si esta listo para recibir de nuevo la pagina, la refresca
		if(objetoAjax.readyState== 4 && objetoAjax.readyState != null){
			document.getElementById(divid).innerHTML=objetoAjax.responseText;
			setTimeout('refresca()',1000);
		}
	}

	if(document.getElementById("voiceMode")!=null){
		if(document.getElementById("voiceMode").innerHTML == "motor"){
			document.location.href = "./obd.php";
		}
	}

	if(document.getElementById("escuchando")!=null){
		if(document.getElementById("escuchando").innerHTML == "true"){
			document.getElementById("mic").src="./Images/Mic2.png";
		}else{
			document.getElementById("mic").src="./Images/Mic1.png";
		}
	}
	
	objetoAjax.open("GET",url,true);
	objetoAjax.send(null);
}
	 
window.onload = function(){
	crearObjetoAjax();
	refresca();	
}


