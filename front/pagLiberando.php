<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Liberação</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/atm.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
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
        .msg-prof{ text-align: left; }
        .msg-prof div{
            background: rgba(20,20,20,.80);
            color: #ddd;
            text-align: left;
        }
        .msg-aluno{ text-align: right; }
        .msg-aluno div{
            background: rgba(20,20,20,.15);
            color: #444;
            text-align: right;
        }
        #iMsg:hover{
            box-shadow: 1px 1px 1px black;
            color: #444;
        }
        #frmTermo b{ display: block }
        #frmTermo .active{ font-weight: 500; color: beige }
        .lista-interna li{ font-weight: 500;}
        .c-pointer{ cursor: pointer; }
        .msgNV{
            float: right;
            background-color: mediumaquamarine;
            color: white; 
            font-size: 10pt;
            border-radius: 5px;
            margin-top: -18px;
            margin-right: -5px;
            margin-left: -38px;
        }
    </style>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
    <script>
		//alert('Fazer com que o scroll do WhatsMatth sempre fique no final da conversa?');
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
                case 6: //Erro ao Aceitar os Termos
                    tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Não foi possível Aceitar os Termos, entre em contato com seu Professor para solucionar esse problema. ";
					break;
                case 7: //Termos Aceitos
                    tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML="Os termos foram aceitos e você está um passo mais próximo de fazer parte dos alunos do ATM.";
					break;
                case 8: //Erro ao Recusar os Termos
                    tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Não foi recusar os Termos!";
					break;
                default: clicou=false; break;
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
        function validaSenha(p,v){
            if(p==v){
                $('#altSenhaConf').prop('required',true);
                $('#altSenhaNova').prop('required',true);
                $('#altSenhaAt').prop('required',false);
                $('#modalAltSenha .modal-title i').html('lock_open');
                $('#legendaSenha h5').html('').append('2º Passo: <span style="font-weight: normal; font-size: 12pt">Insira a Nova Senha</span>');
                $('#frmAltSenha div.form-group:nth-child(1)').addClass('d-none');
                $('#frmAltSenha div.form-group:nth-child(2)').addClass('d-none');
                $('#frmAltSenha div.form-group:nth-child(3)').removeClass('d-none');
                $('#frmAltSenha div.form-group:nth-child(4)').removeClass('d-none');
                $('#frmAltSenha').prop('action','../back/backAlt.php');
                $('#btnAltDadosSenha').removeClass('d-none');
            
            }else{
                $('#legendaSenha h5').addClass('rounded bg-warning p-2').html('** Senha Inválida **');
                $('#altSenhaAt').focus();
            }   
            $('#btnChamaSenha').click();
        }
        function fTrava(){
            if($('#altSenhaConf').val()==$('#altSenhaNova').val()){
                $('#travaSenha').html('done_outline').addClass('text-success').removeClass('text-danger');
                $('#btnAltDadosSenha').prop('disabled',false).attr('title','Clique para Alterar!');
            }else{
                $('#travaSenha').html('cancel').addClass('text-danger').removeClass('text-success');
                $('#btnAltDadosSenha').prop('disabled',true).attr('title','A Nova Senha e a Confimação de Senha devem ser iguais.');
            }
        }
        function preencheTermo(p){
            $('#termoModalidade button').removeClass('active');
            $('#termoModalidade button:nth-child('+p+')').addClass('active');
            if(p==1){
                $('#ulTermo li.list-group-item:nth-child(1)').html("<b>Formato:</b>O modo <em>Presencial</em> é formado de 1 aula por semana, na duração de 1 hora; além de acesso completo ao conteúdo do site <strong title='Aula de Teoria Musical'>ATM</strong>.");
                //Valor
                $('#ulTermo li.list-group-item:nth-child(2)').html("<b>Valor:</b>R$ 70,00 mensal.");
                //Condições
                $('#ulTermo li.list-group-item:nth-child(3)').html("<i class='material-icons float-right c-pointer' id='kadu' onclick='expand(1);'>keyboard_arrow_down</i><b>Condições:</b>Aqui estão algumas condições pré-determinadas para resolver possíveis imprevistos:<ul type='circle' class='pl-4 lista-interna' style='display:none;' id='ulCondicao'><li>Faltas do Aluno:</li><span class='text-muted'>Caso o aluno avise com atecedência sobre uma falta futura, a aula poderá ser remarcada para outro dia ou ficará pendente no <a href='#' onclick='inform()' class='text-primary'>banco de aulas</a>. <span class='card bg-info text-light p-2 pr-0 mb-2' id='informacao' style='display:none;'><strong>Banco de aulas</strong> é um registro que ficará em sua conta mostrando quantas aulas pendentes você tem à fazer.</span>Caso não tenha aviso, não poderá ser remarcada.</span><li>Cancelamento de aula pelo Professor:</li><span class='text-muted'>Mediante a qualquer cancelamento de aulas pelo professor, elas serão remarcadas ou serão adicionadas ao banco de aulas.</span><li>Atraso de Pagamento:</li><span class='text-muted'>As aulas <em>Presenciais</em> continuarão normalmente caso haja atraso, sendo responsabilidade do aluno combinar com o professor o acerto de pagamento. Porém, o acesso ao <strong>ATM</strong> é interrompido temporariamente, por procedimento padrão do site, e só é liberado após a efetivação do pagamento.<br/><span class='small'><hr class='mb-0'/><strong>Obs.</strong> Caso a data do pagamento não esteja num dia adequado, pode ser solicitado a alteração no próprio site.</span></span><li>Manutenção:</li><span class='text-muted'>As manutenções tem a duração máxima de 72 horas (3 dias), caso o prazo seja maior, você receberá um aviso prévio para que esteja ciente. Durante as manutenções você pode entrar em contato diretamente com seu professor pelo WhatsApp para pedir ajuda ou algum conteúdo para estar estudando durante este intervalo.</span></ul>");
                //Recomendações
                $('#ulTermo li.list-group-item:nth-child(4)').html("<i class='material-icons float-right c-pointer' id='kaduR' onclick='expand(2);'>keyboard_arrow_down</i><b>Recomendações:</b>Recomendações referente ao Material de Estudos:<br/><span style='display: none;' id='spanRecomendacao'>O site é desenvolvido <strong>somente</strong> para o uso de alunos. Sendo assim, não compartilhe sua senha e usuário para terceiros, pois isso faz com que todo os esforço para o desenvolvimento deste site, e a criação do conteúdo exposto, sejam em vão.<br/> Compartilhando aulas ou até mesmo o login deste site faz com que o site(e eu, como Professor) perca potênciais alunos.<br/><strong>Lembrando:</strong> Quanto mais alunos integrarem o curso, terei uma maior motivação para estar melhorando e aprimorando o conteúdo, e terei como investir mais nesta Plataforma de Estudos, o que benefícia a todos.</span>");
                //Outros
                $('#ulTermo li.list-group-item:nth-child(5)').html("<b>Outros:</b>Não especificado.");
                $('#btnAceitarTermo').val('Presencial');
            }else
            if(p==2){
                //Formato
                $('#ulTermo li.list-group-item:nth-child(1)').html("<b>Formato:</b>O modo <em>Semi-Presencial</em> é formado de 1 aula por mês para tirar dúvidas, na duração de 1 hora, e principalmente do acesso completo ao conteúdo do site <strong title='Aula de Teoria Musical'>ATM</strong>, onde será direcionado pela metodologia de níveis da Plataforma.");
                //Valor
                $('#ulTermo li.list-group-item:nth-child(2)').html("<b>Valor:</b>R$ 50,00 mensal.");
                //Condições
                $('#ulTermo li.list-group-item:nth-child(3)').html("<i class='material-icons float-right c-pointer' id='kadu' onclick='expand(1);'>keyboard_arrow_down</i><b>Condições:</b>Aqui estão algumas condições pré-determinadas para resolver possíveis imprevistos:<ul type='circle' class='pl-4 lista-interna' style='display:none;' id='ulCondicao'>"
                    + "<li>Faltas do Aluno:</li><span class='text-muted'>Caso o aluno avise com atecedência sobre uma falta futura, a aula poderá ser remarcada para outro dia ou ficará pendente no <a href='#' onclick='inform()' class='text-primary'>banco de aulas</a>. <span class='card bg-info text-light p-2 pr-0 mb-2' id='informacao' style='display:none;'><strong>Banco de aulas</strong> é um registro que ficará em sua conta mostrando quantas aulas pendentes você tem à fazer.</span>Caso não tenha aviso, não poderá ser remarcada.</span>"
                    + "<li>Cancelamento de aula pelo Professor:</li><span class='text-muted'>Mediante a qualquer cancelamento de aulas pelo professor, elas serão remarcadas ou serão adicionadas ao banco de aulas.</span>"
                    + "<li>Atraso de Pagamento:</li><span class='text-muted'>Caso ocorra algum atraso, tente comunicar o professor antecipadamente para que sua conta no <strong>ATM</strong> não seja temporariamente bloqueada. O bloqueio é procedimento padrão do site, e só é liberado após a efetivação do pagamento.<br/><span class='small'><hr class='mb-0'/><strong>Obs.</strong> Caso você avise antecipadamente a data pode ser realocada e impedir o bloqueio da conta.</span></span><li>"
                    + "Manutenção:</li><span class='text-muted'>As manutenções tem a duração máxima de 72 horas (3 dias), caso o prazo seja maior, você receberá um aviso prévio para que esteja ciente. Durante as manutenções você pode entrar em contato diretamente com seu professor pelo WhatsApp para pedir ajuda ou algum conteúdo para estar estudando durante este intervalo.</span></ul>");
                //Recomendações
                $('#ulTermo li.list-group-item:nth-child(4)').html("<i class='material-icons float-right c-pointer' id='kaduR' onclick='expand(2);'>keyboard_arrow_down</i><b>Recomendações:</b>Recomendações referente ao Material de Estudos:<br/><span style='display: none;' id='spanRecomendacao'>O site é desenvolvido <strong>somente</strong> para o uso de alunos. Sendo assim, não compartilhe sua senha e usuário para terceiros, pois isso faz com que todo os esforço para o desenvolvimento deste site, e a criação do conteúdo exposto, sejam em vão.<br/> Compartilhando aulas ou até mesmo o login deste site faz com que o site(e eu, como Professor) perca potênciais alunos.<br/><strong>Lembrando:</strong> Quanto mais alunos integrarem o curso, terei uma maior motivação para estar melhorando e aprimorando o conteúdo, e terei como investir mais nesta Plataforma de Estudos, o que benefícia a todos.</span>");
                //Outros
                $('#ulTermo li.list-group-item:nth-child(5)').html("<b>Outros:</b>Não especificado.");
                $('#btnAceitarTermo').val('Semi-Presencial');
            }
        }
        function termoAceito(){
            $('#btnChamaTermo').removeClass('btn-warning').addClass('btn-outline-light').html("Termos<i class='material-icons float-right ml-1'>brightness_auto</i>");
            $('#btnAceitarTermo').removeClass('btn-primary').addClass('btn-outline-danger').html('<strong>Recusar!</strong>').val('Recusar');
            $('#termoModalidade button:not(.active)').remove();
        }
        function expand(p){
            if(p==1){ elemento = "ulCondicao"; ka = "kadu"; }
            else if(p==2){ elemento = "spanRecomendacao"; ka="kaduR";}
            v = $('#'+elemento).is(':visible')==true?'keyboard_arrow_down':'keyboard_arrow_up';
            $('#'+elemento).toggle('slow');
            $('#'+ka).html(v);
        }
        function inform(){
            $('#informacao').toggle('easing');
        }
        function msgNotView(p){
            if(p!=0){
                $('#linkWM').html("WhatsMatth<span class='msgNV px-2' title='Mensagem Não Lida'>"+p+"</span><i class=\"material-icons float-right ml-1\">announcement</i>");
            }
        }
        window.onload = function(){
            <?php if(isset($_GET['erro'])){ echo "click2({$_GET['erro']});"; } ?>
            <?php if(isset($_GET['valida'])){ echo "validaSenha('{$_SESSION['senha']}','".md5($_POST['altSenhaAt'])."');";} ?>
            <?php echo "preencheTermo(".($_SESSION['modalidade']=="Presencial"?1:2).");"; ?>
            <?php if($_SESSION['termo']==0){ echo " $('#btnChamaTermo').click();"; }else{ echo " termoAceito();"; } ?>
            <?php if(isset($_GET['wm'])){
                include('../back/conexao_wm.php');
                $sql = "update chat set msg_view=1 where id_usuario={$_SESSION['id']} and msg_user=0 and msg_view=0;";
                $conn->query($sql);
                $conn->close();
                echo "$('#btnWM').click();";
            } ?>
            <?php
                include('../back/conexao_wm.php');
                $sql = "select count(*) msg from chat where id_usuario={$_SESSION['id']} and msg_user=0 and msg_view=0;";
                $data = $conn->query($sql);
                $conn->close();
                if($res = $data->fetch_array()){ echo " msgNotView(".$res['msg'].");"; }
            ?>
        };
       $(function(e) {
            v = $('#wmFim').offset();
            $('#modalBodyWM').animate({scrollTop:4000},1000);
        });
    </script>
