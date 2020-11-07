<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Aulas Teóricas</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<style>
		div#baixarPdf{ margin: auto; }
		div#baixarPdf a{ margin: 10px; }
		div#baixarPdf img{ border: .8px solid rgba(0,0,0,.2); }
		div#baixarPdf figcaption{ max-width: 200px; }
		div#container-pdf{ position: relative; }
		div#container-pdf h5#titulo-pdf{ display: none; }
		div#container-pdf:hover h5#titulo-pdf{
			display: block;
			background: rgba(250,250,250,.6);
			border-radius: 3px;
			position: absolute;
			top:0;
			width: 201px;
			height: 113px;
			padding-top: 45px;
			padding-bottom: 45px;
			padding-left: 0px;
			padding-right: 0px;
			color: rgb(65,65,65);
		}
	</style>
    <script>
        function msgModal(t,st){
            tituloModalResultado.innerHTML=t;
            subTituloModalResultado.innerHTML=st;
            document.getElementById('btnChamaModalResult').click();
		}
		function recarrega(c,id){
            if(c!=1){ window.location.href = "../back/backAlt.php?conc=" + id; }
        }
        window.onload = function(){ 
        <?php if(isset($_GET['conc'])){ if($_GET['conc']==0){ ?>
            msgModal('Parabéns',"<center><b style='font-size: 14pt;'>Você Completou este Objetivo!</b><br/>Veja a aula para entender seu conteúdo e poder usar os conhecimentos adquiridos no futuro.</center>");
        <?php }else if($_GET['conc']==1){ ?>
            msgModal('Desculpe','Houve um erro ao tentar concluir o objetivo. Peça ajuda ao seu professor para corrigir este problema.');
        <?php } } ?>
        };
	</script>
</head>
<body>
	<?php 
        include('topBar.php');
    ?>
	<div class="card text-center conteudo" id="ppt"> <!--PPT-->
	  	<div class="card-header">
	    	Power Point - Aulas Teóricas
	  	</div>
	  	<div class="card-body" id="pptCard">
	  		<h5 class="card-title">Aulas Teóricas</h5>
	    	<div id="baixarPdf"> <!--Baixar PDF-->
	    		<?php 
	  				include('../back/conexao.php');
  					$sql1 = "select p.tituloArq,p.nomePdf,oa.concluido,oa.id OAID,p.nomeImg from ppt p inner join objetivo o on p.nomePdf=o.urlObj inner join objaluno oa on o.id=oa.objId where p.aula='".$_SESSION['aula']."' and p.nivelId<='".$_SESSION['nivelId']."' and oa.alunoId={$_SESSION['id']};";
  					$resultado1 = $conn->query($sql1);
  					$conn->close();
  					while($linha1 = $resultado1->fetch_assoc()){
  						$entrou1=1;
	  			?>
		    	<a href="<?php echo $linha1['nomePdf'];?>" title="PDF - <?php echo $linha1['tituloArq'];?>" target="_blank" onclick="recarrega('<?php echo $linha1['concluido'];?>','<?php echo $linha1['OAID'];?>');">
		    		<figure class="figure" style="position: relative;">
                        <?php if($linha1['concluido']){ ?><span class="text-dark" style="position: absolute;z-index: 1;right: 0" title="Aula Concluida"><i class="material-icons">bookmark</i></span><?php } ?>
		    			<div id="container-pdf">
  							<img src="<?php echo "../img/ppt/".$linha1['nomeImg'];?>" class="figure-img img-fluid rounded" alt="PDF - <?php echo $linha1['tituloArq'];?>"/>
  							<h5 id="titulo-pdf">PDF</h5>
						</div>
  						<figcaption class="figure-caption">
						<?php
						if(strlen($linha1['tituloArq'])>24){
							echo "PDF - ".substr($linha1['tituloArq'],0,20)."...";
  						}else{
  							echo "PDF - ".$linha1['tituloArq'];
  						}
  						?>
  						</figcaption>
					</figure>
		    	</a>
		    	<?php
		    		}
		    		if(!(isset($entrou1))){
    			?>
    			<p style="background: rgba(0,0,0,.3);border-radius:7px;color: white;padding: 45px;margin-left:200px;margin-right: 200px;font-size: 15pt;">
		    		Sem aulas Registradas!
		    	</p>
    			<?php
		    		}
		    	?>		    	
	    	</div>
	  	</div>
	  	<br/>
	  	<div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
        <?php include('../modais/modalResultado.php'); ?>
	</div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>