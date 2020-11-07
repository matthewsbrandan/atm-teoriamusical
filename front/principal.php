<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>Aula de Música</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="../css/bootstrap.min.css" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<!--link rel="stylesheet" type="text/css" href="css/level-css.css"/-->
	<style>
		ul#lista a{ color: black; }
		#tblObjetivo{
			display: none;
			opacity: 0;
			transition: opacity .5s;
		}
		#tblObjetivo a{
			color: black;
			font-size: 11pt;
		}
		#tblObjetivo i{ vertical-align: middle; }
		.tblPadrao{
			margin: auto;
			max-width: 800px;
		}
		#thObjetivo{ transition: background 1s; }
		#thObjetivo:hover{
			cursor: Pointer;
			background: rgba(0,0,0,.7);
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
		    animation: loading-50 1.8s linear forwards;
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
		.progress.blue .progress-left .progress-bar{ animation: loading-50 1.5s linear forwards 1.8s; }
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
		@keyframes loading-75{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(90deg);
		        transform: rotate(90deg);
		    }
		}
		@keyframes loading-70{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(80deg);
		        transform: rotate(80deg);
		    }
		}
		@keyframes loading-50{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		}
		@keyframes loading-35{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(120deg);
		        transform: rotate(120deg);
		    }
		}
		@keyframes loading-25{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(90deg);
		        transform: rotate(90deg);
		    }
		}
		@keyframes loading-0{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(2deg);
		        transform: rotate(2deg);
		    }
		}
		@media only screen and (max-width: 990px){ .progress{ margin-bottom: 20px; } }
	</style>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
	<script>
		var vObj = false;
		function desSob(v){
			if(v==1){
				document.getElementById('divDesempenho').style="display: block;";
				document.getElementById('divSobre').style="display: none;";
				document.getElementById('btnDes').style="background: white;color: rgba(0,0,0,.9);border-color: white;";
				document.getElementById('btnSob').style="background: #707580;color: white;border-color: gray;";
			}else{
				document.getElementById('divSobre').style="display: block;";
				document.getElementById('divDesempenho').style="display: none;";
				document.getElementById('btnSob').style="background: white;color: rgba(0,0,0,.9);border-color: white;";
				document.getElementById('btnDes').style="background: #707580;color: white;border-color: gray;";
			}
		}
		function mostraTbl(){
			if(vObj){
				document.getElementById("tblObjetivo").style="display: none; opacity:0;";
				vObj = false;	
			}else{
				document.getElementById("tblObjetivo").style="display: block; opacity: 1;";
				vObj = true;
			}			
		}
		function altNivel(v){
            objPorcBar.innerHTML= v+"%";
			switch(v){
                case 'Subiu':
                    objPorcBar.innerHTML= "0%";
                    document.getElementById('pbr').style="animation: loading-0 1.8s linear forwards;";
					document.getElementById('pbl').style="animation: loading-50 1.5s linear forwards 1.8s;";
                    newNivel();
                    break;
				case '100': case '75':case '70':case '50':
					document.getElementById('pbr').style="animation: loading-100 1.8s linear forwards;";
					document.getElementById('pbl').style="animation: loading-"+v+" 1.5s linear forwards 1.8s;";
					break;
				case '35':case '25':
					document.getElementById('pbr').style="animation: loading-"+v+" 1.8s linear forwards;";
					document.getElementById('pbl').style="animation: loading-50 1.5s linear forwards 1.8s;";
					break;
				case '0':
					document.getElementById('pbr').style="animation: loading-0 1.8s linear forwards;";
					document.getElementById('pbl').style="animation: loading-50 1.5s linear forwards 1.8s;";
					break;
			}
		}
        function newNivel(){
            tituloModalResultado.innerHTML="Parabéns";
            subTituloModalResultado.innerHTML="<center><b style='font-size: 14pt;'>Você alcançou um novo Nível Musical!</b><br/>Conclua seus novos objetivos e alcance novos níveis.</center>";
            document.getElementById('btnChamaModalResult').click();
        }
		function primeiroLog(){
			tituloModalResultado.innerHTML="Bem Vindo ao Curso de Teoria Musical";
			subTituloModalResultado.innerHTML="Aqui você terá todo o apoio necessário para aprender e entender o seu instrumento. Se dedique e verá os resultados.<br/><br/>Está é a <em>Página Principal</em>. Quando o botão <b>Desempenho</b> estiver ativado você verá o seu nível musical e os seus objetivos para alcançar o próximo nível. Ativando o botão <b>Sobre</b> você terá um resumo sobre todo o site; o que te ajudará a conhecer seu ambiente de estudos.<br/><br/><i>Boa Sorte, e que a música sempre esteja a seu favor!</i>";
			document.getElementById('btnChamaModalResult').click();
		}
        function recarrega(v){
            window.location.href = "principal.php?conc=" + v;
        }
        function jsCumpreObj(v){
            if(v){
                tituloModalResultado.innerHTML="Parabéns";
                subTituloModalResultado.innerHTML="<center><b style='font-size: 14pt;'>Você Completou este Objetivo!</b><br/>Parabéns por mais esta conquista, continue estudando e aprimorando seu conhecimentos musicais.</center>";
                document.getElementById('btnChamaModalResult').click();
            }
		}
        function jsCumpreExerc(v){
        	if(v){
        		tituloModalResultado.innerHTML="Parabéns";
				subTituloModalResultado.innerHTML="<center><b style='font-size: 14pt;'>Você Completou este Objetivo!</b><br/>Vá a tabela de Objetivos e Continue estudando e alcançando novos niveis músicais.</center>";
				document.getElementById('btnChamaModalResult').click();
        	}
		}
        $(function(e){ 
            $('#thObjetivo').click(function(e){
               v = $('#thObjetivo').offset();
               $('html,body').animate({scrollTop:v.top},1000);
           });
        });
	</script>
