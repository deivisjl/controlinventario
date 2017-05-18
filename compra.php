<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/config.php';
    include 'controllers/BaseUrl.php';

    if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2){

?>
<style type="text/css">
  .block-loading{
    position:absolute;
    width:100%;
    height:100%;
    top:0;
    left:0;
    background:#fff url(/images/loader.gif) no-repeat center;
    opacity:0.7;
  }
  
</style>

<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 style="text-align: center;">RECEPCION DE PRODUCTOS</h4>
						
					</div>
					<div class="panel-body">

<?php if(isset($_SESSION["insertCompra"]) && $_SESSION["insertCompra"] == 1){?>
    <div class="alert alert-success" role="alert">
         Registro guardado correctamente.</a>
    </div>  
<?php } unset($_SESSION["insertCompra"]); ?>

<div id="load"></div>
<div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="/index.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
            </ol>
        </div>
</div>
<form id="frm-comprobante" method="post" action="./controllers/getCompra.php">
    <div class="row">
        <div class="col-xs-12">

            <div class="well well-sm">
                <div class="row">
                    <div class="col-xs-5">
                        <input id="producto_id" type="hidden" value="0" />
                        <input autocomplete="off" id="producto" class="form-control" type="text" placeholder="Nombre del producto" />
                    </div>
                    <div class="col-xs-2">
                        <input autocomplete="off" id="cantidad" class="form-control" type="text" placeholder="Cantidad" />
                    </div>
                    <div class="col-xs-2">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">Q.</span>
                          <input autocomplete="off" id="costo" class="form-control" type="text" placeholder="Precio Costo" />
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">Q.</span>
                          <input autocomplete="off" id="precio" class="form-control" type="text" placeholder="Precio Sugerido" />
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <button class="btn btn-primary form-control" id="btn-agregar" type="button" data-toggle="tooltip" data-placement="top" title="Agregar al detalle">
                             <i class="glyphicon glyphicon-plus"></i>
                        </button>
                    </div>
                </div>            
            </div>

            <hr />

            <ul id="facturador-detalle" class="list-group"></ul>
            
            <button class="btn btn-primary btn-block btn-lg" type="submit">Generar compra</button>

        </div>
</div>    
</form>


<script id="facturador-detalle-template" type="text/x-jsrender" src="">
    {{for items}}
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-7">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-danger form-control" onclick="facturador.retirar({{:id}});" data-toggle="tooltip" data-placement="top" title="Eliminar fila">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </span>
                    <input name="producto_id" type="hidden" value="{{:producto_id}}" />
                    <input disabled name="producto" class="form-control" type="text" placeholder="Nombre del producto" value="{{:producto}}" />
                </div>
            </div>
            <div class="col-xs-1">
                <input name="cantidad" class="form-control" type="text" placeholder="Cantidad" value="{{:cantidad}}" />
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Q.</span>
                  <input name="precio" class="form-control" type="text" placeholder="Precio" readonly value="{{:costo}}" />
                </div>
            </div>
            <input type="hidden" name="sugerido" readonly value="{{:precio}}">
            <div class="col-xs-2">
                <div class="input-group">
                    <span class="input-group-addon">Q.</span>
                    <input name="precio"  class="form-control" type="text" readonly value="{{:total}}" />
                    <span class="input-group-btn">
<button type="button" class="btn btn-success form-control" onclick="facturador.actualizar({{:id}}, this);" class="btn-retirar" data-toggle="tooltip" data-placement="top" title="Actualizar fila">
    <i class="fa fa-refresh" aria-hidden="true"></i>
</button>
                    </span>
                </div>
            </div>
        </div>
    </li>
    {{else}}
    <li class="text-center list-group-item">No se han agregado productos al detalle</li>
    {{/for}}

    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                <h2>TOTAL Q.</h2>
            </div>
            <div class="col-xs-2">
                <b><h2>{{:total}}</h2></b>
            </div>
        </div>
    </li>

</script>





					</div>
				</div>
			</div>
</div>
<script type="text/javascript" src="/assets/scripts/compra.js"></script>
<?php include 'includes/footer.php'; ?>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>