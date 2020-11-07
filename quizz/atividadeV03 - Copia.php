<?php
    session_start();
    $nomeAtividade = "atividadeV03";
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Atividade 03</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Upright" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<style>
		body{
			background: url("../img/exerc/<?php echo $nomeAtividade; ?>.jpg");
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
        .altura-icons{ }
	</style>
	<script src="../js/jquery/jquery-3.4.1.min.js"></script>
    <script>
        var fim = false;
        var atividadeNome = "<?php echo $nomeAtividade; ?>.php";
        var atividadeTitulo = "Campo Harmônico";
        function mostraAt(){
            document.getElementById('btnStart').style="display:none;";
            document.getElementById('hTitulo').style="margin-top: 0;background: rgba(10,10,10,.4);";
            document.getElementById('atividade').style="display: block;";
        }
        function esconde(){
            if(fim){ window.location.href=atividadeNome; }
            else{
                hTitulo.innerHTML=atividadeTitulo;
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
            v = new Array(v1,v2,v3,v4,v5,v6,v7,v8,v9,v10,v11,v12,v13,v14,v15,v16,v17,v18,v19,v20,v21,v22);
            $('[name="q2"]').removeAttr('checked'); 
            $('[name="q16"]').removeAttr('checked'); 
            $('[name="q2"]').val(v2); 
            $('[name="q16"]').val(v16);
            document.getElementById(problemaRadio('q2',v2)).checked = true;
            document.getElementById(problemaRadio('q16',v16)).checked = true;
            q = new Array("q1","-","q3","q4","q5","q6","q7","q8","q9","q10","q11","q12","q13","q14","q15","-","q17","q18","q19","q20","q21","q22");
            for(indice=0; indice<22; indice++){ setValor(q[indice],v[indice]); }
            corrige();
        }
        function manutencao(){ alert("Área em Manutenção!"); }
        function getValor(v){ return document.getElementById(v).value; }
        function getNameValor(v){ return $('[name="'+v+'"]').val(); }
        function setValor(p,v){ if(!(p=="-")){ document.getElementById(p).value=v; } }
        function problemaRadio(n,v){
            retorno = 1;
            switch(v){
                case 'a': retorno=1; break;
                case 'b': retorno=2; break;
                case 'c': retorno=3; break;
            }
            return n+'r'+retorno;
        }
        function preencheQ(q){
            alfa = ['a','b','c','d','e','f','g'];
            completo = true;
            valorFinal = "";
            for(i=0;i<7;i++){
                if(!($('#q'+q+alfa[i]).val().length)){ completo = false; i=8; }
                else{ valorFinal += $('#q'+q+alfa[i]).val() + "/"; }
            }
            if(completo){
                $('#q'+q).val(valorFinal);
                $('#d'+q+' i').removeClass('vermelho').addClass('verde').html('check_circle_outline');
            }else
            if(!completo){ $('#d'+q+' i').removeClass('verde').addClass('vermelho').html('cancel'); }
        }
        function funcoesChange(){
            $('#q11b').on('change',function(){preencheQ(11)});$('#q11c').on('change',function(){preencheQ(11)});
            $('#q11d').on('change',function(){preencheQ(11)});$('#q11e').on('change',function(){preencheQ(11)});
            $('#q11f').on('change',function(){preencheQ(11)});$('#q11g').on('change',function(){preencheQ(11)});
            //
            $('#q12b').on('change',function(){preencheQ(12)});$('#q12c').on('change',function(){preencheQ(12)});
            $('#q12d').on('change',function(){preencheQ(12)});$('#q12e').on('change',function(){preencheQ(12)});
            $('#q12f').on('change',function(){preencheQ(12)});$('#q12g').on('change',function(){preencheQ(12)});
            //
            $('#q13b').on('change',function(){preencheQ(13)});$('#q13c').on('change',function(){preencheQ(13)});
            $('#q13d').on('change',function(){preencheQ(13)});$('#q13e').on('change',function(){preencheQ(13)});
            $('#q13f').on('change',function(){preencheQ(13)});$('#q13g').on('change',function(){preencheQ(13)});
            //
            $('#q14b').on('change',function(){preencheQ(14)});$('#q14c').on('change',function(){preencheQ(14)});
            $('#q14d').on('change',function(){preencheQ(14)});$('#q14e').on('change',function(){preencheQ(14)});
            $('#q14f').on('change',function(){preencheQ(14)});$('#q14g').on('change',function(){preencheQ(14)});
            //
            $('#q15b').on('change',function(){preencheQ(15)});$('#q15c').on('change',function(){preencheQ(15)});
            $('#q15d').on('change',function(){preencheQ(15)});$('#q15e').on('change',function(){preencheQ(15)});
            $('#q15f').on('change',function(){preencheQ(15)});$('#q15g').on('change',function(){preencheQ(15)});
            //
            $('#q16b').on('change',function(){preencheQ(16)});$('#q16c').on('change',function(){preencheQ(16)});
            $('#q16d').on('change',function(){preencheQ(16)});$('#q16e').on('change',function(){preencheQ(16)});
            $('#q16f').on('change',function(){preencheQ(16)});$('#q16g').on('change',function(){preencheQ(16)});
            //
            $('#q17b').on('change',function(){preencheQ(17)});$('#q17c').on('change',function(){preencheQ(17)});
            $('#q17d').on('change',function(){preencheQ(17)});$('#q17e').on('change',function(){preencheQ(17)});
            $('#q17f').on('change',function(){preencheQ(17)});$('#q17g').on('change',function(){preencheQ(17)});
            //
            $('#q18b').on('change',function(){preencheQ(18)});$('#q18c').on('change',function(){preencheQ(18)});
            $('#q18d').on('change',function(){preencheQ(18)});$('#q18e').on('change',function(){preencheQ(18)});
            $('#q18f').on('change',function(){preencheQ(18)});$('#q18g').on('change',function(){preencheQ(18)});
            //
            $('#q19b').on('change',function(){preencheQ(19)});$('#q19c').on('change',function(){preencheQ(19)});
            $('#q19d').on('change',function(){preencheQ(19)});$('#q19e').on('change',function(){preencheQ(19)});
            $('#q19f').on('change',function(){preencheQ(19)});$('#q19g').on('change',function(){preencheQ(19)});
            //
            $('#q20b').on('change',function(){preencheQ(20)});$('#q20c').on('change',function(){preencheQ(20)});
            $('#q20d').on('change',function(){preencheQ(20)});$('#q20e').on('change',function(){preencheQ(20)});
            $('#q20f').on('change',function(){preencheQ(20)});$('#q20g').on('change',function(){preencheQ(20)});
            //
            $('#q21b').on('change',function(){preencheQ(21)});$('#q21c').on('change',function(){preencheQ(21)});
            $('#q21d').on('change',function(){preencheQ(21)});$('#q21e').on('change',function(){preencheQ(21)});
            $('#q21f').on('change',function(){preencheQ(21)});$('#q21g').on('change',function(){preencheQ(21)});
            //
            $('#q22b').on('change',function(){preencheQ(22)});$('#q22c').on('change',function(){preencheQ(22)});
            $('#q22d').on('change',function(){preencheQ(22)});$('#q22e').on('change',function(){preencheQ(22)});
            $('#q22f').on('change',function(){preencheQ(22)});$('#q22g').on('change',function(){preencheQ(22)});
        }
        $(function(){funcoesChange();});
	</script>
</head>
<body>
	<main>
        <?php
            include("../back/conexao.php");
            $nomeAtividade .= ".php";
            $sql = "select oa.concluido conc from objetivo o inner join objaluno oa on o.id=oa.objId where urlObj='../quizz/$nomeAtividade' and oa.alunoId=".$_SESSION['id'].";";
            $resConc = $conn->query($sql);
            $conn->close();
            $lineConc = $resConc->fetch_array();
            if($lineConc['conc']==0){
        ?>
        <header>
            <h1 id="hTitulo">Campo Harmônico</h1>
            <button type="button" class="btn btn-danger btn-lg" id="btnStart" onclick="mostraAt()">Iniciar Atividade</button>
        </header>
        <?php
            }
            else{
                include('../back/conexao.php');
                $sql = "select q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,q21,q22 from respondeexerc where alunoId='{$_SESSION['id']}' and exercId=(select id from exerc where urlExerc='../quizz/$nomeAtividade');";
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
                <input type="hidden" id="exerc" name="exerc" value="../quizz/<?php echo $nomeAtividade; ?>">
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
                    <!--Transposição +/- (1 > 4)-->
                    <div class="form-group">
                        <li>
                            <label for="q1">Transponha os acordes somando ou subtraindo os tons indicados:</label>
                            <label class="input-group" for="q1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">C + 3 tons = </span>
                                </div>
                                <input type="text" class="form-control" id="q1" name="q1" placeholder="Nota..." required>
                            </label>
                            <label class="input-group" for="q2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">D# + 4 tons = </span>
                                </div>
                                <input type="text" class="form-control" id="q2" name="q2" placeholder="Nota..." required>
                            </label>
                            <label class="input-group" for="q3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">A - 2 tons = </span>
                                </div>
                                <input type="text" class="form-control" id="q3" name="q3" placeholder="Nota..." required>
                            </label>
                            <label class="input-group" for="q4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">E + 6 tons = </span>
                                </div>
                                <input type="text" class="form-control" id="q4" name="q4" placeholder="Nota..." required>
                            </label>
                        </li>
                    </div>
                    <!--Calculo de Distância (5 > 7)-->
                    <div class="form-group">
                        <li>
                            <label class="mb-0 pb-0" for="q5">Calcule a Distância entre os acordes:</label><small class="mt-0 pt-0 pb-2 d-block"><strong>Obs.</strong> Calcule sempre indo para frente. Caso seja tons quebrados digite desta maneira: (Ex. 2,5 - Dois tons e meio).</small>
                            <label class="input-group" for="q5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">F e B</span>
                                </div>
                                <input type="text" class="form-control" id="q5" name="q5" placeholder="Distância..." required>
                            </label>
                            <label class="input-group" for="q6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">F# e D</span>
                                </div>
                                <input type="text" class="form-control" id="q6" name="q6" placeholder="Distância..." required>
                            </label>
                            <label class="input-group" for="q7">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">C e B</span>
                                </div>
                                <input type="text" class="form-control" id="q7" name="q7" placeholder="Distância..." required>
                            </label>
                        </li>
                    </div>
                    <!--Grau Maior (8)-->
                    <div class="form-group">
                        <li>
                            <label for="q8">Qual Grau define se o Acorde é Maior(M) ou Menor(m)?</label>
                            <label class="input-group" for="q8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">º</span>
                                </div>
                                <select class="custom-select" id="q8" name="q8">
                                    <option>I</option><option>II</option><option>III</option><option>IV</option>
                                    <option>V</option><option>VI</option><option>VII</option>
                                </select>
                            </label>
                        </li>
                    </div>
                    <!--Distância entre Graus (9 > 10)-->
                    <div class="form-group">
                        <li>
                            <label for="q9">Qual a distância entre a Tônica(I) e o Grau que torna o acorde M ou m, quando ele é... </label>
                            <label class="input-group" for="q9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Maior: </span>
                                </div>
                                <select class="custom-select" id="q9" name="q9">
                                    <option>1</option><option>1,5</option><option>2</option><option>2,5</option>
                                    <option>3</option><option>3,5</option><option>4</option><option>4,5</option>
                                    <option>5</option><option>5,5</option><option>6</option><option>6,5</option>
                                </select>
                            </label>
                            <label class="input-group" for="q10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-light">Menor: </span>
                                </div>
                                <select class="custom-select" id="q10" name="q10">
                                    <option>1</option><option>1,5</option><option>2</option><option>2,5</option>
                                    <option>3</option><option>3,5</option><option>4</option><option>4,5</option>
                                    <option>5</option><option>5,5</option><option>6</option><option>6,5</option>
                                </select>
                            </label>
                        </li>
                    </div>
                    <!--Campo Harmônico (11 > 22)-->
                    <div class="form-group">
                        <li>
                            <label class="mb-0 pb-0" for="q11b">Escreva o Campo Harmônico: </label><small class="mt-0 pt-0 pb-2 d-block"><strong>Obs.</strong>Utilizar as siglas das notas, e colocar da mais grave para a mais aguda.</small>
                            <!--C 11-->
                            <div class="row mx-auto mb-1" id="d11">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q11a" value="C" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q11b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q11c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q11d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q11e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q11f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q11g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q11" name="q11" value="C" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                                <!--verde|check_circle_outline-->
                            </div>
                            <!--C# 12-->
                            <div class="row mx-auto mb-1" id="d12">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q12a" value="C#" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q12b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q12c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q12d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q12e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q12f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q12g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q12" name="q12" value="C#" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--D 13-->
                            <div class="row mx-auto mb-1" id="d13">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q13a" value="D" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q13b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q13c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q13d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q13e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q13f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q13g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q13" name="q13" value="D" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--D# 14-->
                            <div class="row mx-auto mb-1" id="d14">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q14a" value="D#" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q14b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q14c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q14d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q14e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q14f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q14g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q14" name="q14" value="D#" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--E 15-->
                            <div class="row mx-auto mb-1" id="d15">
                                <div class="col px-1">
                                    <input type="text" class="form-control  bg-white" id="q15a" value="E" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q15b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q15c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q15d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q15e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q15f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q15g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q15" name="q15" value="E" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--F 16-->
                            <div class="row mx-auto mb-1" id="d16">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q16a" value="F" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q16b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q16c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q16d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q16e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q16f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q16g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q16" name="q16" value="F" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--F# 17-->
                            <div class="row mx-auto mb-1" id="d17">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q17a" value="F#" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q17b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q17c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q17d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q17e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q17f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q17g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q17" name="q17" value="F#" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--G 18-->
                            <div class="row mx-auto mb-1" id="d18">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q18a" value="G" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q18b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q18c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q18d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q18e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q18f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q18g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q18" name="q18" value="G" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--G# 19-->
                            <div class="row mx-auto mb-1" id="d19">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q19a" value="G#" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q19b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q19c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q19d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q19e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q19f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q19g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q19" name="q19" value="G#" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--A 20-->
                            <div class="row mx-auto mb-1" id="d20">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q20a" value="A" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q20b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q20c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q20d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q20e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q20f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q20g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q20" name="q20" value="A" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--A# 21-->
                            <div class="row mx-auto mb-1" id="d21">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q21a" value="A#" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q21b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q21c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q21d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q21e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q21f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q21g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q21" name="q21" value="A#" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
                            </div>
                            <!--B 22-->
                            <div class="row mx-auto mb-1" id="d22">
                                <div class="col px-1">
                                    <input type="text" class="form-control bg-white" id="q22a" value="B" readonly>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q22b" placeholder="IIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q22c" placeholder="IIIº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q22d" placeholder="IVº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q22e" placeholder="Vº Grau" required>
                                </div>
                                <div class="col px-0">
                                    <input type="text" class="form-control" id="q22f" placeholder="VIº Grau" required>
                                </div>
                                <div class="col px-1">
                                    <input type="text" class="form-control" id="q22g" placeholder="VIIº Grau" required>
                                </div>
                                <input type="hidden" id="q22" name="q22" value="B" readonly>
                                <i class="material-icons vermelho pt-2" title="Preencha o Campo Harmônico para finalizar a linha">cancel</i>
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