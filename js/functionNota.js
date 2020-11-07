	var vetNota = new Array("C","C#","D","D#","E","F","F#","G","G#","A","A#","B","C","C#","D","D#","E","F","F#","G","G#","A","A#","B");
	var vetNaturais = new Array("C","D","E","F","G","A","B","C","D","E","F","G","A","B");
	function nota(v){
		var resultado = "";
		if(v.indexOf("º")>(-1)){
			i = vetNota.indexOf(v.replace("º",""));
			resultado = vetNota[i] + " - " + vetNota[i+3] + " - " + vetNota[i+6];
		}else
        if(v.indexOf("m")>(-1)){
			i = vetNota.indexOf(v.replace("m",""));
			resultado = vetNota[i] + " - " + vetNota[i+3] + " - " + vetNota[i+7];
		}
        else{
			i = vetNota.indexOf(v);
			resultado = vetNota[i] + " - " + vetNota[i+4] + " - " + vetNota[i+7];
		}
		document.getElementById('inResultado').value=resultado;
	}
	function campoHarmonicoR(v){
		i = vetNota.indexOf(v);
		var resultado = vetNota[i] + " - " + vetNota[i+2] + " - " + vetNota[i+4] + " - " + vetNota[i+5] + " - " + vetNota[i+7] + " - " + vetNota[i+9] + " - " + vetNota[i+ 11] + " - " + vetNota[i+ 12];
		document.getElementById('inResultado').value=resultado;
	}
	function exPosicaoDedo(v){
		i = vetNaturais.indexOf(v);
		var resultado = vetNaturais[i] + " - " + vetNaturais[i+1] + " - " + vetNaturais[i+2] + " - " + vetNaturais[i+3] + " - " + vetNaturais[i+4] + " - " + vetNaturais[i+3] + " - " + vetNaturais[i+ 2] + " - " + vetNaturais[i+ 1];
		document.getElementById('inResultado').value=resultado;
	}
	function limpar() {
		document.getElementById('inResultado').value="";
	}
	function writeResultado(v){
		document.getElementById('inResultado').value=v;	
	}