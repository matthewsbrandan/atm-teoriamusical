<?php
	//Conexão com o banco
	include('conexao_wm.php');
    if(isset($_GET['pidU'])&&isset($_POST['pmsg'])&&isset($_GET['pmsgU'])){
        $sql = "call enviar({$_GET['pidU']},'{$_POST['pmsg']}',{$_GET['pmsgU']})";
        $conn->query($sql);
        echo $sql;
        header('Location: ../front/pagLiberando.php?wm=1');
    }
?>