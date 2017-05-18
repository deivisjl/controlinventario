<?php 
	include 'includes/redirect.php';
	include 'includes/header.php';
  include 'controllers/BaseUrl.php';

  if($_SESSION["login"]["Rol_Id"] == 1){

 ?>
 <style type="text/css">
   #atras{
    list-style: none;
   }
 </style>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
          
						<h4 style="text-align: center;">GRAFICOS DE MOVIMIENTOS</h4>
						
					</div>
					<div class="panel-body">
            <div class="row">
              <div class="col-md-1">
                  <li id="atras"><a href="/reportes.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
            </div>  
            </div>
          

            <div class="row tex-center">

              <div class="col-xs-12 col-md-6">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 style="text-align: center;">Productos más vendidos</h4>
                      </div>
                      <div class="panel-body">
                          <div class="col-xs-12" id="container2" style="height: 400px"></div>
                      </div>
                  </div>
              </div>

              <div class="col-xs-12 col-md-6">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 style="text-align: center;">Ventas ultimos 12 meses</h4>
                      </div>
                      <div class="panel-body">
                          <div class="col-xs-12" id="container6" style="height: 400px"></div>
                      </div>
                  </div>
              </div>
                

             <div class="row tex-center">
                  <div class="col-xs-12 col-md-6  col-md-offset-6">
                    <div class="panel panel-default" style="margin-right: 15px;">
                        <div class="panel-heading">
                          <h4 style="text-align: center;">Modo de Ventas</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12" id="container4" style="height: 400px"></div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="row tex-center">
                  <div class="col-xs-12 col-md-6 col-md-offset-6">
                    <div class="panel panel-default" style="margin-right: 15px;">
                        <div class="panel-heading">
                          <h4 style="text-align: center;">Historial de compras</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12" id="container" style="height: 400px"></div>
                        </div>
                    </div>
                </div>
              </div>


          		</div>
        	</div>
</div>

      


 <?php include 'includes/footer.php'; ?>
 <script type="text/javascript" src="./assets/scripts/charts.js"></script>
 <script type="text/javascript" src="./assets/scripts/exporting.js"></script>
   <script src="/assets/scripts/BI_ListBuy.js"></script>
   <script src="/assets/scripts/BI_prodVendidos.js"></script>
   <script src="/assets/scripts/BI_FormSales.js"></script>
   <script src="/assets/scripts/BI_ListByMonth.js"></script>

    <?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>

