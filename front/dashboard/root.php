<?php
	session_start();
	if(!((isset($_SESSION['root']))&&($_SESSION['root']=="Ativo"))){
		header('Location: ../index.php?erro=4');
	}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATMD - G. de Documentos</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../../css/scroll.css">
	<style>
		body{ background: url("../../img/fundo/foneGrande.jpg"); }
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
		a{ color: rgba(250,250,250,.8); }
		div#addDoc,div#primeiro,div#pagamento,div#liberacao,div#status,div#notificacao{
			background: rgba(250,250,250,.1);
			color: white;
		}
		div#addDoc{ display: block; }
		.deitar{ font-style: italic; }
		form#formAula,form#formExerc,form#formAudio,form#formObjetivo,form#formMusica,form#formApp{
			margin-left: 200px;
			margin-right: 200px;
			display: block;
		}
		form#formAula{ display: block; }
		label{ text-align: left; }
		.box-transparent-radius{
			background: rgba(0,0,0,.4);
			padding: 5px;
			color: rgb(230,230,230);
			font-size: 11pt;
			border-radius: 7px;
		}
		.btnTamanho{ width: 170px; }
		div#tblPg,div#tblLib,div#tblStatus{
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
		table#pg i.pg:hover,table#lib i.lib:hover{ background: rgba(80,250,180,.6); }
		table#pg i.cancel:hover,table#lib i.cancel-lib:hover{ background: rgba(250,80,100,.7); }
		a.hoverWhite:hover{ color:white; }
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
		.txtarea { margin-top: 15px; }
        select.table-select{
            border: none;
            background: transparent;
            color: inherit;
            font-weight: inherit;
        }
        select.table-select option{ background: #333; }
	</style>
	<!-- Estilo Level -->
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
		.progress .progress-left{ left: 0; }
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
		.progress .progress-right{ right: 0; }
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
		.progress.blue .progress-bar{ border-color: rgba(204, 0, 0,.9); }
		.progress.blue .progress-left .progress-bar{ animation: loading-100 1.5s linear forwards 1.8s; }
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
		@media only screen and (max-width: 990px){ .progress{ margin-bottom: 20px; } }
	</style>
	<script src="../../js/jquery/jquery-3.4.1.min.js"></script>
    <script>
        var audio1 = new Audio();
        var varTocando = false;
        function btnActive(v){
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
		function selButton(v){ window.location.href = "root.php?sess=" + v; }
		/*Wora*/
		function displayNone(v){ document.getElementById(v).style="display:none;"; }
		function displayBlock(v){ document.getElementById(v).style="display:block;"; }
		function styleButtonSelected(v){ document.getElementById(v).style="background: white;color: rgba(0,0,0,.9);border-color: white;"; }
		function styleButtonNonSelected(v){ document.getElementById(v).style="background: #707580;color: white;border-color: gray;"; }
        function clickFile(v){ $(v).click(); }
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
                case 18: //Upload de Arquivo                    
                    tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="O Upload do Arquivo foi completo!";
                    break;
                case 19: //Erro de Upload de Arquivo                    
                    tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Houve um erro ao fazer o Upload do Arquivo. Verifique se o nome já está sendo utilizado.";
                    break;
                default:
                    v=100;
                    tituloModalResultado.innerHTML="<i class='material-icons'>warning</i>";
					subTituloModalResultado.innerHTML="<b>Procedimento não autorizado </b><br/>Não altere os dados da URL.";
                    break;
			}
			if((v<12 && v>-1) || v>13 && v<17 || v>17 && v<20 || v==100 ){
				document.getElementById('btnChamaModalResult').click();
			}else if(v==12 || v==13){
				document.getElementById('btnSobNivel').click();
			}else if(v==17){
                document.getElementById('btnProgramar').click();
            }
		}
        function startAudio(v,v2){
            audio1.src = "../../audio/"+v;
            if(varTocando){
                audio1.pause();
                varTocando = false;
                v3 = 'audPlay' + v2;
                displayBlock(v3);
                v3 = 'audPause' + v2;
                displayNone(v3);
            }
            else{
                audio1.play();
                varTocando = true;
                v3 = 'audPause' + v2;
                displayBlock(v3);
                v3 = 'audPlay' + v2;
                displayNone(v3);
            }
        }
        /*Filtro*/
        function filtro(f){
            if(f=='aula'){                
                switch(document.getElementById('tblSelA').value){
                    case 'Aula':
                        $('.filtro-Teclado').show("slow");  
                        $('.filtro-Violão').show("slow");  
                        $('.filtro-Guitarra').show("slow"); 
                        break;
                    case 'Teclado':
                        $('.filtro-Teclado').show("slow");  
                        $('.filtro-Violão').hide("slow");  
                        $('.filtro-Guitarra').hide("slow");
                        break;
                    case 'Violão':
                        $('.filtro-Violão').show("slow");  
                        $('.filtro-Teclado').hide("slow");  
                        $('.filtro-Guitarra').hide("slow");
                        break;
                    case 'Guitarra':
                        $('.filtro-Guitarra').show("slow");
                        $('.filtro-Teclado').hide("slow");  
                        $('.filtro-Violão').hide("slow");  
                        break;
                }
                document.getElementById('tblSelN').value = "Nível";
                document.getElementById('tblSelD').value = "Dificuldade";
            }else
            if(f=='nivel'){
                if(document.getElementById('tblSelN').value=='Nível'){
                    showNivel();
                }else{
                    for(c=1;c<($('#tblSelN option').length);c++){
                        if(document.getElementById('tblSelN').value=='N. '+c){
                           hideNivel(c);
                        }
                    }
                }
                document.getElementById('tblSelA').value = "Aula";
                document.getElementById('tblSelD').value = "Dificuldade";
            }else
            if(f=="dificuldade"){
                switch(document.getElementById('tblSelD').value){
                    case 'Dificuldade':
                        $('.filtro-Padrão').show("slow");
                        $('.filtro-Pró').show("slow");
                        break;
                    case 'Padrão':
                        $('.filtro-Padrão').show("slow");
                        $('.filtro-Pró').hide("slow");
                        break;
                    case 'Pró':
                        $('.filtro-Pró').show("slow");
                        $('.filtro-Padrão').hide("slow");
                        break;
                }
            }
        }
        function showNivel(){
            for(c=1;c<($('#tblSelN option').length);c++){ $('.filtro-'+c).show("slow"); }
        }
        function hideNivel(p){
            for(c=1;c<($('#tblSelN option').length);c++){
                if(c==p){
                    $('.filtro-'+c).show("slow");  
                }else{
                    $('.filtro-'+c).hide("slow");
                }
            }
        }
        function uploadExerc(){ $('#btnUploadExerc').click(); }
        /*Inicialização*/
        window.onload = function(){
            $('.files').addClass('d-none').on('change',function(e){
               if(this.id=="btnUploadExerc"){
                   $('#btnUploadClick').val(this.files[0].name);
                   $('#cadTituloExerc').val(' ');
                   $('#btnCadExerc').click();
               }else{
                   console.log(this.files[0]);
                   $("#"+this.id+"Click").val((this.files[0].type=="application/pdf"?"../doc/":"")+this.files[0].name);
               }
            });
            <?php if(isset($_GET['erro'])){ ?>
                click2(<?php echo $_GET['erro'];?>); 
            <?php }elseif (isset($_GET['sobN'])){ ?>
                click2(13);
            <?php } echo isset($_GET['sess'])?"btnActive(".$_GET['sess'].");":" ";
                    echo isset($_GET['program'])?"click2(17)":"";
            ?>
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
		$conn->close();
	?>
    <!-- Barra de Navegação -->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background: rgba(0,0,0,.8);">
		<a href="rootSobre.php"><img src="../../img/icones/blur_two.png" title="Sobre o Site"/></a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
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
	<!-- Conteúdo -->
    <div class="card text-center" id="addDoc">
	  	<div class="card-header">
	    	Gerênciamento de Documentos
	  	</div>
	  	<div class="card-body">
            <!-- Selecionar Tipo de Arquivo -->
	  		<div class="btn-group" role="group" aria-label="Selecionar Tipo de Arquivo" style="margin-bottom:30px;">
	  			<button type="button" class="btn btn-light btnTamanho" onclick="selButton(1)" id="cadastrarAula">Adicionar Aulas</button>
    			<button type="button" class="btn btn-secondary btnTamanho" onclick="selButton(0)" id="cadastrarExerc">Adicionar Exercícios</button>
    			<button type="button" class="btn btn-secondary btnTamanho" onclick="selButton(2)" id="cadastrarAudio">Adicionar Audio</button>
    			<button type="button" class="btn btn-secondary btnTamanho" onclick="selButton(3)" id="cadastrarObj">Adicionar Objetivo</button>
    			<div class="dropdown">
    				<button type="button" class="btn btn-secondary btnTamanho dropdown-toggle" id="dropdownIndica" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    					Adic. Indicações
    				</button>
				  	<div class="dropdown-menu" aria-labelledby="dropdownIndica">
				    	<a class="dropdown-item" href="#" onclick="selButton(4)" id="cadastrarMusica">Adicionar Músicas</a>
				    	<a class="dropdown-item" href="#" onclick="selButton(5)" id="cadastrarApp">Adicionar Aplicativos</a>
				  	</div>
				</div>
				<button type="button" class="btn btn-dark" onclick="click2(12)" title="Nível Máximo" id="subirNivel"><span id="spanNivelMax"><?php echo $nivelMax['max'];?></span></button>
	  		</div>
            <?php
		      if(!isset($_GET['sess'])||($_GET['sess']==1)){
	        ?>
            <!-- Formulário de Aula -->
  			<form method="POST" action="../../back/backCadDocument.php" id="formAula" enctype="multipart/form-data">
                <a href="#tabAula"><i class="material-icons" style="margin-left: -25px;float: right; color: white" title="Tabela">table_chart</i></a>
  				<h5 class="h5Form">- Cadastrar Aulas Teóricas -</h5>
                <!-- Instrumento -->
  				<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadAula" class="col-sm-3 col-form-label">Instrumento:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadAula" name="cadAula" autofocus required>
					    	<option>Selecione...</option>
					    	<option>Teclado</option>
					    	<option>Guitarra</option>
					    	<option>Violão</option>
					  	</select>
				  	</div>
				</div>
                <!-- Nível -->
				<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadNivel" class="col-sm-3 col-form-label">Nível:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadNivel" name="cadNivel" required>
					    	<option>Selecione...</option>
					    	<?php for($cont=1;$cont<=$nivelMax['max'];$cont++){
					    		echo "<option value='$cont'>Nível $cont</option>";
					    	}?>
					  	</select>
				  	</div>
				</div>
                <!-- Nome da Imagem -->
			  	<div class="form-group row">
			    	<label for="cadNomeArq" class="col-sm-3 col-form-label">Imagem:</label>
			    	<div class="col-sm-9 input-group mb-3">
                        <input type="text" class="form-control" placeholder="Clique para selecionar a imagem..." maxlength="30" onclick="clickFile('#cadNomeArq');" id="cadNomeArqClick" readonly>
                        <input type="file" accept="image/x-png" class="files" id="cadNomeArq" name="cadNomeArq" required>
                        <div class="input-group-append">
                            <span class="input-group-text">.png</span>
                        </div>
					</div>
			  	</div>
                <!-- Nome do Arquivo em pdf -->
			  	<div class="form-group row">
			    	<label for="cadPdfArq" class="col-sm-3 col-form-label">Arquivo PDF:</label>
			    	<div class="col-sm-9 input-group mb-3">
				    		<input type="text" class="form-control" placeholder="Clique para selecionar o arquivo..." maxlength="30" onclick="clickFile('#cadPdfArq');" id="cadPdfArqClick" readonly>
                            <input type="file" accept="application/pdf" class="files" id="cadPdfArq" name="cadPdfArq" required>
				    		<div class="input-group-append">
    							<span class="input-group-text">.pdf</span>
  							</div>
					</div>
			  	</div>
                <!-- Titulo do Arquivo -->
			  	<div class="form-group row">
			    	<label for="cadTituloArq" class="col-sm-3 col-form-label">Titulo do Arquivo:</label>
			    	<div class="col-sm-9">
			    		<input type="text" class="form-control" id="cadTituloArq" name="cadTituloArq" placeholder="Exemplo: 'Cronograma de Aulas'" maxlength="50" required>
					</div>
			  	</div>
			  	<p class="card-text box-transparent-radius" style="">Para evitar erros, utilize apenas a extensão .png, e o arquivo png medindo 200x112 em pixels </p>
	    		<button class="btn btn-primary btnTamanho" type="submit" id="btnCadAula" name="btnCadAula">Adicionar</button>
                <br/><br/>
                <!-- Aulas Cadastradas -->
                <table class="table" id="tabAula">
	  				<thead class="thead-dark">
	    				<tr>
	    					<th scope="col" colspan="5">Aulas Cadastradas
                            <a href="#addDoc"><i class="material-icons" style="margin-left: -25px;float: right; color: white"title="Cadastrar Novo Documento">create_new_folder</i></a>
                            </th>
	    				</tr>
					</thead>
		  			<tbody>
                        <tr class="table-active">
                            <th scope="col">Imagem</th>
                            <th scope="col">Título da Aula</th>
                            <th scope="col">Nome do Arquivo</th>
                            <th scope="col">
                                <select id="tblSelA" class="table-select" onchange="filtro('aula');">
                                    <option>Aula</option>
                                    <option>Teclado</option>
                                    <option>Violão</option>
                                    <option>Guitarra</option>
                                </select>
                            </th>
                            <th scope="col">
                                <select id="tblSelN" class="table-select" onchange="filtro('nivel');">
                                    <option>Nível</option>
                                    <?php for($contN=1;$contN<=$nivelMax['max'];$contN++){ ?> 
                                    <option><?php echo 'N. '.$contN; ?></option>
                                    <?php } ?>
                                </select>
                            </th>
                        </tr>
		  				<?php
                        include('../../back/conexao.php');
                        $sql = "select p.nomeImg,p.nomePdf,p.tituloArq,p.aula,n.nivel from ppt p inner join nivel n on p.nivelId=n.id;";
                        $resAula=$conn->query($sql);
                        $conn->close();
                        $entrou=0;
		  				while($preLinha=$resAula->fetch_array()){
                            $linhaAula[$entrou]['nomeImg'] = $preLinha['nomeImg'];
                            $linhaAula[$entrou]['tituloArq'] = $preLinha['tituloArq'];
                            $linhaAula[$entrou]['nomePdf'] = $preLinha['nomePdf'];
                            $linhaAula[$entrou]['aula'] = $preLinha['aula'];
                            $linhaAula[$entrou]['nivel'] = $preLinha['nivel'];
                            $entrou++;                       
                        } if($entrou==0){ ?>
                        <tr class="table-active">				
					      	<td colspan="5"><i>Sem Aulas Cadastradas</i></td>
	    				</tr>
                        <?php }else{ for($cA=0;$cA<$entrou;$cA++){ ?>
						<tr class="table-active <?php echo 'filtro-'.$linhaAula[$cA]['nivel'].' filtro-'.$linhaAula[$cA]['aula']; ?>">				
					      	<td><img src="../../img/ppt/<?php echo $linhaAula[$cA]['nomeImg'];?>" width="50"/></td>
					      	<td><?php echo $linhaAula[$cA]['tituloArq'];?></td>
                            <td><a href="../../doc/<?php echo $linhaAula[$cA]['nomePdf'];?>" target="_blank"><?php echo $linhaAula[$cA]['nomePdf'];?></a></td>
                            <td><?php echo $linhaAula[$cA]['aula'];?></td>
                            <td><span class="colNivel"><?php echo $linhaAula[$cA]['nivel'];?></span></td>
	    				</tr>
                        <?php }} ?>
	  				</tbody>
				</table>
			</form>
            <?php
		      }elseif(isset($_GET['sess'])&&($_GET['sess']==0)){
	        ?>
            <!-- Formulário de Exercicio-->
			<form method="POST" action="../../back/backCadDocument.php" id="formExerc" enctype="multipart/form-data">
                <a href="#tabExerc"><i class="material-icons" style="margin-left: -25px;float: right; color: white" title="Tabela">table_chart</i></a>
				<h5 class="h5Form">- Cadastrar Exercícios e Avaliação -</h5>
                <!-- Instrumento-->
  				<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadAulaExerc" class="col-sm-3 col-form-label">Instrumento:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadAulaExerc" name="cadAulaExerc" required>
					    	<option>Selecione...</option>
					    	<option>Teclado</option>
					    	<option>Guitarra</option>
					    	<option>Violão</option>
					  	</select>
				  	</div>
				</div>
                <!-- Nível-->
				<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadNivelExerc" class="col-sm-3 col-form-label">Nível:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadNivelExerc" name="cadNivelExerc" required>
					    	<option>Selecione...</option>
					    	<?php for($cont=1;$cont<=$nivelMax['max'];$cont++){
					    		echo "<option value='$cont'>Nível $cont</option>";
					    	}?>
					  	</select>
				  	</div>
				</div>
                <!-- Url do Arquivo-->
				<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadUrlExerc" class="col-sm-3 col-form-label">URL do Exercício:</label>
                    <div class="col-sm-9">
				    	<select class="custom-select" id="cadUrlExerc" name="cadUrlExerc" required>
					    	<option>Selecione...</option>
                        <?php
                            $diretorio = dir("../../quizz/");
                            while($arquivo = $diretorio -> read()){
                                if($arquivo!="." && $arquivo!="..") echo "<option>".$arquivo."</option>";
                            }
                            $diretorio -> close();
                        ?>
					  	</select>
				  	</div>
			  	</div>
                <!-- Nome da Imagem em png-->
			  	<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadImgExerc" class="col-sm-3 col-form-label">Nome do Imagem:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadImgExerc" name="cadImgExerc" required>
					    	<option>Selecione...</option>
                        <?php
                            $diretorio = dir("../../img/exerc/");
                            while($arquivo = $diretorio -> read()){
                                if($arquivo!="." && $arquivo!=".." && $arquivo!="index.php") echo "<option>".$arquivo."</option>";
                            }
                            $diretorio -> close();
                        ?>
					  	</select>
				  	</div>
			  	</div>
                <!-- Titulo do Arquivo-->
			  	<div class="form-group row">
			    	<label for="cadTituloExerc" class="col-sm-3 col-form-label">Titulo do Arquivo:</label>
			    	<div class="col-sm-9">
			    		<input type="text" class="form-control" id="cadTituloExerc" name="cadTituloExerc" maxlength="50" placeholder="Exemplo: 'Atividade 01 - Nomenclatura'" required>
					</div>
			  	</div>
			  	<p class="card-text box-transparent-radius" style="">Para evitar erros, utilize apenas as extensões informadas na tela, arquivo pdf, imagem png e no tamanho 210x300 pixels</p>
                <button class="btn btn-dark btnTamanho" type="button" id="btnUploadClick" name="btnUploadClick" onclick="uploadExerc()">Upload</button>
                <!--accept="image/x-png"--> 
                <input class="files" type="file" id="btnUploadExerc" name="btnUploadExerc">
	    		<button class="btn btn-primary btnTamanho" type="submit" id="btnCadExerc" name="btnCadExerc">Adicionar</button>
                <br/><br/>
                <!-- Exercícios Cadastrados-->
                <table class="table" id="tabExerc">
	  				<thead class="thead-dark">
	    				<tr>
	    					<th scope="col" colspan="5">Exercícios Cadastrados
                            <a href="#addDoc"><i class="material-icons" style="margin-left: -25px;float: right; color: white"title="Cadastrar Novo Documento">create_new_folder</i></a>
                            </th>
	    				</tr>
					</thead>
		  			<tbody>
                        <tr class="table-active">
                            <th scope="col">Imagem</th>
                            <th scope="col">Título do Exercício</th>
                            <th scope="col">Url do Exercício</th>
                            <th scope="col">
                                <select id="tblSelA" class="table-select" onchange="filtro('aula');">
                                    <option>Aula</option>
                                    <option>Teclado</option>
                                    <option>Violão</option>
                                    <option>Guitarra</option>
                                </select>
                            </th>
                            <th scope="col">
                                <select id="tblSelN" class="table-select" onchange="filtro('nivel');">
                                    <option>Nível</option>
                                    <?php for($contN=1;$contN<=$nivelMax['max'];$contN++){ ?> 
                                    <option><?php echo 'N. '.$contN; ?></option>
                                    <?php } ?>
                                </select>
                            </th>
                        </tr>
                    <?php
                        include('../../back/conexao.php');
                        $sql = "select e.imgExerc,e.tituloExerc,e.urlExerc,e.aula,n.nivel from exerc e inner join nivel n on e.nivelId=n.Id;";
                        $resExer=$conn->query($sql);
                        $conn->close();
                        $entrou=0;
		  				while($preLinhaE=$resExer->fetch_array()){
                            $linhaExer[$entrou]['imgExerc'] = $preLinhaE['imgExerc'];
                            $linhaExer[$entrou]['tituloExerc'] = $preLinhaE['tituloExerc'];
                            $linhaExer[$entrou]['urlExerc'] = $preLinhaE['urlExerc'];
                            $linhaExer[$entrou]['aula'] = $preLinhaE['aula'];
                            $linhaExer[$entrou]['nivel'] = $preLinhaE['nivel'];
                            $entrou++;
                        }if($entrou==0){
                    ?>
                        <tr class="table-active">				
					      	<td colspan="5"><i>Sem Exercícios Cadastrados</i></td>
	    				</tr>
                    <?php }else for($cE=0;$cE<$entrou;$cE++){ ?>
						<tr class="table-active <?php echo 'filtro-'.$linhaExer[$cE]['nivel'].' filtro-'.$linhaExer[$cE]['aula']; ?>">				
					      	<td><img src="../<?php echo $linhaExer[$cE]['imgExerc'];?>" width="50" height="32"/></td>
					      	<td><?php echo $linhaExer[$cE]['tituloExerc'];?></td>
                            <td><a href="../<?php echo $linhaExer[$cE]['urlExerc'];?>" target="_blank"><?php echo $linhaExer[$cE]['urlExerc'];?></a></td>
                            <td><?php echo $linhaExer[$cE]['aula'];?></td>
                            <td><span class="colNivel"><?php echo $linhaExer[$cE]['nivel'];?></span></td>
	    				</tr>
                        <?php } ?>
	  				</tbody>
				</table>
			</form>
            <?php
		      }elseif(isset($_GET['sess'])&&($_GET['sess']==2)){
	        ?>
            <!-- Formulário de Audio-->
			<form method="POST" action="../../back/backCadDocument.php" id="formAudio" enctype="multipart/form-data">
				<a href="#tabAudio"><i class="material-icons" style="margin-left: -25px;float: right; color: white" title="Tabela">table_chart</i></a>
                <h5 class="h5Form">- Cadastrar Audios -</h5>
                <!-- Instrumento-->
  				<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadAulaAudio" class="col-sm-3 col-form-label">Instrumento:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadAulaAudio" name="cadAulaAudio" required>
					    	<option>Selecione...</option>
					    	<option>Teclado</option>
					    	<option>Guitarra</option>
					    	<option>Violão</option>
					  	</select>
				  	</div>
			  	</div>
                <!-- Nível-->
			  	<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadNivelAudio" class="col-sm-3 col-form-label">Nível:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadNivelAudio" name="cadNivelAudio" required>
					    	<option>Selecione...</option>
					    	<?php for($cont=1;$cont<=$nivelMax['max'];$cont++){
					    		echo "<option value='$cont'>Nível $cont</option>";
					    	}?>
					  	</select>
				  	</div>
				</div>
                <!-- Pixels-->
			  	<div class="form-group row" style="margin-bottom: 31px;">
				  	<label for="cadTamanho" class="col-sm-3 col-form-label">Pixels:</label> 
			    	<div class="col-sm-9">
			    		<input type="number" class="form-control" id="cadTamanho" name="cadTamanho" value="300" min="80" max="600" step="5" required>
				  	</div>
				</div>
				<!-- Tipo-->
                <div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadTipoAudio" class="col-sm-3 col-form-label">Classificação do Aúdio:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadTipoAudio" name="cadTipoAudio" required>
					    	<option>Selecione...</option>
					    	<option>Sequência de Acordes</option>
					    	<option>Exercício de Mobilidade</option>
					    	<option>Escalas</option>
					  	</select>
				  	</div>
			  	</div>
			  	<!-- Dificuldade-->
                <div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadDifAudio" class="col-sm-3 col-form-label">Dificuldade:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadDifAudio" name="cadDifAudio" required>
					    	<option>Selecione...</option>
					    	<option>Padrão</option>
					    	<option>Pró</option>
					  	</select>
				  	</div>
				</div>
			  	<!-- Nome do Audio -->
                <div class="form-group row">
			    	<label for="cadNomeAudio" class="col-sm-3 col-form-label">Nome do Audio:</label>
			    	<div class="col-sm-9 input-group mb-3">
			    		<input type="text" class="form-control" id="cadNomeAudioClick" name="cadNomeAudioClick" placeholder="Clique para selecionar o audio..." onclick="clickFile('#cadNomeAudio');" maxlength="30"  readonly>
                        <input type="file" accept="audio/*" class="files" id="cadNomeAudio" name="cadNomeAudio" required>
			    		<div class="input-group-append">
							<span class="input-group-text">.mp3</span>
						</div>
					</div>
			  	</div>
                <!-- Titulo do Audio -->
			  	<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadTituloAudio" class="col-sm-3 col-form-label">Titulo do Audio:</label>
			    	<div class="col-sm-9">
			    		<input type="text" class="form-control" id="cadTituloAudio" name="cadTituloAudio" placeholder="Exemplo: '1º Sequência de Acordes'" maxlength="50" required>
					</div>
			  	</div>
			  	<!-- Complemento -->
                <div class="form-group row">
			    	<label for="cadComplemento" class="col-sm-3 col-form-label">Arquivo de Complemento:</label>
			    	<div class="col-sm-9 input-group mb-3">
			    		<input type="text" class="form-control" id="cadComplementoClick" name="cadComplementoClick" placeholder="Clique para selecionar o arquivo de complemento..."  onclick="clickFile('#cadComplemento');" maxlength="50" readonly>
                        <input type="file" class="files" id="cadComplemento" name="cadComplemento" required>
			    		<div class="input-group-append">
							<span class="input-group-text">.php</span>
						</div>
					</div>
			  	</div>
			  	<p class="card-text box-transparent-radius">Preencha todos os campos, e atente-se ao formato do audio para que seja MP3 e do arquivo de Complemento em PHP</p>
	    		<button class="btn btn-primary btnTamanho" type="submit" id="btnCadAudio" name="btnCadAudio">Adicionar</button>
	    		<button class="btn btn-primary btnTamanho" type="submit" id="btnTestAudio" name="btnTestAudio">Testar</button>
                <br/><br/>
                <!-- Audios Cadastrados -->
                <table class="table" id="tabAudio">
	  				<thead class="thead-dark">
	    				<tr>
	    					<th scope="col" colspan="5">Audios Cadastrados
                            <a href="#addDoc"><i class="material-icons" style="margin-left: -25px;float: right; color: white"title="Cadastrar Novo Documento">create_new_folder</i></a>
                            </th>
	    				</tr>
					</thead>
		  			<tbody>
                        <tr class="table-active">
                            <th scope="col">MP3</th>
                            <th scope="col">Título do Audio</th>
                            <th scope="col">
                                <select id="tblSelD" class="table-select" onchange="filtro('dificuldade');">
                                    <option>Dificuldade</option>
                                    <option>Padrão</option>
                                    <option>Pró</option>                                    
                                </select>
                            </th>
                            <th scope="col">
                                <select id="tblSelA" class="table-select" onchange="filtro('aula');">
                                    <option>Aula</option>
                                    <option>Teclado</option>
                                    <option>Violão</option>
                                    <option>Guitarra</option>
                                </select>
                            </th>
                            <th scope="col">
                                <select id="tblSelN" class="table-select" onchange="filtro('nivel');">
                                    <option>Nível</option>
                                    <?php for($contN=1;$contN<=$nivelMax['max'];$contN++){ ?> 
                                    <option><?php echo 'N. '.$contN; ?></option>
                                    <?php } ?>
                                </select>
                            </th>
                        </tr>
		  				<?php
                        include('../../back/conexao.php');
                        $sql = "select a.tituloAud,a.nomeAud,a.dificuldade,a.aula,n.nivel from audio a inner join nivel n on a.nivelId=n.id;";
                        $resAud=$conn->query($sql);
                        $conn->close();
                        $entrou=0;
		  				while($linhaAud=$resAud->fetch_array()){
                            $entrou++;
		  				?>
						<tr class="table-active <?php echo 'filtro-'.$linhaAud['nivel'].' filtro-'.$linhaAud['aula'].' filtro-'.$linhaAud['dificuldade']; ?>">				
					      	<td>
                                <i onclick="startAudio('<?php echo $linhaAud['nomeAud'];?>','<?php echo $entrou;?>')" title="<?php echo $linhaAud['nomeAud'];?>" class="material-icons" style="display:block;" id="audPlay<?php echo $entrou;?>">play_circle_filled</i>
                                <i onclick="startAudio('<?php echo $linhaAud['nomeAud'];?>','<?php echo $entrou;?>')" class="material-icons" style="display:none;" id="audPause<?php echo $entrou;?>">pause_circle_filled</i>
                            </td>
                            <td><?php echo $linhaAud['tituloAud'];?></td>
                            <td><?php echo $linhaAud['dificuldade'];?></td>
                            <td><?php echo $linhaAud['aula'];?></td>
                            <td><span class="colNivel"><?php echo $linhaAud['nivel'];?></span></td>
	    				</tr>
                        <?php } if($entrou==0){ ?>
                        <tr class="table-active">
					      	<td colspan="5"><i>Sem Audios Cadastrados</i></td>
	    				</tr>
                        <?php } ?>
	  				</tbody>
				</table>
			</form>
            <?php
		      }elseif(isset($_GET['sess'])&&($_GET['sess']==3)){
	        ?>
            <!-- Formulário de Objetivos -->
			<form method="POST" action="../../back/backCadDocument.php" id="formObjetivo"> 
                <a href="#tabObj"><i class="material-icons" style="margin-left: -25px;float: right; color: white" title="Tabela">table_chart</i></a>
				<h5 class="h5Form">- Cadastrar Objetivos -</h5>
                <!-- Instrumento -->
  				<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadAulaObj" class="col-sm-3 col-form-label">Instrumento:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadAulaObj" name="cadAulaObj" required>
					    	<option>Selecione...</option>
					    	<option>Teclado</option>
					    	<option>Guitarra</option>
					    	<option>Violão</option>
					  	</select>
				  	</div>
				</div>
				<!-- Nível -->
                <div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadNivelObj" class="col-sm-3 col-form-label">Nível:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadNivelObj" name="cadNivelObj" required>
					    	<option>Selecione...</option>
					    	<?php for($cont=1;$cont<=$nivelMax['max'];$cont++){
					    		echo "<option value='$cont'>Nível $cont</option>";
					    	}?>
					  	</select>
				  	</div>
				</div>
				<!-- Url do Objetivo -->
                <div class="form-group row">
			    	<label for="cadUrlObj" class="col-sm-3 col-form-label">URL do Objetivo:</label>
			    	<div class="col-sm-9 input-group mb-3">
			    		<input type="text" class="form-control" id="cadUrlObj" name="cadUrlObj" maxlength="50" placeholder="Exemplo: 'pagPpt'" list="breadcrumbsObj" required>
			    		<div class="input-group-append">
							<span class="input-group-text">.php</span>
						</div>
					</div>
			  	</div>
                <datalist id="breadcrumbsObj">
                    <option value="pagAudio.php">
                    <option value="pagCordas.php">
                    <option value="pagExerc.php">
                    <option value="pagIndica.php">
                    <option value="pagNotas.php">
                    <option value="pagPerfil.php">
                    <option value="pagPpt.php">
                    <option value="../doc/">
                    <option value="../quizz/">
                    <option value="">
                </datalist>
			  	<!-- Titulo do Objetivo -->
                <div class="form-group row">
			    	<label for="cadTituloObj" class="col-sm-3 col-form-label">Titulo do Objetivo:</label>
			    	<div class="col-sm-9">
			    		<input type="text" class="form-control" id="cadTituloObj" name="cadTituloObj" maxlength="100" placeholder="Exemplo: 'Ver aula de Introdução a Música'" required>
					</div>
			  	</div>
			  	<!-- Descrição do Objetivo -->
                <div class="form-group row">
			    	<label for="cadDescricaoObj" class="col-sm-3 col-form-label txtarea">Descrição do Objetivo:</label>
			    	<div class="col-sm-9">
			    		<textarea type="text" class="form-control txtarea" id="cadDescricaoObj" name="cadDescricaoObj" maxlength="150" placeholder="Exemplo: 'Acessar página de Aulas e fazer o Download da Aula 01 - Introdução a Música'" required></textarea>
					</div>
			  	</div>
                <!-- Conclusão Automática do Objetivo -->
                <div class="form-group row">
			    	<label for="cadOnclickObj" class="col-sm-3 col-form-label">Conclusão Automática:</label>
			    	<div class="col-sm-9">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <input type="checkbox" id="cadOnclickObj" name="cadOnclickObj">
                            </div>
                          </div>
                          <input type="text" class="form-control" placeholder="Funcionalidade: 'Ao clicar no objetivo, ele é automáticamente concluído.'" readonly>
                        </div>
					</div>
			  	</div>                
			  	<p class="card-text box-transparent-radius" style="">Para evitar erros, se atente ao URL do Objetivo, para que não haja divergencias na hora de ser utilizado para redirecionamento. Não utilize aspa simples.</p>
	    		<button class="btn btn-primary btnTamanho" type="submit" id="btnCadObj" name="btnCadObj">Adicionar</button>
	    		<br/><br/>
                <!-- Objetivos Cadastrados -->
                <table class="table" id="tabObj">
	  				<thead class="thead-dark">
	    				<tr>
	    					<th scope="col" colspan="5">Objetivos Cadastrados
                            <a href="#addDoc"><i class="material-icons" style="margin-left: -25px;float: right; color: white"title="Cadastrar Novo Documento">create_new_folder</i></a>
                            </th>
	    				</tr>
					</thead>
		  			<tbody>
                        <tr class="table-active">
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">URL</th>
                            <th scope="col">
                                <select id="tblSelA" class="table-select" onchange="filtro('aula');">
                                    <option>Aula</option>
                                    <option>Teclado</option>
                                    <option>Violão</option>
                                    <option>Guitarra</option>
                                </select>
                            </th>
                            <th scope="col">
                                <select id="tblSelN" class="table-select" onchange="filtro('nivel');">
                                    <option>Nível</option>
                                    <?php for($contN=1;$contN<=$nivelMax['max'];$contN++){ ?> 
                                    <option><?php echo 'N. '.$contN; ?></option>
                                    <?php } ?>
                                </select>
                            </th>
                        </tr>
                    <?php
                        include('../../back/conexao.php');
                        $sql = "select o.tituloObj,o.descricao,o.urlObj,o.aula,n.nivel from objetivo o inner join nivel n on o.nivelId=n.id;";
                        $resObj=$conn->query($sql);
                        $conn->close();
                        $entrou=0;
		  				while($preLinhaO=$resObj->fetch_array()){
                            $linhaObj[$entrou]['tituloObj'] = $preLinhaO['tituloObj'];
                            $linhaObj[$entrou]['descricao'] = $preLinhaO['descricao'];
                            $linhaObj[$entrou]['urlObj'] = $preLinhaO['urlObj'];
                            $linhaObj[$entrou]['aula'] = $preLinhaO['aula'];
                            $linhaObj[$entrou]['nivel'] = $preLinhaO['nivel'];
                            $entrou++;
                        } if($entrou==0){
                    ?>
                        <tr class="table-active">
					      	<td colspan="5"><i>Sem Objetivos Cadastrados</i></td>
	    				</tr>
                    <?php }else for($cO=0;$cO<$entrou;$cO++){ ?>
						<tr class="table-active <?php echo 'filtro-'.$linhaObj[$cO]['nivel'].' filtro-'.$linhaObj[$cO]['aula']; ?>">				
					      	<td><?php echo $linhaObj[$cO]['tituloObj'];?></td>
                            <td><?php echo $linhaObj[$cO]['descricao'];?></td>
                            <td><?php echo $linhaObj[$cO]['urlObj'];?></td>
                            <td><?php echo $linhaObj[$cO]['aula'];?></td>
                            <td><span class="colNivel"><?php echo $linhaObj[$cO]['nivel'];?></span></td>
	    				</tr>
                    <?php } ?>
	  				</tbody>
				</table>
			</form>
            <?php
		      }elseif(isset($_GET['sess'])&&($_GET['sess']==4)){
	        ?>
            <!-- Formulário de Indicação de Músicas -->
			<form method="POST" action="../../back/backCadDocument.php" id="formMusica">
                <a href="#tabIndi"><i class="material-icons" style="margin-left: -25px;float: right; color: white" title="Tabela">table_chart</i></a>
				<h5 class="h5Form">- Cadastrar Indicações de Músicas -</h5>
                <!-- Instrumento -->
				<div class="form-group row" style="margin-bottom: 31px;">
			    	<label for="cadAulaMusic" class="col-sm-3 col-form-label">Instrumento:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadAulaMusic" name="cadAulaMusic" required>
					    	<option>Selecione...</option>
					    	<option>Teclado</option>
					    	<option>Guitarra</option>
					    	<option>Violão</option>
					    	<option>Todos</option>
					  	</select>
				  	</div>
				</div>
                <!-- Url do Música -->
				<div class="form-group row"> 
			    	<label for="cadUrlMusic" class="col-sm-3 col-form-label">URL da Música:</label>
			    	<div class="col-sm-9 input-group mb-3">
			    		<input type="text" class="form-control" id="cadUrlMusic" name="cadUrlMusic" maxlength="100" placeholder="Exemplo: 'https://www.cifrasclub.com/nomedamusica'" required>
					</div>
			  	</div>
			  	<!-- Nome da Música -->
                <div class="form-group row">
			    	<label for="cadNomeMusic" class="col-sm-3 col-form-label">Nome da Música:</label>
			    	<div class="col-sm-9">
			    		<input type="text" class="form-control" id="cadNomeMusic" name="cadNomeMusic" maxlength="50" placeholder="Exemplo: 'Santo Espirito - Laura Souguelis'" required>
					</div>
			  	</div>
                <!-- Recomendação da Música -->
			  	<div class="form-group row"> 
			    	<label for="cadRecomendaMusic" class="col-sm-3 col-form-label txtarea">Recomendação da Música:</label>
			    	<div class="col-sm-9">
			    		<textarea type="text" class="form-control txtarea" id="cadRecomendaMusic" name="cadRecomendaMusic" maxlength="50" placeholder="Exemplo: 'Nivel Musical 4'" required></textarea>
					</div>
			  	</div>

			  	<p class="card-text box-transparent-radius" style="">Para evitar erros, se atente ao URL da Música, para que não o usuário não seja redirecionado para uma página inexistente</p>
	    		<button class="btn btn-primary btnTamanho" type="submit" id="btnCadMusic" name="btnCadMusic">Adicionar</button>

	    		<br/><br/>
                <!-- Indicação de Músicas Cadastradas -->
                <table class="table" id="tabIndi"> 
	  				<thead class="thead-dark">
	    				<tr>
	    					<th scope="col" colspan="5">Indicações de Músicas
                            <a href="#addDoc"><i class="material-icons" style="margin-left: -25px;float: right; color: white"title="Cadastrar Novo Documento">create_new_folder</i></a>
                            </th>
	    				</tr>
					</thead>
		  			<tbody>
                        <tr class="table-active">
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Recomendação</th>
                            <th scope="col">Aula</th>
                            <th scope="col">URL</th>
                        </tr>
		  				<?php
                        include('../../back/conexao.php');
                        $sql = "select * from musicas;";
                        $resMus=$conn->query($sql);
                        $conn->close();
                        $entrou=0;
		  				while($linhaMus=$resMus->fetch_array()){
                            $entrou++;
		  				?>
						<tr class="table-active">				
					      	<td><?php echo $entrou."ª";?></td>
                            <td><?php echo $linhaMus['nome'];?></td>
                            <td><?php echo $linhaMus['recomendacao'];?></td>
                            <td><?php echo $linhaMus['aula'];?></td>
                            <td><a href="<?php echo $linhaMus['url'];?>" target="_blank" class="colNivel">Link</a></td>
	    				</tr>
                        <?php } if($entrou==0){ ?>
                        <tr class="table-active">
					      	<td colspan="5"><i>Sem Músicas Cadastradas</i></td>
	    				</tr>
                        <?php } ?>
	  				</tbody>
				</table>
			</form>
            <?php
		      }elseif(isset($_GET['sess'])&&($_GET['sess']==5)){
	        ?>
            <!-- Formulário de Indicação de Aplicativos -->
			<form method="POST" action="../../back/backCadDocument.php" id="formApp" enctype="multipart/form-data"> 
                <a href="#tabApp"><i class="material-icons" style="margin-left: -25px;float: right; color: white" title="Tabela">table_chart</i></a>
				<h5 class="h5Form">- Cadastrar Indicações de Aplicativos -</h5>
                <!-- Instrumento -->
				<div class="form-group row" style="margin-bottom: 31px;"> 
			    	<label for="cadAulaApp" class="col-sm-3 col-form-label">Instrumento:</label>
			    	<div class="col-sm-9">
				    	<select class="custom-select" id="cadAulaApp" name="cadAulaApp" required>
					    	<option>Selecione...</option>
					    	<option>Teclado</option>
					    	<option>Guitarra</option>
					    	<option>Violão</option>
					    	<option>Todos</option>
					  	</select>
				  	</div>
				</div>
                <!-- Url do Aplicativo -->
				<div class="form-group row"> 
			    	<label for="cadUrlApp" class="col-sm-3 col-form-label">URL do Aplicativo:</label>
			    	<div class="col-sm-9 input-group mb-3">
			    		<input type="text" class="form-control" id="cadUrlApp" name="cadUrlApp" maxlength="100" placeholder="Exemplo: 'https://www.cifrasclub.com/'" required>
					</div>
			  	</div>
                <!-- Nome da Imagem -->
			  	<div class="form-group row"> 
			    	<label for="cadImgApp" class="col-sm-3 col-form-label">Nome da Imagem:</label>
			    	<div class="col-sm-9 input-group mb-3">
                        <input type="text" class="form-control" placeholder="Clique para selecionar a imagem..." maxlength="30" onclick="clickFile('#cadImgApp');" id="cadImgAppClick" readonly>
                        <input type="file" accept="image/x-png" class="files" id="cadImgApp" name="cadImgApp" required>
                        <div class="input-group-append">
                            <span class="input-group-text">.png</span>
                        </div>
					</div>
			  	</div>
                <!-- Nome do Aplicativo -->
			  	<div class="form-group row"> 
			    	<label for="cadNomeApp" class="col-sm-3 col-form-label">Nome do Aplicativo:</label>
			    	<div class="col-sm-9">
			    		<input type="text" class="form-control" id="cadNomeApp" name="cadNomeApp" maxlength="50" placeholder="Exemplo: 'Cifras Club'" required>
					</div>
			  	</div>
                <!-- Descrição do Aplicativo -->
			  	<div class="form-group row"> 
			    	<label for="cadDescricaoApp" class="col-sm-3 col-form-label txtarea">Descrição do Aplicativo:</label>
			    	<div class="col-sm-9">
			    		<textarea type="text" class="form-control txtarea" id="cadDescricaoApp" name="cadDescricaoApp" maxlength="100" placeholder="Exemplo: 'Aplicativo para encontrar Cifras de Músicas que deseja tocar'" required></textarea>
					</div>
			  	</div>

			  	<p class="card-text box-transparent-radius" style="">Para evitar erros, se atente ao URL da Música, para que não o usuário não seja redirecionado para uma página inexistente</p>
	    		<button class="btn btn-primary btnTamanho" type="submit" id="btnCadApp" name="btnCadApp">Adicionar</button>
	    		<br/><br/>
                <!-- Indicação de Aplicativos Cadastrados -->
                <table class="table" id="tabApp"> 
	  				<thead class="thead-dark">
	    				<tr>
	    					<th scope="col" colspan="5">Indicações de Aplicativos
                            <a href="#addDoc"><i class="material-icons" style="margin-left: -25px;float: right; color: white"title="Cadastrar Novo Documento">create_new_folder</i></a>
                            </th>
	    				</tr>
					</thead>
		  			<tbody>
                        <tr class="table-active">
                            <th scope="col">Logo</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Aula</th>
                            <th scope="col">URL</th>
                        </tr>
		  				<?php
                        include('../../back/conexao.php');
                        $sql = "select * from apps;";
                        $resApp=$conn->query($sql);
                        $conn->close();
                        $entrou=0;
		  				while($linhaApp=$resApp->fetch_array()){
                            $entrou++;
		  				?>
						<tr class="table-active">				
					      	<td><img src="../../img/app/<?php echo $linhaApp['img'];?>" width="30"/></td>
                            <td><?php echo $linhaApp['nome'];?></td>
                            <td><?php echo $linhaApp['descricao'];?></td>
                            <td><?php echo $linhaApp['aula'];?></td>
                            <td><a href="<?php echo $linhaApp['url'];?>" target="_blank" id="colNivel">Link</a></td>
	    				</tr>
                        <?php } if($entrou==0){ ?>
                        <tr class="table-active">
					      	<td colspan="5"><i>Sem Aplicativos Cadastrados</i></td>
	    				</tr>
                        <?php } ?>
	  				</tbody>
				</table>
			</form>
            <?php } ?>
            <!--FOOTER-->
			<div  style="margin-left: 200px; margin-right: 200px;">
				<a class="btn btn-danger btn-block" href="root.php?program">
                    Programar { }
                </a>
                <button id="btnProgramar" type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalProgram" style="display: none;"></button>
			</div>
	  	</div>
	  	<div class="card-footer">
	    	Prof. Mateus Brandão
	  	</div>
	  	<br/>
	</div>
	<?php include('../../modais/modalResultado.php');include('../../modais/modalSobNivel.php');include('../../modais/modalProgram.php');?>
</body>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.bundle.js"></script>
</html>
<!--
	Adicionar campo alunos{pagamento|liberação}|
-->