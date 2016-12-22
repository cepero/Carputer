<?php
	$m = new Memcache;
	$m->addServer('localhost', 11211);

	//Información OBD
	if(isset($_POST["obd"])){
		$obd = $_POST["obd"];
		$arrayOBD = explode(',', $obd);
		$m->set('time', $arrayOBD[0]);
		$m->set('rpm', $arrayOBD[1]);
		$m->set('speed', $arrayOBD[2]);
		$m->set('throtle', $arrayOBD[3]);
		echo "Variable ".$m->get('time')." ".$m->get('throtle')." actualizada";
	}else{
		echo "<p id=time>".$m->get('time')."</p>";
		echo "<p id=rpm>".$m->get('rpm')."</p>";
		echo "<p id=speed>".$m->get('speed')."</p>";
		echo "<p id=throtle>".$m->get('throtle')."</p>";
	}

	//Reconocimiento de algunos comandos por voz
	if(isset($_POST["escuchando"])){
		$m->set('escuchando', $_POST["escuchando"]);
		echo "ESCUCHANDO";
	}else{
		echo "<p id=escuchando>".$m->get('escuchando')."</p>";
	}

	if(isset($_POST["voiceMode"])){
		if($_POST["voiceMode"] == "motor"){
			$m->set('voiceMode', 'motor');
		}else if($_POST["voiceMode"] == "music" || $_POST["voiceMode"] == "radio"){
			shell_exec("sudo kodi-standalone");
		}else if($_POST["voiceMode"] == "shutdown"){
			shell_exec("sudo shutdown -h now");
		}
	}else{
		echo "<p id=voiceMode>".$m->get('voiceMode')."</p>";
		$m->set('voiceMode', 'nada');
	}
?>
