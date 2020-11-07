<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Notas</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<style>
		div#divSelNota{
			opacity: 1;
			margin-top: 15px;
			margin-bottom: 20px;
		}
		.box-transparent-radius{
			background: rgba(0,0,0,.4);
			padding: 5px;
			color: rgb(230,230,230);
			font-size: 11pt;
			border-radius: 7px;
			width: 600px;
			margin: auto;
		}
		section#sectionTeclado,div#mapeado img{
			position: relative;
			width:600px;
			height: 187px;
			margin:auto;
			border-radius: 7px;
			box-shadow: 2px 2px 2px rgba(0,0,0,.4);
			border: .5px solid gray;
		}
		section#sectionTeclado{
			background: url("../img/obj/teclado.jpg") no-repeat;
		}
		div#mapeado{
			display: none;
		}
		div#mapeado h5{
			background: rgba(0,0,0,.5);
			color:white;
			border-radius: 7px;
			width:600px;
			margin: auto;
			padding: 3px;
			margin-bottom: 5px;
			font-size: 13pt;
		}
	</style>
	<!--Notas-->
	<style>
		span.nota,span.notaAscendente,span.notaDescendente{
			position: absolute;
			display: block;
			opacity: 0;
			font-size: 9pt;
			width: 30px;
			padding: 2px 7px 4px 7px;
			border-radius: 30px;
			color: white;
			transition: opacity 0.9s;
		}
		span.nota{
			background: rgba(0,100,250,.9);
		}
		span.notaAscendente{
			background: rgba(220,0,40,.9);
		}
		span.notaDescendente{
			background: rgba(130,0,5,.9);
		}
		span#notaC{
			margin-top: 125px;
			margin-left: 7px;
		}
		span#notaD{
			margin-top: 125px;
			margin-left: 50px;
		}
		span#notaE{
			margin-top: 125px;
			margin-left: 93px;
		}
		span#notaF{
			margin-top: 125px;
			margin-left: 135px;
		}
		span#notaG{
			margin-top: 125px;
			margin-left: 178px;
		}
		span#notaA{
			margin-top: 125px;
			margin-left: 220px;
		}
		span#notaB{
			margin-top: 125px;
			margin-left: 263px;
		}
		span#notaCs{
			margin-top: 40px;
			margin-left: 28px;
		}
		span#notaDs{
			margin-top: 40px;
			margin-left: 71px;
		}
		span#notaFs{
			margin-top: 40px;
			margin-left: 156px;
		}
		span#notaGs{
			margin-top: 40px;
			margin-left: 199px;
		}
		span#notaAs{
			margin-top: 40px;
			margin-left: 242px;
		}
		span#notaDb{
			margin-left: 28px;
		}
		span#notaEb{
			margin-left: 71px;
		}
		span#notaGb{
			margin-left: 156px;
		}
		span#notaAb{
			margin-left: 199px;
		}
		span#notaBb{
			margin-left: 242px;
		}
		span#notaC8{
			margin-top: 125px;
			margin-left: 307px;
		}
		span#notaD8{
			margin-top: 125px;
			margin-left: 350px;
		}
		span#notaE8{
			margin-top: 125px;
			margin-left: 393px;
		}
		span#notaF8{
			margin-top: 125px;
			margin-left: 435px;
		}
		span#notaG8{
			margin-top: 125px;
			margin-left: 478px;
		}
		span#notaA8{
			margin-top: 125px;
			margin-left: 520px;
		}
		span#notaB8{
			margin-top: 125px;
			margin-left: 563px;
		}
		span#notaCs8{
			margin-top: 40px;
			margin-left: 327px;
		}
		span#notaDs8{
			margin-top: 40px;
			margin-left: 370px;
		}
		span#notaFs8{
			margin-top: 40px;
			margin-left: 455px;
		}
		span#notaGs8{
			margin-top: 40px;
			margin-left: 498px;
		}
		span#notaAs8{
			margin-top: 40px;
			margin-left: 541px;
		}
		span#notaDb8{
			margin-left: 327px;
		}
		span#notaEb8{
			margin-left: 370px;
		}
		span#notaGb8{
			margin-left: 455px;
		}
		span#notaAb8{
			margin-left: 498px;
		}
		span#notaBb8{
			margin-left: 541px;
		}
	</style>
	<script>
		var visivel = false;
		var menor = false;
		var sustenido = false;
		var notaSel = 0;
		var tocar = true;
		vetCampo = new Array("notaC","notaCs","notaD","notaDs","notaE","notaF","notaFs","notaG","notaGs","notaA","notaAs","notaB","notaC8","notaCs8","notaD8","notaDs8","notaE8","notaF8","notaFs8","notaG8","notaGs8","notaA8","notaAs8","notaB8");
		function notaTeclado(){
			if(visivel){
				esconde('notaC');esconde('notaC8');
				esconde('notaD');esconde('notaD8');
				esconde('notaE');esconde('notaE8');
				esconde('notaF');esconde('notaF8');
				esconde('notaG');esconde('notaG8');
				esconde('notaA');esconde('notaA8');
				esconde('notaB');esconde('notaB8');
				esconde('notaCs');esconde('notaCs8');
				esconde('notaDs');esconde('notaDs8');
				esconde('notaFs');esconde('notaFs8');
				esconde('notaGs');esconde('notaGs8');
				esconde('notaAs');esconde('notaAs8');
				esconde('notaDb');esconde('notaDb8');
				esconde('notaEb');esconde('notaEb8');
				esconde('notaGb');esconde('notaGb8');
				esconde('notaAb');esconde('notaAb8');
				esconde('notaBb');esconde('notaBb8');
				visivel = false;
			}else{
				mostra('notaC');mostra('notaC8');
				mostra('notaD');mostra('notaD8');
				mostra('notaE');mostra('notaE8');
				mostra('notaF');mostra('notaF8');
				mostra('notaG');mostra('notaG8');
				mostra('notaA');mostra('notaA8');
				mostra('notaB');mostra('notaB8');
				mostra('notaCs');mostra('notaCs8');
				mostra('notaDs');mostra('notaDs8');
				mostra('notaFs');mostra('notaFs8');
				mostra('notaGs');mostra('notaGs8');
				mostra('notaAs');mostra('notaAs8');
				mostra('notaDb');mostra('notaDb8');
				mostra('notaEb');mostra('notaEb8');
				mostra('notaGb');mostra('notaGb8');
				mostra('notaAb');mostra('notaAb8');
				mostra('notaBb');mostra('notaBb8');
				visivel = true;
			}
		}
		function nota(v,pmenor,psus){
			notaSel=v;
			visivel=true;
			notaTeclado();
			v=psus?v+1:v;
			if(pmenor){
				mostra(vetCampo[v]);
				mostra(vetCampo[v+3]);
				mostra(vetCampo[v+7]);
			}else{
				mostra(vetCampo[v]);
				mostra(vetCampo[v+4]);
				mostra(vetCampo[v+7]);
			}
		}
		function seleciona(v){
			var cor;
			if(v=="btnSelMenor"){
				if(menor){
					cor="background: #dddddd;color:black;";
					menor=false;
				}else{
					cor="background: #646464;color:white;";
					menor=true;
				}
			}else if(v=="btnSelSustenido"){
				if(notaSel!=4 && notaSel!=11 && notaSel!=16 && notaSel!=23){
					if(sustenido){
						cor="background: #dddddd;color:black;";
						sustenido=false;
					}else{
						cor="background: #646464;color:white;";
						sustenido=true;
					}
				}else{
					alert("As notas 'E' e 'B' não possuem sustenido.");
				}
			}
			nota(notaSel,menor,sustenido);
			document.getElementById(v).style=cor;
		}
		function deseleciona(){
			document.getElementById('btnSelMenor').style="background: #dddddd;color:black;";
			document.getElementById('btnSelSustenido').style="background: #dddddd;color:black;";
			menor=false;
			sustenido=false;
		}
		function tocarTeclado(){
			if(tocar){
				block('mapeado');
				block('voff');
				none('sectionTeclado');
				none('vup');
				tocar=false;
			}else{
				block('sectionTeclado');
				block('vup');
				none('mapeado');
				none('voff');
				tocar=true;
			}
			
		}
		function esconde(v){
			document.getElementById(v).style="opacity: 0;";
		}
		function mostra(v){
			document.getElementById(v).style="opacity: 1;";
		}
		function block(v){
			document.getElementById(v).style="display:block;";
		}
		function none(v){
			document.getElementById(v).style="display:none;";
		}
	</script>
