<?php 
	session_start();
    if(isset($_POST['btnFinaliza'])){
    	//CRIAR UMA TABELA PARA GUARDAR OS RESULTADOS DAS ATIVIDADES
    	$sql="insert alunoQuizz(alunoId,quizz) values ('{$_SESSION['id']}','Nomenclatura');";
    	$sql="insert respostaQuizz(quizzId,resposta) values ('NN','{$_POST['q1']}'),('NN','{$_POST['q2a']}'),('NN','{$_POST['q2b']}'),('NN','{$_POST['q2c']}'),('NN','{$_POST['q2d']}'),('NN','{$_POST['q2e']}'),('NN','{$_POST['q2f']}'),('NN','{$_POST['q3a']}'),('NN','{$_POST['q3b']}'),('NN','{$_POST['q3c']}'),('NN','{$_POST['q3d']}'),('NN','{$_POST['q3e']}'),('NN','{$_POST['q3f']}'),('NN','{$_POST['q3g']}'),'{$_POST['q4a']}'),('NN','{$_POST['q4b']}'),('NN','{$_POST['q4c']}'),('NN','{$_POST['q4d']}'),('NN','{$_POST['q4e']}'),('NN','{$_POST['q4f']}'),('NN','{$_POST['q4g']}');"
q1
q2a - q2g
q3a - q3g
q4a - q4g
    }
?>