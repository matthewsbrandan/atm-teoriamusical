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
		div#divSelNota{ opacity: 1; margin-top: 3px; }
		div#divSelNota button,select,label,input{ margin-top: 3px; margin-bottom: 8px; }
		div#divSelNota button{ width: 100%; }
		.box-transparent-radius{
			background: rgba(0,0,0,.4);
			padding: 5px;
			color: rgb(230,230,230);
			font-size: 11pt;
			border-radius: 7px;
			width: 600px;
			margin: auto;
		}
		section#sectionBraco,div#mapeado img{
			position: relative;
			width:250px;
			height: 384px;
			margin:auto;
			border-radius: 7px;
			box-shadow: 2px 2px 2px rgba(0,0,0,.4);
			border: .5px solid gray;
		}
		section#sectionBraco{ background: url("../img/obj/bracoMenor.jpg") no-repeat; }
		div#mapeado{ display: none; }
		div#mapeado h5{
			background: rgba(0,0,0,.5);
			color:white;
			border-radius: 7px;
			margin: auto;
			padding: 3px;
			margin-bottom: 5px;
			font-size: 13pt;
		}
        .btnSelecionado{ background: #646464; color:white; }
        #numDedos{ box-shadow: 5px 5px 25px black; display: none; }
        #numDedos span{
            background: rgba(20,20,20,.8);
            padding: 1px 5px 2px 5px;
            border-radius: 10px;
        }
	</style>
	<!--Notas-->
	<style>
		.azul{ background: rgba(0,70,150,.9); }
		.vermelho{ background: rgba(220,0,40,.9); }
		.vermelhoEscuro{ background: rgba(130,0,5,.9); }
		span.nota{
			background: rgba(220,0,40,.9);
			position: absolute;
			display: block;
			opacity: 0;
			font-size: 8pt;
			width: 15px;
			padding: 1px;
			border-radius: 7px;
			transition: opacity 0.9s;
		}
		span.nota input{
			padding:0px;
			margin:0px;
			border:none;
			background:transparent;
			width:12px;
			color:white;
			text-align:center;
		}
		span.casa{
			background: rgba(0,70,150,.9);
			position: absolute;
			display: block;
			opacity: 0;
			font-size: 9pt;
			width: 55px;
			padding: 1px;
			border-radius: 7px;
			color: white;
			transition: opacity 0.9s;
		}
	</style>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
	<script>
		vertical = new Array(-2,30,91,151,204,253,296,338);
		horizont = new Array(131,148,165,181,197,213);
		cromatica = new Array("C","C#","D","D#","E","F","F#","G","G#","A","A#","B","C","C#","D","D#","E","F","F#","G","G#","A","A#","B");
							// 0   1    2 	3 	 4 	 5   6    7   8    9   10   11  12   13  14  15   16  17   18  19  20   21  22   23
		var visivel = false;
		var verNum = false;
		var tocar = true;
		function numerDedos(){ $('#numDedos').toggle('slow'); }
        function notaCasa(){
			v = parseInt(document.getElementById('nCasa').value);
			local('cordaE',vertical[v],horizont[0]);localNota('inCE',cromatica[4+v]);
			local('cordaA',vertical[v],horizont[1]);localNota('inCA',cromatica[9+v]);
			local('cordaD',vertical[v],horizont[2]);localNota('inCD',cromatica[2+v]);
			local('cordaG',vertical[v],horizont[3]);localNota('inCG',cromatica[7+v]);
			local('cordaB',vertical[v],horizont[4]);localNota('inCB',cromatica[11+v]);
			local('cordae',vertical[v],horizont[5]);localNota('inCe',cromatica[4+v]);
		}
		function notaBraco(){
			if(visivel){
				esconde('cordaE');esconde('cordaA');
				esconde('cordaD');esconde('cordaG');
				esconde('cordaB');esconde('cordae');
				visivel = false;
			}else{
				mostra('cordaE');mostra('cordaA');
				mostra('cordaD');mostra('cordaG');
				mostra('cordaB');mostra('cordae');
				notaCasa();
				visivel = true;
			}
		}
		function numCasa(){
			if(verNum){
				esconde('casa1');esconde('casa2');
				esconde('casa3');esconde('casa4');
				esconde('casa5');esconde('casa6');
				esconde('casa7');
				verNum = false;
			}else{
				local('casa1',vertical[1],70);local('casa2',vertical[2],70);
				local('casa3',vertical[3],70);local('casa4',vertical[4],70);
				local('casa5',vertical[5],70);local('casa6',vertical[6],70);
				local('casa7',vertical[7],70);
				verNum = true;
			}
		}
		function nota(){
            if($('#btnSelMenor').hasClass('btnSelecionado')||$('#btnSelSustenido').hasClass('btnSelecionado')){ notaPestana(); }
            else{
             v = document.getElementById('selAcorde').value;
			 switch(v){
				case 'C':   
					local('cordaE',vertical[0],horizont[0]);localNota('inCE','x');
					local('cordaA',vertical[3],horizont[1]);localNota('inCA','3');
					local('cordaD',vertical[2],horizont[2]);localNota('inCD','2');
					local('cordaG',vertical[0],horizont[3]);localNota('inCG','0');
					local('cordaB',vertical[1],horizont[4]);localNota('inCB','1');
					local('cordae',vertical[0],horizont[5]);localNota('inCe','0');
					break;
				case 'D':
					local('cordaE',vertical[0],horizont[0]);localNota('inCE','x');
					local('cordaA',vertical[0],horizont[1]);localNota('inCA','x');
					local('cordaD',vertical[0],horizont[2]);localNota('inCD','0');
					local('cordaG',vertical[2],horizont[3]);localNota('inCG','1');
					local('cordaB',vertical[3],horizont[4]);localNota('inCB','3');
					local('cordae',vertical[2],horizont[5]);localNota('inCe','2');
					break;
				case 'E':
					local('cordaE',vertical[0],horizont[0]);localNota('inCE','0');
					local('cordaA',vertical[2],horizont[1]);localNota('inCA','2');
					local('cordaD',vertical[2],horizont[2]);localNota('inCD','3');
					local('cordaG',vertical[1],horizont[3]);localNota('inCG','1');
					local('cordaB',vertical[0],horizont[4]);localNota('inCB','0');
					local('cordae',vertical[0],horizont[5]);localNota('inCe','0');
					break;
				case 'F':
					local('cordaE',vertical[1],horizont[0]);localNota('inCE','1');
					local('cordaA',vertical[3],horizont[1]);localNota('inCA','3');
					local('cordaD',vertical[3],horizont[2]);localNota('inCD','4');
					local('cordaG',vertical[2],horizont[3]);localNota('inCG','2');
					local('cordaB',vertical[1],horizont[4]);localNota('inCB','1');
					local('cordae',vertical[1],horizont[5]);localNota('inCe','1');
					break;
				case 'G':
					local('cordaE',vertical[3],horizont[0]);localNota('inCE','2');
					local('cordaA',vertical[2],horizont[1]);localNota('inCA','1');
					local('cordaD',vertical[0],horizont[2]);localNota('inCD','0');
					local('cordaG',vertical[0],horizont[3]);localNota('inCG','0');
					local('cordaB',vertical[3],horizont[4]);localNota('inCB','3');
					local('cordae',vertical[3],horizont[5]);localNota('inCe','4');
					break;
				case 'A':
					local('cordaE',vertical[0],horizont[0]);localNota('inCE','x');
					local('cordaA',vertical[0],horizont[1]);localNota('inCA','0');
					local('cordaD',vertical[2],horizont[2]);localNota('inCD','1');
					local('cordaG',vertical[2],horizont[3]);localNota('inCG','2');
					local('cordaB',vertical[2],horizont[4]);localNota('inCB','3');
					local('cordae',vertical[0],horizont[5]);localNota('inCe','0');
					break;
				case 'B':
					local('cordaE',vertical[0],horizont[0]);localNota('inCE','x');
					local('cordaA',vertical[2],horizont[1]);localNota('inCA','1');
					local('cordaD',vertical[4],horizont[2]);localNota('inCD','2');
					local('cordaG',vertical[4],horizont[3]);localNota('inCG','3');
					local('cordaB',vertical[4],horizont[4]);localNota('inCB','4');
					local('cordae',vertical[2],horizont[5]);localNota('inCe','1');
					break;
			}
         }
            notaPestana();
		}
        function notaPestana(){
            acordeAtual = document.getElementById('selAcorde').value;
            acordem = $('#btnSelMenor').hasClass('btnSelecionado')?"m":"";
            acordesus = $('#btnSelSustenido').hasClass('btnSelecionado')?"#":"";
            indexAcorde = cromatica.indexOf(acordeAtual+acordesus); 
            //Modelo de E
            if(indexAcorde>=7 && indexAcorde<=8){
                somaI = indexAcorde-4;
                local('cordaE',vertical[0+somaI],horizont[0]);localNota('inCE',somaI==0?'0':'1');
                local('cordaA',vertical[2+somaI],horizont[1]);localNota('inCA',somaI==0?'2':'3');
                local('cordaD',vertical[2+somaI],horizont[2]);localNota('inCD',somaI==0?'3':'4');
                local('cordaG',vertical[(acordem=="m"?0:1)+somaI],horizont[3]);localNota('inCG',somaI==0?(acordem=="m"?'0':'1'):(acordem=="m"?'1':'2'));
                local('cordaB',vertical[0+somaI],horizont[4]);localNota('inCB',somaI==0?'0':'1');
                local('cordae',vertical[0+somaI],horizont[5]);localNota('inCe',somaI==0?'0':'1');
            }else
            //Modelo de A
            if(indexAcorde==0 || indexAcorde==1 || (indexAcorde>=9 && indexAcorde<=13)){
                somaI = indexAcorde-(indexAcorde>=9?9:(-3));
                local('cordaE',vertical[0],horizont[0]);localNota('inCE','x');
                local('cordaA',vertical[0+somaI],horizont[1]);localNota('inCA',somaI!=0?'1':'0');
                local('cordaD',vertical[2+somaI],horizont[2]);localNota('inCD',somaI!=0?(acordem=="m"?'3':'2'):(acordem=="m"?'2':'1'));
                local('cordaG',vertical[2+somaI],horizont[3]);localNota('inCG',somaI!=0?(acordem=="m"?'4':'3'):(acordem=="m"?'3':'2'));
                local('cordaB',vertical[(acordem=="m"?1:2)+somaI],horizont[4]);localNota('inCB',somaI!=0?(acordem=="m"?'2':'4'):(acordem=="m"?'1':'3'));
                local('cordae',vertical[0+somaI],horizont[5]);localNota('inCe',somaI!=0?'1':'0');
            }else
            //Modelo de D
            if(indexAcorde==2 || indexAcorde==3 || indexAcorde==4 || indexAcorde==5 || indexAcorde==6 ){
                somaI = indexAcorde-2;
                local('cordaE',vertical[0],horizont[0]);localNota('inCE','x');
                local('cordaA',vertical[0],horizont[1]);localNota('inCA','x');
                local('cordaD',vertical[0+somaI],horizont[2]);localNota('inCD',somaI!=0?'1':'0');
                local('cordaG',vertical[2+somaI],horizont[3]);localNota('inCG',somaI!=0?(acordem=="m"?'3':'2'):(acordem=="m"?'2':'1'));
                local('cordaB',vertical[3+somaI],horizont[4]);localNota('inCB',somaI!=0?'4':'3');
                local('cordae',vertical[(acordem=="m"?1:2)+somaI],horizont[5]);localNota('inCe',somaI!=0?(acordem=="m"?'2':'3'):(acordem=="m"?'1':'2'));
            }
        }
        function seleciona(v){
            if($('#'+v).hasClass('btnSelecionado')){ $('#'+v).removeClass('btnSelecionado'); }
            else{ $('#'+v).addClass('btnSelecionado'); }
            nota();
        }
		function tocarInstrumento(){
			if(tocar){
				block('mapeado');
				block('voff');
				none('sectionBraco');
				none('vup');
				tocar=false;
			}else{
				block('sectionBraco');
				block('vup');
				none('mapeado');
				none('voff');
				tocar=true;
			}
		}
        function local(n,vt,vl){ document.getElementById(n).style="margin-top:" +  vt + "px;margin-left: " + vl + "px;opacity:1;"; }
		function localNota(n1,n2){ document.getElementById(n1).value=n2; }
		function esconde(v){ document.getElementById(v).style="opacity: 0;"; }
		function mostra(v){ document.getElementById(v).style="opacity: 1;"; }
		function manutencao(){ alert('Área em Manutenção!'); }
		function block(v){ document.getElementById(v).style="display:block;"; }
		function none(v){ document.getElementById(v).style="display:none;"; }
	</script>
