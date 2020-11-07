<?php
	//Inicializando Session
	session_start();
	//Conexão com o banco
    include('conexao.php');
    include('password.php');
	if(isset($_POST['btnEntrar'])){
		if(!empty($_POST['email'])){  
            $_POST['senha']=md5($_POST['senha']);
			if($_POST['email']==$root['email'] && $_POST['senha']==$root['password']){
				$_SESSION['root'] = "Ativo";
				header('Location: ../front/dashboard/root.php');
			}else{
                $sql = "select id from alunos where email='{$_POST['email']}';";
                $res = $conn->query($sql);
                $lin = $res->fetch_array();
                if($lin['id']!=null){
                    $sql = "select a.id,a.nome,a.dtEntrada,a.email,a.celular,a.aula,a.diaPg,a.dia,a.liberacao,a.nivelId,n.nivel,a.pg,a.senha,a.termo from alunos a inner join nivel n on a.nivelId = n.id where a.email='{$_POST['email']}' and a.senha='{$_POST['senha']}';";
                    $resultado = $conn->query($sql);
                    $linha = $resultado->fetch_array();
                    if($linha['id']!=null){
                        $_SESSION['id'] = $linha['id'];
                        $_SESSION['nome'] = $linha['nome'];
                        $_SESSION['dtEntrada'] = $linha['dtEntrada'];
                        $_SESSION['email'] = $linha['email'];
                        $_SESSION['celular'] = $linha['celular'];
                        $_SESSION['aula'] = $linha['aula'];
                        $_SESSION['diaPg'] = $linha['diaPg'];
                        $_SESSION['dia'] = $linha['dia'];
                        $_SESSION['liberacao'] = $linha['liberacao'];
                        $_SESSION['termo'] = $linha['termo'];
                        $_SESSION['nivelId'] = $linha['nivelId'];
                        $_SESSION['nivel'] = $linha['nivel'];
                        $_SESSION['pg'] = $linha['pg'];
                        $_SESSION['senha'] = $linha['senha'];
                        if(!$_SESSION['liberacao']){
                            header('Location: ../front/pagLiberando.php');
                        }else{
                            if($_SESSION['nivelId']==1){
                                $novoNivel = 1;
                                switch ($_SESSION['aula']) {
                                    case 'Teclado':
                                        $novoNivel = 2;
                                        break;
                                    case 'Violão':
                                        $novoNivel = 3;
                                        break;
                                    case 'Guitarra':
                                        $novoNivel = 4;
                                        break;
                                }
                                if($novoNivel != 1){
                                    $sql = "update alunos set nivelId = $novoNivel where id={$_SESSION['id']};";
                                    $conn->query($sql);
                                    if(isset($conn->error)&&!empty($conn->error)){
                                        header('Location: ../front/index.php?erro=6');
                                    }else{
                                        $_SESSION['nivelId']=$novoNivel;
                                        $_SESSION['nivel']=1;
                                        header('Location: ../front/principal.php?prLog=1');
                                    }
                                    $conn->close();
                                }else{
                                    header('Location: ../front/index.php?erro=5');
                                }
                            }else{
                                header('Location: ../front/principal.php');
                            }
                        }
                    }
                    else{
				        $conn->close();
                        header('Location: ../front/index.php?erro=7');
                    }
                }
                else{
				    $conn->close();
                    header('Location: ../front/index.php?erro=2');
                }
			}
		}
	}
?>