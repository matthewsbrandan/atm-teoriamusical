<!doctype html>
<html lang="pt-br">
<head>
	<title>Aula de Música</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/atm.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
    <style>
        body{
            background: #222;
            background: url("../img/fundo/100992.jpg");
            background-size: cover;
            padding: 0px;
		}
        /*Header*/
        header ul{
            background: rgba(20,20,20,.6);
            transition: background .8s;
        }
        header .ativo{
            transition: box-shadow .8s;
            background: #111;
            box-shadow: 2px 2px 20px #777;
            color: antiquewhite;
            font-weight: 500;
        }
        header .nav-link{ color: #bbb; }
        header ul:hover{ background: rgba(10,10,10,.8); }
        header .nav-item{ transition: background .6s; border-radius: 5px; }
        header .nav-item:hover{ background: rgba(200,200,200,.4); }
        /* Sessão - Aula de Teoria Músical */
        #divWall{
            height: 100vh;
            margin: 0px;
        }
        #hgTitulo{
            color: #bbb;
            text-align: center;
            margin-top: -80px;
        }
        #hgTitulo h1{ font-size: 48pt; }
        #hgTitulo h2{ color: #999; margin-top: -8px; font-size: 14pt; }
        /* Sessão - Acesse o Site */
        #contLog{
            width: 100vw;
            height: 100vh;
            display: block;
        }
        #divLog{
            height: 100vh;
            margin: 0px;
            margin-top: -60px;
        }
		#login{
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
		fieldset div.form-group{ padding-left: 10px; padding-right: 10px; }
        /* Sessão - Sobre */
        #contDivulga .card-title{ text-align: center; }
        #contDivulga .card-text{ text-align: center; }
        #wrapFig{ background: black; position: absolute; }
        #conteudoSobre ul li{ font-weight: 500; }
    </style>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
    <script>
        //Variáveis
		var visivel = false;
		var pag = 1;
		var senha = false;
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
			if(document.getElementById('cadSenha').value==document.getElementById('confSenha').value)
            { document.getElementById('confSenha').style="background: transparent;"; senha=true; }
            else
            { document.getElementById('confSenha').style="background: rgba(200,0,0,.3);"; senha=false; }
		}
		function validaCad(){
			retorno = false;
            if($('#cadAula').val()=="Selecione...") click3('Erro de Preenchimento','Selecione uma Aula para poder finalizar o Cadastro!');
            else if(!senha) click3('Erro de Preenchimento','Senhas Divergentes!');
            else retorno = true;
			return retorno;
		}
		function fContato(v){
			switch(v){
				case '1':
                    n = document.getElementById('cadNome').value;
                    if(n.length>1) document.getElementById('cadEmail').value= naoAcentua(trim(n).toLowerCase()) + "@atm.com";
                    else click3('Erro de Preenchimento','Preencha primeiro o <em>Nome do Usuário</em> e depois clique neste botão para gerar um Email padrão do ATM.');
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
            t="";s="";
			switch(v){
				case 0: //Cadastrado com Sucesso
					t="Parabéns";s= "O Usuário foi Cadastrado com Sucesso!";
					break;
				case 1: //Erro no Casdatramento
					t="Desculpe";s="Houve um erro de Cadastramento!";
					break;
				case 2: //Usuário não encontrado
					t="Desculpe";s="Usuário não Encontrado!";
					break;
				case 3: //Erro no Cadastramento, Email já utilizado
                    t='Desculpe, erro de Cadastramento';s='Este Email já está sendo utilizado. Caso você já tenha uma conta, e não consiga acessá-la, utilize a função <em>- Esqueci Minha Senha -</em> ou entre em contato com seu Professor para recuperá-la. Caso contrário, entre com outra conta de email.';
					break;
				case 4: //Login Expirou
					t="Login Expirou..";s="Logue novamente para acessar sua conta!";
					break;
				case 5: //Erro de Seleção de Aula
					t='Desculpe';s='O curso do Aluno não foi Identificado. Tente logar novamente.';
					break;
				case 6: //Erro de Atualização de Nível
					t='Desculpe';s='Houve um erro ao atualizar o seu Nível Musical.';
					break;
                case 7: //Senha Incorreta no Login
					t='Desculpe';s='Senha Incorreta.';
					break;
			}
            if(t.length>1 || s.length>1){
                tituloModalResultado.innerHTML=t;
                subTituloModalResultado.innerHTML=s;
			    document.getElementById('btnChamaModalResult').click();
            }
		}
        function click3(t,s){
            tituloModalResultado.innerHTML=t;
            subTituloModalResultado.innerHTML=s;
			document.getElementById('btnChamaModalResult').click();
        }
        //Local - Estético
        function msDiv(p){
            $('ul div div li a').removeClass('ativo');
            $('ul div div:nth-child('+p+') li a').addClass('ativo');
            $('section').addClass('d-none');
            $('section:nth-child('+(p+1)+')').removeClass('d-none');
            if(p==2){ $('#email').focus(); }
        }
        function trim(vlr) {
            while(vlr.indexOf(" ") != -1)vlr = vlr.replace(" ", "");
            return vlr;
        }
        function naoAcentua(p){
            return p.replace(/[áàâã]/g,'a').replace(/[éèê]/g,'e').replace(/[óòôõ]/g,'o').replace(/[úùû]/g,'u').replace(/[ç]/g,'c');
        }
        //Inicialização
        $(function(e){
           $('#modalCadastro').on('shown.bs.modal', function () { $('#cadNome').trigger('focus') });
            //msDiv(3); //Função para iniciar em uma tela específica. (1 - 2 - 3)
        });
        //Função Onload
        window.onload = function(){ <?php if(isset($_GET['erro'])){?>click2(<?php echo $_GET['erro']; ?>);<?php } ?> };
    </script>
</head>
<body>
    <!-- Header -->
    <header>
        <ul class="nav nav-pills nav-fill m-0 p-0">
        <div class="row fixed-top">
            <div class="col">
              <li class="nav-item">
                <a class="nav-link ativo" href="#" onclick="msDiv(1);">
                    <span class="d-none d-lg-block">Aula de Teoria Musical</span>
                    <span class="d-lg-none">ATM</span>
                </a>
              </li>
            </div>
            <div class="col">
              <li class="nav-item">
                <a class="nav-link" href="#" onclick="msDiv(2);">
                    <span class="d-none d-lg-block">Acesse o Site</span>
                    <span class="d-lg-none">Acessar</span>
                </a>
              </li>
            </div>
            <div class="col">
              <li class="nav-item">
                <a class="nav-link" href="#" onclick="msDiv(3);">
                    <span class="d-none d-lg-block">Sobre o Site</span>
                    <span class="d-lg-none">Sobre</span>
                </a>
              </li>
            </div>
        </div>
        </ul>
    </header>
    <!-- Aula de Teoria Musical -->
    <section id="contWall">
        <div class="row align-items-center" id="divWall">
            <div class="col">
                <hgroup id="hgTitulo">
                    <h1>
                        <span class="d-none d-md-block">Aula de Teoria Musical</span>
                        <span class="d-md-none">ATM</span>
                    </h1>
                    <h2>Mateus Brandão</h2>
                </hgroup>
            </div>
        </div>
    </section>
    <!-- Acesse o Site -->
    <section id="contLog" class="content d-none">
        <div class="row justify-content-center align-items-center p-0" id="divLog">
            <div class="col-lg-5 col-md-8 col-sm-10">
               <div class="card bg-light px-0"  id="login">
                    <!--Login-->
                    <form method="POST" action="../back/backLogin.php" id="formLogin">
                        <div class="card-header">Aulas de Música</div>
                        <div class="card-body px-4">
                            <h5 class="card-title">Login</h5>
                            <div class="input-group mb-3"> <!--Email-->
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">perm_identity</i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email do Usuário" aria-label="Email do Usuário" aria-describedby="Email do Usuário" minlength="2" maxlength="30" required/> <!--Email-->
                            </div>
                            <div class="input-group mb-0"> <!--Senha-->
                                <div class="input-group-prepend" style="cursor: pointer;" onclick="ver_senha()">
                                    <span class="input-group-text">
                                        <i class="material-icons" id="iconVer" style="display: block;">visibility</i>
                                        <i class="material-icons" id="iconNaoVer" style="display: none;">visibility_off</i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha de 6 digitos" aria-label="Senha do Usuário" aria-describedby="Senha do Usuário" minlength="6" maxlength="12" required/> <!--Senha-->
                            </div>
                            <!--Esqueci minha Senha-->
                            <div class="input-group m-0 pl-1">
                                <a href="pagEsqSenha.php" target="_blank" class="m-0 d-block text-muted small">Esqueci minha senha...</a>
                            </div>
                            <!--Botões-->
                            <div class="btn-group float-right" role="group" aria-label="Basic example" id="botoes">
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
                                            <label for="cadNome">Nome *</label>
                                            <input type="text" class="form-control" name="cadNome" id="cadNome" placeholder="Digite o Nome" minlength="2" maxlength="30" required/>
                                        </div>
                                        <div class="form-group"> <!--Data de Pagamento-->
                                            <label for="cadData">Data de Entrada *<span style="font-size: 8pt;">&nbsp;(Digite a data do primeiro dia de aula)</span></label>
                                            <input type="date" class="form-control" name="cadData" id="cadData" required/>
                                        </div>
                                    </fieldset>
                                    <fieldset id="contato"> <!--Contato-->
                                        <h6>Contato<span style="font-size: 8pt;font-weight: normal;">&nbsp;(Selecione pelo menos um tipo de contato)</span></h6><hr/>
                                        <div class="form-group"> <!--Email-->
                                            <label for="checkEmail">Email *<span style="font-size: 8pt;">&nbsp;(Se não tiver email, utilize o padrão do site clicando <a href="#" onclick="fContato('1')">AQUI!</a>)</span></label>
                                            <input type="email" class="form-control" name="cadEmail" id="cadEmail" aria-label="Email" placeholder="Digite o Email" minlength="5" maxlength="30"/>
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
                </div>
            </div>
        </div>
    </section>
    <!--Sobre-->
    <section id="contDivulga"  class="d-none pt-2">
        <div class="container mt-5">
            <div class="row">
                <!--Principal-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/home.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Principal</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
                <!--Aulas-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/aula.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Aulas</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
                <!--Exercícios-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/exercicio.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Exercícios</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
                <!--Áudios-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/audio.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Áudios</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
                <!--Notas-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/nota-t.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Notas no Teclado</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
                <!--Notas-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/nota-v.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Notas no Violão</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
                <!--Indicações-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/indicacao.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Indicações</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
                <!--Apoio-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/apoio.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Apoio</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
                <!--Perfil-->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <img src="../img/print/perfil.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Perfil</h5>
                            <p class="card-text">...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        
            <div id="conteudoSobre" class="card mb-3 bg-dark text-light">
                <div class="card-body">
                    <h1 class="card-title">Sobre o Site</h1>
                    <p class="card-text">O site foi total desenvolvido e idealizado por Mateus Brandão, desenvolvedor e professor desse curso. O curso envolve aulas de Teclado, Violão e Guitarra, com três ferramentas para sua metodologia de ensino:</p>
                    <ul type="circle">
                        <li>Aulas Teóricas: </li>
                            <p>Feitas no PowerPoint e disponível para download, nelas terá todo o conteúdo que será base para as outras aplicações de ensino que serão citadas abaixo. Conteúdo de fácil leitura, fontes seguras, definições do dicionário e imagens para facilitar o entendimento.</p>
                        <li>Exercícios de Fixação: </li>
                            <p>São atividades avaliativas para testar os conhecimentos adquiridos, atividades estas, que serão realizadas e corrigidas no mesmo momento, direto no site. Sua finalidade é colocar em prática conhecimentos mais teóricos e reforçar os pontos mais importantes para o conhecimento musical do aluno.</p>
                        <li>Exercícios Práticos: </li>
                            <p>Disponibilizados no formato de aúdio, com um quadro explicativo sobre a sua execução. Vem em dois níveis, o <em>Padrão</em> que será exigido para as aulas e o <em>Pró</em>, um nível de desafios caso o aluno deseje fazer coisas diferentes e com maior complexidade.</p>
                    </ul>
                    <p class="card-text">O site possuí a metodologia de níveis, com objetivos para serem cumpridos e elevar o nível musical do aluno, guiando-o em seu aprendizado. Além disso ele possui áreas de apoio, onde tem acesso fácil as informações mais importantes, como uma área de notas e outra de conceitos teóricos.</p>
                    <span class="d-block text-right text-muted"><em>Desenvolvido e disponibilizado em 2019, <a target="_blank" href="../../LiteraryWorld/sign-in/">Matthews Brandan</a></em></span>
                </div>
            </div>
        </div>
    </section>
    <?php include('../modais/modalResultado.php'); ?>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
</html>