</head>
<body>
	<?php include('topBar.php'); ?>
	<div class="card text-center conteudo" id="cordas"> <!--Sobre o Site-->
        <div class="card-header"> Notas no Instrumento </div> <br/>
		<div class="row" style="max-width: 600px; margin: auto;">
			<div class="col-sm-6" id="divSelNota">
				<h5>Funções</h5>
				<hr/>
				<button class="btn btn-dark" onclick="notaBraco()"> Ver Notas no Braço do Instrumento</button>
				<button class="btn btn-dark" onclick="numCasa()"> Ver Número de Casas</button>
                <!--Selecionar Nota-->
				<div class="input-group">
					<select class="custom-select" id="selAcorde" name="selAcorde" onchange="nota()">
						<option onclick="nota()">C</option><option onclick="nota()">D</option>
						<option onclick="nota()">E</option><option onclick="nota()">F</option>
						<option onclick="nota()">G</option><option onclick="nota()">A</option>
						<option onclick="nota()">B</option>
					</select>
					<label class="input-group-append" for="selAcorde">
						<span class="input-group-text">Acorde</span>
					</label>
				</div>
				<!--Selecionar Número da Casa-->
                <div class="input-group">
					<input type="number" class="form-control" id="nCasa" name="nCasa" value="0" min="0" max="7" onchange="notaCasa()">
					<label class="input-group-append" for="nCasa">
						<span class="input-group-text">Casas</span>
					</label>
				</div>
                <!--Menor | Sustenido-->
				<div class="btn-group" role="group" style="width: 100%;">
	    			<button id="btnSelMenor" type="button" class="btn btn-secundary" onclick="seleciona('btnSelMenor');">
						Menor (m)
					</button>
					<button id="btnSelSustenido" type="button" class="btn btn-secundary" onclick="seleciona('btnSelSustenido');">
						Sustenido (#)
					</button>
	  			</div>
	  			<button class="btn btn-dark" onclick="numerDedos();"> Numeração dos Dedos </button>
	  			<button id="btnTocar" type="button" class="btn btn-dark" onclick="tocarInstrumento()" title="Tocar o Instrumento"> <i style="display: block;" class="material-icons" id="vup">volume_up</i><i style="display: none;" class="material-icons" id="voff">volume_off</i> </button>
			</div>
            <!--Braço-->
			<div class="col-sm-6">
				<section id="sectionBraco">
					<span class="nota" id="cordaE"><input type="text" id="inCE" readonly value="E"></span>
					<span class="nota" id="cordaA"><input type="text" id="inCA" readonly value="A"></span>
					<span class="nota" id="cordaD"><input type="text" id="inCD" readonly value="D"></span>
					<span class="nota" id="cordaG"><input type="text" id="inCG" readonly value="G"></span>
					<span class="nota" id="cordaB"><input type="text" id="inCB" readonly value="B"></span>
					<span class="nota" id="cordae"><input type="text" id="inCe" readonly value="E"></span>

					<span class="casa" id="casa1">Casa 1 &rarr;</span><span class="casa" id="casa2">Casa 2 &rarr;</span>
					<span class="casa" id="casa3">Casa 3 &rarr;</span><span class="casa" id="casa4">Casa 4 &rarr;</span>
					<span class="casa" id="casa5">Casa 5 &rarr;</span><span class="casa" id="casa6">Casa 6 &rarr;</span>
					<span class="casa" id="casa7">Casa 7 &rarr;</span>
				</section>
				<div id="mapeado">
					<h5>Reprodução em Manutenção!<!--Liberado para Reprodução--></h5>
					<img src="../img/obj/bracoMenor.jpg" usemap="#meumapa">
					<map name="meumapa">
						<area shape="poly" coords="0,0,33,0,33,108,43,109,43,186,0,186" href="#" style="cursor:pointer;"/>
					</map>
				</div>
			</div>
            <!--Dedos-->
            <div class="col-sm-12 bg-dark text-light rounded mt-2" id="numDedos">
                <div class="d-inline-block">Dedos:</div>
                <div class="d-inline-block px-3"><span>1</span> - Indicador</div>
                <div class="d-inline-block px-3"><span>2</span> - Médio</div>
                <div class="d-inline-block px-3"><span>3</span> - Anelar</div>
                <div class="d-inline-block px-3"><span>4</span> - Mindinho</div>
            </div>
		</div>			
		<br/>
		<p class="card-text box-transparent-radius">É importante saber, que cada <span class="deitar">corda do instrumento possui uma nota</span>, que na ordem seria [E - A - D - G - B - E], e ao descer pelo braço do violão as notas vão subindo de meio em meio tom, como pode se ver alterando o valor das casas nas <span class="deitar">Funções</span> acima.<br/>Os números que vemos são os nossos dedos: 1 - Indicador, 2 - Médio, 3 - Anelar e 4 - Mindinho, com o '0' representando corda solta, e o 'X' dizendo que a corda não será tocada. Com essa idéia, tente reproduzir os Acordes em seu instrumento.<br/>Boa Sorte!</p>
		<br/>
        <div class="card-footer text-muted"> Prof. Mateus Brandão </div>
	</div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>