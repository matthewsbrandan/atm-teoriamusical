<!doctype html>
<html lang="pt-br">
<head>
	<title>Aula de Música</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://fonts.googleapis.com/css?family=Charm" rel="stylesheet">
	<style>
		body{
			background: url("img/fundo/upgrade.jpg");
		}
		main{
			position: absolute;
            background: rgba(40,40,40,.4);
            left: 15em;
            right: 15em;
            padding: 10px;
            padding-top: 20px;
            top: 0;
            min-width: 400px;
            min-height: 100%;
            color: white;
            font-family: 'Charm', cursive;
			text-align: center;
		}
		h1{
			margin-bottom: 0px;
		}
		article{
			margin-top: 40px;
			text-align: left;
		}
		article section h5{
			background: rgba(200,200,200,.8);
			color: rgba(0,0,0,.8); 
			padding: 5px;
			text-align: center;
		}
		article section p{
			padding-left: 5px;
			padding-right: 5px;
		}
	</style>
</head>
<body>
    <?php
        include('back/conexao.php');
        $sql = "select * from manutencao order by id desc limit 1;";
        $dataRes = $conn->query($sql);
        $resultado = $dataRes->fetch_array();
        $conn->close();
    ?>
	<main>
		<header>
			<h1>
				<i class="material-icons">warning</i>
				-- Site em Atualização! --
				<i class="material-icons">warning</i>
			</h1>
			<p>O Site está em atualização, <?php echo date('d/m/Y',strtotime($resultado['data_m'])); ?>.</p>
		</header>
		<article class="row">
			<section class="col-12">
				<h5>Motivo da Atualização:</h5>
				<p><?php echo nl2br($resultado['motivo']); ?></p>
			</section>
		</article>
	</main>	
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.js"></script>
</html>