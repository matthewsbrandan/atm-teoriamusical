<?php
if(!((isset($_SESSION['id']))&&($_SESSION['id']>0))){
	header('Location: index.php?erro=4');
}
if(!isset($_SESSION['liberacao'])||$_SESSION['liberacao']==0){
    header('Location: pagLiberando.php');
}
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background: rgba(0,0,0,.8);">
	<a href="principal.php" title="Principal"> <img src="../img/icones/blur_two.png"/> </a>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    	<ul class="navbar-nav mr-auto" style="margin:auto;">
	      	<li class="nav-item">
		    	<a class="nav-link" href="pagPpt.php">Aulas</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="pagExerc.php">Exercícios</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="pagAudio.php">Audios</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="<?php if($_SESSION['aula']=="Teclado"){ echo "pagNotas.php"; }else{ echo "pagCordas.php"; }?>">Notas</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="pagIndica.php">Indicações</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="#" data-toggle="modal" data-target="#modalApoio">Apoio</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="pagPerfil.php">Perfil</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link disabled" href="index.php">Sair</a>
		  	</li>
	    </ul>
  </div>
</nav>
<br/>
<?php include('../modais/modalApoio.php'); ?>