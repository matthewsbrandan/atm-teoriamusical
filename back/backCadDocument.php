<?php
	//Conexão com o banco
	include('conexao.php');
	if(isset($_POST['btnCadAula'])){
		if(!empty($_POST['cadAula'])){
            $verifica = verificaNome('img/ppt',$_FILES['cadNomeArq']);
            if($verifica) $verifica = verificaNome('doc',$_FILES['cadPdfArq']);
            if($_FILES['cadNomeArq']['error']==0 && $_FILES['cadPdfArq']['error']==0 && $verifica){
                move_uploaded_file($_FILES['cadNomeArq']['tmp_name'],"../img/ppt/".$_FILES['cadNomeArq']['name']);
                move_uploaded_file($_FILES['cadPdfArq']['tmp_name'],"../doc/".$_FILES['cadPdfArq']['name']);
                $nivel = "(select id from nivel where nivel='{$_POST['cadNivel']}' and aula='{$_POST['cadAula']}')";
                $sql = "insert ppt(nomeImg,nomePdf,tituloArq,nivelId,aula) values ('{$_FILES['cadNomeArq']['name']}','../doc/{$_FILES['cadPdfArq']['name']}','{$_POST['cadTituloArq']}',$nivel,'{$_POST['cadAula']}');";
    			$conn->query($sql);
                if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
                else{ $erro=0; }
			    $conn->close();
            }else $erro = 1;
			header('Location: ../front/dashboard/root.php?sess=1&erro='.$erro);
		}
        else{ echo "Não está entrando no if"; }
	}else
    if(isset($_POST['btnCadExerc'])){
		if(!empty($_POST['cadAulaExerc'])){
            if($_FILES['btnUploadExerc']['error']!=4){
                if($_FILES['btnUploadExerc']['type']=="application/octet-stream"){
                    $verifica = verificaNome('quizz',$_FILES['btnUploadExerc']['name']);
                    $erro = 19;
                    if($_FILES['btnUploadExerc']['error']==0 && $verifica){
                        move_uploaded_file($_FILES['btnUploadExerc']['tmp_name'],"../quizz/".$_FILES['btnUploadExerc']['name']);
                        $erro = 18;
                    }
                }else
                if(substr($_FILES['btnUploadExerc']['type'],0,5)=="image"){
                    $verifica = verificaNome('img/exerc',$_FILES['btnUploadExerc']['name']);
                    $erro = 19;
                    if($_FILES['btnUploadExerc']['error']==0 && $verifica){
                        move_uploaded_file($_FILES['btnUploadExerc']['tmp_name'],"../img/exerc/".$_FILES['btnUploadExerc']['name']);
                        $erro = 18;
                    }
                }
                header('Location: ../front/dashboard/root.php?sess=0&erro='.$erro);
            }
            else{
                $nivel="(select id from nivel where nivel='{$_POST['cadNivelExerc']}' and aula='{$_POST['cadAulaExerc']}')";
                $sql = "insert exerc(urlExerc,imgExerc,tituloExerc,nivelId,aula) values('../quizz/{$_POST['cadUrlExerc']}','../img/exerc/{$_POST['cadImgExerc']}','{$_POST['cadTituloExerc']}',$nivel,'{$_POST['cadAulaExerc']}');";
                $conn->query($sql);
                if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
                else{ $erro=0; }
                $conn->close();
                header('Location: ../front/dashboard/root.php?sess=0&erro='.$erro);
            }
		}
        else{ echo "Não está entrando no if"; }
	}else
    if(isset($_POST['btnCadAudio'])){
		if(!empty($_POST['cadAulaAudio'])){
            if(isset($_FILES['cadNomeAudio'])){
                $_POST['cadNomeAudio']=retornoTipoAud($_POST['cadTipoAudio'])."/".$_FILES['cadNomeAudio']['name'];
                $_POST['cadComplemento']=$_FILES['cadComplemento']['name'];
                cadAud($_FILES['cadNomeAudio'],'mp3',$_POST['cadTipoAudio']);
                cadAud($_FILES['cadComplemento'],'php',$_POST['cadTipoAudio']);
            }
            $nivel="(select id from nivel where nivel='{$_POST['cadNivelAudio']}' and aula='{$_POST['cadAulaAudio']}')";
			$sql = "insert audio(nomeAud,tituloAud,urlComplemento,tipo,dificuldade,nivelId,aula,tamanho) values ('{$_POST['cadNomeAudio']}','{$_POST['cadTituloAudio']}','{$_POST['cadComplemento']}','{$_POST['cadTipoAudio']}','{$_POST['cadDifAudio']}',$nivel,'{$_POST['cadAulaAudio']}','{$_POST['cadTamanho']}');";
			$conn->query($sql);
			if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
            else{ $erro=2; }
			$conn->close();
			header('Location: ../front/dashboard/root.php?sess=2&erro='.$erro);
		}
        else{ echo "Não está entrando no if"; }
	}else
    if(isset($_POST['btnTestAudio'])){
		$url = "../front/iAudio.php?audio=".retornoTipoAud($_POST['cadTipoAudio'])."/".$_FILES['cadNomeAudio']['name']."&nome=".$_POST['cadTituloAudio']."&comp=".$_FILES['cadComplemento']['name']."&tamanho=".$_POST['cadTamanho']."&tipo=".$_POST['cadTipoAudio']."&nivel=".$_POST['cadNivelAudio']."&aula=".$_POST['cadAulaAudio']."&dif=".$_POST['cadDifAudio'];
        cadAud($_FILES['cadNomeAudio'],'mp3',$_POST['cadTipoAudio']);
        cadAud($_FILES['cadComplemento'],'php',$_POST['cadTipoAudio']);
		header('Location: '.$url);
         
	}else
    if(isset($_POST['btnCadObj'])){ //Objetivo
		if(!empty($_POST['cadAulaObj'])){
            $nivel="(select id from nivel where nivel='{$_POST['cadNivelObj']}' and aula='{$_POST['cadAulaObj']}')";
            $onClick = isset($_POST['cadOnclickObj'])?true:false;
			$sql = "insert objetivo(urlObj,tituloObj,descricao,nivelId,aula,onclick) values ('{$_POST['cadUrlObj']}','{$_POST['cadTituloObj']}','{$_POST['cadDescricaoObj']}',$nivel,'{$_POST['cadAulaObj']}','{$onClick}');";
			$conn->query($sql);
            $sql="call atualizaObjAlu('{$_POST['cadAulaObj']}');";
			$conn->query($sql);
			if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
            else{ $erro=14; }
			$conn->close();
			header('Location: ../front/dashboard/root.php?sess=3&erro='.$erro);
		}
        else{ echo "Não está entrando no if"; }
	}else
    if(isset($_POST['btnCadMusic'])){ //Musica
		if(!empty($_POST['cadAulaMusic'])){
			$sql = "insert musicas(url,nome,recomendacao,aula) values('{$_POST['cadUrlMusic']}','{$_POST['cadNomeMusic']}','{$_POST['cadRecomendaMusic']}','{$_POST['cadAulaMusic']}');";
			$conn->query($sql);
			if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
            else{ $erro=15; }
			$conn->close();
			header('Location: ../front/dashboard/root.php?sess=4&erro='.$erro);
		}
        else{ echo "Não está entrando no if"; }
	}else
    if(isset($_POST['btnCadApp'])){
		if(!empty($_POST['cadAulaApp'])){
            if(verificaNome('img/app',$_FILES['cadImgApp']['name'])){
                move_uploaded_file($_FILES['cadImgApp']['tmp_name'],"../img/app/".$_FILES['cadImgApp']['name']);
                $erro = 18;
            }
			$sql = "insert apps(img,url,nome,descricao,aula) values ('{$_FILES['cadImgApp']['name']}','{$_POST['cadUrlApp']}','{$_POST['cadNomeApp']}','{$_POST['cadDescricaoApp']}','{$_POST['cadAulaApp']}');";
			$conn->query($sql);
			if(isset($conn->error)&&!empty($conn->error)){ $erro=1; }
            else{ $erro=16; }
			$conn->close();
			header('Location: ../front/dashboard/root.php?sess=5&erro='.$erro);
		}
        else{ echo "Não está entrando no if"; }
	}else
    if(isset($_GET['deb'])&&($_GET['deb']>0)){
		$sql = "call pgNow('{$_GET['deb']}');";
		$conn->query($sql);
		if(isset($conn->error)&&!empty($conn->error)){ $erro=3; }
        else{ $erro=4; }
		$conn->close();
		header('Location: ../front/dashboard/root.php?sess=2&erro='.$erro);		
	}else
    if(isset($_GET['rem'])&&($_GET['rem']>0)){
		$sql="call remPg('{$_GET['rem']}');";
		$conn->query($sql);
		if(isset($conn->error)&&!empty($conn->error)){ $erro=5; }
        else{ $erro=6; }
		$conn->close();
		header('Location: ../front/dashboard/root.php?sess=2&erro='.$erro);
	}else
    if(isset($_GET['lib'])&&($_GET['lib']>0)){
		$sql = "select termo from alunos where id='{$_GET['lib']}';";
		$dt = $conn->query($sql);
        if($res = $dt->fetch_array()) if($res['termo']==1){
            $sql = "update alunos set liberacao='1' where id='{$_GET['lib']}';";
            $conn->query($sql);
            if(isset($conn->error)&&!empty($conn->error)){ $erro=7; }
            else{ $erro=8; }
        }
        else{ $erro=20; }
		$conn->close();
		header('Location: ../front/dashboard/rootLiberacao.php?sess=3&erro='.$erro);		
	}else
    if(isset($_GET['remLib'])&&($_GET['remLib']>0)){
		$sql = "update alunos set liberacao='0' where id='{$_GET['remLib']}';";
		$conn->query($sql);
		if(isset($conn->error)&&!empty($conn->error)){ $erro=9; }
        else{ $erro=10; }
		$conn->close();
		header('Location: ../front/dashboard/root.php?sess=3&erro='.$erro);
	}else
    if(isset($_GET['libObj'])&&($_GET['libObj']>0)){
        $sql = "update objaluno set concluido='1' where id='{$_GET['libObj']}'";
        $conn->query($sql);
        if(isset($conn->error)&&!empty($conn->error)){ $erro=18; }
        else{ $erro=19; }
        $conn->close();
        header('Location: ../front/dashboard/rootLiberacao.php?active=1&erro='.$erro);
    }else
    if(isset($_GET['notificaVer'])){
        $sql = "update notificaroot set vista=1 where id={$_GET['notificaVer']}";
        $conn->query($sql);
        $conn->close();
        header('Location: ../front/dashboard/root.php?sess=5');
    }else
    if(isset($_GET['notificaDesver'])){
        $sql = "update notificaroot set vista=0 where id={$_GET['notificaDesver']}";
        $conn->query($sql);
        $conn->close();
        header('Location: ../front/dashboard/root.php?sess=5');
    }
    // - - - FUNCTIONS - - - //
    function print_pre($p){ echo "<pre>"; print_r($p); echo "</pre>"; }
    function verificaNome($pasta,$nome){
        $retorno=true;
        $path = "../".$pasta."/";
        $diretorio = dir($path);
        while($arquivo = $diretorio -> read()){ if($arquivo==$nome){ $retorno=false; break; } }
        $diretorio -> close();
        return $retorno;
    }
    function cadAud($f,$n,$t){
        if($n=='mp3'){ $path = "audio/".retornoTipoAud($t); }else 
        if($n=='php'){ $path = "audio/complemento"; }
        if(verificaNome($path,$f['name'])){ move_uploaded_file($f['tmp_name'],"../".$path."/".$f['name']); }
    }
    function retornoTipoAud($t){
        $retorno;
        switch($t){
            case 'Sequência de Acordes':    $retorno="sequencia";   break;
            case 'Exercício de Mobilidade': $retorno="exercicio";   break;
            case 'Escalas':                 $retorno="escalas";     break;        
        }
        return $retorno;
    }
?>
