<?php
    include('back/conexao.php');
    $sql = "select status_m from manutencao order by id desc limit 1;";
    $data = $conn->query($sql);
    $res = $data->fetch_array();
    $conn->close();
    if($res['status_m']){
        header('Location: manutencao.php');
    }else{
        header('Location: front/');
    }
?>