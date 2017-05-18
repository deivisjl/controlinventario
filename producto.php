<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/config.php';
  	include 'controllers/BaseUrl.php';

	if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2){
	$resultUsuario;
  	$band = 0;
?>

<?php 
	
	$conteo = "SELECT Id from producto";
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

	$sql="SELECT P.Id, concat(C.Nombre_Categoria,' ',M.Nombre_Marca,' ',A.Nombre,' ',T.Nombre_Atributo) as nombre,
			P.Caracteristica, R.Nombre_Empresa as Proveedor, P.StockMin, P.StockMax 
				from producto as P inner join categoria as C
				on P.Categoria_Id = C.Id
				right join marca as M
				on P.Marca_Id = M.Id
				right join cantidad as A
				on P.Cantidad_Id = A.Id
				right join atributo as T
				on P.Atributo_Id = T.Id
				right join proveedor as R
				on P.Proveedor_Id = R.Persona_id 
	 			ORDER BY C.Nombre_Categoria ASC LIMIT {$start}, {$rows_per_page};";
	

	$resultUsuario = mysqli_query($db, $sql);

	$band = mysqli_num_rows($resultUsuario);
	}

 ?>


<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 style="text-align: center;">PRODUCTO</h4>
						
					</div>
					<div class="panel-body">
<?php if(isset($_SESSION["insertMarca"]) && $_SESSION["insertMarca"] == 1){?>

<div class="alert alert-success" role="alert">
 Registro guardado correctamente.</a>
</div>	


<?php }else if(isset($_SESSION["insertMarca"]) && $_SESSION["insertMarca"]==0){ ?>
<div class="alert alert-danger" role="alert">
 Ocurrió un error en el registro.
</div>
<?php } unset($_SESSION["insertMarca"]); ?>

<?php if(isset($_SESSION["insertCategoria"]) && $_SESSION["insertCategoria"] == 1){?>

<div class="alert alert-success" role="alert">
 Registro guardado correctamente.
</div>	


<?php }else if(isset($_SESSION["insertCategoria"]) && $_SESSION["insertCategoria"]==0){ ?>
<div class="alert alert-danger" role="alert">
Ocurrió un error en el registro. 
</div>
<?php } unset($_SESSION["insertCategoria"]); ?>


<?php if(isset($_SESSION["insertCantidad"]) && $_SESSION["insertCantidad"] == 1){?>

<div class="alert alert-success" role="alert">
Registro guardado correctamente.
</div>	


<?php }else if(isset($_SESSION["insertCantidad"]) && $_SESSION["insertCantidad"]==0){ ?>
<div class="alert alert-danger" role="alert">
 Ocurrió un error en el registro. 
</div>
<?php } unset($_SESSION["insertCantidad"]); ?>

<?php if(isset($_SESSION["insertAtributo"]) && $_SESSION["insertAtributo"] == 1){?>

<div class="alert alert-success" role="alert">
 Registro guardado correctamente. 
</div>	


<?php }else if(isset($_SESSION["insertAtributo"]) && $_SESSION["insertAtributo"]==0){ ?>
<div class="alert alert-danger" role="alert">
Ocurrió un error en el registro. 
</div>
<?php } unset($_SESSION["insertAtributo"]); ?>

<?php if(isset($_SESSION["insertTipo"]) && $_SESSION["insertTipo"] == 1){?>

<div class="alert alert-success" role="alert">
Registro guardado correctamente. 
</div>	


<?php }else if(isset($_SESSION["insertTipo"]) && $_SESSION["insertTipo"]==0){ ?>
<div class="alert alert-danger" role="alert">
 Ocurrió un error en el registro. 
</div>
<?php } unset($_SESSION["insertTipo"]); ?>

<?php if(isset($_SESSION["insertProd"]) && $_SESSION["insertProd"] == 1){?>

<div class="alert alert-success" role="alert">
Registro guardado correctamente. 
</div>	


<?php }else if(isset($_SESSION["insertProd"]) && $_SESSION["insertProd"]==0){ ?>
<div class="alert alert-danger" role="alert">
 Ocurrió un error en el registro.
</div>
<?php } unset($_SESSION["insertProd"]); ?>





						<div class="btn-group">
							  <a href="/agregarMarca.php" class="btn btn-primary">
							    Agregar Marca</span>
							  </a>
						</div>
						<div class="btn-group">
							  <a href="/agregarCategoria.php" class="btn btn-warning">
							    Agregar Categoría</span>
							  </a>
						</div>

						<div class="btn-group">
							  <a href="/agregarCantidad.php" class="btn btn-success">
							    Agregar Cantidad</span>
							  </a>
						</div>

						<div class="btn-group">
							  <a href="/agregarAtributo.php" class="btn btn-default">
							    Agregar Atributo</span>
							  </a>
						</div>
						<div class="btn-group">
							  <a href="/agregarTipo.php" class="btn btn-info">
							    Agregar Tipo</span>
							  </a>
						</div>
						
								  <a style="float: right;" href="/agregarProducto.php"  class="btn btn-primary">
								    Agregar Producto</span>
								  </a>
						
						<br></br>
					<div class="col-md-1"></div>
					<div class="col-md-10">

					<table class="table">
								<tr>
								<th data-field="id" style="text-align: center !important;">NOMBRE DEL PRODUCTO</th>
								<th data-field="name" style="text-align: center !important;">CARACTERISTICA</th>
								<th data-field="name" style="text-align: center !important;">PROVEEDOR</th>
								<th data-field="marca" style="text-align: center !important;">STOCK MINIMO</th>
								<th data-field="stock" style="text-align: center !important;">STOCK MAXIMO</th>
								<th data-field="cantidad" style="text-align: center !important;">ACCION</th>
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
							               <td><?php echo $arrays["nombre"] ?></td>
							               <td><?php echo $arrays["Caracteristica"] ?></td>
							               <td><?php echo $arrays["Proveedor"] ?></td>
							               <td><?php echo $arrays["StockMin"] ?></td>
							               <td><?php echo $arrays["StockMax"] ?></td>
							               <td><a href="/actualizarProducto.php?id=<?=$arrays["Id"]?>" class="btn btn-success">Editar</a></td>
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


				</div>
			</div>
</div>


<?php include 'includes/footer.php'; ?>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>