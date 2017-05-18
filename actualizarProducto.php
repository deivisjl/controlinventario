<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/config.php';
  	include '/controllers/BaseUrl.php';

  	if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2){
?>

<?php 
$baseUrl = BaseUrl::getServer();

if(isset($_GET["id"])  && !empty($_GET['id'])){

	$prod = $_GET["id"];
	$queryProducto = "SELECT *  from producto where Id = '{$prod}'";
	$resultProducto = mysqli_query($db,$queryProducto);
	
	$num_total_prod = mysqli_num_rows($resultProducto);

	if($num_total_prod > 0){
			$arrays = mysqli_fetch_array($resultProducto);

			$queryProveedor = "SELECT Persona_id as clave, Nombre_Empresa as nombre from proveedor Order by Nombre_Empresa asc";
			$queryMarca = "SELECT Id as clave, Nombre_Marca as nombre from Marca Order by Nombre_Marca asc";
			$queryCategoria = "SELECT Id as clave, Nombre_Categoria as nombre from Categoria Order by Nombre_Categoria asc";
			$queryCantidad = "SELECT Id as clave, Nombre as nombre from Cantidad Order by Nombre asc";
			$queryAtributo = "SELECT Id as clave, Nombre_Atributo as nombre from Atributo Order by Nombre_Atributo asc";
			$queryTipo = "SELECT Id as clave, Nombre_Tipo as nombre from Tipo Order by Nombre_Tipo asc";

			$resultProveedor = mysqli_query($db,$queryProveedor);
			$resultMarca = mysqli_query($db,$queryMarca);
			$resultCategoria = mysqli_query($db,$queryCategoria);
			$resultCantidad = mysqli_query($db,$queryCantidad);
			$resultAtributo = mysqli_query($db,$queryAtributo);
			$resultTipo = mysqli_query($db,$queryTipo);
	}else{
		header("Location: $baseUrl");
	}

}else{
	header("Location: $baseUrl");
}
	

 ?>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div style="text-align: center;">ACTUALIZAR PRODUCTO</div>
					</div>
					<div class="panel-body">
								<div class="row">
									<div class="col-md-2"></div>
										<div class="col-md-8">
											<ol class="breadcrumb">
											  <li><a href="/producto.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
											</ol>
										</div>
									<div class="col-md-2"></div>
								</div>

					<div class="col-md-2"></div>
						<div class="col-md-8">


							<form role="form" id="frm_proveedor" method="POST" action="./controllers/getProducto.php">
							<div class="col-xs-6">
								<div class="form-group">
									<label>Proveedor</label>
									<select name="proveedor" class="form-control">
										<?php 
									        while($results = mysqli_fetch_array($resultProveedor)){ ?>
									        <option value="<?php echo $results["clave"] ?>" 
												<?php 
													if($arrays["Proveedor_Id"] == $results["clave"])
														{ 
															echo "selected='selected'"; 
														} 
												?>
									        >
									        	<?php  echo $results["nombre"]?>
									        </option>
									    <?php } ?>
									</select>
								</div>
									
								<div class="form-group">
									<label>Marca</label>
									<select name="marca" class="form-control">
										<?php 
									        while($results = mysqli_fetch_array($resultMarca)){ ?>
									        <option value="<?php echo $results["clave"] ?>" 
											<?php 
													if($arrays["Marca_Id"] == $results["clave"])
														{ 
															echo "selected='selected'"; 
														} 
												?>	
									        >
									        	<?php  echo $results["nombre"]?>
									        </option>
									    <?php } ?>
									</select>
								</div>

								<div class="form-group">
									<label>Categoría Artículo</label>
									<select name="categoria" class="form-control">
										<?php 
									        while($results = mysqli_fetch_array($resultCategoria)){ ?>
									        <option value="<?php echo $results["clave"] ?>" 
											<?php 
													if($arrays["Categoria_Id"] == $results["clave"])
														{ 
															echo "selected='selected'"; 
														} 
												?>
									        >
									        	<?php  echo $results["nombre"]?>
									        </option>
									    <?php } ?>
									</select>
								</div>

								<div class="form-group">
									<label>Cantidad</label>
									<select name="cantidad" class="form-control">
										<?php 
									        while($results = mysqli_fetch_array($resultCantidad)){ ?>
									        <option value="<?php echo $results["clave"] ?>" 
									        <?php 
													if($arrays["Cantidad_Id"] == $results["clave"])
														{ 
															echo "selected='selected'"; 
														} 
												?>

									        >
									        	<?php  echo $results["nombre"]?>
									        </option>
									    <?php } ?>
									</select>
								</div>
							
							</div>

							

							<div class="col-xs-6">
																
								<div class="form-group">
									<label>Atributo</label>
									<select name="atributo" class="form-control">
										<?php 
									        while($results = mysqli_fetch_array($resultAtributo)){ ?>
									        <option value="<?php echo $results["clave"] ?>" 
									        <?php 
													if($arrays["Atributo_Id"] == $results["clave"])
														{ 
															echo "selected='selected'"; 
														} 
												?>

									        >
									        	<?php  echo $results["nombre"]?>
									        </option>
									    <?php } ?>
									</select>
								</div>

								<div class="form-group">	
									<label>Tipo</label>
										<select name="tipo" class="form-control">
											<?php 
									        while($results = mysqli_fetch_array($resultTipo)){ ?>
									        <option value="<?php echo $results["clave"] ?>" 
									        <?php 
													if($arrays["Tipo_Id"] == $results["clave"])
														{ 
															echo "selected='selected'"; 
														} 
												?>
									        >
									        	<?php  echo $results["nombre"]?>
									        </option>
									    <?php } ?>
										</select>
								</div>


								<div class="form-group">
									<label>Características</label>
									<input type="text" class="form-control" placeholder="Características" name ="features" 
									value="<?= $arrays["Caracteristica"]; ?>" data-validacion-tipo="requerido|min:3"/>
								</div>

								<div class="form-group">
									<label>Stock Minímo</label>
									<input type="numeric" class="form-control" placeholder="Stock Minímo" name ="stockmin"
									value="<?= $arrays["StockMin"]; ?>" data-validacion-tipo="requerido|numero"/>
								</div>
								
								<div class="form-group">
									<label>Stock Máximo</label>
									<input type="numeric" class="form-control" placeholder="Stock Máximo" name ="stockmax"
									value="<?= $arrays["StockMax"]; ?>" data-validacion-tipo="requerido|numero"/>
								</div>

								<input type="hidden" value="<?= $arrays["Id"];  ?>" name="prodID" />
								<input type="hidden" value="2" name="send" />
								
								<button type="submit" name="addproducto" class="btn btn-warning">Actualizar</button>
								<a href="/producto.php" class="btn btn-default">Cancelar</a>
							</div>

							</div>
					
						</form>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->




<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function(){
        $("#frm_proveedor").submit(function(){
            return $(this).validate();
        });
    })
</script>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>
		