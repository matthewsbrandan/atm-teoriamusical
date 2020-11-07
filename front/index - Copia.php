<!doctype html>
<html lang="pt-br">
<head>
	<title>Aula de Música</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<style>
		body{
			background: url("../img/fundo/fone.jpg");
            padding: 0px;
            overflow-x: hidden;
		}
        /* Header */
        #hNavegacao{ width: 100vw; }
        header{
            position: fixed;
            color: #ddd;
            background: rgba(03, 07, 11,.4);
            z-index: 100;
            transition: .7s background;
        }
        header nav{
            min-height: 50px;
        }
        header:hover{
            background: rgba(03, 07, 11,1);
        }
        header ul li,#btnScrAula{
            background: rgba(03, 07, 11,.6);
            text-align: center;
            cursor: pointer;
            max-height: 40px;
            width: 200px;
            padding: 5px;
/*            float: right;*/
            border-radius: 6px;
            transition: .7s background;
        }
        header ul li:last-child{
            margin-left: 4px;
            margin-right: 15px;
        }
        header ul li:hover,#btnScrAula:hover{
            background: rgba(103, 107, 111,.4);
        }
        /* Sessão - Aula de Teoria Músical */
        div#contWall{
            width: 100vw;
            height: 100vh;
            margin: 0px;
            background: url("../img/fundo/100992.jpg");
            background-size: cover;
        }
        #hgTitulo{
            color: #bbb;
            text-align: center;
            margin: 0px;
            padding: 0px;
        }
        #hgTitulo h1{
            font-size: 48pt;
        }
        #hgTitulo h2{
            color: #999;
            margin-top: -8px;
            font-size: 14pt;
        }
        /* Sessão - Acesse o Site */
        div#contLog{
            width: 100vw;
            height: 100vh;
            padding-top: 13vh;
            position: static;
            display: block;
        }
		div#login{
            display: block;
			margin-left: auto;
			margin-right: auto;
		}
		p#descricao{
			margin-top: 68px;
			border-top: 1px solid rgba(0,0,0,.3);
			text-align: center;
			color: rgba(0,0,0,.8);
			font-size: 9pt;
		}
		fieldset div.form-group{
			padding-left: 10px;
			padding-right: 10px;
		}
        /* Sessão - Sobre */
        div#contDivulga div.container-fluid{
            width: 100vw;
            height: 100vh;
            padding-top: 54px;
            display: block;
            max-height: 100%;
            overflow-x: auto;
            margin: auto;
        }
        #wrapFig{
            background: black;
            position: absolute;
        }
        figure{
            float: left;
            background: gainsboro;
            display: block;
            margin: auto;
            border-radius: 8px;
            text-align: center;
        }
        figure h2{
            font-size: 11pt;
            background: #191921;
            color: gainsboro;
            padding: 1px;
            margin-bottom: 1px;
        }
        figure img.imgSobre{
            display: block;
            margin: auto;
        }
        figure figcaption{
            display: none;
        }
	</style>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
	<script>
        //Variáveis
		var visivel = false;
		var pag = 1;
		var senha = false;
		var cEmail = false;
		var cCelular = false;
        //Validação de Cadastro
		function ver_senha(){
			if(visivel){
				document.getElementById('senha').type = "password";
				document.getElementById('iconVer').style = "display: block;";
				document.getElementById('iconNaoVer').style = "display: none;";
				visivel = false;
			}else{
				document.getElementById('senha').type = "text";
				document.getElementById('iconVer').style = "display: none;";
				document.getElementById('iconNaoVer').style = "display: block;";
				visivel = true;
			}
		}
		function validaSenha(){
			if(document.getElementById('cadSenha').value==document.getElementById('confSenha').value){
				document.getElementById('confSenha').style="background: transparent;";
				senha=true;
			}else{
				document.getElementById('confSenha').style="background: rgba(200,0,0,.3);";
				senha=false;
			}
		}
		function validaCad(){
			var retorno = senha;
			if(!senha){
				alert("Senha diferentes");
			}
			return retorno;
		}
		function fContato(v){
			switch(v){
				case '1':
					if(cEmail){
						document.getElementById('roEmail').style="display: block;";
						document.getElementById('cadEmail').value="";
						document.getElementById('cadEmail').style="display: none;";
						cEmail = false;
					}else{
						document.getElementById('cadEmail').style="display: block;";
						document.getElementById('roEmail').style="display: none;";
						cEmail = true;
					}
					break;
				case '2':
					if(cCelular){
						document.getElementById('roCelular').style="display: block;";
						document.getElementById('cadCelular').value="";
						document.getElementById('cadCelular').style="display: none;";
						cCelular = false;
					}else{
						document.getElementById('cadCelular').style="display: block;";
						document.getElementById('roCelular').style="display: none;";
						cCelular = true;
					}
					break;
			}
		}
        //Modal Resultado
        function click2(v){
			switch(v){
				case 0: //Cadastrado com Sucesso
					tituloModalResultado.innerHTML="Parabéns";
					subTituloModalResultado.innerHTML = "O Usuário foi Cadastrado com Sucesso!";
					break;
				case 1: //Erro no Casdatramento
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Houve um erro de Cadastramento!";
					break;
				case 2: //Usuário não encontrado
					tituloModalResultado.innerHTML="Desculpe";
					subTituloModalResultado.innerHTML="Usuário não Encontrado!";
					break;
				case 3: //Esperando Liberação do Professor
					tituloModalResultado.innerHTML="Aguarde..";
					subTituloModalResultado.innerHTML="Esperando Liberação do Professor!";
					break;
				case 4: //Esperando Liberação do Professor
					tituloModalResultado.innerHTML="Login Inspirou..";
					subTituloModalResultado.innerHTML="Logue novamente para acessar sua conta!";
					break;
				case 5: //Erro de Seleção de Aula
					tituloModalResultado.innerHTML='Desculpe';
					subTituloModalResultado.innerHTML='O curso do Aluno não foi Identificado. Tente logar novamente.';
					break;
				case 6:
					tituloModalResultado.innerHTML='Desculpe';
					subTituloModalResultado.innerHTML='Houve um erro ao atualizar o seu Nível Musical.';
					break;
			}
			document.getElementById('btnChamaModalResult').click();
		}
		//Redimensionamento
        function redimensionar(){
            var altWindowH = ($(window).height());
            var altWindowW = ($(window).width());
            $('body').css('max-width',altWindowW);
            $('#contLog').css('width',altWindowW);
            $('#contLog').css('height',altWindowH);
            $('#contLog').css('padding-top',altWindowH*.13);
            $('#contWall').css('width',altWindowW);
            $('#contWall').css('height',altWindowH);
            $('#contWall').css('padding-top',altWindowH*.30);
            $('#contDivulga').css('width',altWindowW);
            $('#contDivulga').css('height',altWindowH);
            $('#hNavegacao').css('width',altWindowW);
            redimensImg();
        }
        function redimensImg(){
            var altWindowH = ($(window).height());
            var altWindowW = ($(window).width());
            if(altWindowH>altWindowW){
                //Pegar pela Largura
                $('.imgSobre').css('width',altWindowW-30);
            }else{
                //Pegar pela Altura
                $('.imgSobre').css('height',altWindowH-100);
            }
            $('.container-fluid').css('width',$('.imgSobre').width()+30);
            $('figure').css('width',$('.imgSobre').width()).css('height',$('.imgSobre').height()+25);
        }
        $(function(e){
           redimensionar();
           $(window).resize(function(e){
               redimensionar();
           });
           $('#btnScrAula').click(function(e){
               $('html,body').animate({scrollTop:0},1000);
           });
           $('#btnScrLogar').click(function(e){
               var scrWindowH = $(window).height();
               $('html,body').animate({scrollTop: scrWindowH},1000);
           });
           $('#btnScrSobre').click(function(e){
               var scrWindowH = $(window).height();
               $('html,body').animate({scrollTop:(scrWindowH)*2},1000);
           });
        });
            //Função Onload
        window.onload = function(){
            <?php if(isset($_GET['erro'])){ if($_GET['erro']>=0&&$_GET['erro']<7){?>      
                click2(<?php echo $_GET['erro']; ?>);
            <?php }} ?>
        };
	</script>
