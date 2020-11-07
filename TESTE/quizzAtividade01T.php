<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>Aula de Música</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Upright" rel="stylesheet">
	<style>
		body{
			background: url("../img/fundo/fundoFone.jpg");
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
        .linha input{
            display: inline-block;
            width: 100px;
        }
        section div#dBtn{
            margin-left:20px;
        }
        div#legenda{
            margin-top: -15px;
            display: none;
            font-family: 'Cormorant Upright', serif;
            text-align: center;
            background: rgba(40,40,40,.6);
        }
        .azul{
            color: rgba(64,224,208,1);
        }
        .verde{
            color: rgba(0,250,154,1);;
        }
        .vermelho{
            color: rgba(255,34,34,1);
        }
	</style>
	<script>
        var fim = false;
        function mostraAt(){
            document.getElementById('btnStart').style="display:none;";
            document.getElementById('hTitulo').style="margin-top: 0;background: rgba(10,10,10,.4);";
            document.getElementById('atividade').style="display: block;";
        }
        function esconde(){
            if(fim){
                window.location.href="quizzAtividade01T.php";
            }else{
                hTitulo.innerHTML="Nomenclatura";
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
                    hTitulo.innerHTML="Correção Nomenclatura";
                    document.getElementById('legenda').style="display:block;"
                    setValor("q1","Para escrever as notas de uma forma mais simplificada e eficiente. ("+getValor("q1")+")");
                    rCor("q1","Parcial");
                    //q2 q8
                    if(getValor("q2").toUpperCase()==("Dó Sustenido").toUpperCase()) rCor("q2","Certo");
                    else rCor("q2","Erro");
                    setValor("q2","Dó Sustenido ("+getValor("q2")+")");
                    if(getValor("q3").toUpperCase()==("Si").toUpperCase()) rCor("q3","Certo");
                    else rCor("q3","Erro");
                    setValor("q3","Si ("+getValor("q3")+")");
                    if(getValor("q4").toUpperCase()==("Sol com Sétima").toUpperCase()) rCor("q4","Certo");
                    else rCor("q4","Erro");
                    setValor("q4","Sol com Sétima ("+getValor("q4")+")");
                    if(getValor("q5").toUpperCase()==("Lá Menor com Sétima").toUpperCase()) rCor("q5","Certo");
                    else rCor("q5","Erro");
                    setValor("q5","Lá Menor com Sétima ("+getValor("q5")+")");
                    if(getValor("q6").toUpperCase()==("Sol com Si").toUpperCase()) rCor("q6","Certo");
                    else rCor("q6","Erro");
                    setValor("q6","Sol com Si ("+getValor("q6")+")");
                    if(getValor("q7").toUpperCase()==("Ré com Quarta e Sétima").toUpperCase()) rCor("q7","Certo");
                    else rCor("q7","Erro");
                    setValor("q7","Ré com Quarta e Sétima ("+getValor("q7")+")");
                    if(getValor("q8").toUpperCase()==("Mi Menor com Quinta").toUpperCase()) rCor("q8","Certo");
                    else rCor("q8","Erro");
                    setValor("q8","Mi Menor com Quinta ("+getValor("q8")+")");
                    //q9 q15
                    if(getValor("q9")=="Bb") rCor("q9","Certo");
                    else rCor("q9","Erro");
                    setValor("q9","Bb ("+getValor("q9")+")");
                    if(getValor("q10")=="C#7") rCor("q10","Certo");
                    else rCor("q10","Erro");
                    setValor("q10","C#7 ("+getValor("q10")+")");
                    if(getValor("q11")=="Fm") rCor("q11","Certo");
                    else rCor("q11","Erro");
                    setValor("q11","Fm ("+getValor("q11")+")");
                    if(getValor("q12")=="C/E") rCor("q12","Certo");
                    else rCor("q12","Erro");
                    setValor("q12","C/E ("+getValor("q12")+")");
                    if(getValor("q13")=="G7M") rCor("q13","Certo");
                    else rCor("q13","Erro");
                    setValor("q13","G7M ("+getValor("q13")+")");
                    if(getValor("q14")=="A#m") rCor("q14","Certo");
                    else rCor("q14","Erro");
                    setValor("q14","A#m ("+getValor("q14")+")");
                    if(getValor("q15")=="D/F#") rCor("q15","Certo");
                    else rCor("q15","Erro");
                    setValor("q15","D/F# ("+getValor("q15")+")");
                    //q16 q22
                    if(getValor("q16").toUpperCase()==("Dó").toUpperCase()) rCor("q16","Certo");
                    else rCor("q16","Erro");
                    setValor("q16","Dó ("+getValor("q16")+")");
                    if(getValor("q17").toUpperCase()==("Ré").toUpperCase()) rCor("q17","Certo");
                    else rCor("q17","Erro");
                    setValor("q17","Ré ("+getValor("q17")+")");
                    if(getValor("q18").toUpperCase()==("Mi").toUpperCase()) rCor("q18","Certo");
                    else rCor("q18","Erro");
                    setValor("q18","Mi ("+getValor("q18")+")");
                    if(getValor("q19").toUpperCase()==("Fá").toUpperCase()) rCor("q19","Certo");
                    else rCor("q19","Erro");
                    setValor("q19","Fá ("+getValor("q19")+")");
                    if(getValor("q20").toUpperCase()==("Sol").toUpperCase()) rCor("q20","Certo");
                    else rCor("q20","Erro");
                    setValor("q20","Sol ("+getValor("q20")+")");
                    if(getValor("q21").toUpperCase()==("Lá").toUpperCase()) rCor("q21","Certo");
                    else rCor("q21","Erro");
                    setValor("q21","Lá ("+getValor("q21")+")");
                    if(getValor("q22").toUpperCase()==("Si").toUpperCase()) rCor("q22","Certo");
                    else rCor("q22","Erro");
                    setValor("q22","Si ("+getValor("q22")+")");
                    window.scrollTo(0, 0);
                    tituloModalResultado.innerHTML="Parabéns por Finalizar a Atividade";
                    subTituloModalResultado.innerHTML="<center><b style='font-size: 14pt;'>Você Completou esta Atividade</b><br/>Veja seus erros e acertos e clique em concluir para encerrar a atividade. Continue estudando e evoluindo seus conhecimento musicais.</center>";
                    document.getElementById('btnChamaModalResult').click(); 
                }
            }
        }
        function valida(){
            v = new Array("q1","q2","q3","q4","q5","q6","q7","q8","q9","q10","q11","q12","q13","q14","q15","q16","q17","q18","q19","q20","q21","q22");
            retorno = false;
            for(indice=0; indice<22; indice++){
                if(getValor(v[indice]).trim().length==0){
                    alert("Preencha todos os Campos do Formulário");
                    indice = 22;
                    retorno = false;
                }else{
                    retorno = true;
                }
            }
            return retorno;
        }
        function rCor(v,t){
            switch(t){
                case 'Erro':
                    document.getElementById(v).style="background: rgba(255,34,34,.7);color:white;";
                    break;
                case 'Certo':
                    document.getElementById(v).style="background: rgba(0,250,154,.7);color:white;";
                    break;
                case 'Parcial':
                    document.getElementById(v).style="background: rgba(64,224,208,.7);color:white;";
                    break;
            }
        }
        function preenche(v1,v2,v3,v4,v5,v6,v7,v8,v9,v10,v11,v12,v13,v14,v15,v16,v17,v18,v19,v20,v21,v22){
            mostraAt();
            v = new Array(v1,v2,v3,v4,v5,v6,v7,v8,v9,v10,v11,
                          v12,v13,v14,v15,v16,v17,v18,v19,v20,v21,v22);
            q = new Array("q1","q2","q3","q4","q5","q6","q7","q8","q9","q10","q11",
                          "q12","q13","q14","q15","q16","q17","q18","q19","q20","q21","q22");
            for(indice=0; indice<22; indice++){
                setValor(q[indice],v[indice]);
            }
            
            corrige();
        }
        function manutencao(){ alert("Área em Manutenção!"); }
        function getValor(v){ return document.getElementById(v).value; }
        function setValor(p,v){ document.getElementById(p).value=v; }
	</script>
