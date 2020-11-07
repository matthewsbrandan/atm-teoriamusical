<?php
	session_start();
	if(!((isset($_SESSION['root']))&&($_SESSION['root']=="Ativo"))){
		header('Location: ../index.php?erro=4');
	}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATMD - Liberação</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../../css/scroll.css">
	<style>
		body{
			background: url("../../img/fundo/foneGrande.jpg");
		}
		ul#menu{
			background: rgba(0,0,0,.8);
			padding: 7px;
		}
		ul#lista li{
			text-align: left;
			margin: auto;
			max-width: 700px;
			background: rgba(200,200,200,.2);
		}
		a{
			color: rgba(250,250,250,.8);
		}
		div#addDoc,div#primeiro,div#pagamento,div#liberacao,div#status,div#notificacao{
			background: rgba(250,250,250,.1);
			color: white;
		}
		div#addDoc{
			display: block;
		}
		.deitar{
			 font-style: italic;
		}
		form#formAula,form#formExerc,form#formAudio,form#formObjetivo,form#formMusica,form#formApp{
			margin-left: 200px;
			margin-right: 200px;
			display: none;
		}
		form#formAula{
			display: block;
		}
		label{
			text-align: left;
		}
		.box-transparent-radius{
			background: rgba(0,0,0,.4);
			padding: 5px;
			color: rgb(230,230,230);
			font-size: 11pt;
			border-radius: 7px;
		}
		.btnTamanho{
			width: 170px;
		}
		div#tblPg,div#tblLib,div#tblLibObj,div#tblStatus,div#btnGroupProg{
			margin-left: 200px;
			margin-right: 200px;
		}
		table#pg thead,table#lib thead{
			background:rgba(250,250,250,.9);
			color:black;
		}
		table#pg i,table#lib i{
			border-radius: 6px;
			cursor: pointer;			
		}
		table#pg i.pg{
			background: rgba(0,200,120,.7);
			padding: 1px 30px 1px 30px;
		}
		table#lib i.lib{
			background: rgba(0,120,200,.7);
			padding: 1px 20px 1px 20px;
		}
		table#pg i.pg:hover,table#lib i.lib:hover{
			background: rgba(80,250,180,.6);
		}
		table#pg i.cancel:hover,table#lib i.cancel-lib:hover{
			background: rgba(250,80,100,.7);
		}
		a.hoverWhite:hover{
			color:white;
		}
		span#spanNotificacao{
			position:absolute;
			float: right;
			background: rgba(220,0,40,1);
			color:white;
			border-radius: 10px;
			padding: .1px 6.5px 1px 6.5px;
			font-size: 9pt;
			margin-top: -12px;
		}
		span#spanNivelMax,span#colNivel,.colNivel{
			background: rgb(60,60,60);
			color:white;
			padding: 1px 8px 3px 8px;
			border-radius: 20px;
			border: 2.5px solid rgb(200,0,5);
		}
		.h5Form{
			margin-top:-5px;
			margin-bottom:20px;
			font-weight:normal;
		}
		.txtarea {
			margin-top: 15px;
		}
        #tblLib,#tblLibObj{
            display: none;
        }
        select.table-select{
            border: none;
            background: transparent;
            color: inherit;
            font-weight: inherit;
        }
        select.table-select option{
            background: #333;
        }
	</style>
	<!--Estilo Level-->
	<style>
		.progress{
		    width: 150px;
		    height: 150px;
		    line-height: 150px;
		    background: none;
		    margin: 0 auto;
		    box-shadow: none;
		    position: relative;
		}
		.progress:after{
		    content: "";
		    width: 100%;
		    height: 100%;
		    border-radius: 50%;
		    border: 12px solid rgba(200,200,200,.5);
		    position: absolute;
		    top: 0;
		    left: 0;
		}
		.progress > span{
		    width: 50%;
		    height: 100%;
		    overflow: hidden;
		    position: absolute;
		    top: 0;
		    z-index: 1;
		}
		.progress .progress-left{
		    left: 0;
		}
		.progress .progress-bar{
		    width: 100%;
		    height: 100%;
		    background: none;
		    border-width: 12px;
		    border-style: solid;
		    position: absolute;
		    top: 0;
		}
		.progress .progress-left .progress-bar{
		    left: 100%;
		    border-top-right-radius: 80px;
		    border-bottom-right-radius: 80px;
		    border-left: 0;
		    -webkit-transform-origin: center left;
		    transform-origin: center left;
		}
		.progress .progress-right{
		    right: 0;
		}
		.progress .progress-right .progress-bar{
		    left: -100%;
		    border-top-left-radius: 80px;
		    border-bottom-left-radius: 80px;
		    border-right: 0;
		    -webkit-transform-origin: center right;
		    transform-origin: center right;
		    animation: loading-100 1.8s linear forwards;
		}
		.progress .progress-value{
		    width: 90%;
		    height: 90%;
		    border-radius: 50%;
		    background: rgba(0,0,0,.7);
		    font-size: 24px;
		    font-family: Times, sans-serif;
		    color: #fff;
		    line-height: 135px;
		    text-align: center;
		    position: absolute;
		    top: 5%;
		    left: 5%;
		}
		.progress.blue .progress-bar{
		    border-color: rgba(204, 0, 0,.9);
		}
		.progress.blue .progress-left .progress-bar{
		    animation: loading-100 1.5s linear forwards 1.8s;
		}
		@keyframes loading-100{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(180deg);
		        transform: rotate(180deg);
		    }
		}
		@media only screen and (max-width: 990px){
		    .progress{ margin-bottom: 20px; }
		}
	</style>
    <script src="../../js/jquery/jquery-3.4.1.min.js"></script>
	<script>
        var audio1 = new Audio();
        var varTocando = false;
		function selButton(v){
			switch (v) {
				case 0: //Exercícios
					styleButtonSelected("cadastrarExerc");
					styleButtonNonSelected("cadastrarAula");
					styleButtonNonSelected("cadastrarAudio");
					styleButtonNonSelected("cadastrarObj");
					styleButtonNonSelected("dropdownIndica");
					displayBlock("formExerc");
					displayNone("formAula");
					displayNone("formAudio");
					displayNone("formObjetivo");
					displayNone("formMusica");
					displayNone("formApp");
					break;
				case 1: //Aula
					styleButtonSelected("cadastrarAula");
					styleButtonNonSelected("cadastrarExerc");
					styleButtonNonSelected("cadastrarAudio");
					styleButtonNonSelected("cadastrarObj");
					styleButtonNonSelected("dropdownIndica");
					displayBlock("formAula");
					displayNone("formExerc");
					displayNone("formAudio");
					displayNone("formObjetivo");
					displayNone("formMusica");
					displayNone("formApp");
					break;
				case 2: //Audio
					styleButtonSelected("cadastrarAudio");
					styleButtonNonSelected("cadastrarExerc");
					styleButtonNonSelected("cadastrarAula");
					styleButtonNonSelected("cadastrarObj");
					styleButtonNonSelected("dropdownIndica");
					displayBlock("formAudio");
					displayNone("formExerc");
					displayNone("formAula");
					displayNone("formObjetivo");
					displayNone("formMusica");
					displayNone("formApp");
					break;
				case 3: //Objetivo
					styleButtonSelected("cadastrarObj");
					styleButtonNonSelected("cadastrarExerc");
					styleButtonNonSelected("cadastrarAudio");
					styleButtonNonSelected("cadastrarAula");
					styleButtonNonSelected("dropdownIndica");
					displayBlock("formObjetivo");
					displayNone("formExerc");
					displayNone("formAudio");
					displayNone("formAula");
					displayNone("formMusica");
					displayNone("formApp");
					break;
				case 4: //Música 
					styleButtonSelected("dropdownIndica");
					styleButtonNonSelected("cadastrarExerc");
					styleButtonNonSelected("cadastrarAudio");
					styleButtonNonSelected("cadastrarObj");
					styleButtonNonSelected("cadastrarAula");
					displayBlock("formMusica");
					displayNone("formExerc");
					displayNone("formAudio");
					displayNone("formObjetivo");
					displayNone("formAula");
					displayNone("formApp");
					break;
				case 5: //App
					styleButtonSelected("dropdownIndica");
					styleButtonNonSelected("cadastrarExerc");
					styleButtonNonSelected("cadastrarAudio");
					styleButtonNonSelected("cadastrarObj");
					styleButtonNonSelected("cadastrarAula");
					displayBlock("formApp");
					displayNone("formExerc");
					displayNone("formAudio");
					displayNone("formObjetivo");
					displayNone("formMusica");
					displayNone("formAula");
					break;
				default:
					break;
			}
		}
		/*Wora*/
		function displayNone(v){ document.getElementById(v).style="display:none;"; }
		function displayBlock(v){ document.getElementById(v).style="display:block;"; }
		function styleButtonSelected(v){ document.getElementById(v).style="background: white;color: rgba(0,0,0,.9);border-color: white;"; }
		function styleButtonNonSelected(v){ document.getElementById(v).style="background: #707580;color: white;border-color: gray;"; }
		/*Alert*/
		function click2(v){
			switch(v){
				case 0: //Cadastrado com Sucesso
					tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Documento Cadastrado!";
					break;
				case 1: //Erro no Casdatramento
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Houve um erro de Cadastramento!";
					break;
				case 2: //Usuário não encontrado
					tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Audio Cadastrado!";
					break;
				case 3: //Erro ao Receber Pagamento
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Pagamento não pode ser Recebido!";
					break;
				case 4: //Pagamento Recebido
					tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Recebimento Efetuado com Sucesso!";
					break;
				case 5: //Erro ao Remover Pagamento
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Pagamento não pode ser Removido!";
					break;
				case 6: //Pagamento Removido
					tituloModalResultado.innerHTML="Operação Realizada";
					subTituloModalResultado.innerHTML="Remoção de Pagamento Efetuada com Sucesso!";
					break;
				case 7: //Erro ao Liberar Aluno
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Não foi possível Efetuar Liberação!";
					break;
				case 8: //Liberação Efetuada
					tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Liberação Efetuada com Sucesso!";
					break;
				case 9: //Erro ao Cancelar Liberação
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Não foi possível Cancelar Liberação!";
					break;
				case 10: //Liberação Removida
					tituloModalResultado.innerHTML="Operação Realizada";
					subTituloModalResultado.innerHTML="Cancelamento de Liberação Efetuado!";
					break;
				case 11: //Falha ao Gerar outro Nivel
                    tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Houve um erro ao gerar novos Níveis!";
					break;
				case 12: //Botão de Subir de Nível
					break;
                case 13: //Nível Gerado
                    tituloModalSobNivel.innerHTML="Novo Nível Musical";
					subTituloSobNivel.innerHTML="Nível Alcançado";
					pLegendaSobNivel.innerHTML="Novo Nível Musical para as três áreas de Ensino: <i>Teclado, Violão e Guitarra.</i>";
					btnActionSobNivel.innerHTML="Avançar + 1";
                    break;
                case 14: //Objetivo Cadastrado
                    tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Objetivo Cadastrado com Sucesso!";
                    break;
                case 15: //Indicação de Musica Cadastrada
                    tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Indicação de Música foi Cadastrada com Sucesso!";
                    break;
                case 16: //Indicação de Aplicativo Cadastrado
                    tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Indicação de Aplicativo Cadastrada com Sucesso!";
                    break;
                case 17: //Modal de Programação
                    break;
                case 18: //Erro na Realização de Objetivo
                    tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Não foi possível Realizar este Objetivo!";
					break;
				case 19: //Liberação Efetuada
					tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Objetivo Realizado com Sucesso!";
                    break;
                case 20: //Usuário ainda não aceitou os Termos
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="O usuário ainda não aceitou os Termos de utilização do Site!";
                    break;
                default:
                    v=100;
                    tituloModalResultado.innerHTML="<i class='material-icons'>warning</i>";
					subTituloModalResultado.innerHTML="<b>Procedimento não autorizado </b><br/>Não altere os dados da URL.";
                    break;
                    
			}
            if(v!=12 && v!=13 && v!=17 ){
				document.getElementById('btnChamaModalResult').click();
			}else if(v==12 || v==13){
				document.getElementById('btnSobNivel').click();
			}else if(v==17){
                document.getElementById('btnProgramar').click();
            }
		}
        /*Audio*/
        function startAudio(v,v2){
            audio1.src = "../../audio/"+v+".mp3";
            if(varTocando){
                audio1.pause();
                varTocando = false;
                v3 = 'audPlay' + v2;
                displayBlock(v3);
                v3 = 'audPause' + v2;
                displayNone(v3);
            }else{
                audio1.play();
                varTocando = true;
                v3 = 'audPause' + v2;
                displayBlock(v3);
                v3 = 'audPlay' + v2;
                displayNone(v3);
            }
        }
        /*Página em Exibição*/
        function alterna(p){ $(p).toggle("slow"); }
        /*Filtro*/
        function filtro(){
            if(document.getElementById('tblSelLO').value=="Alunos"){ showLO(); }
            else{ hideLO(document.getElementById('tblSelLO').value); }
        }
        function showLO(){
            for(c=1;c<($('#tblSelLO option').length);c++){
                nomef = tblSelLO.options[c].value;
                $('.filtro-'+nomef).show("slow");
            }
        }
        function hideLO(p){
            for(c=1;c<($('#tblSelLO option').length);c++){
                nomef = tblSelLO.options[c].value;
                if(nomef==p){ $('.filtro-'+nomef).show("slow"); }
                else{ $('.filtro-'+nomef).hide("slow"); }
            }
        }
        window.onload = function(){
            <?php if(isset($_GET['active'])){ if($_GET['active']==0){ ?> alterna('#tblLib'); <?php } ?>
            <?php if($_GET['active']==1){ ?> alterna('#tblLibObj'); <?php }} ?>
            <?php if(isset($_GET['erro'])){ ?> click2(<?php echo $_GET['erro'];?>); <?php }else ?>
            <?php if (isset($_GET['sobN'])){ ?> click2(13); <?php } ?>
            <?php echo isset($_GET['sess'])?"btnActive(".$_GET['sess'].");":" "; ?>
            <?php echo isset($_GET['program'])?"click2(17)":""; ?>
        };
	</script>
