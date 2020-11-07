<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Indicações</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<style>
		#tblMusic,#tblApp{
			display: none;
			opacity: 0;
			transition: opacity .5s;
		}
		#areaMusic,#areaApp{
			transition: background 1s;
		}
		#areaMusic:hover,#areaApp:hover{
			cursor: Pointer;
			background: rgba(0,0,0,.7);
		}
		.tblPadrao{
			margin: auto;
			max-width: 800px;
		}
		a{
			color: black;
		}
		.preenchimentoDefault{
			text-align: center;
			color:white;
			background: rgba(50,50,50,.7);
			border-radius: 12px;
		}
	</style>
	<script>
		var vMusic = false;
		var vApp = false;
		function mostraTbl(v){
			if(v=="m"){
				if(vMusic){
					dispOpaNone("tblMusic");
					vMusic = false;	
				}else{
					dispOpa("tblMusic");
					vMusic = true;
				}
			}else if(v=="a"){
				if(vApp){
					dispOpaNone("tblApp");
					vApp = false;
				}else{
					dispOpa("tblApp");
					vApp = true;
				}
			}
		}
		function dispOpa(v){
			document.getElementById(v).style="display: block;opacity: 1;";
		}
		function dispOpaNone(v){
			document.getElementById(v).style="display: none;opacity: 0;";
		}
	</script>
</head>
<body>
	<?php
		include('topBar.php');
		include('../back/conexao.php');
		$sql = "select * from musicas where aula='{$_SESSION['aula']}' or aula='Todos';";
		$musica = $conn->query($sql);
		$sql = "select * from apps where aula='{$_SESSION['aula']}' or aula='Todos';";
		$arrayApps = $conn->query($sql);
		$conn->close();
	?>
	<div class="card text-center conteudo" id="primeiro"> <!--Sobre o Site-->
	  	<div class="card-header">
	    	Indicações - Músicas e Aplicativos</b>
	  	</div>
	  	<div class="card-body">
	    	<h5 class="card-title" style="margin-bottom: 5px;">Indicações</h5>
    		<p class="card-text" style="margin-bottom: 25px;">Aqui você recebe indicações sobre músicas e aplicativos que te ajudarão em seu desenvolvimento musical</p>
			<table class="table tblPadrao"> <!--Area de Click-->
    			<thead class="thead-dark">
				    <tr>
				      	<th scope="col" id="areaMusic" onclick="mostraTbl('m')">Músicas</th>
				    </tr>
			  	</thead>
		  	</table>
		  	<div id="tblMusic">
		    	<table class="table tblPadrao">
				  	<thead>
					    <tr>
					      	<th scope="col">#</th>
					      	<th scope="col">Nome</th>
					      	<th scope="col">Recomendações</th>
					    </tr>
				  	</thead>
				  	<tbody>
				  		<?php
				  			$entrou = 0;
				  			while($linha = $musica->fetch_array()){
				  				$entrou++;
			  			?>
				  		<tr>
					      	<th scope="row"><?php echo $entrou;?></th>
					      	<td><a href="<?php echo $linha['url'];?>" target="_blank"><?php echo $linha['nome'];?></a></td>
					      	<td><?php echo $linha['recomendacao'];?></td>
					    </tr>
					    <?php 
							} if($entrou==0){
						?>
						<tr>
							<td colspan="3" class="preenchimentoDefault">Ainda não há nenhuma Música Recomendada.</td>
						</tr>
						<?php 
							}
						?>
				  	</tbody>
				</table>
			</div>
			<br/>
			<table class="table tblPadrao"> <!--Area de Click-->
				<thead class="thead-dark"> 
				    <tr>
				      	<th scope="col" colspan="4" id="areaApp" onclick="mostraTbl('a')">Aplicativos</th>
				    </tr>
			  	</thead>
			</table>
			<div id="tblApp">
		    	<table class="table tblPadrao">
				  	<thead>
					    <tr>
					      	<th scope="col">#</th>
					      	<th scope="col">Nome</th>
					      	<th scope="col">Descrição</th>
					    </tr>
				  	</thead>
				  	<tbody>
				  		<?php
				  			$entrou1 = 0;
				  			while($linha1 = $arrayApps->fetch_array()){
				  				$entrou1=1;
			  			?>
					    <tr>
					      	<th scope="row" style="background: rgba(50,50,50,.1);border-radius: 10px;"><img src="../img/app/<?php echo $linha1['img'];?>" style="width: 35px;display:block;margin: auto;" title="<?php echo $linha1['nome'];?>" alt="Imagem do app <?php echo $linha1['nome'];?>"/></th>
					      	<td style="vertical-align:middle;"><a href="<?php echo $linha1['url'];?>" target="_blank"><?php echo $linha1['nome'];?></a></td>
					      	<td><?php echo $linha1['descricao'];?></td>
					    </tr>
					    <?php 
							} if($entrou1==0){
						?>
						<tr>
							<td colspan="3" class="preenchimentoDefault">Ainda não há nenhuma Aplicativo Recomendado.</td>
						</tr>
						<?php 
							}
						?>
				  	</tbody>
				</table>
			</div>
			<br/>
	  	</div>
	  	<div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
	</div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>