</head>
<body>
    <!-- Cabeçalho -->
    <header id="hNavegacao"> 
        <span id="btnScrAula" style="float: left;margin-top:7px;margin-left: 15px;">
             Aula de Teoria Músical
        </span>
        <nav class="navbar navbar-expand-lg navbar-dark" style="float:right;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	       <span class="navbar-toggler-icon"></span>
  	        </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" >
                    <li id="btnScrLogar"> Acesse o Site </li>
                    <li id="btnScrSobre"> Sobre </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Aula de Teoria Musical -->
    <div id="contWall">
        <hgroup id="hgTitulo">
            <h1>Aula de Teoria Musical</h1>
            <h2>Mateus Brandão</h2>
        </hgroup>
    </div>
    <!-- Acesso o Site -->
    <div id="contLog" class="content">
<!--        style="width: 350px;" -->
	   <div class="card bg-light col-lg-4 col-md-6 col-sm-10"  id="login">
            <!--Login-->
            <form method="POST" action="../back/backLogin.php" id="formLogin">
                <div class="card-header">Aulas de Música</div>
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <div class="input-group mb-3"> <!--Nome-->
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">perm_identity</i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Usuário" aria-label="Nome do Usuário" aria-describedby="Nome do Usuário" minlength="2" maxlength="30" required/> <!--Nome-->
                    </div>
                    <div class="input-group mb-3"> <!--Senha-->
                        <div class="input-group-prepend" style="cursor: pointer;" onclick="ver_senha()">
                            <span class="input-group-text">
                                <i class="material-icons" id="iconVer" style="display: block;">visibility</i>
                                <i class="material-icons" id="iconNaoVer" style="display: none;">visibility_off</i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha de 6 digitos" aria-label="Senha do Usuário" aria-describedby="Senha do Usuário" minlength="6" maxlength="12" required/> <!--Senha-->
                    </div>
                    <div class="btn-group float-right" role="group" aria-label="Basic example" id="botoes"> <!--Botões-->
                        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalCadastro" id="btnChamaModalCad">Cadastrar</button>
                        <button type="submit" class="btn btn-dark" id="btnEntrar" name="btnEntrar">&nbsp;&nbsp;Entrar&nbsp;&nbsp;</button>
                    </div>
                    <p class="card-text" id="descricao">Encontre aqui suas aulas de Violão, Guitarra ou Teclado, com aulas em Power Point, atividades online, áudios e outras ferramentas para ter um melhor desempenho.</p>
                </div>
            </form>
            <!--Modal Cadastro-->
            <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"> <!-- Titulo -->
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <!-- x -->
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="../back/backCadastro.php" id="formCadastro" onsubmit="return validaCad();">
                        <div class="modal-body">
                            <fieldset id="pessoal"> <!--Dados Pessoais-->
                                <h6>Dados Pessoais </h6><hr/>
                                <div class="form-group"> <!--Nome-->
                                    <label for="cadNome">Nome</label>
                                    <input type="text" class="form-control" name="cadNome" id="cadNome" placeholder="Digite o Nome" minlength="2" maxlength="30" required/>
                                </div>
                                <div class="form-group"> <!--Data de Pagamento-->
                                    <label for="cadData">Data de Entrada<span style="font-size: 8pt;">&nbsp;(Digite a data do primeiro dia de aula)</span></label>
                                    <input type="date" class="form-control" name="cadData" id="cadData" required/>
                                </div>
                            </fieldset>
                            <fieldset id="contato"> <!--Contato-->
                                <h6>Contato<span style="font-size: 8pt;font-weight: normal;">&nbsp;(Selecione pelo menos um tipo de contato)</span></h6><hr/>
                                <div class="form-group"> <!--Email-->
                                    <label for="checkEmail">Email<span style="font-size: 8pt;">&nbsp;(Se não tiver e-mail não selecione a caixa)</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" name="checkEmail" id="checkEmail" aria-label="Validação para Email" onclick="fContato('1');"/>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Selecione a caixa e digite o Email" id="roEmail" readonly/>
                                        <input type="email" class="form-control" name="cadEmail" id="cadEmail" aria-label="Email" placeholder="Digite o Email" minlength="5" maxlength="30" style="display:none;"/>
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
                                        <input type="text" class="form-control" name="cadCelular" id="cadCelular" aria-label="Celular" placeholder="Digite o número do Whatsapp" minlength="10" maxlength="13" style="display:none;"/>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset id="conta"> <!--Conta-->
                                <h6>Conta </h6><hr/>
                                <div class="form-group"> <!--Instrumento-->
                                    <label for="cadAula">Aula</label>
                                    <select class="custom-select" id="cadAula" name="cadAula" required>
                                        <option>Selecione...</option>
                                        <option>Teclado</option>
                                        <option>Guitarra</option>
                                        <option>Violão</option>
                                    </select>
                                </div>
                                <div class="form-group"> <!--Senha-->
                                    <label for="cadSenha">Senha</label>
                                    <input type="password" class="form-control" id="cadSenha" name="cadSenha" placeholder="Digite a Senha" minlength="6" maxlength="12" required/>
                                </div>
                                <div class="form-group"> <!--Confirmar Senha-->
                                    <label for="confSenha">Confirmar Senha</label>
                                    <input type="password" class="form-control" id="confSenha" name="confSenha" placeholder="Digite a Senha novamente" minlength="6" maxlength="12" oninput="validaSenha()" required/>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer"> <!--Rodapé-->
                            <div id="finalizaCad">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary" id="btnCadastrar" name="btnCadastrar">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <?php include('../modais/modalResultado.php'); ?>
        </div>
    </div>
    <!--Sobre-->
    <div id="contDivulga">
        <div class="container-fluid">
            <div id="wrapFig">
                <div id="carFig" class="carousel slide" data-ride="carousel" >
                    <ol class="carousel-indicators">
                        <li data-target="#carFig" data-slide-to="0" class="active" title="Página Principal"></li>
                        <li data-target="#carFig" data-slide-to="1" title="Página de Aulas"></li>
                        <li data-target="#carFig" data-slide-to="2" title="Página de Exercícios"></li>
                        <li data-target="#carFig" data-slide-to="3" title="Página de Áudios"></li>
                        <li data-target="#carFig" data-slide-to="4" title="Notas no Teclado"></li>
                        <li data-target="#carFig" data-slide-to="5" title="Notas no Violão"></li>
                        <li data-target="#carFig" data-slide-to="6" title="Página de Indicações"></li>
                        <li data-target="#carFig" data-slide-to="7" title="Área de Apoio"></li>
                        <li data-target="#carFig" data-slide-to="8" title="Perfil"></li>
                    </ol>
                    <div class="carousel-inner">
                        <!--Principal-->
                        <div class="carousel-item active">
                            <figure>
                                <h2>Principal</h2>
                                <img src="../img/print/home.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                        <!--Aulas-->
                        <div class="carousel-item">
                            <figure>
                                <h2>Aulas</h2>
                                <img src="../img/print/aula.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                        <!--Exercícios-->
                        <div class="carousel-item">
                            <figure>
                                <h2>Exercícios</h2>
                                <img src="../img/print/exercicio.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                        <!--Áudios-->
                        <div class="carousel-item">
                            <figure>
                                <h2>Áudios</h2>
                                <img src="../img/print/audio.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                        <!--Notas-->
                        <div class="carousel-item">
                            <figure>
                                <h2>Notas no Teclado</h2>
                                <img src="../img/print/nota-t.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                        <!--Notas-->
                        <div class="carousel-item">
                            <figure>
                                <h2>Notas no Violão</h2>
                                <img src="../img/print/nota-v.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                        <!--Indicações-->
                        <div class="carousel-item">
                            <figure>
                                <h2>Indicações</h2>
                                <img src="../img/print/indicacao.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                        <!--Apoio-->
                        <div class="carousel-item">
                            <figure>
                                <h2>Apoio</h2>
                                <img src="../img/print/apoio.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                        <!--Perfil-->
                        <div class="carousel-item">
                            <figure>
                                <h2>Perfil</h2>
                                <img src="../img/print/perfil.png" class="imgSobre">
                                <figcaption>Descrição...</figcaption>
                            </figure>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carFig" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carFig" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
</html>