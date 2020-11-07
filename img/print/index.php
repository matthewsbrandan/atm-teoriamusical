<!doctype html>
<html lang="pt-br">
<head>
	<title>ATMD - Prints</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../../css/scroll.css">
	<style>
        body{ background: url('../fundo/claro.jpg'); }
        figure{
            box-shadow: 1px 1px 30px black;
        }
	</style>
	<script src="../../js/jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
    <script>
        window.onload = function(){ $('.nav-item:nth-child(7) .nav-link').addClass('active'); }
	</script>
    <?php
        include('../links.php');
    ?>
    <div class="container pt-3 pb-3">
	<?php
        $diretorio = dir("../print");
        while($arquivo = $diretorio -> read()){
            if($arquivo!="." && $arquivo!=".." && $arquivo!="index.php" && $arquivo!="error_log") echo "<figure class='img-thumbnail d-inline-block m-1 text-center'><img src='$arquivo' title='$arquivo' height=280><figcaption>$arquivo</figcaption></figure>";            
        }
        $diretorio -> close();
    ?>
    </div>
</body>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.bundle.js"></script>
</html>