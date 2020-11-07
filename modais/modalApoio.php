<!--Botão acima, acionado por GET e JS-->
<style>
	#apNomenc,#apCroma,#apForm,#apCampo{
		transition: background 1s;
	}
	#apNomenc:hover,#apCroma:hover,#apForm:hover,#apCampo:hover{
		cursor: Pointer;
		background: rgba(0,0,0,.75);
	}
	#tblNomenc,#tblCroma,#divForm,#tblCampoHarmonico{
		display: none;
	}
	#tblNomenc table,#tblCroma table,#tblCampoHarmonico table{
		text-align: center;
		font-size: 10.5pt;
		margin-top: -15px;
	}
	#tblCampoHarmonico td{
		cursor: pointer;
		transition: background .8s;
	}
	#tblCampoHarmonico td:hover{
		background: rgba(20,20,20,.8);
		color: white;
		border-radius: 5px;
	}

</style>
<script>
	var vTblNomenc = false;
	var vTblCroma = false;
	var vDivForm = false;
	var vTblCampoH = false;
	var vetNota = new Array("C","C#","D","D#","E","F","F#","G","G#","A","A#","B","C","C#","D","D#","E","F","F#","G","G#","A","A#","B");
	testeDWrite("teste");
	function apClick(v){
		switch(v){
			case 1:
				if(vTblNomenc){
					displayNone("tblNomenc");
					vTblNomenc = false;
				}else{
					displayBlock("tblNomenc");
					vTblNomenc = true;
				}
				break;
			case 2:
				if(vTblCroma){
					displayNone("tblCroma");
					vTblCroma = false;
				}else{
					displayBlock("tblCroma");
					vTblCroma = true;
				}
				break;
			case 3:
				if(vDivForm){
					displayNone("divForm");
					vDivForm = false;
				}else{
					displayBlock("divForm");
					vDivForm = true;
				}
				break;
			case 4:
				if(vTblCampoH){
					displayNone("tblCampoHarmonico");
					vTblCampoH = false;
				}else{
					displayBlock("tblCampoHarmonico");
					vTblCampoH = true;
				}
				break;
		}
	}
	function campoHarmonicoR(v){
		i = vetNota.indexOf(v);
		var resultado = vetNota[i] + " - " + vetNota[i+2] + " - " + vetNota[i+4] + " - " + vetNota[i+5] + " - " + vetNota[i+7] + " - " + vetNota[i+9] + " - " + vetNota[i+ 11] + " - " + vetNota[i+ 12];
		document.getElementById('inResultado').value=resultado;
	}
	function limpar() {
		document.getElementById('inResultado').value="";
	}
	function displayNone(v){
		document.getElementById(v).style="display: none;";
	}
	function displayBlock(v){
		document.getElementById(v).style="display: block;";
	}
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="modalApoio" aria-hidden="true"> <!--Modal Resultado-->
		<div class="modal-dialog" role="document">
	<div class="modal-content" >
  		<div class="modal-header">
	        <h5 class="modal-title">Apoio</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	</div>
	    <div class="modal-body">
	      	<h6 style="text-align: center;margin-bottom: 15px;">Áreas de Apoio</h6>
	      	<table class="table"> <!--Area de Click Nomenclatura-->
				<thead class="thead-dark"> 
				    <tr><th scope="col"id="apNomenc" onclick="apClick(1);">Nomenclatura</th></tr>
			  	</thead>
			</table>
			<div id="tblNomenc"> <!--Tabela Nomenclatura-->
		    	<table class="table">
				  	<thead>
					    <tr>
					      	<th scope="col">Nota/Símbolo</th>
					      	<th scope="col">Cifra/Sigla</th>
					    </tr>
				  	</thead>
				  	<tbody>
				  		<?php
				  			$nomenclatura = array (array("Dó","C"),array("Ré","D"),array("Mi","E"),array("Fá","F"),array("Sol","G"),array("Lá","A"),array("Si","B"),array("Maior","M"),array("Menor","m"),array("Sustenido","#"),array("Bemol","b"),array("Diminuto","<sup>o</sup>"));
				  			$cont = 0;
				  			while($cont<count($nomenclatura)){
			  			?>
				  		<tr>
					      	<th scope="row"><?php echo $nomenclatura[$cont][0];?></th>
					      	<td><?php echo $nomenclatura[$cont][1];?></td>
					    </tr>
					    <?php 
					    		$cont++;
							}
						?>
				  	</tbody>
				</table>
			</div>
			<table class="table"> <!--Area de Click Escala Cromática-->
				<thead class="thead-dark"> 
				    <tr><th scope="col"id="apCroma" onclick="apClick(2);">Escala Cromática</th></tr>
			  	</thead>
			</table>
			<div id="tblCroma"> <!--Tabela Cromatica-->
		    	<table class="table">
				  	<tbody>
				  		<tr>
			  				<th colspan="7">O Intervalo das notas é de Meio Tom (Existem 12 notas)</th>
				  		</tr>
			  			<tr>
					      <td>C</td>
					      <td>C#</td>
					      <td>D</td>
					      <td>D#</td>
					      <td>E</td>
					      <td>F</td>
					      <th>&#8617;</th>
					    </tr>
					    <tr>
					      <td>F#</td>
					      <td>G</td>
					      <td>G#</td>
					      <td>A</td>
					      <td>A#</td>
					      <td>B</td>
					      <td>C</td>
					    </tr>
				  	</tbody>
				</table>
			</div>
			<table class="table"> <!--Area de Click Formação de Acordes-->
				<thead class="thead-dark"> 
				    <tr><th scope="col"id="apForm" onclick="apClick(3);">Formação de Acordes</th></tr>
			  	</thead>
			</table>
			<div id="divForm"> <!--Tabela Formação de Acordes-->
				<p><b>Pelo Campo Harmônico:</b><br/>Todo Acorde é formado por tônica, terça e quinta (1 - 3 - 5). Esses graus são contados usando apenas notas que estão no campo harmônico em que a nota se encaixa.</p>
				<p><b>Exemplo:</b><br/>Para fazer uma acorde A no campo harmônico de C(que possui todas as notas naturais), você começaria a contar a partir do A:</p>
				<p style="text-align: center;">A<sup>1</sup> - B<sup>2</sup> - C<sup>3</sup> - D<sup>4</sup> - E<sup>5</sup> - F<sup>6</sup> - G<sup>7</sup></p>
				<p>Sendo assim, A - C - E. E ao observar a terça do Acorde, sabemos que ele é menor. Confira as Regras a baixo:</p>

				<p><b>Por Distância:</b><br/>Sabemos que a formação dos acordes é 1, 3 e 5, mas temos que saber que a distância que separam essas notas influência se a nota é maior, menor ou diminuta.</p>
				<b>Regras:</b>
				<ul>
					<li><b>Maior:</b> A <i>Tônica</i> é a própria nota, a <i>Terça</i> é 2 tons a frente da primeira e a <i>Quinta</i> é 3 tons e meio a frente da primeira.</li>
					<li><b>Menor:</b> Segue o mesmo padrão que a Maior, porém a terça é apenas 1 tom e meio da primeira. Ou seja, a terça é o que torna a nota menor ou maior.</li>
					<li><b>Diminuta:</b> Segue o mesmo padrão da nota Menor, porém a quinta é apenas 3 tons a frente da primeira. Ou seja, além da terça ser meio tom atrás do que seria a nota maior, a quinta também é meio tom atrás.</li>
				</ul>
			</div>
			<table class="table"> <!--Area de Click Campo Harmonico-->
				<thead class="thead-dark"> 
				    <tr><th scope="col"id="apCampo" onclick="apClick(4);">Campo Harmônico</th></tr>
			  	</thead>
			</table>
			<div id="tblCampoHarmonico">
				<table class="table">
				  	<tbody>
				  		<tr>
			  				<th colspan="7">Selecione uma nota para descobrir o seu Campo Harmônico</th>
				  		</tr>
			  			<tr>
					      <td onclick="campoHarmonicoR('C');">C</td>
					      <td onclick="campoHarmonicoR('C#');">C#</td>
					      <td onclick="campoHarmonicoR('D');">D</td>
					      <td onclick="campoHarmonicoR('D#');">D#</td>
					      <td onclick="campoHarmonicoR('E');">E</td>
					      <td onclick="campoHarmonicoR('F');">F</td>
					      <th>&#8617;</th>
					    </tr>
					    <tr>
				    	  <th>&#8618;</th>
					      <td onclick="campoHarmonicoR('F#');">F#</td>
					      <td onclick="campoHarmonicoR('G');">G</td>
					      <td onclick="campoHarmonicoR('G#');">G#</td>
					      <td onclick="campoHarmonicoR('A');">A</td>
					      <td onclick="campoHarmonicoR('A#');">A#</td>
					      <td onclick="campoHarmonicoR('B');">B</td>
					    </tr>
				  	</tbody>
				</table>
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="inResultado" placeholder="Selecione uma Nota para ver sua Escala" title="Selecione uma Nota para ver sua Escala" style="text-align: center;" readonly>
					<div class="input-group-append" onclick="limpar()" style="cursor:pointer;">
			    		<span class="input-group-text">&times;</span>
					</div>
				</div>
			</div>
      	</div>
      	<div class="modal-footer">
    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      	</div>
		</div>
	</div>
</div>