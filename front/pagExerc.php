<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Exercícios</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<style>
		div#pdfAtividade a{
			margin: 10px;
		}
		div#pdfAtividade img{
			border: .8px solid rgba(0,0,0,.2);
		}
		div#pdfAtividade figcaption{
			max-width: 200px;
		}
        div#container-exerc{
			position: relative;
		}
		div#container-exerc h5#titulo-exerc{
			display: block;
			background: rgba(250,250,250,.6);
			border-radius: 3px;
			position: absolute;
			top:0;
			width: 220px;
			height: 130px;
			padding-top: 45px;
			padding-bottom: 45px;
			padding-left: 0px;
			padding-right: 0px;
			color: rgb(65,65,65);
            transition: background .6s;
		}
		div#container-exerc:hover h5#titulo-exerc{ background: rgba(150,150,150,.6);color: white; transition: background .6s;}
	</style>
</head>
<body>
	<?php include('topBar.php');?>
	<div class="card text-center conteudo" id="exercicio"> <!--Exercicio-->
	  	<div class="card-header">
	    	Exercícios
	  	</div>
	  	<div class="card-body">
	    	<h5 class="card-title">Atividades e Avaliações</h5>
	    	<div id="pdfAtividade"> <!--Atividade PDF-->
	    		<?php 
	  				include('../back/conexao.php');
  					$sql2 = "select e.urlExerc,e.tituloExerc,e.imgExerc,oa.concluido from exerc e inner join objetivo o on e.urlExerc=o.urlObj inner join objaluno oa on o.id=oa.objId where e.aula='".$_SESSION['aula']."' and oa.alunoId={$_SESSION['id']};";
  					$resultado2 = $conn->query($sql2);
  					$conn->close();
  					while($linha2 = $resultado2->fetch_assoc()){ //Remover o '!' do inicio da expressão quando os exercícios estiverem funcionando
  						$entrou2=1;
//                        echo "<pre class='text-left'>";
//                        print_r($linha2);
//                        echo "</pre>";
	  			?>
		    	<a href="<?php echo $linha2['urlExerc'];?>" target="_blank" title="<?php echo $linha2['tituloExerc'];?>"> <!--Teste 01-->
		    		<figure class="figure" style="position: relative;">
                        <?php if($linha2['concluido']){ ?><span class="text-dark" style="position: absolute;z-index: 1;right: 0" title="Aula Concluida"><i class="material-icons">bookmark</i></span><?php } ?>
                        <div id="container-exerc">
  						    <img src="<?php echo $linha2['imgExerc'];?>" width="220" class="figure-img img-fluid rounded" alt="<?php echo $linha2['tituloExerc'];?>"/>
                            <h5 id="titulo-exerc">QUIZZ</h5>
						</div>
  						<figcaption class="figure-caption">
						<?php
						if(strlen($linha2['tituloExerc'])>31){
							$mostrar = substr($linha2['tituloExerc'],0,28);
							echo $mostrar."...";
  						}else{
  							echo $linha2['tituloExerc'];
  						}
  						?>
  						</figcaption>
					</figure>
		    	</a>
		    	<?php
		    		}
		    		if(!(isset($entrou2))){
    			?>
    			<p style="background: rgba(0,0,0,.3);border-radius:7px;color: white;padding: 45px;margin-left:200px;margin-right: 200px;font-size: 15pt;">
		    		Sem atividades Registradas!
		    	</p>
    			<?php
		    		}
		    	?>
		    </div>
	  	</div>
	  	<div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
        <?php include('../modais/modalResultado.php'); ?>
	</div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>