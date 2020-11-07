<?php
	session_start();
	if(!((isset($_SESSION['root']))&&($_SESSION['root']=="Ativo"))){
		header('Location: ../../front/index.php?erro=4');
	}
?>
<style>
    .nav{
        background: rgba(0,0,0,.1);
    }
</style>
<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item"><a class="nav-link" href="../app">Aplicativos</a></li>
  <li class="nav-item"><a class="nav-link" href="../exerc">Exercícios</a></li>
  <li class="nav-item"><a class="nav-link" href="../fundo">Fundo</a></li>
  <li class="nav-item"><a class="nav-link" href="../icones">Icones</a></li>
  <li class="nav-item"><a class="nav-link" href="../obj">Objetos</a></li>
  <li class="nav-item"><a class="nav-link" href="../ppt">Power Point</a></li>
  <li class="nav-item"><a class="nav-link" href="../print">Print</a></li>
</ul>