<?php
	function rMes($v){
		switch ($v) {
			case 1:
				$retorno= "Janeiro";
				break;
			case 2:
				$retorno= "Fevereiro";
				break;
			case 3:
				$retorno= "Março";
				break;
			case 4:
				$retorno= "Abril";
				break;
			case 5:
				$retorno= "Maio";
				break;
			case 6:
				$retorno= "Junho";
				break;
			case 7:
				$retorno= "Julho";
				break;
			case 8:
				$retorno= "Agosto";
				break;
			case 9:
				$retorno= "Setembro";
				break;
			case 10:
				$retorno= "Outubro";
				break;
			case 11:
				$retorno= "Novembro";
				break;
			case 12:
				$retorno= "Dezembro";
				break;
			default:
				$retorno= "Mês Inválido";
				break;
		}
		return $retorno;
	}
?>