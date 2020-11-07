<?php
    session_start();
    if(!((isset($_SESSION['root']))&&($_SESSION['root']=="Ativo"))){
		header('Location: index.php?erro=4');
	}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>ATM - Testes</title>
	<link rel="icon" href="../img/icones/blur_on.png" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilo-basic.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css"/>
    <meta charset="UTF-8"/>
    <style>
        body{
            background-image: url(../img/fundo/fundoCel.jpg);
        }
        /* Sessão */
        section{
            margin-top: 20px;
            text-align: center;
        }
        section h1{
            color: #eee;
            padding: 5px;
            background: rgba(0,0,0,.4);
            margin-bottom: 10px;
        }
        section h2{
            color: rgba(0,0,0,.75);
            margin-top:-8px;
            font-size: 16pt;
            padding: 5px;
            background: rgba(120,120,120,.4);
            cursor: pointer;
            transition: background .4s;
            transition: color .4s;
            border-radius: 20px;
        }
        section h2:hover{
            background: rgba(0,0,0,.4);
            color: rgb(220,220,220);
            
        }
        /* Artigo */
        article{
            margin-bottom: 10px;
        }
        /* Conteudo 1 */
        div#conteudo1 div.table-responsive{
            margin: auto;
            margin-top: -8px;
            margin-bottom: 20px;
            color: rgb(220,220,220);
            background: rgba(20,20,20,.9);
            max-width: 1000px;
            border-radius: 20px;
        }
        div#selecao{
            margin: 10px;
            margin-bottom: 20px;
        }
        /* Conteudo 2 - Parte 1*/
        div#conteudo2{
            position: relative;
            height: 400px;
        }
        div#janela1, div#janela2{ position: absolute; height: 150px; width: 1300px; }
        div#janela1{
            background: black;
            clip: rect(0px 1300px 150px 0px);
        }
        div#janela2{
            background: aquamarine;
            margin:35px;
        }
        /* Parte 2 */
        div#principal{
            margin-top: 150px;
            position: absolute;
            height: 150px;
            width: 2660px;
            clip: rect(0px 266px 150px 0px);
        }
        div#janela{
            padding: 0px;
            margin: 0px;
            background: white;
            display: block;
            height: 150px;
            position: relative;
        }
        div#janela img{
            padding: 0px;
            margin: 0px;
            width: 266px;
            height: 150px;
            float: left;
        }
        div#conteudo1, div#conteudo2, div#conteudo3, div#conteudo4{
            display: none;
        }
    </style>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
    <script>
        var ct1 = false;
        var ct2 = false;
        var ct3 = false;
        var ct4 = false;
        function expande(v){
            disp = false;
            switch(v){
                case 'conteudo1': disp = ct1; ct1 = !disp; break;
                case 'conteudo2': disp = ct2; ct2 = !disp; break;
                case 'conteudo3': disp = ct3; ct3 = !disp; break;
                case 'conteudo4': disp = ct4; ct4 = !disp; break;
                default: alert('Erro ao chamar função'); break;
            }
            if(disp) document.getElementById(v).style = "display: none;";    
            else document.getElementById(v).style = "display: block;";
        }
        function clickGet(v){
            window.location.href="TESTE.php?table="+v;
        }
        function link(v){
            window.location.href=v;
        }
        window.onload = function(){
            <?php
                if(isset($_GET['active'])){ echo "expande('conteudo".$_GET['active']."');"; }
                if(isset($_GET['table'])){ echo "expande('conteudo1');"; }
            ?>
        }
        $(function(e){
           $('#janela1').hover(mover);
           $('#janela2').hover(voltar);
           setInterval(moverFoto,3500);
        });
        function mover(){
            $('#janela2').animate({left:-35},500);
            $('#janela2').animate({top:-35},500);
        }
        function voltar(){
            $('#janela2').animate({top:0},500);
            $('#janela2').animate({left:0},500);
        }
        function moverFoto(){
            $('#janela').animate({left:"-=266"},1500, function(e){
                $('#info').html($('#janela').position().left);
                if($('#janela').position().left == -2394){ $('#janela').css('left',0);}
            });
        }
        function selectCol(p){
            document.getElementById('btnExecutar').value = p;
            document.getElementById('btnExecutar').click();
        }
        function fCopy(){
            $('textarea').select();
            confirma = document.execCommand('copy');
            if(confirma) alert('Texto Copiado com Sucesso');
            else alert('Houve um Erro');
        }
    </script>
