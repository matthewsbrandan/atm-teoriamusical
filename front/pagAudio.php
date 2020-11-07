<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Audios</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<style>
		.btnTamanho{
			width: 120px;
		}
		div#divAudio{
			opacity:0;
			transition: opacity 2s;
			position: relative;
		}
		iframe#frame-audio,iframe#frame-audio-pro{
			margin: auto;
			width: 95%;
			height: 80px;
			border: none;
			overflow: hidden;
			margin-left: 0px;
		}
		iframe#frame-audio::-webkit-scrollbar,iframe#frame-audio-pro::-webkit-scrollbar{
			display: none;
		}
	</style>
	<script>
		function divAudio(padrao){
			if(padrao){
				document.getElementById('divAudioPadrao').style="display: block;background: rgba(70,70,70,.5);margin: 10px 100px 10px 100px;border-radius: 7px;border: 1px solid gray;color:white;";
				document.getElementById('divAudioPro').style="display: none;";
				document.getElementById('imgAudio').style="display: none;";
				document.getElementById('divAudio').style="opacity: 1;";
			}else{
				document.getElementById('divAudioPro').style="display: block;background: rgba(230,230,230,.8);margin: 10px 100px 10px 100px;border-radius: 7px;border: 1px solid gray;";
				document.getElementById('divAudioPadrao').style="display: none;";
				document.getElementById('imgAudio').style="display: none;";
				document.getElementById('divAudio').style="opacity: 1;";
			}
		}
		function voltar(){
			document.getElementById('imgAudio').style="display: block;";
			document.getElementById('divAudio').style="opacity: 0;";
			document.getElementById('divAudioPro').style="display: none;";
			document.getElementById('divAudioPadrao').style="display: none;";
			restauraHeight();
		}
		function altHeight(v,pro){
			if(pro){
				document.getElementById('frame-audio-pro').style="height: " + v + "px;";
			}else{
				document.getElementById('frame-audio').style="height: " + v + "px;";
			}
		}
		function restauraHeight(pro){			
			document.getElementById('frame-audio-pro').style="height: 80px;";
			document.getElementById('frame-audio').style="height: 80px;";
		}
	</script>
