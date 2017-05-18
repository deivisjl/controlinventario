<?php
	include 'includes/redirect.php';
  include 'includes/header.php';
  include 'controllers/BaseUrl.php';

  if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2 || $_SESSION["login"]["Rol_Id"] == 3){
?>
 <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 style="text-align: center;">BUSQUEDA DE PRODUCTOS</h4>
            
          </div>
          <div class="panel-body">
               <table id="producto2" class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Costo Actual</th>
                  <th>Precio Sugerido</th>
                  <th>Stock</th>
                </tr>
              </thead>
                
              </table>
            </div>
          </div>
        </div>
    </div>
 

<!--script type="text/javascript" src="/assets/datatables/jquery.datatables.min.js"></script-->

<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
  (function(){
    $(document).ready(function(){
      $('#producto2').DataTable(
        {
          "processing": true,
          "serverSide": true,
          "ajax":{
            'url': './controllers/getInventario.php',
            'type': 'GET'
          },
          "columnDefs": [ {
              "targets": 4,//index of column starting from 0
              "data": "Stock", //this name should exist in your JSON response
              "render": function ( data, type, full, meta ) {
                return '<span class="label label-info">'+data+'</span>';
              }
            } ],
          "columns":[
            {'data': 'Id'},
              {'data': 'Nombre'},
              {'data': 'CostoActual'},
              {'data': 'PrecioSugerido'},
              {'data': 'Stock'}
          ]
        }
      );
    });
  }) ();
</script>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>