</head>
<body>
	<section>
        <a href="TESTE.php" style="text-decoration: none;"><h1>Teste de Execução</h1></a>
        <!-- Testes -->
        <article id="teste1" title="Teste 1">
             <h2 onclick="expande('conteudo1');">Tabela Dinâmica</h2>
             <div id="conteudo1">
                 <div id="selecao">
                    <?php $arrayButton = array("alunos","apps","audio","exerc","musicas","nivel","notificaroot","objaluno","objetivo","pagamento", "ppt","respondeexerc"); ?>                
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <?php foreach($arrayButton as $values){?>
                      <button type="submit" class="btn btn-secondary" onclick="clickGet('<?php echo $values; ?>')"> <?php echo $values; ?> </button>
                      <?php } ?>                    
                    </div>
                 </div>
                <?php if(isset($_GET['table'])){ ?>
                    <?php               
                        include('../back/conexao.php');
                        $sql = "select * from ".$_GET['table']." limit 1;";
                        $res = $conn->query($sql);
                        $conn->close();
                        include('../back/conexao.php');
                        $sql = "select * from ".$_GET['table'].";";
                        $res1 = $conn->query($sql);
                        $conn->close();
                        $linha = $res->fetch_array();
                        $qtdCol = 0;
                        unset($col);
                        if($linha){
                        foreach($linha as $key => $value){
                            if(!isset($ajuste)||$ajuste==true){
                                $ajuste = false;
                            }else{
                                $col[$qtdCol] = $key;
                                $qtdCol++;
                                $ajuste = true;
                            }                            
                        }
                    ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <?php foreach($col as $value){ ?>
                                    <th scope="col"><?php echo $value."<br/>"; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($linha1 = $res1->fetch_array()){ ?>
                                <tr>
                                    <?php for($c=0;$c<$qtdCol;$c++){ ?>
                                    <td><?php echo $linha1[$c]; ?></td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ echo "<h2>Não há dados nesta tabela</h2>"; }?>
                <?php } ?>
             </div>
             <h2 onclick="expande('conteudo2');">Teste Clip</h2>
             <div id="conteudo2">
                <div id="janela1">
                    <div id="janela2"></div>
                </div><br/>
                <div id="principal">
                    <div id="janela">
                        <img src="../img/print/apoio.png">
                        <img src="../img/print/audio.png">
                        <img src="../img/print/aula.png">
                        <img src="../img/print/exercicio.png">
                        <img src="../img/print/home.png">
                        <img src="../img/print/indicacao.png">
                        <img src="../img/print/perfil.png">
                        <img src="../img/print/nota-t.png">
                        <img src="../img/print/nota-v.png">
                        <img src="../img/print/apoio.png">
                    </div>
                </div>
                    <h1 id="info" style="margin-top: 320px;">Aqui </h1>
            </div>
             <h2 onclick="expande('conteudo3');">Backup Banco</h2>
             <div id="conteudo3">
                <div class="col-md-6 offset-md-3">
                    <table class="table table-dark" id="bpTbl">
                        <thead>
                            <tr><th colspan="3">Colunas</th></tr>
                        </thead>
                        <tbody>
                        <?php
                            include('../back/conexao.php');
                            $sql = "show tables";
                            $dataRes = $conn->query($sql);
                            $conn->close();
                            while($res = $dataRes->fetch_array()){
                        ?>
                            <tr>
                                <td style="width:50px;"></td>
                                <td><?php echo $res[0];?></td>
                                <td style="width:50px;" onclick="selectCol('select * from <?php echo $res[0]; ?>;');" style="cursor: pointer;"><i class="material-icons" style="color: rgb(218, 165, 32);cursor: pointer;">flash_on</i></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <form action="TESTE.php?active=3&#bpResposta" method="POST" style="display:none;">
                        <button type="submit" id="btnExecutar" name="btnExecutar" value="">Executar</button>
                    </form>
                    <?php
                        if(isset($_POST['btnExecutar'])){
                            $nCol = substr($_POST['btnExecutar'],14,-1); 
                            include('../back/conexao.php');
                            $dataBP = $conn->query($_POST['btnExecutar']);
                            $copyCommand = "insert into $nCol values(";
                            $conn->close();
                            while($resBP = $dataBP->fetch_array()){
                                for($c=0;$c<(count($resBP)/2);$c++){
                                    $copyCommand .= "'".$resBP[$c]."',";
                                }
                                $copyCommand = substr($copyCommand,0,-1)."),(";
                            }
                            $copyCommand = substr($copyCommand,0,-2);
                            $copyCommand .=";";
                            $vazia = false;
                            if(!preg_match("#\((.*)\)#",$copyCommand)){
                                $copyCommand = "Tabela $nCol está vazia...";
                                $vazia = true;
                            }
                    ?>
                    <div class="form-group">
                        <textarea class="form-control <?php if($vazia) echo 'text-center';?>" style="background: rgba(250,250,250,.95);" id="bpResposta" rows="<?php echo $vazia?1:3;?>"><?php echo $copyCommand; ?></textarea>
                    </div>
                    <div class="btn-group btn-block">
                        <?php if(!$vazia){ ?>
                        <button type="button" class="btn btn-primary btn-block" onclick="fCopy()">
                            Copiar
                        </button>
                        <?php } ?>
                        <a href="#bpTbl" class="btn btn-default <?php echo $vazia?"btn-block":"";?>" style="border: 1px solid #aaa;color: #666;background: rgba(250,250,250,.8)" title="Voltar ao Topo">&uarr;</a>
                    </div>
                    <?php } ?>
                </div>
             </div>
            <h2 onclick="expande('conteudo4');">Conexão com Banco</h2>
            <div id="conteudo4">
                <div class="card rounded m-3 p-2 bg-dark text-warning">
                    <h3>Aula: <?php include('../back/conexao.php'); ?></h3><hr class="bg-light"/>
                    <h3>What: <?php include('../back/conexao_wm.php'); ?></h3>
                </div>
            </div>
        </article>
        <!--Retorno-->
        <div  style="margin-left: 200px; margin-right: 200px;">
            <button type="button" class="btn btn-danger btn-block" onclick="link('dashboard/root.php');">Dashboard &Omega;</button>
        </div>
        <div class="card-footer text-muted"> Prof. Mateus Brandão </div>
    </section>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
</html>