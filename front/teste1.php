<!doctype html>
<html lang="pt-br">
<head>
	<title>Aula de Música</title>
	<meta charset="UTF-8"/>
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<style>
		body{
/*			background: url("../img/fundo/fone.jpg");*/
            padding: 0px;
            overflow-x: hidden;
		}
        /* Sessão - Aula de Teoria Músical */
        div#contWall{
            margin: auto;
            background: url("../img/fundo/100992.jpg");
            background-size: cover;
        }
        #hgTitulo{
            color: #bbb;
            text-align: center;
            margin: 0px;
            padding: 0px;
        }
        #hgTitulo h1{
            padding-top: 130px;
            font-size: 220pt;
        }
        #hgTitulo h2{
            color: #999;
            margin-top: -45px;
            font-size: 18pt;
        }
	</style>
    <script src="../js/jquery/jquery-3.4.1.min.js"></script>
	<script>
		//Redimensionamento
        function redimensionar(){
            var altWindowH = ($(window).height());
            var altWindowW = ($(window).width());
            $('body').css('max-width',altWindowW);
            $('#contWall').css('width',altWindowW);
            $('#contWall').css('height',altWindowH);
        }
        $(function(e){           
           redimensionar();
           $(window).resize(function(e){
               redimensionar();
           });
        });
	</script>
</head>
<body>
    <!-- Aula de Teoria Musical -->
    <div id="contWall">
        <hgroup id="hgTitulo">
            <h1>ATM</h1>
            <h2>Mateus Brandão</h2>
        </hgroup>
    </div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
</html>