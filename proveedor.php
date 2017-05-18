<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include 'controllers/BaseUrl.php';
  	include '/config.php';

	if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2){
  	$resultUsuario;
  	$band = 0;

?>

<?php 
	
	$conteo = "SELECT Persona_id from proveedor";
	$resultConteo = mysqli_query($db,$conteo);

	$num_total_prod = mysqli_num_rows($resultConteo);

	if($num_total_prod > 0){
	$rows_per_page = 10;
	$page = false;
	
	if(isset($_GET["page"])){
		$page = $_GET["page"];
	}
	
	if(!$page){
		$start = 0;
		$page = 1;
	}else{
		$start = ($page-1) * $rows_per_page;
	}
	
	$total_pages = ceil($num_total_prod / $rows_per_page);
	
	$sql="SELECT P.Persona_id, P.Nombre_Empresa, P.Telefono_Empresa, CONCAT(E.Nombres,' ',E.Apellidos) as Contacto, E.Correo
						 from proveedor as P join persona as E
						 	on P.Persona_id = E.Id 
	 						ORDER BY P.Nombre_Empresa ASC LIMIT {$start}, {$rows_per_page};";
	$resultUsuario = mysqli_query($db, $sql);

	$band = mysqli_num_rows($resultUsuario);

	}
 ?>

<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 style="text-align: center;">PROVEEDORES</h4>
						
					</div>
					<div class="panel-body">
<?php if(isset($_SESSION["insertProv"]) && $_SESSION["insertProv"]==1) {?>
				<div class="alert alert-success" role="alert">
					 Registro exitoso. 
				</div>	
<?php } else if(isset($_SESSION["insertProv"]) && $_SESSION["insertProv"] == 2){?>

<div class="alert alert-info" role="alert">
 Registro actualizado correctamente. 
</div>	


<?php }else if(isset($_SESSION["insertProv"]) && $_SESSION["insertProv"]==0){ ?>
<div class="alert alert-danger" role="alert">
 Ocurrió un error en el registro.
</div>
<?php } unset($_SESSION["insertProv"]); ?>

					<div class="col-md-1"></div>
					<div class="col-md-10">
					<a href="/agregarProveedor.php" class="btn btn-primary" style="float: right;">Agregar Proveedor</a>
					<br></br>
							<table class="table">
								<tr>
								<th data-field="id" style="text-align: center !important;">NOMBRE DEL PROVEEDOR</th>
								<th data-field="name" style="text-align: center !important;">TELEFONO DEL PROVEEDOR</th>
								<th data-field="marca" style="text-align: center !important;">NOMBRE DEL CONTACTO</th>
								<th data-field="stock" style="text-align: center !important;">CORREO</th>
								<th data-field="cantidad" style="text-align: center !important;">ACCION</th>
								</tr>

								<?php

								if($band == 0){
										echo 'No se encontraron resultados...';
								}
						    	else if($resultUsuario == true && $band > 0)
								{
									 while($arrays = mysqli_fetch_array($resultUsuario))
									 {	?>
									   <tr style="text-align: center;">
							               <td><?php echo $arrays["Nombre_Empresa"] ?></td>
							               <td><?php echo $arrays["Telefono_Empresa"] ?></td>
							               <td><?php echo $arrays["Contacto"] ?></td>
							               <td><?php echo $arrays["Correo"] ?></td>
							               <td><a href="/actualizarProveedor.php?id=<?=$arrays["Persona_id"]?>" class="btn btn-success">Editar</a></td>
						               </tr>

							   <?php } 
								}
							 ?>
							</table>
					</div>




					<div class="col-md-1"></div>

					</div>

<?php if($num_total_prod >= 1){ ?>
<div class="text-center">
<ul class="pagination">
	<li><a href="?page=<?=($page-1)?>">&laquo;</a></li>
	<?php for($i = 1; $i<=$total_pages; $i++){ ?>
		
		<?php if($page == $i){ ?>
			<li class="active"><a href=""><?=$i?></a></li>
			
		<?php }else{ ?>
			<li><a href="?page=<?=$i?>"><?=$i?></a></li>
			
		<?php } ?>
			
	<?php } ?>
	<li><a href="?page=<?php $show_page=($page+1); if($show_page <= $total_pages){ echo $show_page ; }else{ echo $total_pages; } ?>">&raquo;</a></li>
</ul>
</div>
<?php }?>

			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->


<?php include 'includes/footer.php'; ?>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>