</head>
<body>
	<?php
        include('topBar.php');
    ?>
	<div class="card text-center conteudo" id="audio"> <!--Audio-->
	  	<div class="card-header">
	    	MP3 - Audios de Sequências
	  	</div>
	  	<div class="card-body">
	    	<h5 class="card-title">Audios</h5>
	    	<div id="imgAudio">
	    		<a href="#" onclick="divAudio(true)">
		    		<figure class="figure" style="background: rgba(70,70,70,.5);border-radius: 7px;width:130px;">
						<img src="../img/icones/audio.png" class="figure-img img-fluid rounded" alt=""/>
						<figcaption class="figure-caption" style="background: rgba(250,250,250,.6);">
							Padrão
						</figcaption>
					</figure>
				</a>
				<a href="#" onclick="divAudio(false)">
					<figure class="figure" style="background: rgba(230,230,230,.8);border-radius: 7px;width:130px;">
						<img src="../img/icones/audioOnda.png" class="figure-img img-fluid rounded" alt=""/>
						<figcaption class="figure-caption" style="background: rgba(0,0,0,.4);color:white;">
							Pró
						</figcaption>
					</figure>
				</a>
	    	</div>
	    	<div id="divAudio"> <!--Conteudo-->
	    		<div id="divAudioPadrao" style="margin: auto; width: 370px;display:none;"> <!--Padrão-->
	    			<a href="iAudio.php" target="janela"><button type="button" class="close" style="display: block;position:absolute;padding: 6px 10px 10px 10px; color:white;float:right;" onclick="voltar()"><span aria-hidden="true">&times;</span></button></a>
	    			<h4 style="margin-top:8px;margin-bottom:18px;">Audio Padrão</h4>
		    		<?php
		    			include('../back/conexao.php');
	  					$sql = "select * from audio where aula='".$_SESSION['aula']."' and dificuldade='Padrão' and tipo='Sequência de Acordes' and nivelId<='".$_SESSION['nivelId']."';";
	  					$sql1 = "select * from audio where aula='".$_SESSION['aula']."' and dificuldade='Padrão' and tipo='Exercício de Mobilidade' and nivelId<='".$_SESSION['nivelId']."';";
	  					$sql2 = "select * from audio where aula='".$_SESSION['aula']."' and dificuldade='Padrão' and tipo='Escalas' and nivelId<='".$_SESSION['nivelId']."';";
	  					$resSequencia = $conn->query($sql);
	  					$resMobilidade = $conn->query($sql1);
	  					$resEscalas = $conn->query($sql2);
	  					$conn->close();
		    		?>
				  	<div class="btn-group" role="group"> <!--Sequencia-->
					    <button id="btnSequencia" type="button" class="btn btn-secondary dropdown-toggle btnTamanho" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					      Sequência
					    </button>
					    <div class="dropdown-menu" aria-labelledby="btnSequencia">
				    		<?php
				    			$entrou=0;
				    			while($linha = $resSequencia->fetch_array()){
			    				$entrou=1;
		    				?>
					      		<a class="dropdown-item" href="iAudio.php?nome=<?php echo $linha['tituloAud'];?>&audio=<?php echo $linha['nomeAud'];?>&comp=<?php echo $linha['urlComplemento'];?>" target="janela" onclick="altHeight(<?php echo $linha['tamanho'];?>,false)">
					      			<?php echo $linha['tituloAud'];?>
					      		</a>
					      	<?php }if($entrou==0){?>
					      		<a class="dropdown-item" href="iAudio.php" target="janela" onclick="restauraHeight()">Sem Sequências Disponíveis</a>
					      	<?php }?>
					    </div>
				  	</div>
				  	<div class="btn-group" role="group"> <!--Exercício-->
					    <button id="btnMobilidade" type="button" class="btn btn-secondary dropdown-toggle btnTamanho" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					      Exercício
					    </button>
					    <div class="dropdown-menu" aria-labelledby="btnMobilidade">
					    	<?php
				    			$entrou1=0;
				    			while($linha1 = $resMobilidade->fetch_array()){
			    				$entrou1=1;
		    				?>
		    					<a class="dropdown-item" href="iAudio.php?nome=<?php echo $linha1['tituloAud'];?>&audio=<?php echo $linha1['nomeAud'];?>&comp=<?php echo $linha1['urlComplemento'];?>" target="janela" onclick="altHeight(<?php echo $linha1['tamanho'];?>,false)">
					      			<?php echo $linha1['tituloAud'];?>
					      		</a>
					      	<?php }if($entrou1==0){?>
					      		<a class="dropdown-item" href="iAudio.php" target="janela" onclick="restauraHeight()">Sem Exercícios Disponíveis</a>
					      	<?php }?>
					    </div>
				  	</div>
				  	<div class="btn-group" role="group"> <!--Escalas-->
					    <button id="btnEscalas" type="button" class="btn btn-secondary dropdown-toggle btnTamanho" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					      Escalas
					    </button>
					    <div class="dropdown-menu" aria-labelledby="btnEscalas">
					    	<?php
				    			$entrou2=0;
				    			while($linha2 = $resEscalas->fetch_array()){
			    				$entrou2=1;
		    				?>
		    					<a class="dropdown-item" href="iAudio.php?nome=<?php echo $linha2['tituloAud'];?>&audio=<?php echo $linha2['nomeAud'];?>&comp=<?php echo $linha2['urlComplemento'];?>" target="janela" onclick="altHeight(<?php echo $linha2['tamanho'];?>,false)">
					      			<?php echo $linha2['tituloAud'];?>
					      		</a>
					      	<?php }if($entrou2==0){?>
					      		<a class="dropdown-item" href="iAudio.php" target="janela" onclick="restauraHeight()">Sem Escalas Disponíveis</a>
					      	<?php }?>
					    </div>
				  	</div>
				  	<br/><br/>
					<iframe src="iAudio.php" name="janela" id="frame-audio"></iframe>
					<div style="font-size:9pt;">	
				    	<hr/><h5>Ajuda</h5>
				      	<ul>
				      		<li>Selecione o Audio em uma das categorias: Sequência de Notas, Exercícios de Mobilidade ou Escalas. Eles serão exibidos a abaixo do botão tendo a <spam class="deitar">Mídia</spam> e o <spam class="deitar">Complemento</spam>.</li>
				      		<li>Clique em reproduzir para ouvir a mídia selecionadas, ou clique nos três pontos na borda direita para efetuar o <spam class="deitar">Download.</spam></li>
				      		<li>Siga as instruções descritas e tente praticá-las acompanhando o audio. Você pode também selecionar as notas na tabela para ver detalhes, como de sua composição.</li>
				      	</ul>
		      		</div>
				</div>
				<div id="divAudioPro" style="margin: auto; width: 370px;display:none;"> <!--Pró-->
					<button type="button" class="close" style="display: block;position:absolute;padding: 6px 10px 10px 10px;float: right;" onclick="voltar()"><span aria-hidden="true">&times;</span></button>
					<h4 style="margin-top:8px;margin-bottom:18px;">Audio Pro</h4>
					<?php
		    			include('../back/conexao.php');
	  					$sql = "select * from audio where aula='".$_SESSION['aula']."' and dificuldade='Pro' and tipo='Sequência de Acordes' and nivelId<='".$_SESSION['nivelId']."';";
	  					$sql1 = "select * from audio where aula='".$_SESSION['aula']."' and dificuldade='Pro' and tipo='Exercício de Mobilidade' and nivelId<='".$_SESSION['nivelId']."';";
	  					$sql2 = "select * from audio where aula='".$_SESSION['aula']."' and dificuldade='Pro' and tipo='Escalas' and nivelId<='".$_SESSION['nivelId']."';";
	  					$resSequencia = $conn->query($sql);
	  					$resMobilidade = $conn->query($sql1);
	  					$resEscalas = $conn->query($sql2);
	  					$conn->close();
		    		?>
				  	<div class="btn-group" role="group"> <!--Sequencia-->
					    <button id="btnSequencia" type="button" class="btn btn-secondary dropdown-toggle btnTamanho" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					      Sequência
					    </button>
					    <div class="dropdown-menu" aria-labelledby="btnSequencia">
				    		<?php
				    			$entrou=0;
				    			while($linha = $resSequencia->fetch_array()){
			    				$entrou=1;
		    				?>
					      		<a class="dropdown-item" href="iAudio.php?nome=<?php echo $linha['tituloAud'];?>&audio=<?php echo $linha['nomeAud'];?>&comp=<?php echo $linha['urlComplemento'];?>&pro=1" target="janelaPro" onclick="altHeight(<?php echo $linha['tamanho'];?>,true)">
					      			<?php echo $linha['tituloAud'];?>
					      		</a>
					      	<?php }if($entrou!=1){?>
					      		<a class="dropdown-item" href="iAudio.php" target="janelaPro" onclick="restauraHeight()">Sem Sequências Disponíveis</a>
					      	<?php }?>
					    </div>
				  	</div>
				  	<div class="btn-group" role="group"> <!--Exercício-->
					    <button id="btnMobilidade" type="button" class="btn btn-secondary dropdown-toggle btnTamanho" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					      Exercício
					    </button>
					    <div class="dropdown-menu" aria-labelledby="btnMobilidade">
					    	<?php
				    			$entrou1=0;
				    			while($linha1 = $resMobilidade->fetch_array()){
			    				$entrou1=1;
		    				?>
		    					<a class="dropdown-item" href="iAudio.php?nome=<?php echo $linha1['tituloAud'];?>&audio=<?php echo $linha1['nomeAud'];?>&comp=<?php echo $linha1['urlComplemento'];?>&pro=1" target="janelaPro" onclick="altHeight(<?php echo $linha1['tamanho'];?>,true)">
					      			<?php echo $linha1['tituloAud'];?>
					      		</a>
					      	<?php }if($entrou1!=1){?>
					      		<a class="dropdown-item" href="iAudio.php" target="janelaPro" onclick="restauraHeight()">Sem Exercícios Disponíveis</a>
					      	<?php }?>
					    </div>
				  	</div>
				  	<div class="btn-group" role="group"> <!--Escalas-->
					    <button id="btnEscalas" type="button" class="btn btn-secondary dropdown-toggle btnTamanho" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					      Escalas
					    </button>
					    <div class="dropdown-menu" aria-labelledby="btnEscalas">
					    	<?php
				    			$entrou2=0;
				    			while($linha2 = $resEscalas->fetch_array()){
			    				$entrou2=1;
		    				?>
		    					<a class="dropdown-item" href="iAudio.php?nome=<?php echo $linha2['tituloAud'];?>&audio=<?php echo $linha2['nomeAud'];?>&comp=<?php echo $linha2['urlComplemento'];?>&pro=1" target="janelaPro" onclick="altHeight(<?php echo $linha2['tamanho'];?>,true)">
					      			<?php echo $linha2['tituloAud'];?>
					      		</a>
					      	<?php }if($entrou2!=1){?>
					      		<a class="dropdown-item" href="iAudio.php" target="janelaPro" onclick="restauraHeight()">Sem Escalas Disponíveis</a>
					      	<?php }?>
					    </div>
				  	</div>
				  	<br/><br/>
					<iframe src="iAudio.php" name="janelaPro" id="frame-audio-pro"></iframe>
					<div style="font-size:9pt;">	
				    	<hr/><h5>Ajuda</h5>
				      	<ul>
				      		<li>Selecione o Audio em uma das categorias: Sequência de Notas, Exercícios de Mobilidade ou Escalas. Eles serão exibidos a abaixo do botão tendo a <spam class="deitar">Mídia</spam> e o <spam class="deitar">Complemento</spam>.</li>
				      		<li>Clique em reproduzir para ouvir a mídia selecionadas, ou clique nos três pontos na borda direita para efetuar o <spam class="deitar">Download.</spam></li>
				      		<li>Siga as instruções descritas e tente praticá-las acompanhando o audio. Você pode também selecionar as notas na tabela para ver detalhes, como de sua composição.</li>
				      	</ul>
		      		</div>
				</div>
	    	</div>
	    	<p class="card-text">Obs. A opção para Download do pacote completo de audios estará disponivel em breve.</p>
	    	<a href="#" class="btn btn-primary" onclick="alert('Em breve');">Download</a>
	  	</div>
	  	<div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
	</div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>