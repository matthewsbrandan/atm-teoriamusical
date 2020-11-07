<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Perfil</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<script>
		//alert('No modal de contato copiar lógica da pag index, e alterar lógica de nivelId');
		var cEmail = false;
		var cCelular = false;
		function click2(v){
            clicou = true;
			switch(v){
				case 0: //Alterado com Sucesso
					tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Alteração Realizada com Sucesso!";
					break;
				case 1: //Erro na Alteração
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Houve um erro de Alteração!";
					break;
				case 2: //Manutenção
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Estamos em Manutenção!";
					break;
				case 3: //Solicitação Enviada
					tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Solicitação Enviada com Sucesso!";
					break;
                case 4: //Email Vazio
					tituloModalResultado.innerHTML="Erro de Preenchimento";
					subTituloModalResultado.innerHTML="Preencha o Email.<br/>O usuário precisa de um email para poder Logar em sua conta.";
					break;
                case 5: //Senha de Confirmação Inválida
					tituloModalResultado.innerHTML="Erro de Preenchimento";
					subTituloModalResultado.innerHTML="A Nova Senha não corresponde a Senha de Confirmação.";
					break;
                default: clicou = false; break;
			}
            if(clicou) document.getElementById('btnChamaModalResult').click();
		}
		function fContato(v){
			switch(v){
				case '1':
					if(cEmail){
						document.getElementById('roEmail').style="display: block;";
						document.getElementById('altEmail').value="";
						document.getElementById('altEmail').style="display: none;";
						cEmail = false;
					}else{
						document.getElementById('altEmail').style="display: block;";
						document.getElementById('roEmail').style="display: none;";
						cEmail = true;
					}
					break;
				case '2':
					if(cCelular){
						document.getElementById('roCelular').style="display: block;";
						document.getElementById('altCelular').value="";
						document.getElementById('altCelular').style="display: none;";
						cCelular = false;
					}else{
						document.getElementById('altCelular').style="display: block;";
						document.getElementById('roCelular').style="display: none;";
						cCelular = true;
					}
					break;
			}
		}
        window.onload = function(){
            <?php if(isset($_GET['erro'])){?>
            click2(<?php echo $_GET['erro']; ?>);
            <?php } ?>
        };
	</script>
