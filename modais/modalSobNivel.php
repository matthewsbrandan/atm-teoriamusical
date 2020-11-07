<!--Botão acionado por GET e JS-->
<a href="#" style="display:none;" data-toggle="modal" data-target="#modalSobNivel" id="btnSobNivel">Chama o Resultado</a>
<!--Botão acima, acionado por GET e JS-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalSobNivel" aria-hidden="true"> <!--Modal Resultado-->
		<div class="modal-dialog" role="document">
	<div class="modal-content"  id="corpoModalSobNivel">
  		<div class="modal-header">
	        <h5 class="modal-title" id="tituloModalSobNivel" style="font-weight:normal;">Subir Nivel Musical</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	</div>
	    <div class="modal-body">
	    	<div style="text-align:center;">
    			<h5 id="subTituloSobNivel">Nível Atual</h5><hr/>
    			<div class="container" style="background: transparent;">
		            <div class="progress blue">
		                <span class="progress-left">
		                    <span class="progress-bar" id="pbl"></span>
		                </span>
		                <span class="progress-right">
		                    <span class="progress-bar" id="pbr"></span>
		                </span>
		                <div class="progress-value" style="color: white;"><?php echo $nivelMax['max']."º";?></div>
		            </div>
				</div>
				<p style="margin-top: 15px;margin-bottom:25px;" id="pLegendaSobNivel">Clicando em Subir de Nível você subirá igualmente para as três áreas de Ensino: <i>Teclado, Violão e Guitarra.</i></p>
				<form action="../../back/backAlt.php" method="POST">
					<button type="submit" href="root.php?sess=1&sobN=1" class="btn btn-danger" name="btnActionSobNivel" id="btnActionSobNivel">Subir de Nível</button>
				</form>
    		</div>
      	</div>
      	<div class="modal-footer">
      	</div>
		</div>
	</div>
</div>