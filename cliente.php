<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include 'controllers/BaseUrl.php';
  	include '/config.php';

  	if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2 || $_SESSION["login"]["Rol_Id"] == 3){
  	$resultUsuario;
  	$band = 0;

?>

<?php 
	
	$conteo = "SELECT Persona_id from cliente";
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
	
	$sql="SELECT C.Persona_Id as Id, C.DPI as dpi, CONCAT(P.Nombres,' ',P.Apellidos) as Cliente, count(F.Id) as factura
	from cliente as C join persona as P
		on C.Persona_Id = P.Id
			Left join venta as V
				on C.Persona_Id = V.Cliente_Id
					Left join factura as F
						on V.Id = F.Venta_Id
							group by C.Persona_Id, C.DPI, P.Nombres, P.Apellidos
	 							ORDER BY P.Nombres ASC LIMIT {$start}, {$rows_per_page};";
	$resultUsuario = mysqli_query($db, $sql);

	$band = mysqli_num_rows($resultUsuario);
	
	}

 ?>

<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 style="text-align: center;">CLIENTES</h4>
						
					</div>
					<div class="panel-body">
<?php if(isset($_SESSION["insertCliente"]) && $_SESSION["insertCliente"]==1) {?>
				<div class="alert alert-success" role="alert" >
					Registro exitoso
				</div>	
<?php } else if(isset($_SESSION["insertCliente"]) && $_SESSION["insertCliente"] == 2){?>

<div class="alert alert-info" role="alert">
	Registro actualizado correctamente. 
</div>	

<?php }else if(isset($_SESSION["insertCliente"]) && $_SESSION["insertCliente"]==0){ ?>
<div class="alert alert-danger" role="alert">
 	Ocurrió un error en el registro. 
</div>
<?php } unset($_SESSION["insertCliente"]); ?>

					<div class="col-md-1"></div>
					<div class="col-md-10">
					<a href="/agregarCliente.php" class="btn btn-primary" style="float: right;">Agregar Cliente</a>
					<br></br>
							<table class="table">
								<tr>									  
					                  <th style="text-align: center;">Cliente</th>
					                  <th style="text-align: center;">DPI</th>
					                  <th style="text-align: center;">No. facturas</th>
					                  <th style="text-align: center;">Accion</th>
								</tr>

								<?php
								if($band == 0){
										echo 'No se encontraron resultados...';
								}
						    	else if($resultUsuario && $band > 0)
								{
									 while($arrays = mysqli_fetch_array($resultUsuario))
									 {	?>
									   <tr style="text-align: center;">
							               <td><?php echo $arrays["Cliente"] ?></td>
							               <td><?php echo $arrays["dpi"] ?></td>
							               <td><?php echo $arrays["factura"] ?></td>
							               <td><a href="/actualizarCliente.php?id=<?=$arrays["Id"]?>" class="btn btn-success">Editar</a></td>
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