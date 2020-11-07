<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Audio</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<script type="text/javascript" src="../js/functionNota.js"></script>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
	<style>
		body{ background:	transparent; }
		audio{
			display: block;
			margin: auto;
			width: 400px;
		}
		p#pSelecione{
			display: block;
			margin: auto;
			text-align: center;
			border-radius: 8px;
			padding: 20px;
			background: rgba(0,0,0,.6);
			color:white;
			font-size: 14pt;
		}
		h5{
			text-align: center;
			color:rgba(250,250,250,.9);
			margin-bottom: 20px;
		}
		div#complemento{
			margin: auto;
			margin-top: 30px;
			width: 600px
		}
		div#complemento h5{ text-align: left; }
		td{
			cursor: pointer;
			transition: background .8s;
		}
		td:hover{
			background: rgba(250,250,250,.4);
			border-radius: 5px;
		}
		form#formCad input{ display: none; }
	</style>
	<script>
		function click2(v){
			document.getElementById('conteudo').style="background: rgba(0,0,0,.8);height: "+ v + "px;width:800px; margin: auto;";
			document.getElementById('formCad').style="display: block;margin-top: 30px;";
		}
        window.onload = function(){
            <?php if(isset($_GET['tamanho'])){?>
            click2(<?php echo $_GET['tamanho']; ?>);
            <?php } ?>    
        };
	</script>
</head>
<body>	
	<div id="conteudo">
		<?php if((isset($_GET['nome']))&&(isset($_GET['audio']))&&(isset($_GET['comp']))){?>
		<h5 <?php if(isset($_GET['pro'])){?> style="color:rgba(50,50,50,.9);" <?php }?> >
			<?php echo $_GET['nome'];?>
		</h5>
		<audio id="musica" controls="controls">
			<source src="../audio/<?php echo $_GET['audio'];?>" type="audio/mpeg"/>
			Desculpe, mas o audio não pode ser carregado neste navegador!
		</audio>
		<?php 
			include('../audio/complemento/'.$_GET['comp']);
		}else{
		?>
		<p id="pSelecione">Selecione um audio a ser Exibido.</p>
		<?php
		}?>
	</div>
	<form style="display:none;" method="POST" action="../back/backCadDocument.php" id="formCad">
		<input name="cadNomeAudio" id="cadNomeAudio" value="<?php echo $_GET['audio'];?>">
		<input name="cadTituloAudio" id="cadTituloAudio" value="<?php echo $_GET['nome'];?>">
		<input name="cadComplemento" id="cadComplemento" value="<?php echo $_GET['comp'];?>">
		<input name="cadTamanho" id="cadTamanho" value="<?php echo $_GET['tamanho'];?>">
		<input name="cadTipoAudio" id="cadTipoAudio" value="<?php echo $_GET['tipo'];?>">
		<input name="cadNivelAudio" id="cadNivelAudio" value="<?php echo $_GET['nivel'];?>">
		<input name="cadAulaAudio" id="cadAulaAudio" value="<?php echo $_GET['aula'];?>">
        <input name="cadDifAudio" id="cadDifAudio" value="<?php echo $_GET['dif'];?>">
		<button style="margin:auto;display:block;" class="btn btn-primary btnTamanho" type="submit" id="btnCadAudio" name="btnCadAudio">Caso tenha mudado os valores na URL recarregue a página para atualizar os valores</button>
	</form>
</body>
</html>