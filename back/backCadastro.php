<?php
	//Conexão com o banco
	include('conexao.php');
	if(isset($_POST['btnCadastrar'])){
		if(!empty($_POST['cadNome'])){
            $_POST['cadSenha'] = md5($_POST['cadSenha']);
			$sql = "insert alunos(nome,dtEntrada,email,celular,aula,senha)values('{$_POST['cadNome']}','{$_POST['cadData']}','{$_POST['cadEmail']}','{$_POST['cadCelular']}','{$_POST['cadAula']}','{$_POST['cadSenha']}');";
			$conn->query($sql);
			if(isset($conn->error)&&!empty($conn->error)){
                $erro=1;
                if($conn->errno=='1062') $erro=3;
            }
            else $erro=0;
			$conn->close();
			header('Location: ../front/index.php?erro='.$erro);
		}else{
			echo "Não está entrando no if";
		}
	}
?>