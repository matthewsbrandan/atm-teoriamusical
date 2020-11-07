<style>
    #divColBd{
        margin-top: 10px;
        margin-bottom: 2px;
        padding: 0px;
    }
    #iconColBd{
        vertical-align: -4px;
        cursor: pointer;
        float: right;
    }
    #ulColBd{
        display: none;
        padding: 0px;
        margin-left: 5px;
    }
    #ulColBd li{
        color: aliceblue;
        background: rgba(250,250,250,.1);
        border: 1px solid gainsboro;
        border-radius: 5px;
        vertical-align: middle;
        display: inline-block;
        list-style: none;
        padding: 2px;
        margin: 0px;
        margin-bottom: 2px;
        cursor: pointer;
    }
    #ulColBd .opColBd{
        background: rgba(50,50,50,.8);
        padding: 0px 6px 0px 6px;
        margin-bottom: 6px;
        display: inline-block;
    }
    #ulColBd .opAtivo{
        background: rgba(250,250,250,.9);
        color: rgba(50,50,50,.7);
    }
</style>
<script>
    var colBd = false;
    var opSel = true;
    var opCam = false;
    
    function verColBd(){
        if(colBd){
            document.getElementById('ulColBd').style="display: none";
            document.getElementById('iconColBd').style="float: right;";
        }else{
            document.getElementById('ulColBd').style="display: inline";
            document.getElementById('iconColBd').style="float: none; display: inline;";
        }
        colBd = !colBd;
    }
    function trocaAtivo(){
        if(opSel){
            liOpSel.classList.remove('opAtivo');
            liOpCam.classList.add('opAtivo');
        }else{
            liOpSel.classList.add('opAtivo');
            liOpCam.classList.remove('opAtivo');
        }
        opSel = !opSel;
        opCam = !opCam;
    }
    function selColBd(p){
        if(opSel){
            document.getElementById('txtSql').value = "select * from " + p + ";";
        }else{
            document.getElementById('txtSql').value = "show columns from " + p + ";";
        }
        document.getElementById('btnExecutaSql').click();
    }
</script>
<!--Botão acima, acionado por GET e JS-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalProgram" aria-hidden="true"> <!--Modal Resultado-->
		<div class="modal-dialog" role="document">
	<div class="modal-content bg-dark">
  		<div class="modal-header">
	        <h5 class="modal-title text-white" style="font-weight:normal;">Programing</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	</div>
	    <div class="modal-body" style="padding-top: 0px;">
            <form method="POST">
                <div class="form-group" id="divColBd">
                    <i class="material-icons text-light" id="iconColBd" onclick="verColBd()">table_chart</i>
                    <ul id="ulColBd">
                        <li id="liOpSel" class="opColBd opAtivo" onclick="trocaAtivo()">Select</li>
                        <li id="liOpCam" class="opColBd" onclick="trocaAtivo()">Campos</li>
                        <br/>
                    <?php
                        include('../../back/conexao.php');
                        $sql = "show tables;";
                        $data = $conn->query($sql);
                        while($resTbl = $data->fetch_array()){
                    ?>
                        <li id="dd<?php echo $resTbl['Tables_in_'.$database];?>" name="dd<?php echo $resTbl['Tables_in_'.$database];?>" onclick="selColBd('<?php echo $resTbl['Tables_in_'.$database];?>');">
                            <?php echo $resTbl['Tables_in_'.$database];?>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="form-group">
                    <label for="txtSql" class="text-white">Entre com o código SQL</label>
                    <textarea class="form-control" id="txtSql" name="txtSql" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-danger btn-block" id="btnExecutaSql" name="btnExecutaSql">Executar { }</button>
            </form>
            <div id="resultado" class="text-light" name="resultado" style="margin: auto; margin-top: 10px;">
                <?php
                    if(isset($_POST['btnExecutaSql'])&&(!empty($_POST['txtSql']))){
                        include('../../back/conexao.php');
                        $sql = $_POST['txtSql'];
                        $data = $conn->query($sql);
                        if(isset($conn->error)&&!empty($conn->error)){
                ?>
                    <h5 class="text-center"> Houver um Erro SQL</h5>
                <?php }else{ ?>
                    <h6 class="text-center rounded-top p-1 mb-0" style="background: rgba(150,150,150,.15);"><?php echo $sql; ?></h6>
                    <div class="table-responsive">
                        <table class="table table-hover table-dark" style="background: rgba(0,0,0,.3)">
                        <!-- Show Columns -->
                        <?php if(substr($sql,0,4)=="show"){ ?>
                            <?php while($resSql = $data->fetch_array()){ ?>
                            <tr class="table-sm">
                                <td class="text-center"><?php echo $resSql['Field']; ?></td>
                            </tr>
                            <?php } ?>
                        <?php }elseif(is_bool($data)){ ?>
                            <h5 class="text-center p-1 table-dark rounded-bottom"><?php echo $data?"Comando Realizado com Sucesso":"Erro ao Realizar o Comando";?></h5>
                        <?php }else{ ?>
                            <?php while($resSql = $data->fetch_array()){ ?>
                            <?php if(!isset($thead)){?>
                            <tr>
                            <?php
                                $thead = true;
                                $linha = $resSql;
                                foreach($linha as $key => $value){
                                    if(!isset($ajuste)||$ajuste==true){
                                        $ajuste = false;
                                    }else{
                            ?>
                                <th class="text-center"><?php echo $key; ?></th>
                            <?php
                                        $ajuste = true;
                                    }                            
                                }
                            ?>
                            </tr>
                            <?php } ?>
                            <tr>
                                <?php for($cont=0;$cont<(count($resSql)/2);$cont++){ ?>
                                    <td class="text-center"><?php echo $resSql[$cont]; ?></td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>
                    </div>
                <?php }} $conn->close(); ?>
            </div>
        </div>
      	<div class="modal-footer">
    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      	</div>
		</div>
	</div>
</div>