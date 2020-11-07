<script>
$(function(){ $('#modalResultado').on('shown.bs.modal', function () { $('#btnFechaModalResultado').trigger('focus') }); });
</script>
<!--Botão acionado por GET e JS-->
<a href="#" style="display:none;" data-toggle="modal" data-target="#modalResultado" id="btnChamaModalResult">Chama o Resultado</a>
<!--Botão acima, acionado por GET e JS-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalResultado" aria-hidden="true"> <!--Modal Resultado-->
		<div class="modal-dialog" role="document">
	<div class="modal-content"  id="corpoModalResultado">
  		<div class="modal-header">
	        <h5 class="modal-title" id="tituloModalResultado" style="font-weight:normal;"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	</div>
	    <div class="modal-body">
	      	<p id="subTituloModalResultado" style="margin-top: 10px;text-align:left;"></p>
      	</div>
      	<div class="modal-footer">
    		<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFechaModalResultado">Fechar</button>
      	</div>
		</div>
	</div>
</div>