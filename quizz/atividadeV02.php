<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Atividade 02</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Upright" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<style>
		body{
			background: url("../img/exerc/atividadeV02.jpg");
			background-size:cover;
		}
		main{
            position: absolute;
            background: rgba(40,40,40,.3);
            left: 15em;
            right: 15em;
            padding: 10px;
            top: 0;
            min-width: 400px;
            min-height: 100%;
		}
        main header h1{
            color: white;
            font-family: 'Cormorant Upright', serif;
            text-align: center;
            margin-top: 5em;
            margin-bottom: 10px;
            padding: 10px;
            transition: margin .5s;
        }
        main header button#btnStart{
            display: block;
            margin: auto;
            margin-top: 0px;
        }
        main section{
            position: relative;
            background: rgba(10,10,10,.4);
            margin-top:-10px;
            padding: 20px;
            padding-left: 0px;
            display: none;
            color: white;
        }
        section div#dBtn{ margin-left:20px; }
        div#legenda{
            margin-top: -15px;
            display: none;
            font-family: 'Cormorant Upright', serif;
            text-align: center;
            background: rgba(40,40,40,.6);
        }
        .azul{ color: rgba(64,224,208,1); }
        .verde{ color: rgba(0,250,154,1); }
        .vermelho{ color: rgba(255,34,34,1); }
	</style>
	<script>
        var fim = false;
        var atividadeNome = "atividadeV02.php";
        function mostraAt(){
            document.getElementById('btnStart').style="display:none;";
            document.getElementById('hTitulo').style="margin-top: 0;background: rgba(10,10,10,.4);";
            document.getElementById('atividade').style="display: block;";
        }
        function esconde(){
            if(fim){ window.location.href=atividadeNome; }
            else{
                hTitulo.innerHTML="Revisão";
                document.getElementById('atividade').style="display: none;";
                document.getElementById('hTitulo').style="margin-top: 5em;";
                document.getElementById('btnStart').style="display:block;";
            }
        }
        function corrige(){
            if(valida()){
                if(!fim){
                    fim=true;
                    document.getElementById("btnFinaliza").style="display: none";
                    document.getElementById("btnConclui").style="display: block";
                    //document.getElementById("btnCancela").style="display:none;";
                    hTitulo.innerHTML="Correção da Revisão";
                    document.getElementById('legenda').style="display:block;"
                    //q1
                    setValor("q1","Música é a arte de se expressar através de sons. ("+getValor("q1")+")");
                    rCor("q1","Parcial");
                    //q2
                    if(getNameValor("q2")==("c")) rCor("q2i3","Certo");
                    else{
                        rCor("q2i3","Certo");  
                        q2ri = getNameValor("q2")==("a")?"q2i1":"q2i2";
                        rCor(q2ri,"Erro");  
                    }
                    //q3 q7
                    setValor("q3","Ritmo: Movimento, Batidas. ("+getValor("q3")+")");
                    rCor("q3","Parcial");
                    setValor("q4","Melodia: Parte \"cantada\" da música. ("+getValor("q4")+")");
                    rCor("q4","Parcial");
                    setValor("q5","Harmonia: O acompanhamento, o fundo musical. ("+getValor("q5")+")");
                    rCor("q5","Parcial");
                    setValor("q6","Nota é apenas uma unidade sonora. ("+getValor("q6")+")");
                    rCor("q6","Parcial");
                    setValor("q7","Acorde é um conjunto de notas. ("+getValor("q7")+")");
                    rCor("q7","Parcial");
                    //q8 q9
                    if(getValor("q8")==7) rCor("q8","Certo");
                    else rCor("q8","Erro");
                    setValor("q8",7);
                    if(getValor("q9")==5) rCor("q9","Certo");
                    else rCor("q9","Erro");
                    setValor("q9",5);
                    //q10
                    setValor("q10","São notas que ficam no intervalo das Notas Naturais, e possuem #(Sustenido) ou b(bemol). ("+getValor("q10")+")");
                    rCor("q10","Parcial");
                    //q11 q14
                    if(getValor("q11")==("B - C")) rCor("q11","Certo");
                    else rCor("q11","Erro");
                    setValor("q11","B - C");
                    if(getValor("q12")==("E - F")) rCor("q12","Certo");
                    else rCor("q12","Erro");
                    setValor("q12","E - F");
                    if(getValor("q13")==3) rCor("q13","Certo");
                    else rCor("q13","Erro");
                    setValor("q13",3);
                    if(getValor("q14")==("I - III - V")) rCor("q14","Certo");
                    else rCor("q14","Erro");
                    setValor("q14","I - III - V");
                    //q15
                    setValor("q15","Sustenido vai para frente, bemol vai para trás. ("+getValor("q15")+")");
                    rCor("q15","Parcial");
                    //q16
                    if(getNameValor("q16")=="b") rCor("q16i2","Certo");
                    else{
                        rCor("q16i3","Certo");  
                        q16ri = getNameValor("q16")==("a")?"q16i1":"q16i3";
                        rCor(q16ri,"Erro");  
                    }
                    //q22
                    if(getValor("q17").toUpperCase()==("E").toUpperCase()) rCor("q17","Certo");
                    else rCor("q17","Erro");
                    setValor("q17","E ("+getValor("q17")+")");
                    if(getValor("q18").toUpperCase()==("A").toUpperCase()) rCor("q18","Certo");
                    else rCor("q18","Erro");
                    setValor("q18","A ("+getValor("q18")+")");
                    if(getValor("q19").toUpperCase()==("D").toUpperCase()) rCor("q19","Certo");
                    else rCor("q19","Erro");
                    setValor("q19","D ("+getValor("q19")+")");
                    if(getValor("q20").toUpperCase()==("G").toUpperCase()) rCor("q20","Certo");
                    else rCor("q20","Erro");
                    setValor("q20","G ("+getValor("q20")+")");
                    if(getValor("q21").toUpperCase()==("B").toUpperCase()) rCor("q21","Certo");
                    else rCor("q21","Erro");
                    setValor("q21","B ("+getValor("q21")+")");
                    if(getValor("q22").toUpperCase()==("E").toUpperCase()) rCor("q22","Certo");
                    else rCor("q22","Erro");
                    setValor("q22","E ("+getValor("q22")+")");
                    window.scrollTo(0, 0);
                    tituloModalResultado.innerHTML="Parabéns por Finalizar a Atividade";
                    subTituloModalResultado.innerHTML="<center><b style='font-size: 14pt;'>Você Completou esta Atividade</b><br/>Veja seus erros e acertos e clique em concluir para encerrar a atividade. Continue estudando e evoluindo seus conhecimento musicais.</center>";
                    document.getElementById('btnChamaModalResult').click(); 
                }
            }
        }
        function valida(){
            v = new Array("q1","-","q3","q4","q5","q6","q7","q8","q9","q10","q11","q12","q13","q14","q15","-","q17","q18","q19","q20","q21","q22");
            retorno = false;
            for(indice=0; indice<22; indice++){
                if(!(v[indice]=="-")){
                    if(getValor(v[indice]).trim().length==0){
                        alert("Preencha todos os Campos do Formulário");
                        indice = 22;
                        retorno = false;
                    }
                    else{ retorno = true; }
                }
            }
            return retorno;
        }
        function rCor(v,t){
            $('#'+v).removeClass('bg-light');
            switch(t){
                case 'Erro': document.getElementById(v).style="background: rgba(255,34,34,.7);color:white;"; break;
                case 'Certo': document.getElementById(v).style="background: rgba(0,250,154,.7);color:white;"; break;
                case 'Parcial': document.getElementById(v).style="background: rgba(64,224,208,.7);color:white;"; break;
            }
        }
        function preenche(v1,v2,v3,v4,v5,v6,v7,v8,v9,v10,v11,v12,v13,v14,v15,v16,v17,v18,v19,v20,v21,v22){
            mostraAt();
            v = new Array(v1,v2,v3,v4,v5,v6,v7,v8,v9,v10,v11,
                          v12,v13,v14,v15,v16,v17,v18,v19,v20,v21,v22);
            $('[name="q2"]').removeAttr('checked'); 
            $('[name="q16"]').removeAttr('checked'); 
            $('[name="q2"]').val(v2); 
            $('[name="q16"]').val(v16);
//            alert('#'+problemaRadio('q2',v2));
            document.getElementById(problemaRadio('q2',v2)).checked = true;
            document.getElementById(problemaRadio('q16',v16)).checked = true;
//            $('#'+problemaRadio('q16',v16)).attr('checked'); 
            //Nome das questões
            
//            q2r1,q2r2,q2r3
//            q16r1,q16r2,q16r3
            q = new Array("q1","-","q3","q4","q5","q6","q7","q8","q9","q10","q11",
                          "q12","q13","q14","q15","-","q17","q18","q19","q20","q21","q22");
            for(indice=0; indice<22; indice++){ setValor(q[indice],v[indice]); }
            corrige();
        }
        function manutencao(){ alert("Área em Manutenção!"); }
        function getValor(v){ return document.getElementById(v).value; }
        function getNameValor(v){ return $('[name="'+v+'"]').val(); }
        function setValor(p,v){
            if(!(p=="-")){ document.getElementById(p).value=v; }
        }
        function problemaRadio(n,v){
            retorno = 1;
            switch(v){
                case 'a': retorno=1; break;
                case 'b': retorno=2; break;
                case 'c': retorno=3; break;
            }
            return n+'r'+retorno;
        }
	</script>
