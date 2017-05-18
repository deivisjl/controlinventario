
<?php
	include 'includes/redirect.php';
  include 'includes/header.php';  	
?>
<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div style="text-align: center;">ACTUALIZAR CONTRASEÑA</div>
          </div>
          <div class="panel-body">
          <div class="row">
            <div class="col-md-2"></div>
              <div class="col-md-8">
                <ol class="breadcrumb">
                  <li><a href="/index.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
                </ol>
              </div>
            <div class="col-md-2"></div>
          </div>
            
          <div class="col-md-2"></div>
            <div class="col-md-8">

<?php if(isset($_SESSION["insertUser"]) && $_SESSION["insertUser"]==1) {?>
        <div class="alert alert-success" role="alert">
           Se ha actualizado correctamente el registro.
        </div>  

<?php }else if(isset($_SESSION["insertUser"]) && $_SESSION["insertUser"]==0){ ?>
<div class="alert alert-danger" role="alert">
 Ocurrió un error en el registro.
</div>
<?php } unset($_SESSION["insertUser"]); ?>

                <form role="form" class="form-horizontal" id="frm_pass" method="POST" action="./controllers/getUser.php">

                  <div class="form-group">
                      <label class="col-xs-3 control-label">Nueva Contraseña</label>
                      <div class="col-xs-5">
                          <input type="password" class="form-control" name="pass2" id="pass2" placeholder="Nueva Contraseña" 
                          data-validacion-tipo="requerido|min:5" autofocus />
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-xs-3 control-label">Repita Contraseña</label>
                      <div class="col-xs-5">
                          <input type="password" class="form-control" name="pass3" id="pass3" placeholder="Repita Contraseña" 
                           data-validacion-tipo="requerido|min:5"/>
                      </div>
                  </div>
            
                  <input type="hidden" value="3" name="send" />

                  <div class="form-group">
                    <div class="col-xs-9 col-xs-offset-3">
                        <button type="submit" name="addusuario" class="btn btn-info">Guardar</button>
                    </div>
                </div>

                  </div>
              
                </form>
            </div>
          <div class="col-md-2"></div>

        </div> 
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function(){

        $("#pass3").on('keyup', function(){
          var pass1 = $("#pass2").val();
          var pass2 = $("#pass3").val();

          var obj = $(this);
              var small = $('<small />');

              /* El contenedor del control */
              var form_group = obj.closest('.form-group');
                form_group.removeClass('has-error'); /* Limpiamos el estado de error */
                form_group.removeClass('has-success'); /* Limpiamos el estado de error */
                var label = form_group.find('label');/* Capturamos el label donde queremos mostrar el mensaje */
                label.find('small').remove(); /* Eliminamos el mensaje anterior */
              

              if (pass1 === pass2) {

                label.append(small);
                form_group.addClass('has-success');
            small.text(obj.data('validacion-mensaje'));
            small.text(" ");
            
          }else{

            
            label.append(small);
            form_group.addClass('has-error');
            small.text(obj.data('validacion-mensaje'));
            small.text(" No coinciden las contraseñas");  

          }
          
         }).keyup();

        $("#frm_pass").submit(function(){
            return $(this).validate();
        });
    })
</script>