</head>
<body>
	<?php
		include('topBar.php');
		include('../back/conexao.php');
		$sql = "select * from alunos where nome='{$_SESSION['nome']}' and senha='{$_SESSION['senha']}';";
		$resultado = $conn->query($sql);
        $conn->close();
		$linha = $resultado->fetch_array();
		if($linha['id']!=null){
			$_SESSION['id'] = $linha['id'];
			$_SESSION['nome'] = $linha['nome'];
			$_SESSION['dtEntrada'] = $linha['dtEntrada'];
			$_SESSION['email'] = $linha['email'];
			$_SESSION['celular'] = $linha['celular'];
			$_SESSION['aula'] = $linha['aula'];
			$_SESSION['diaPg'] = $linha['diaPg'];
			$_SESSION['dia'] = $linha['dia'];
			$_SESSION['liberacao'] = $linha['liberacao'];
			$_SESSION['nivelId'] = $linha['nivelId'];
			$_SESSION['pg'] = $linha['pg'];
			$_SESSION['senha'] = $linha['senha'];
		}
	?>
	<div class="card text-center conteudo" id="perfil"> <!--Perfil-->
	  	<div class="card-header">
	    	Perfil - Usuário
	  	</div>
	  	<div class="card-body">
	    	<h5 class="card-title"><?php echo $_SESSION['nome'];?></h5> <!--Nome do Usuário-->
	    	<br/>
	    	<div class="row">
	    		<div class="col-sm-3"> <!--Horário de Aula-->
	    			<div class="card bg-light mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Horário de Aula</div>
	    				<div class="card-body">
	    					<?php echo $_SESSION['dia'];?>
	    					<br/><br/>
	    					<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalAltHorario">Alterar Dados</button>
    					</div>
    				</div>
	    		</div>
	    		<div class="col-sm-3"> <!--Data de Pagamento-->
	    			<div class="card bg-light mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Data de Pagamento</div>
	    				<div class="card-body">
	    					Próximo ao dia <?php echo $_SESSION['diaPg'];?><br/>
	    					<b>Status:</b> <?php echo $_SESSION['pg'];?>
	    					<br/><br/>
	    					<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalAltDtPagamento">Solicitar Alteração</button>
    					</div>
    				</div>
	    		</div>
	    		<div class="col-sm-3"> <!--Contato Aluno-->
	    			<div class="card bg-light mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Meus Dados</div>
	    				<div class="card-body">
	    					<b>E-mail:</b> <?php echo strlen($_SESSION['email'])>0?$_SESSION['email']:"Não Cadastrado";?><br/>
	    					<b>Whatsapp:</b> <?php echo strlen($_SESSION['celular'])>0?$_SESSION['celular']:"Não Cadastrado";?>
	    					<br/><br/>
	    					<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalAltDados">Alterar Dados</button>
    					</div>
    				</div>
	    		</div>
	    		<div class="col-sm-3"> <!--Curso-->
	    			<div class="card bg-light mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Curso</div>
	    				<div class="card-body">
	    					<h6>
	    						<?php echo $_SESSION['aula'];?><br/>(Nível Musical: <?php echo $_SESSION['nivel'];?>)
	    					</h6>
	    					<hr/>
	    					<p style="font-size: 8pt;margin: -5px 0px 0px 0px;" class="deitar">"A música pode mudar o mundo porque pode mudar as pessoas" - Bono Vox</p>
    					</div>
    				</div>
	    		</div>
	    	</div>
	    	<p class="card-text">Qualquer duvida, clique logo abaixo em 'Entrar em Contato'</p>
	    	<form>
	    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalContato">Entrar em Contato</button>
	    	</form>
	  	</div>
	  	<div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
	</div>
	<!--Modais-->
	<div class="modal fade" tabindex="-1" role="dialog" id="modalContato" aria-hidden="true"> <!--Modal Contato-->
  		<div class="modal-dialog" role="document">
		<div class="modal-content">
	  		<div class="modal-header">
		        <h5 class="modal-title">Entrar em Contato</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
		    <div class="modal-body">
		      	<form>
		      		<div class="form-group row">
	    				<label for="staticEmail" class="col-sm-2 col-form-label">Email: </label>
	    				<div class="col-sm-8">
	      					<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="mateusfleria@gmail.com">
	    				</div>
	    				<a title="Enviar msg por E-mail" style="margin-top: -3px;text-decoration:none;" href="mailto:mateusfleria@gmail.com" target="_blank" class="col-sm-2">&nbsp;<img src="../img/icones/email.png" style="width: 45px;"/></a>
	  				</div>
	  				<div class="form-group row">
	    				<label for="staticEmail" class="col-sm-2 col-form-label">WhatsApp: </label>
	    				<div class="col-sm-8">
	      					<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="(19) 99473-1016">
	    				</div>
	    				<a title="Enviar msg por WhatsApp" style="margin-top: -10px;" href="http://api.whatsapp.com/send?1=pt_BR&phone=5519994731016" class="col-sm-2" target="_blank"><img src="../img/icones/whats.png" style="width: 60px;"/></a>
	  				</div>
		      	</form>
	      	</div>
	      	<div class="modal-footer">
	    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
  		</div>
		</div>
	</div>
	<!--Modais de Alteração-->
	<div class="modal fade" tabindex="-1" role="dialog" id="modalAltHorario" aria-hidden="true"> <!--Modal Horário de Aula-->
  		<div class="modal-dialog" role="document">
		<div class="modal-content">
	  		<div class="modal-header">
		        <h5 class="modal-title">Horário de Aula</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
	      	<form action="../back/backAlt.php" method="POST" id="frmAltHora">
	      		<input type="hidden" id="idHora" name="idHora" value="<?php echo $_SESSION['id'];?>">
		    	<div class="modal-body">
	      			<div class="form-group"> <!--Semana-->
					    <label for="altSemana">Dia da Semana:</label>
				    	<select class="custom-select" id="altSemana" name="altSemana" required>
					    	<option value="Segunda" selected>Segunda-feira</option>
					    	<option value="Terça">Terça-feira</option>
					    	<option value="Quarta">Quarta-feira</option>
					    	<option value="Quinta">Quinta-feira</option>
					    	<option value="Sexta">Sexta-feira</option>
					    	<option value="Sábado">Sábado</option>
					  	</select>
					</div>
					<div class="form-group row"> <!--Nome-->
						<div class="col-sm-12">
					    	<label for="altHora">Horário de Início:</label>
					    </div>
					    <div class="col-sm-6 input-group">
					    	<select class="custom-select" id="altHora" name="altHora" required>
						    	<option>09</option><option>10</option><option>11</option>
						    	<option>12</option><option>13</option><option>14</option>
						    	<option>15</option><option>16</option><option>17</option>
						    	<option>18</option><option>19</option><option>20</option>
						  	</select>
					    	<div class="input-group-append">
    							<span class="input-group-text">horas</span>
  							</div>
					    </div>
					    <div class="col-sm-6 input-group">
						    <select class="custom-select" id="altMin" name="altMin" required>
						    	<option>00</option>
						    	<option>30</option>
						  	</select>
						  	<div class="input-group-append">
    							<span class="input-group-text">minutos</span>
  							</div>
					  	</div>
					</div>
		      	</div>
		      	<div class="modal-footer">
		      		<button type="submit" class="btn btn-primary" id="btnAltHora" name="btnAltHora">Alterar</button>
		    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
  		</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="modalAltDtPagamento" aria-hidden="true"> <!--Modal Data de Pagamento-->
  		<div class="modal-dialog" role="document">
		<div class="modal-content">
	  		<div class="modal-header">
		        <h5 class="modal-title">Data de Pagamento</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
	      	<form action="../back/backAlt.php" method="POST" id="frmAltPG">
	      		<input type="hidden" id="idPG" name="idPG" value="<?php echo $_SESSION['id'];?>">
		    	<div class="modal-body">
		      		<div class="form-group input-group"> <!--Semana-->
			    		<label class="input-group-append" for="altDataPG">
							<span class="input-group-text">Dia do Mês:</span>
						</label>
						<input type="number" class="form-control" id="altDataPG" name="altDataPG" value="1" min="1" max="28">
					</div>
					<p style="text-align:center;margin-top: -15px;font-size: 10pt;margin-bottom: 0px;color: gray;">Obs. A data de pagamento será alterada após a aprovação desta solicitação.</p>
		      	</div>
		      	<div class="modal-footer">
		      		<button type="submit" class="btn btn-primary" id="btnAltPG" name="btnAltPG">Solicitar</button>
		    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
  		</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="modalAltDados" aria-hidden="true"> <!--Modal Dados Pessoais-->
  		<div class="modal-dialog" role="document">
		<div class="modal-content">
	  		<div class="modal-header">
		        <h5 class="modal-title">Dados Pessoais</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
	      	<form action="../back/backAlt.php" method="POST" id="frmAltDados">
	      		<input type="hidden" id="idDados" name="idDados" value="<?php echo $_SESSION['id'];?>">
		    	<div class="modal-body">
	      			<div class="form-group"> <!--Email-->
		      			<label for="checkEmail">Email<span style="font-size: 8pt;">&nbsp;(Se não tiver e-mail não selecione a caixa)</span></label>
					    <div class="input-group mb-3">
						  	<div class="input-group-prepend">
						    	<div class="input-group-text">
						      		<input type="checkbox" name="checkEmail" id="checkEmail" aria-label="Validação para Email" onclick="fContato('1');"/>						      		
						    	</div>
						  	</div>
						  	<input type="text" class="form-control" placeholder="Selecione a caixa e digite o Email" id="roEmail" readonly/>
						  	<input type="email" class="form-control" name="altEmail" id="altEmail" aria-label="Email" placeholder="Digite o Email" minlength="5" maxlength="30" style="display:none;"/>
						</div>
				  	</div>
				  	<div class="form-group"> <!--Whatsapp-->
		      			<label for="checkCelular">Celular<span style="font-size: 8pt;">&nbsp;(Se não tiver whatsapp não selecione a caixa)</span></label>
					    <div class="input-group mb-3">
						  	<div class="input-group-prepend">
						    	<div class="input-group-text">
						      		<input type="checkbox" name="checkCelular" id="checkCelular" aria-label="Validação para Celular" onclick="fContato('2');"/>
						    	</div>
						  	</div>
						  	<input type="text" class="form-control" placeholder="Selecione a caixa e digite o número do Whatsapp" id="roCelular" readonly/>
						  	<input type="text" class="form-control" name="altCelular" id="altCelular" aria-label="Celular" placeholder="Selecione a caixa e digite o número do Whatsapp" minlength="10" maxlength="13" style="display:none;"/>
						</div>
				  	</div>
		      	</div>
		      	<div class="modal-footer">
		      		<button type="submit" class="btn btn-primary" id="btnAltDados" name="btnAltDados">Alterar</button>
		    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
  		</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="modalAltCurso" aria-hidden="true"> <!--Modal Curso-->
  		<div class="modal-dialog" role="document">
		<div class="modal-content">
	  		<div class="modal-header">
		        <h5 class="modal-title">Curso - Instrumento</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
	      	<form action="../back/backAlt.php" method="POST" id="frmAltCurso">
	      		<input type="hidden" id="idCurso" name="idCurso" value="<?php echo $_SESSION['id'];?>">
		    	<div class="modal-body">
		      		<div class="form-group"> <!--Instrumento-->
				    	<label for="altCurso">Aula</label>
				    	<select class="custom-select" id="altCurso" name="altCurso" required>
					    	<option>Selecione...</option>
					    	<option>Teclado</option>
					    	<option>Guitarra</option>
					    	<option>Violão</option>
					  	</select>
					</div>
	      		</div>
		      	<div class="modal-footer">
		      		<button type="submit" class="btn btn-primary" id="btnAltCurso" name="btnAltCurso">Alterar</button>
		    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
  		</div>
		</div>
	</div>
	<?php include('../modais/modalResultado.php'); ?>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>