</head>
<body>
	<main>
        <?php
            include("../back/conexao.php");
            $atividadeNome = "atividadeV02.php";
            $sql = "select oa.concluido conc from objetivo o inner join objaluno oa on o.id=oa.objId where urlObj='../quizz/$atividadeNome' and oa.alunoId=".$_SESSION['id'].";";
            $resConc = $conn->query($sql);
            $conn->close();
            $lineConc = $resConc->fetch_array();
            if($lineConc['conc']==0){
        ?>
        <header>
            <h1 id="hTitulo">Revisão</h1>
            <button type="button" class="btn btn-danger btn-lg" id="btnStart" onclick="mostraAt()">Iniciar Atividade</button>
        </header>

        <?php
            }
            else{
                include('../back/conexao.php');
                $sql = "select q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,q21,q22 from respondeexerc where alunoId='{$_SESSION['id']}' and exercId=(select id from exerc where urlExerc='../quizz/$atividadeNome');";
                $respostas = $conn->query($sql);
                $conn->close();
                $lineResposta = $respostas->fetch_array();
                $paramResposta = "";
                $ajuste = true;
                foreach($lineResposta as $value){
                    if($ajuste){
                        $paramResposta .= "'$value',";
                    }
                    $ajuste=!$ajuste;
                }
                $paramResposta = substr($paramResposta,0,-1);
        ?>
        <header id="hResultados">
            <h1 id="hTitulo">Atividade de Revisão Concluida</h1>
            <button type="button" class="btn btn-primary btn-lg" id="btnStart" onclick="preenche(<?php echo $paramResposta; ?>)">Resultados</button>
        </header>
        <?php } ?>
        <!-- Atividade -->
        <section id="atividade">
            <form method="POST" action="../back/backAlt.php" autocomplete="off">
                <input type="hidden" id="exerc" name="exerc" value="../quizz/<?php echo $atividadeNome; ?>">
                <input type="hidden" id="qtdQ" name="qtdQ" value="22">
                <!--Legenda-->
                <div class="form-group" id="legenda">
                    <p>
                        <b>Legenda de Cores: &nbsp;&nbsp;</b>
                        <span class="verde">Verde para Certas &nbsp;&nbsp;</span>|&nbsp;&nbsp;
                        <span class="vermelho">Vermelho para Erradas &nbsp;&nbsp;</span>|&nbsp;&nbsp;
                        <span class="azul">Azul para Dissertativas &nbsp;&nbsp;</span>|&nbsp;&nbsp;(&nbsp; ) Suas Respostas
                    </p>
                </div>
                <ol>
                    <div class="form-group">
                        <li>
                            <label for="q1">O que é a música?</label>
                            <textarea class="form-control" id="q1" name="q1" rows="2" placeholder="Resposta.." required></textarea>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q2r1">A música é dividida em três partes, que são:</label>
                            <label class="input-group" for="q2r1">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-dark"><input type="radio" id="q2r1" name="q2" value="a" checked></div>
                                </div>
                                <input type="text" class="form-control bg-light" value="Batida, Solo e Acompanhamento" id="q2i1" readonly>
                                <div class="input-group-append" title="Marque a caixinha, o texto é somente para leitura">
                                    <div class="input-group-text"><i class="material-icons">https</i></div>
                                </div>
                            </label>
                            <label class="input-group" for="q2r2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-dark"><input type="radio" id="q2r2" name="q2" value="b"></div>
                                </div>
                                <input type="text" class="form-control bg-light" value="Harmonia, Tom e Ritmo" id="q2i2" readonly>
                                <div class="input-group-append" title="Marque a caixinha, o texto é somente para leitura">
                                    <div class="input-group-text"><i class="material-icons">https</i></div>
                                </div>
                            </label>
                            <label class="input-group" for="q2r3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-dark"><input type="radio" id="q2r3" name="q2" value="c"></div>
                                </div>
                                <input type="text" class="form-control bg-light" value="Ritmo, Melodia e Harmonia" id="q2i3" readonly>
                                <div class="input-group-append" title="Marque a caixinha, o texto é somente para leitura">
                                    <div class="input-group-text"><i class="material-icons">https</i></div>
                                </div>
                            </label>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q3">Descreva o significado dessas divisões:</label>
                            <label class="input-group" for="q3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Primeira Parte:</span>
                                </div>
                                <input type="text" class="form-control" id="q3" name="q3" placeholder="Descrição..." required>
                            </label>
                            <label class="input-group" for="q4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Segunda Parte:</span>
                                </div>
                                <input type="text" class="form-control" id="q4" name="q4" placeholder="Descrição..." required>
                            </label>
                            <label class="input-group" for="q5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Terceira Parte:</span>
                                </div>
                                <input type="text" class="form-control" id="q5" name="q5" placeholder="Descrição..." required>
                            </label>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q6">Significado de Nota:</label>
                            <textarea class="form-control" id="q6" name="q6" rows="2" placeholder="Resposta.." required></textarea>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q7">Significado de Acorde:</label>
                            <textarea class="form-control" id="q7" name="q7" rows="2" placeholder="Resposta.." required></textarea>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q8">Quantas notas existem?</label>
                            <label class="input-group" for="q8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Naturais:</span>
                                </div>
                                <input type="number" class="form-control" id="q8" name="q8" min=1 max=24 value=1 required>
                            </label>
                            <label class="input-group" for="q9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Acidentais:</span>
                                </div>
                                <input type="number" class="form-control" id="q9" name="q9" min=1 max=24 value=1 required>
                            </label>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q10">O que são acidentes musicais?</label>
                            <textarea class="form-control" id="q10" name="q10" rows="2" placeholder="Resposta.." required></textarea>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q11">Quais notas não possuem intervalo:</label>
                            <label class="input-group" for="q11">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Sem Intervalo</span>
                                </div>
                                <select class="custom-select" id="q11" name="q11">
                                    <option>Cb - E</option>
                                    <option>B - C</option>
                                    <option>D# - F</option>
                                    <option>G - A</option>
                                </select>
                            </label>
                            <label class="input-group" for="q12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Sem Intervalo</span>
                                </div>
                                <select class="custom-select" id="q12" name="q12">
                                    <option>F - E#</option>
                                    <option>B# - E</option>
                                    <option>Bb - A#</option>
                                    <option>E - F</option>
                                </select>
                            </label>
                        </li>
                    </div>    
                    <div class="form-group">
                        <li>
                            <label for="q13">Um acorde simples é formado por quantas notas? E quais são seus Graus?</label>
                            <label class="input-group" for="q13">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">#</span>
                                </div>
                                <input type="number" class="form-control" id="q13" name="q13" min=1 max=7 value=1 required>
                            </label>
                            <label class="input-group" for="q14">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">º</span>
                                </div>
                                <select class="custom-select" id="q14" name="q14">
                                    <option>I - III - V</option>
                                    <option>I - III - V - VII</option>
                                    <option>I - IV - V</option>
                                    <option>III - I - V - IX</option>
                                </select>
                            </label>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q15">Qual a diferença entre Sustenido e Bemol?</label>
                            <textarea class="form-control" id="q15" name="q15" rows="2" placeholder="Resposta.." required></textarea>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label for="q16r1">Qual país é o berço da teoria músical?</label>
                            <label class="input-group" for="q16r1">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-dark"><input type="radio" id="q16r1" name="q16" value="a" checked></div>
                                </div>
                                <input type="text" class="form-control bg-light" value="Egito" id="q16i1" readonly>
                                <div class="input-group-append" title="Marque a caixinha, o texto é somente para leitura">
                                    <div class="input-group-text"><i class="material-icons">https</i></div>
                                </div>
                            </label>
                            <label class="input-group" for="q16r2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-dark"><input type="radio" id="q16r2" name="q16" value="b"></div>
                                </div>
                                <input type="text" class="form-control bg-light" value="Grécia" id="q16i2" readonly>
                                <div class="input-group-append" title="Marque a caixinha, o texto é somente para leitura">
                                    <div class="input-group-text"><i class="material-icons">https</i></div>
                                </div>
                            </label>
                            <label class="input-group" for="q16r3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-dark"><input type="radio" id="q16r3" name="q16" value="c"></div>
                                </div>
                                <input type="text" class="form-control bg-light" value="Estados Unidos" id="q16i3" readonly>
                                <div class="input-group-append" title="Marque a caixinha, o texto é somente para leitura">
                                    <div class="input-group-text"><i class="material-icons">https</i></div>
                                </div>
                            </label>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>
                            <label class="mb-0 pb-0" for="q17">Adicione o nome das notas nas cordas do violão: </label><small class="mt-0 pt-0 pb-2 d-block"><strong>Obs.</strong>Utilizar as siglas das notas, e colocar da mais grave para a mais aguda.</small>
                            <div class="row mx-auto">
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q17" name="q17" placeholder="1ª Corda" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q18" name="q18" placeholder="2ª Corda" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q19" name="q19" placeholder="3ª Corda" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q20" name="q20" placeholder="4ª Corda" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q21" name="q21" placeholder="5ª Corda" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q22" name="q22" placeholder="6ª Corda" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <figure>
                                        <img src="../img/obj/braco3.jpg" class="rounded mx-auto d-block"/>
                                    </figure>
                                </div>
                            </div>
                        </li>
                    </div>
                </ol>
                <div class="form-group" id="dBtn">
                    <button type="button" class="btn btn-danger btn-block" id="btnCancela" name="btnCancela" onclick="esconde()">Cancelar</button>
                    <button type="submit" class="btn btn-dark btn-block" id="btnFinaliza" name="btnFinaliza" onclick="valida()">Finalizar</button>
                    <button type="submit" class="btn btn-dark btn-block" id="btnConclui" name="btnConclui" style="display: none;">Concluir</button>
                </div>
            </form>
        </section>
        <?php include('../modais/modalResultado.php'); ?>
	</main>	
</body>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>