</head>
<body onload="<?php if(isset($_GET['conc'])){ echo " jsCumpreObj(".cumpreObj($_GET['conc']).");";} echo " altNivel('".fobjetivo()."');"; if(isset($_GET['prLog'])){ echo " primeiroLog();";} if(isset($_GET['ativC'])){ echo " jsCumpreExerc(".$_GET['ativC'].");";}?>">
	<?php
		include('topBar.php');
		include('../back/conexao.php');
		$sql = "select oa.id,oa.concluido,ob.urlObj,ob.tituloObj,ob.descricao,ob.onclick from objaluno oa inner join objetivo ob on oa.objId=ob.id where oa.alunoId='{$_SESSION['id']}' and ob.nivelId='{$_SESSION['nivelId']}';";
		$objetivo = $conn->query($sql);
		$conn->close();
		function fobjetivo(){
			include('../back/conexao.php');            
			$sql = "call porcNivel('{$_SESSION['nivelId']}','{$_SESSION['id']}');";
			$resultado = $conn->query($sql);
			$linha = $resultado->fetch_array();
            $conn->close();
            if($linha['porc']=="Subiu"){
                $retornoMetodo = $linha['porc'];
                $_SESSION['nivel']++;
                $_SESSION['nivelId']=$linha['nivel'];
            }else{
                if($linha['porc']!=0 && $linha['porc']!=25 && $linha['porc']!=35 && $linha['porc']!=50 && $linha['porc']!=70 && $linha['porc']!=75 && $linha['porc']!=100){
                    if($linha['porc']<25){
                        $retornoMetodo = 25;
                    }elseif($linha['porc']<35){
                        $retornoMetodo = 35;
                    }elseif($linha['porc']<50){
                        $retornoMetodo = 50;
                    }elseif($linha['porc']<70){
                        $retornoMetodo = 70;
                    }elseif($linha['porc']<75){
                        $retornoMetodo = 75;
                    }else{
                        $retornoMetodo = 100;
                    }
                }else{
                    $retornoMetodo = $linha['porc'];
                }   
            }
			return $retornoMetodo;	
		}
		function cumpreObj($param){
            include('../back/conexao.php');
            $sql = "select concluido from objaluno where id='$param' and alunoId='{$_SESSION['id']}';";
            $obj = $conn->query($sql);
            $resultado = $obj->fetch_array();
            if($resultado['concluido']==0){
                $sql = "update objaluno set concluido='1' where alunoId='{$_SESSION['id']}' and id='$param';";
                $conn->query($sql);
                $retorno = true;
            }else{
                $retorno = false;
            }
            $conn->close();
            return $retorno;
        }
	?>	
	<div class="card text-center conteudo" id="primeiro" style="background: rgba(250,250,250,.6);"> <!--Sobre o Site-->
	  	<div class="card-header">
	    	Aulas de Música - <b><?php echo $_SESSION['aula'];?></b>
	  	</div>
  		<div class="card-body">
	  		<div class="btn-group" role="group" aria-label="..."> <!--Selecionar Sessão-->
	  			<button type="button" class="btn btn-light" onclick="desSob(1)" id="btnDes">Desempenho</button>
    			<button type="button" class="btn btn-secondary" onclick="desSob(0)" id="btnSob">Sobre o Site</button>
	  		</div><br/><br/>

    		<div id="divDesempenho"><!-- Desempenho -->
	    		<h5 class="card-title">Seu Nível Musical</h5>
	    		<p class="card-text" id="ptxt">Parabéns por chegar até aqui continue treinando e vá avançando e melhorando seu nível Musical a cada Etapa.</p>
				<div class="container" style="background: transparent;">
		            <div class="progress blue">
		                <span class="progress-left">
		                    <span class="progress-bar" id="pbl"></span>
		                </span>
		                <span class="progress-right">
		                    <span class="progress-bar" id="pbr"></span>
		                </span>
		                <div class="progress-value" id="objPorcBar"></div>
		            </div>
		            <p><b><?php echo "Nível ".$_SESSION['nivel']; ?></b></p>
				</div>
				<br/>
				<table class="table tblPadrao"> <!--Area de Click-->
	    			<thead class="thead-dark">
					    <tr>
					      	<th scope="col" id="thObjetivo" onclick="mostraTbl()">Objetivos</th>
					    </tr>
				  	</thead>
			  	</table>
			  	<div id="tblObjetivo">
			    	<table class="table tblPadrao" style="background: rgba(220,220,220,.4);">
					  	<thead>
						    <tr>
						      	<th scope="col">#</th>
						      	<th scope="col">Objetivo</th>
						      	<th scope="col">Descrição</th>
						    </tr>
					  	</thead>
					  	<tbody>
					  		<?php 
					  		$entrou = 0;
					  		while($linha = $objetivo->fetch_array()){
					  			$entrou = 1;
					  		?>
					  		<tr>
						      	<th scope="row"><?php echo $linha['concluido']?"<i class='material-icons' title='Objetivo Realizado'>done</i>":"<i class='material-icons' title='Objetivo Pendente'>hourglass_empty</i>";?></th>
						      	<td>
                                    <a <?php if($linha['onclick']==1){ echo "onclick='recarrega({$linha['id']});' target='_blank'";} ?> href=<?php echo $linha['urlObj'];?>>
                                        <?php echo $linha['tituloObj'];?>
                                    </a>
                                </td>
						      	<td style="font-size: 10pt;"><?php echo $linha['descricao'];?></td>
						    </tr>
						    <?php
							} if($entrou==0){
							?>
							<tr>
								<td colspan="3" class="table-dark" style="text-align: center;">Você está no nível Máximo.<br/>Espere até que novos objetivos sejam lançados para alcançar novos níveis!</td>
							</tr>
							<?php
							}
							?>
                            <tr>
                                <td colspan="3" class="table-dark" style="font-size: 9pt; padding: 3px;">Obs. Os objetivos relacionados a audio serão concluidos com a liberação do professor.</td>
                            </tr>
					  	</tbody>
					</table>
				</div>
			</div>

			<div id="divSobre" style="display: none;"> <!-- Sobre o Site -->
				<h5 class="card-title">Sobre o Site</h5>
	    		<p class="card-text" id="ptxt">Esta é sua área, onde você encontra o que precisa sobre seu curso.<br/>Aqui você vê:</p>
		    	<ul class="list-group" id="lista">
	  				<li class="list-group-item rounded"><a href="pagPpt.php">
	  					<b>Aulas:</b> Aqui você vê suas aulas em <span class="deitar">Power Point</span> dispostas para Download
	  				</a></li>
	  				<li class="list-group-item rounded"><a href="pagExerc.php">
	  					<b>Exercícios:</b> Aqui você vê seus exercícios vistos em aula dispostos para Download
	  				</a></li>
	  				<li class="list-group-item rounded"><a href="pagAudio.php">
	  					<b>Audios:</b> Aqui você vê o audio de todas as músicas vistas em aula dispostos para Download
	  				</a></li>
	  				<li class="list-group-item rounded"><a href="<?php if($_SESSION['aula']=="Teclado"){ echo "pagNotas.php"; }else{ echo "pagCordas.php"; }?>">
	  					<b>Notas:</b> Aqui você vê as <span class="deitar">Notas</span> e <span class="deitar">Acordes</span> em seu instrumento
	  				</a></li>
	  				<li class="list-group-item rounded"><a href="pagIndica.php">
	  					<b>Indicações:</b> Aqui você vê indicações de músicas e aplicativos que irão ajudá-lo
	  				</a></li>
	  				<li class="list-group-item rounded"><a href="#" data-toggle="modal" data-target="#modalApoio">
	  					<b>Apoio:</b> Aqui você vê os conceitos mais importantes obtidos no curso como Nomenclatura|Escala Cromática|Formação de Acorde|Campo Harmônico entre outros
	  				</a></li>
	  				<li class="list-group-item rounded"><a href="pagPerfil.php">
	  					<b>Perfil:</b> Aqui você vê detalhes do seu perfil e é onde pode alterá-los
	  				</a></li>
				</ul>
			</div>
	  	</div>
	  	<div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
	  	<?php include('../modais/modalResultado.php'); ?>
	</div>
</body>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>