</head>
<body>
	<?php
		include('../back/conexao.php');
		$sql = "select * from alunos where nome='{$_SESSION['nome']}' and senha='{$_SESSION['senha']}';";
		$resultado = $conn->query($sql);
        $conn->close();
		$linha = $resultado->fetch_array();
        //Usuário
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
			$_SESSION['modalidade'] = $linha['modalidade'];
			$_SESSION['termo'] = $linha['termo'];
		}
	?>
    <!--Geral-->
	<div class="card text-center conteudo" id="geral">
        <!--Header-->
	  	<div class="card-header">
            <a href="../index.php" class="text-secondary float-right px-2 pb-1 m-0 h5" style="width: 30px;transition: 1s background;" id="aVoltar" title="Voltar para a página de Login">&times;</a>
            <a href="pagLiberando.php" id="aReload"><h5 style="margin-left: 30px;"> Esperando Liberação do Professor </h5></a>
	  	</div>
	  	<div class="card-body pt-3">
	    	<h5 class="card-title pt-0"><?php echo $_SESSION['nome'];?></h5> <!--Nome do Usuário-->
            <hr class="bg-secondary mt-2"/>
            <p class="text-center mt-0 mb-4" style="max-width: 700px;margin:auto;">Seu acesso será liberado quando todos os dados e termos forem acertados com o professor. Enquanto isso você pode alterar suas informações nesta página ou mandar suas dúvidas pelo WhatsMatth.</p>
	    	<div class="row">
                <!--Horário de Aula-->
	    		<div class="col-sm-3">
	    			<div class="card bg-dark mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Horário de Aula</div>
	    				<div class="card-body">
	    					<?php echo $_SESSION['dia'];?>
	    					<br/><br/>
	    					<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalAltHorario">Alterar Dados</button>
    					</div>
    				</div>
	    		</div>
	    		<!--Data de Pagamento-->
                <div class="col-sm-3">
	    			<div class="card bg-dark mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Data de Pagamento</div>
	    				<div class="card-body">
	    					Próximo ao dia <?php echo $_SESSION['diaPg'];?><br/>
	    					<b>Status:</b> <?php echo $_SESSION['pg'];?>
	    					<br/><br/>
	    					<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalAltDtPagamento">Solicitar Alteração</button>
    					</div>
    				</div>
	    		</div>
	    		<!--Contato Aluno-->
                <div class="col-sm-3">
	    			<div class="card bg-dark mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Meus Dados</div>
	    				<div class="card-body">
	    					<b>E-mail:</b> <?php echo strlen($_SESSION['email'])>0?$_SESSION['email']:"Não Cadastrado";?><br/>
	    					<b>Whatsapp:</b> <?php echo strlen($_SESSION['celular'])>0?$_SESSION['celular']:"Não Cadastrado";?>
	    					<br/><br/>
	    					<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalAltDados">Alterar Dados</button>
	    					<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalAltSenha" id="btnChamaSenha">Alterar Senha</button>
    					</div>
    				</div>
	    		</div>
                <!--Curso-->
	    		<div class="col-sm-3">
	    			<div class="card bg-dark mb-3 " style="max-width: 22rem;">
	    				<div class="card-header">Curso (<span style="font-weight: 500"><?php echo $_SESSION['modalidade'];?></span>)</div>
	    				<div class="card-body">
	    					<h6><?php echo $_SESSION['aula'];?> <i class="material-icons btn m-0 p-0" data-toggle="modal" data-target="#modalAltCurso" style="vertical-align: -6px;">create</i></h6>
	    					<hr/>
	    					<p style="font-size: 8pt;margin: -5px 0px 0px 0px;" class="deitar">"A música pode mudar o mundo porque pode mudar as pessoas" - Bono Vox</p>
    					</div>
    				</div>
	    		</div>
	    	</div>
            
            <a href="#" class="btn btn-warning mb-2" style="font-weight: 500; width: 180px;" title="Entre em Contato"  data-toggle="modal" data-target="#modalTermos" id="btnChamaTermo">Aceitar Termos<i class="material-icons float-right ml-1">brightness_auto</i></a>
	    	<p class="card-text">Qualquer dúvida, clique abaixo para entrar em seu Chat e falar diretamente com o professor.</p>
            <!--Acionar WhatsMatth-->
	    	<form><a href="pagLiberando.php?wm=1" class="btn btn-danger" title="Entre em Contato" id="linkWM">WhatsMatth<i class="material-icons float-right ml-1">announcement</i></a><button type="button" class="btn btn-danger d-none" id="btnWM" data-toggle="modal" data-target="#modalWM"></button></form>
	  	</div>
	  	<div class="card-footer text-muted">
	    	Prof. Mateus Brandão
	  	</div>
	</div>
	<!--Modais-->
    <!--WhatsMatth-->
	<div class="modal fade" tabindex="-1" role="dialog" id="modalWM" aria-hidden="true">
  		<div class="modal-dialog" role="document">
		<div class="modal-content">
	  		<div class="modal-header bg-dark text-light rounded-0 pl-2">
                <?php
                    include('../back/conexao_wm.php');
                    $sql = "select * from usuario where id_user='{$_SESSION['id']}' and usuario='{$_SESSION['nome']}' and senha='".$_SESSION['senha']."' and site='ATM';";
                    $dataLog = $conn->query($sql);
                    $resLog = $dataLog->fetch_array();
                    if(!$resLog){
                        $sql = "call userAtm('{$_SESSION['id']}','{$_SESSION['nome']}','{$_SESSION['senha']}')";
                        $conn->query($sql);
                        $sql = "select * from usuario where id_user='{$_SESSION['id']}' and usuario='{$_SESSION['nome']}' and senha='".$_SESSION['senha']."' and site='ATM';";
                        $dataLog = $conn->query($sql);
                        $resLog = $dataLog->fetch_array();
                    }
                    $conn->close();
                ?>
                <i class="material-icons float-right mr-1 p-1">announcement</i>
		        <h5 class="modal-title">WhatsMatth </h5><span class="<?php echo $resLog?'bg-success':'bg-danger';?>" style="width: 10px;height: 10px;border-radius: 10px;"></span>
		        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
		    <div class="modal-body pb-0" id="modalBodyWM" style="max-height: 400px; overflow: auto;">
                <?php
                    echo $resLog?'':'<h5 class=\'text-center p-1 text-danger rounded\' style=\'background: rgba(0,0,0,.1)\'>O WhatsMatth está fora do Ar!</h5>';
                    include('../back/conexao_wm.php');
                    $sql = "select * from chat where id_usuario='{$resLog['id']}';";
                    $dataChat = $conn->query($sql);
                    while($resChat = $dataChat->fetch_array()){
                ?>
                    <div class="w-100 mb-2 <?php echo $resChat['msg_user']?'msg-aluno':'msg-prof'; ?>">
                        <div class="<?php echo $resChat['msg_user']?'rounded-left p-1 pr-2 pl-3':'rounded-right p-1 pl-2 pr-3';?> d-inline-block" style=" max-width: 60%;">
                            <?php echo $resChat['msg']; ?>
                        </div>
                    </div>
                <?php } ?>