</head>
<body>
	<main>
        <?php
            include("../back/conexao.php");
            $sql = "select oa.concluido conc from objetivo o inner join objaluno oa on o.id=oa.objId where urlObj='../quizz/quizzAtividade01T.php' and oa.alunoId=".$_SESSION['id'].";";
            $resConc = $conn->query($sql);
            $conn->close();
            $lineConc = $resConc->fetch_array();
            if($lineConc['conc']==0){
        ?>
        <header>
            <h1 id="hTitulo">Nomenclatura</h1>
            <button type="button" class="btn btn-danger btn-lg" id="btnStart" onclick="mostraAt()">Iniciar Atividade</button>
        </header>

        <?php
            }else{
                include('../back/conexao.php');
                $sql = "select q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,q21,q22 from respondeexerc where alunoId='{$_SESSION['id']}' and exercId=(select id from exerc where urlExerc='quizzAtividade01T');";
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
            <h1 id="hTitulo">Atividade de Nomenclatura Concluida</h1>
            <button type="button" class="btn btn-primary btn-lg" id="btnStart" onclick="preenche(<?php echo $paramResposta; ?>)">Resultados</button>
        </header>
        <?php } ?>
        <!-- Atividade -->
        <section id="atividade">
            <form method="POST" action="../back/backAlt.php" autocomplete="off">
                <input type="hidden" id="exerc" name="exerc" value="quizzAtividade01T">
                <input type="hidden" id="qtdQ" name="qtdQ" value="22">
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
                            <label for="q1">Para que utilizamos a Nomenclatura?</label>
                            <textarea class="form-control" id="q1" name="q1" rows="2" placeholder="Resposta.." required></textarea>
                        </li>
                    </div>
                    <div class="form-group">
                        <li>Preencha com a Nota correspondente às Siglas abaixo:</li>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">C#</span>
                            </div>
                            <input type="text" class="form-control" id="q2" name="q2" placeholder="Nome da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">B</span>
                            </div>
                            <input type="text" class="form-control" id="q3" name="q3" placeholder="Nome da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">G7</span>
                            </div>
                            <input type="text" class="form-control" id="q4" name="q4" placeholder="Nome da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Am7</span>
                            </div>
                            <input type="text" class="form-control" id="q5" name="q5" placeholder="Nome da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">G/B</span>
                            </div>
                            <input type="text" class="form-control" id="q6" name="q6" placeholder="Nome da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">D4/7</span>
                            </div>
                            <input type="text" class="form-control" id="q7" name="q7" placeholder="Nome da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Em/5</span>
                            </div>
                            <input type="text" class="form-control" id="q8" name="q8" placeholder="Nome da Nota" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <li>Preencha com as Siglas correspondentes às Notas abaixo:</li>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Si Bemol</span>
                            </div>
                            <input type="text" class="form-control" id="q9" name="q9" placeholder="Sigla da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Dó Sustenido com Sétima</span>
                            </div>
                            <input type="text" class="form-control" id="q10" name="q10" placeholder="Sigla da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Fá Menor</span>
                            </div>
                            <input type="text" class="form-control" id="q11" name="q11" placeholder="Sigla da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Dó com Mi</span>
                            </div>
                            <input type="text" class="form-control" id="q12" name="q12" placeholder="Sigla da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Sol com Sétima Maior</span>
                            </div>
                            <input type="text" class="form-control" id="q13" name="q13" placeholder="Sigla da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Lá Sustenido Menor</span>
                            </div>
                            <input type="text" class="form-control" id="q14" name="q14" placeholder="Sigla da Nota" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-light">Ré com Fá Sustenido</span>
                            </div>
                            <input type="text" class="form-control" id="q15" name="q15" placeholder="Sigla da Nota" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <li>Escreva os Nomes das Notas Naturais em Sequência:</li>
                        <div class="linha">
                            <input type="text" class="form-control" id="q16" name="q16" placeholder="1ª Nota" required>
                            <input type="text" class="form-control" id="q17" name="q17" placeholder="2ª Nota" required>
                            <input type="text" class="form-control" id="q18" name="q18" placeholder="3ª Nota" required>
                            <input type="text" class="form-control" id="q19" name="q19" placeholder="4ª Nota" required>
                            <input type="text" class="form-control" id="q20" name="q20" placeholder="5ª Nota" required>
                            <input type="text" class="form-control" id="q21" name="q21" placeholder="6ª Nota" required>
                            <input type="text" class="form-control" id="q22" name="q22" placeholder="7ª Nota" required>
                        </div>
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