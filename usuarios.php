<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include 'controllers/BaseUrl.php';
  	include '/config.php';

  	if($_SESSION["login"]["Rol_Id"] == 1){

?>

<?php 
	
	$conteo = "SELECT persona_id from usuario";
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
	
$sql="SELECT U.Persona_Id, CONCAT(P.Nombres,' ',P.Apellidos) as Nombre, U.Username as Usuario,R.Nombre_Rol as Rol
				from usuario as U join persona as P
				on U.Persona_Id = P.Id
				inner join rol as R
				on U.Rol_Id = R.Id
	 						ORDER BY P.Nombres ASC LIMIT {$start}, {$rows_per_page};";
	$resultUsuario = mysqli_query($db, $sql);

	}

 ?>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row text-center">
							<div class="col-md-12">
								<h4>USUARIOS</h4>
							</div>

						</div>
					</div>
					<div class="panel-body">
								
						<div class="col-md-2"></div>
							<div class="col-md-8">
							<ol class="breadcrumb">
								   <li><a href="/index.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
								</ol>
								
									<a href="/agregarUsuario.php" class="btn btn-primary" style="float: right;">Agregar Usuario</a>
										<br></br>

<?php if(isset($_SESSION["insertUser"]) && $_SESSION["insertUser"]==1) {?>
        <div class="alert alert-success" role="alert">
           Se ha insertado correctamente el registro.
        </div>  
<?php }else if(isset($_SESSION["insertUser"]) && $_SESSION["insertUser"]==2){?>
		<div class="alert alert-info" role="alert">
           Se ha actualizado correctamente el registro.
        </div> 

<?php }else if(isset($_SESSION["insertUser"]) && $_SESSION["insertUser"]==0){ ?>
		<div class="alert alert-danger" role="alert">
		 Ocurrió un error en el registro.
		</div>
<?php } unset($_SESSION["insertUser"]); ?>
												<table class="table">
													<tr>
													<th data-field="nombre" style="text-align: center !important;">NOMBRE</th>
													<th data-field="username" style="text-align: center !important;">USERNAME</th>
													
													<th data-field="nombre_rol" style="text-align: center !important;">ROL</th>
													<th data-field="cantidad" style="text-align: center !important;">ACCION</th>
													</tr>

													<?php
											    	if($resultUsuario)
													{
														 while($arrays = mysqli_fetch_array($resultUsuario))
														 {	?>
														   <tr style="text-align: center;">
									
												               <td><?php echo $arrays["Nombre"] ?></td>
												               <td><?php echo $arrays["Usuario"] ?></td>
												               
												               <td><?php echo $arrays["Rol"] ?></td>
												               <td><a href="/actualizarUsuario.php?id=<?=$arrays["Persona_Id"]?>" class="btn btn-success">Editar</a></td>
												                
												              
											               </tr>

												   <?php } 
													}
												 ?>
												</table>
							</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>
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
	</div>



<?php include 'includes/footer.php'; ?>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>