</head>
<body>
	<?php include('topBar.php'); ?>
	<div class="card text-center conteudo" id="notas"> <!--Sobre o Site-->
        <div class="card-header">
	    	Notas no Instrumento
	  	</div>
		<br/>
		<div id="divSelNota">
			<button class="btn btn-primary" onclick="notaTeclado()"> Ver Notas no Teclado </button>
			<div class="btn-group" role="group">
				<button id="btnSelAcorde" type="button" class="btn btn-secundary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Acorde
				</button>
    			<div class="dropdown-menu" aria-labelledby="btnSelAcorde">
			      	<a class="dropdown-item" href="#" onclick="nota(0,false);deseleciona();">C</a>
			      	<a class="dropdown-item" href="#" onclick="nota(2,false);deseleciona();">D</a>
			      	<a class="dropdown-item" href="#" onclick="nota(4,false);deseleciona();">E</a>
			      	<a class="dropdown-item" href="#" onclick="nota(5,false);deseleciona();">F</a>
			      	<a class="dropdown-item" href="#" onclick="nota(7,false);deseleciona();">G</a>
			      	<a class="dropdown-item" href="#" onclick="nota(9,false);deseleciona();">A</a>
			      	<a class="dropdown-item" href="#" onclick="nota(11,false);deseleciona();">B</a>
    			</div>
    			<button id="btnSelMenor" type="button" class="btn btn-secundary" onclick="seleciona('btnSelMenor');">
					Menor (m)
				</button>
				<button id="btnSelSustenido" type="button" class="btn btn-secundary" onclick="seleciona('btnSelSustenido');">
					Sustenido (#)
				</button>
  			</div>
  			<button id="btnTocar" type="button" class="btn btn-dark" onclick="tocarTeclado()" title="Tocar Teclado"> <i style="display: block;" class="material-icons" id="vup">volume_up</i><i style="display: none;" class="material-icons" id="voff">volume_off</i> </button>
		</div>
		<section id="sectionTeclado">
			<br/>
			<span class="nota" id="notaC">C</span><span class="nota" id="notaD">D</span><span class="nota" id="notaE">E</span><span class="nota" id="notaF">F</span><span class="nota" id="notaG">G</span><span class="nota" id="notaA">A</span><span class="nota" id="notaB">B</span>
			<span class="notaAscendente" id="notaCs">C#</span><span class="notaAscendente" id="notaDs">D#</span><span class="notaAscendente" id="notaFs">F#</span><span class="notaAscendente" id="notaGs">G#</span><span class="notaAscendente" id="notaAs">A#</span>
			<span class="notaDescendente" id="notaDb">Db</span><span class="notaDescendente" id="notaEb">Eb</span><span class="notaDescendente" id="notaGb">Gb</span><span class="notaDescendente" id="notaAb">Ab</span><span class="notaDescendente" id="notaBb">Bb</span>
			<!--8-->
			<span class="nota" id="notaC8">C</span><span class="nota" id="notaD8">D</span><span class="nota" id="notaE8">E</span><span class="nota" id="notaF8">F</span><span class="nota" id="notaG8">G</span><span class="nota" id="notaA8">A</span><span class="nota" id="notaB8">B</span>
			<span class="notaAscendente" id="notaCs8">C#</span><span class="notaAscendente" id="notaDs8">D#</span><span class="notaAscendente" id="notaFs8">F#</span><span class="notaAscendente" id="notaGs8">G#</span><span class="notaAscendente" id="notaAs8">A#</span>
			<span class="notaDescendente" id="notaDb8">Db</span><span class="notaDescendente" id="notaEb8">Eb</span><span class="notaDescendente" id="notaGb8">Gb</span><span class="notaDescendente" id="notaAb8">Ab</span><span class="notaDescendente" id="notaBb8">Bb</span>
		</section>
		<div id="mapeado">
			<h5>Reprodução em Manutenção!<!--Liberado para Reprodução--></h5>
			<img src="../img/obj/teclado.jpg" usemap="#meumapa">
			<map name="meumapa">
				<area shape="poly" coords="0,0,33,0,33,108,43,109,43,186,0,186" href="#" style="cursor:pointer;"/>
			</map>
		</div>
		<br/>
		<p class="card-text box-transparent-radius">Os <span class="deitar">Acordes</span> são formados por 3 <span class="deitar">Notas</span>, 1ª - 3ª - 5ª, dentro de seu campo harmônico. A chave que transforma uma nota maior em menor é sua 3ª que se estiver a 2 tons de distancia da 1ª é maior, e se estiver 1,5 é menor.<br/>Os números a mais vão adicionando notas ao Acorde.</p>
		<br/>
        <div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
	</div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>