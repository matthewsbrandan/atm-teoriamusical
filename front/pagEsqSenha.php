<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Esqueci Minha Senha</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" type="text/css" href="../css/scroll.css"/>
    <style>
        #aReload:hover {
            text-decoration: none;
            color: white;
        }
        #aVoltar:hover {
            background: rgba(230,230,230,.8);
            text-decoration: none;
        }
        #geral{
            background: rgba(20,20,25,.9);
            color: #ddd;
            min-height: 100vh;
            border-radius: 0px;
        }
        #geral .card-header{ background: #090909;}
        label{
            background: rgba(0,0,0,.4);
            display: block;
            margin-bottom: 0px;
        }
        input{ text-align: center; }
    </style>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
    <script>
		function click3(t,s){
            tituloModalResultado.innerHTML=t;
            subTituloModalResultado.innerHTML=s;
			document.getElementById('btnChamaModalResult').click();
		}
        function carrega(p){
            if(p==2){
                $('.card-title').html('Finalizando...');
                $('.card-desc').html('Seu Perfil foi localizado e sua senha temporária foi gerada. Clique em \'Finalizar\' para concretizar a alteração de sua senha. <br/><span class="small"><b>Obs.</b> Guarde sua senha temporária, e se desejar, após entrar em sua conta vocês poderá alterá-la a qualquer momento.</span>');
                $('.row:first').addClass('d-none');
                $('.row:last').removeClass('d-none');
            }else if(p==3){
                $('.card-title').html('Finalizado!');
                $('.card-desc').html('Agora você está pronto para entrar em sua conta com sua nova senha.');
                $('.row:first').addClass('d-none');
                $('.row:last').removeClass('d-none');
                $('.card-header').html('Finalizado!');
                $('.row:last .card-body div').addClass('d-none');
                $('#btnRecupera').html('- Retornar para o Login -').removeClass('btn-warning').addClass('btn-primary');
                $('form').attr('action','index.php');
            }
        }
        function copyTemp(){
            $('#senhaTemp').select();
            document.execCommand('copy');
            click3('Copiado com Sucesso!','A sua senha temporária foi copiada para sua área de transferência.');
        }
        window.onload = function(){
        <?php if(isset($_POST['esqNome'])){
            include('../back/conexao.php');
            $sql = "select * from alunos where nome='{$_POST['esqNome']}' and email='{$_POST['esqEmail']}' and aula='{$_POST['esqAula']}';";
            $data = $conn->query($sql);
            $res = $data->fetch_assoc();
            $conn->close();
            if($res['id']){
        ?>  carrega(2);
        <?php }else{ echo "click3('Falha não Autenticação!','Usuário não foi encontrado, tente novamente.<br/>Caso tenha esquecido seus dados peça ajuda ao seu professor.');"; } }else if(isset($_POST['senhaTemp'])){ 
            include('../back/conexao.php');
            $sql="update alunos set senha='".md5($_POST['senhaTemp'])."' where id='".$_POST['recId']."';";
            $conn->query($sql);
            if(isset($conn->error)&&!empty($conn->error)){
                click3('Erro de Atualização de Senha','Peça ajuda ao seu professor para fazer a atualização da senha, ou tente novamente.');
            }else{
        ?>  carrega(3);
        <?php } $conn->close(); } ?>
        };
    </script>
</head>
<body>
	<div class="card text-center conteudo" id="geral"> <!--Geral-->
	  	<div class="card-header">
            <a href="../index.php" class="text-secondary float-right px-2 pb-1 m-0 h5" style="width: 30px;transition: 1s background;" id="aVoltar" title="Voltar para a página de Login">&times;</a>
            <a href="pagEsqSenha.php" id="aReload"><h5 style="margin-left: 30px;"> Procedimento para Recuperação de Senha </h5></a>
	  	</div>
	  	<div class="card-body">
	    	<h5 class="card-title">Autenticando...</h5> <!--Autenticação de Usuário-->
            <hr class="bg-secondary mt-2"/>
            <p class="text-center mt-0 mb-4 card-desc" style="max-width: 700px;margin:auto;">
               Para sua segurança, precisamos que confirme alguns de seus dados para localizar seu perfil e permitir a alteração de senha com segurança.<br/><span class="small"><b>Obs.</b> Nome, Email e Aula devem ser os já cadastrados no site. Caso algum desses campos não for compatível ao cadastrado, você não terá acesso a alteração de Senha.</span>
            </p>
            <!--Autenticação-->
	    	<div class="row">
	    		<div class="m-auto">
	    			<div class="card bg-dark mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Dados de Confirmação do Usuário</div>
                        <form action="pagEsqSenha.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="rounded-top" for="esqNome">Nome:</label>
                                    <input type="text" class="form-control" id="esqNome" name="esqNome" placeholder="Digite seu nome..." autofocus required>
                                </div>
                                <div class="form-group">
                                    <label class="rounded-top" for="esqEmail">Email:</label>
                                    <input type="email" class="form-control" id="esqEmail" name="esqEmail" placeholder="Digite seu email..." required>
                                </div>
                                <div class="form-group">
                                    <label class="rounded-top" for="esqAula">Aula:</label>
                                    <select class="form-control" id="esqAula" name="esqAula" required>
                                        <option>Selecione...</option>
                                        <option>Teclado</option>
                                        <option>Violão</option>
                                        <option>Guitarra</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-sm" id="btnAutentica" name="btnAutentica">Próxima Etapa</button>
                            </div>
                        </form>
    				</div>
	    		</div>
	    	</div>
            <!--Recupera-->
            <div class="row d-none">
	    		<div class="m-auto">
	    			<div class="card bg-dark mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Recuperação de Senha</div>
                        <form action="pagEsqSenha.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="rounded-top h5 p-1"><?php echo $res['nome']; ?></label>
                                    <input type="hidden" id="recId" name="recId" value="<?php echo $res['id']; ?>">
                                </div>
                                <div class="form-group btn btn-block" style="background: rgba(200,200,200,.1)">
                                    <h5>Senha Temporária</h5>
                                    <input type="text" name="senhaTemp" id="senhaTemp" class="form-control" value="<?php echo substr((md5(time())),0,6); ?>" readonly>
                                    <a href="#" class="btn btn-secondary btn-sm mt-2">Copiar<i class="material-icons float-right pl-2" onclick="copyTemp()">file_copy</i></a>
                                </div>
                                <button type="submit" class="btn btn-warning text-light btn-block" id="btnRecupera" name="btnRecupera">Finalizar<i class="material-icons float-right pl-2">check</i></button>
                            </div>
                        </form>
    				</div>
	    		</div>
	    	</div>
	    	<p class="card-text">Qualquer problema, entre em contato com seu professor para esclarecimento de suas dúvidas.</p>
	  	</div>
	  	<div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
	</div>
	<?php include('../modais/modalResultado.php'); ?>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>