</head>
<body>
	<?php
		include('../../back/functions.php');
		include('../../back/conexao.php');
		$sql = "select count(*) qtd from notificaroot where vista=false;";
		$resultado = $conn->query($sql);
		$numNotifica = $resultado->fetch_array();
		$sql = "select n.id, a.nome, n.acao from notificaroot n inner join alunos a on n.alunoId=a.id where vista=false;";
		$resultado1 = $conn->query($sql);
		$sql = "select max(nivel) max from nivel;";
		$resultado2 = $conn->query($sql);
		$nivelMax = $resultado2->fetch_array();
        $nivelReal[] = 0;
        for($v=1;$v<=$nivelMax[0];$v++){ $nivelReal[] = $v; $nivelReal[] = $v; $nivelReal[] = $v; }
		$conn->close();
	?>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background: rgba(0,0,0,.8);">
		<a href="rootSobre.php"><img src="../../img/icones/blur_two.png" title="Sobre o Site"/></a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav mr-auto" style="margin:auto;">
		      	<li class="nav-item">
			    	<a class="nav-link" href="root.php?sess=1">Adicionar Documento</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" href="rootPagamento.php">Pagamentos</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" href="rootLiberacao.php">Liberações</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" href="rootNotifica.php">Notificações</a>
			  	</li>
                <li class="nav-item">
			    	<a class="nav-link" href="../TESTE.php" target="_blank">Testes</a>
			  	</li>
                <li class="nav-item">
			    	<a class="nav-link" href="../../img/app/" target="_blank">Preview</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" href="rootStatus.php">Status Geral</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link disabled" href="../index.php">Sair</a>
			  	</li>
		    </ul>
	  	</div>
	  	<div class="btn-group dropleft" style="height: 40px;">
		  <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: relative;">
		    <i class="material-icons">notifications</i>
		    <span id="spanNotificacao" <?php if($numNotifica['qtd']==0){ echo "style='display:none;'"; }?>><?php echo $numNotifica['qtd'];?></span>
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		  	<h6 class="dropdown-header">Notificações</h6>
		  	<?php 
	  			$entrou = 0;
	  			while ($valorNotifica = $resultado1->fetch_array()) {
		  			$entrou=1;
		  	?>
		  	<a class="dropdown-item" href="rootNotifica.php"><?php echo "[".$valorNotifica['nome']."] ".$valorNotifica['acao'];?></a>
		  	<?php
	  			} if($entrou==0){
  			?>
			<a class="dropdown-item disabled" href="#" style="cursor: default;">Sem Notificações</a>
  			<?php } ?>
		    <div class="dropdown-divider"></div>
		    <a class="dropdown-item" href="rootNotifica.php">Ver Página de Notificações</a>
		  </div>
		</div>
	</nav>
	<div class="card text-center" id="liberacao"> <!--Liberação de Alunos-->
	  	<div class="card-header btn" onclick="alterna('#tblLib');">
	    	Liberação de Alunos
	  	</div>
	  	<div class="card-body">
	    	<div id="tblLib">
	  			<?php
	  				include('../../back/conexao.php');
	  				$sql="select id,nome from alunos where liberacao='0';";
	  				$resLib = $conn->query($sql);
	  				$sql="select id,nome from alunos where liberacao='1';";
	  				$resAtivo = $conn->query($sql);
	  				$conn->close();
	  			?>
	  			<table class="table" id="lib">
			  		<thead>
				    	<tr>
					      	<th scope="col" colspan="2">Esperando Liberação</th>
				    	</tr>
				  	</thead>
				  	<tbody>
				  		<?php
				  		while($linhaLib = $resLib->fetch_array()){
				  		?>
				    	<tr>
				      		<td><?php echo $linhaLib['nome'];?></td>
				      		<td><a class="hoverWhite" href="../../back/backCadDocument.php?lib=<?php echo $linhaLib['id'];?>"><i class="material-icons float-right lib" title="Conceder Permissão">check</i></a></td>
				    	</tr>
				    	<?php
			  			}
				  		?>
				    	<tr><td colspan="2"> - </td></tr>
				  	</tbody>
				  	<thead>
				    	<tr>
					      	<th scope="col" colspan="2">Alunos Ativos</th>
				    	</tr>
				  	</thead>
				  	<tbody>
				  		<?php
				  		while($linhaAtivo = $resAtivo->fetch_array()){
				  		?>
				    	<tr>
				      		<td><?php echo $linhaAtivo['nome'];?></td>
				      		<td width="60"><a class="hoverWhite" href="../../back/backCadDocument.php?remLib=<?php echo $linhaAtivo['id'];?>"><i class="material-icons float-right cancel-lib" title="Remover Permissão">cancel</i></a></td>
				    	</tr>
				    	<?php
				    	}
				  		?>
				    	<tr><td colspan="2"> - </td></tr>
				  	</tbody>
				</table>
			</div>
	  	</div>
	  	<div class="card-header btn" onclick="alterna('#tblLibObj');">
	    	Liberação de Objetivos
	  	</div>
        <div class="card-body">
            <div id="tblLibObj">
	  			<?php
	  				include('../../back/conexao.php');
	  				$sql="select a.nome,oa.id,oa.alunoId,oa.objId,o.tituloObj,o.nivelId nivel  from objaluno oa inner join alunos a on oa.alunoId=a.id inner join objetivo o on oa.objId =o.id inner join nivel n on a.nivelId=n.id where oa.concluido=0 order by a.nome";
	  				$resLibO = $conn->query($sql);
	  				$conn->close();
	  			?>
	  			<table class="table" id="lib">
			  		<thead>
				    	<tr>
					      	<th scope="col" colspan="4">Não Concluidos</th>
				    	</tr>
				  	</thead>
				  	<tbody>
                        <tr>
                            <th>
                                <select id="tblSelLO" class="table-select" onchange="filtro();">
                                    <option>Alunos</option>
                                    <?php
                                    include('../../back/conexao.php');
                                    $sql = "select nome from alunos order by nome;";
                                    $dataNome = $conn->query($sql);
                                    $conn->close();
                                    $entrou = 0;
                                    while($preLinhaNome = $dataNome->fetch_array()){ $linhaNome[$entrou] = $preLinhaNome['nome']; $entrou++; }
                                    for($cont=0;$cont<$entrou;$cont++){
                                    ?>
                                        <option><?php echo str_replace(' ','-',$linhaNome[$cont]); ?></option>
                                    <?php } ?>
                                </select>
                            </th>
                            <th>Objetivo</th>
                            <th>Nível</th>
                            <th class="text-right pr-3">Realizar</th>
                        </tr>
				  		<?php
				  		while($linhaLibO = $resLibO->fetch_array()){
				  		?>
				    	<tr class="filtro-<?php echo str_replace(' ','-',$linhaLibO['nome']);?>">
				      		<td><?php echo $linhaLibO['nome'];?></td>
				      		<td><?php echo $linhaLibO['tituloObj'];?></td>
				      		<td><span class="colNivel"><?php echo $nivelReal[$linhaLibO['nivel']];?></span></td>
                            
				      		<td><a class="hoverWhite" href="../../back/backCadDocument.php?libObj=<?php echo $linhaLibO['id'];?>"><i class="material-icons float-right lib" title="Conceder Permissão">check</i></a></td>
				    	</tr>
				    	<?php
			  			}
				  		?>
				    	<tr><td colspan="4"> - </td></tr>
				  	</tbody>
				</table>
			</div>
        </div>
        <div id="btnGroupProg" class="mt-0 mb-3 px-4">
            <a class="btn btn-danger btn-block" href="rootLiberacao.php?program">Programar { }</a>
            <button id="btnProgramar" type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalProgram" style="display: none;"></button>
        </div>
        <div class="card-footer">
	    	Prof. Mateus Brandão
	  	</div>
	</div>
	<?php include('../../modais/modalResultado.php');include('../../modais/modalSobNivel.php');include('../../modais/modalProgram.php');?>
</body>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.bundle.js"></script>
</html>
<!--
	Adicionar campo alunos{pagamento|liberação}|
-->