<!--                <div class="w-100 mb-2 msg-aluno"><div class="rounded-left p-1 pr-2 pl-3 d-inline-block" style=" max-width: 60%;">...</div></div>-->
                <span id="wmFim"></span>
	      	</div>
            <form method="POST" id="formWM" action="../back/backMsg.php?pidU='<?php echo $resLog['id'];?>'&pmsgU=true">
	      	<div class="modal-footer p-2">
                <div class="input-group">
                    <textarea class="form-control" aria-label="With textarea" id="pmsg" name="pmsg" style="height: 40px" placeholder="Digite uma mensagem..." required></textarea>
                    <div class="input-group-prepend">
                        <a href="#" onclick="document.getElementById('formWM').submit();">
                            <i class="material-icons input-group-text rounded-right" style="background: transparent;padding-top: 8px;transition: 1s background;" id="iMsg" >near_me</i>
                        </a>
                    </div>
                </div>
	      	</div>
            </form>
  		</div>
		</div>
	</div>
	<!--Aceitar Termos-->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTermos" aria-hidden="true">
  		<div class="modal-dialog" role="document">
		<div class="modal-content">
	  		<div class="modal-header">
		        <h5 class="modal-title">Aceitar Termos<i class="material-icons p-1" style="vertical-align: -4px;">brightness_auto</i></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
	      	<form action="../back/backAlt.php" method="POST" id="frmTermo">
	      		<input type="hidden" id="idTermo" name="idTermo" value="<?php echo $_SESSION['id'];?>">
		    	<div class="modal-body">
                    <!--Header-->
		      		<div class="form-group mb-4">
                        <div class="btn-group float-right" role="group" id="termoModalidade">
                          <button type="button" class="btn btn-outline-warning btn-sm" onclick="preencheTermo(1)">Presencial</button>
                          <button type="button" class="btn btn-outline-warning btn-sm" onclick="preencheTermo(2)">Semi-Presencial</button>
                        </div>
                        <h5 style="margin-top: 3px;">Aula de Teoria Musical</h5>
                    </div>
                    <ul class="list-group" id="ulTermo">
                        <!--Formato-->
                        <li class="list-group-item"></li>
                        <!--Valor-->
                        <li class="list-group-item"></li>
                        <!--Condições-->
                        <li class="list-group-item"></li>
                        <!--Recomendações-->
                        <li class="list-group-item"></li>
                        <!--Outros--><li class="list-group-item"></li>
                    </ul>
	      		</div>
		      	<div class="modal-footer">
		      		<button type="submit" class="btn btn-primary btn-block" id="btnAceitarTermo" name="btnAceitarTermo">Aceitar</button>
		      	</div>
	      	</form>
  		</div>
		</div>
	</div>
    <!--Modais de Alteração-->
    <!--Modal Horário de Aula-->
	<div class="modal fade" tabindex="-1" role="dialog" id="modalAltHorario" aria-hidden="true">
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
	<!--Modal Data de Pagamento-->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAltDtPagamento" aria-hidden="true">
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
	<!--Modal Dados Pessoais-->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAltDados" aria-hidden="true">
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
    <!--Modal Senha-->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAltSenha" aria-hidden="true">
  		<div class="modal-dialog" role="document">
		<div class="modal-content">
            <!--Header-->
	  		<div class="modal-header">
		        <h5 class="modal-title">Alteração de Senha <i class="material-icons float-left mt-1">lock</i></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
	      	<form action="pagLiberando.php?valida" method="POST" id="frmAltSenha">
	      		<input type="hidden" id="idSenha" name="idSenha" value="<?php echo $_SESSION['id'];?>">
		    	<div class="modal-body">
                    <!--LEGENDA-->
                    <div class="input-group mb-3 d-block" id="legendaSenha">
                        <h5 class="text-center">1º Passo: <span style="font-weight: normal; font-size: 12pt">Validar Senha</span></h5>
                    </div>
                    <!--Senha Atual-->
	      			<div class="form-group">
					    <div class="input-group mb-3">
						  	<input type="password" class="form-control" name="altSenhaAt" id="altSenhaAt" aria-label="Senha Atual" placeholder="Digite a Senha Atual..." minlength="6" required/>
						</div>
                        <button type="submit" class="btn btn-primary btn-block" id="btnValidaSenha" name="btnValidaSenha">Validar</button>
				  	</div>
                    <!--Nova Senha-->
	      			<div class="form-group d-none">
					    <div class="input-group mb-3">
						  	<input type="password" class="form-control" name="altSenhaNova" id="altSenhaNova" aria-label="Nova Senha" placeholder="Digite a nova Senha..." minlength="6" maxlength="20"/>
						</div>
				  	</div>
                    <!--Confirmação de Senha-->
	      			<div class="form-group d-none">
					    <div class="input-group mb-3">
						  	<input type="password" class="form-control" name="altSenhaConf" id="altSenhaConf" aria-label="Confirmar nova Senha" placeholder="Confirme a nova Senha..." minlength="6" onchange="fTrava()"/>
                            <div class="input-group-append">
    							<span class="input-group-text bg-white"><i class="material-icons text-danger" id="travaSenha">cancel</i></span>
  							</div>
						</div>
				  	</div>
		      	</div>
		      	<div class="modal-footer">
		      		<button type="submit" class="btn btn-primary d-none" id="btnAltDadosSenha" name="btnAltDadosSenha" disabled>Alterar</button>
		    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
  		</div>
		</div>
	</div>
	<!--Modal Curso-->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAltCurso" aria-hidden="true">
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
		      		<button type="submit" class="btn btn-primary" id="btnAltCurso" name="btnAltCurso">Solicitar</button>
		    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
  		</div>
		</div>
	</div>
	<?php include('../modais/modalResultado.php');?>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>
