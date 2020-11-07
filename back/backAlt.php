<?php
	//Conexão com o banco
    session_start();
	include('conexao.php');
    $localRetorno = !isset($_SESSION['liberacao'])||$_SESSION['liberacao']==0?'pagLiberando.php':'pagPerfil.php';
    //Alteração de Horário de Aula
	if(isset($_POST['btnAltHora'])){
		$dia = $_POST['altSemana']." às ".$_POST['altHora'].":".$_POST['altMin'];
		$sql = "call altSemana('{$dia}','{$_POST['idHora']}');";
		$conn->query($sql);
		if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
        else{ $erro=0; }
		$conn->close();
		header('Location: ../front/'.$localRetorno.'?erro='.$erro);
	}else
    //Pedido de Altereção de Pagamento
    if(isset($_POST['btnAltPG'])){
		$sql = "insert notificaroot(alunoId,acao) values ('{$_POST['idPG']}','Solicitação de alteração de Data de Pagamento para dia: ({$_POST['altDataPG']})');";
		$conn->query($sql);
		if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
        else{ $erro=3; }
		$conn->close();
		header('Location: ../front/'.$localRetorno.'?erro='.$erro); //Manutenção
	}else
    //Alteração de Dados - Email e Celular
    if(isset($_POST['btnAltDados'])){
		if(!empty($_POST['altEmail'])){
            $sql = "update alunos set email='{$_POST['altEmail']}',celular='{$_POST['altCelular']}' where id='{$_POST['idDados']}'";
            $conn->query($sql);
            if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
            else{ $erro=0; }
        }else $erro=4;
		$conn->close();
		header('Location: ../front/'.$localRetorno.'?erro='.$erro);
	}else
    //Alteração de Senha
    if(isset($_POST['btnAltDadosSenha'])){
		if($_POST['altSenhaNova']==$_POST['altSenhaConf']){
            $senha = md5($_POST['altSenhaNova']);
            $sql = "insert notificaroot(alunoId,acao) values ('{$_POST['idSenha']}','Alteração de senha no dia (".date('d-m-Y').")'); ";
            $conn->query($sql);
            $sql = "update alunos set senha='{$senha}' where id='{$_POST['idSenha']}';";
            $erro=1; //Erro
            if(!(isset($conn->error)&&!empty($conn->error))){
                $conn->query($sql);
                if(!(isset($conn->error)&&!empty($conn->error))){
                    $erro=0; //Alterado
                    $_SESSION['senha']=$senha;
                }
            }
        }else $erro=5;
		$conn->close();
		header('Location: ../front/'.$localRetorno.'?erro='.$erro);
	}else
    //Pedido de Curso
    if(isset($_POST['btnAltCurso'])){
        $sql = "insert notificaroot(alunoId,acao) values ('{$_POST['idCurso']}','Solicitação de alteração de curso para aula de {$_POST['altCurso']} no dia (".date('d-m-Y').")');";
		$conn->query($sql);
		if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
        else{ $erro=3; }
		$conn->close();
		header('Location: ../front/'.$localRetorno.'?erro='.$erro);
	}else
    //Adicionando um novo nível músical
    if(isset($_POST['btnActionSobNivel'])){
        $sql = "call sobNivel();";
        $conn->query($sql);
        if(isset($conn->error)&&!empty($conn->error)){ $retorno="erro=11"; }
        else{ $retorno="sobN=1"; }
        $conn->close();
        header('Location: ../front/dashboard/root.php?sess=1&'.$retorno);
    }else
    //Aluno subindo de nível
    if(isset($_GET['sobN'])){
        $sql = "select * from nivel where nivel=({$_GET['n']}+1) and aula='{$_GET['a']}';";
        $resultado = $conn->query($sql);
        $linha = $resultado->fetch_array();
        if(!empty($linha['id'])){
            $sql="update alunos set nivelId='{$linha['id']}' where id='{$_GET['sobN']}';";
            $retorno = "?sobN=".($_GET['n']+1);
        }
        $conn->close();
        //header('Location: principal.php'.$retorno);
    }else
    //**MANUTENÇÃO** Nenhuma função está sendo executada.    
    if(isset($_POST['btnConclui'])){ header('Location: ../front/principal.php?ativC=true'); }else
    //Finalizando objetivo
    if(isset($_POST['btnFinaliza'])){
        if(isset($_POST['q1'])){
            $sql = "select * from objaluno where alunoId='{$_SESSION['id']}' and objId=(select id from objetivo where urlObj='{$_POST['exerc']}');";
            print_pre($_POST);
            $obj = $conn->query($sql);
            $resultado = $obj->fetch_array();
            if($resultado['concluido']==0){
                $sql = "insert respondeexerc values (null,'{$_SESSION['id']}',(select id from exerc where urlExerc='{$_POST['exerc']}' and aula='{$_SESSION['aula']}'),";
                for($c=1;$c<=$_POST['qtdQ'];$c++){
                    $q = 'q'.$c;
                    $sql=$sql."'".$_POST[$q]."'";
                    if($c!=$_POST['qtdQ']){ $sql=$sql.","; }
                }
                $sql = $sql.");";
                $conn->query($sql);
                if(isset($conn->error)&&!empty($conn->error)){
                    echo "<script> alert('Houver um erro ao Guardar as Resposta da Atividade'); </script>";
                }
                else{
                    $sql = "update objaluno set concluido='1' where alunoId='{$_SESSION['id']}' and id='{$resultado['id']}';";
                    $conn->query($sql);
                    header('Location: '.$_POST['exerc']);
                }
            }
            else{  header('Location: '.$_POST['exerc']); }
            $conn->close();
        }
    }else
    //Aceitar Termos
    if(isset($_POST['btnAceitarTermo'])){
        if($_POST['btnAceitarTermo']=="Recusar"){            
            $sql = "update alunos set liberacao=false,termo=false where id='{$_POST['idTermo']}';";
            $conn->query($sql);
            if(isset($conn->error)&&!empty($conn->error)){ $erro="erro=8"; }
            else{ $_SESSION['termo'] = 0; }
        }
        else{
            $sql = "update alunos set modalidade='{$_POST['btnAceitarTermo']}',termo=true where id='{$_POST['idTermo']}';";
            $conn->query($sql);
            if(isset($conn->error)&&!empty($conn->error)){ $erro="erro=6"; }
            else{
                $erro = "erro=7";
                $_SESSION['termo'] = 1;
                $_SESSION['modalidade'] = $_POST['btnAceitarTermo'];
            } 
        }
		$conn->close();
		header('Location: ../front/pagLiberando.php?'.(isset($erro)?$erro:''));
    }else
    //Conclui Objetivo
    if(isset($_GET['conc'])){
        $sql = "update objaluno set concluido=1 where id='{$_GET['conc']}' and alunoId='{$_SESSION['id']}';";
        $conn->query($sql);
        if(isset($conn->error)&&!empty($conn->error)){ $conc=1; }
        else{ $conc=0; }
        $conn->close();
        header('Location: ../front/pagPpt.php?conc='.$conc);
    }
    function print_pre($p){
        echo "<pre>";
        print_r($p);
        echo "</pre>";
    }
?>