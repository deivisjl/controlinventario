<?php 
include '../includes/redirect.php';
		include '../config.php';

$compra = $_POST['Id'];
$subtotal = 0.00;
$total = 0.00;


$query = "SELECT  C.Id, CONCAT(T.Nombre_Categoria,' ',M.Nombre_Marca,' ',A.Nombre,' ',L.Nombre_Atributo) as Articulo, 
					S.Nombre_Empresa, D.PrecioCosto, D.PrecioSugerido, D.Cantidad 
					from compra as C join compra_detalle as D On C.Id = D.Compra_Id 
					left join producto as I On D.Producto_Id = I.Id 
					left join categoria as T On I.Categoria_Id = T.Id 
					left join marca as M On I.Marca_Id = M.Id 
					left join Cantidad as A On I.Cantidad_Id = A.Id 
					left join atributo as L On I.Atributo_Id = L.Id 
					left join proveedor as S On I.Proveedor_Id = S.Persona_id 
					Where C.Id = $compra";


$registro = mysqli_query($db,$query);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped dataTable no-footer">
        	<tr>
            	<th style="text-align: center !important;">Compra</th>
                <th style="text-align: center !important;">Producto</th>
                <th style="text-align: center !important;">Proveedor</th>
                <th style="text-align: center !important;">Precio Costo</th>
                <th style="text-align: center !important;">Precio Sugerido</th>
                <th style="text-align: center !important;">Cantidad Adquirida</th>
                <th style="text-align: center !important;">Subtotal</th>
            </tr>';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
		$subtotal = $registro2['PrecioCosto'] * $registro2['Cantidad'];
		$total = $total + $subtotal;
		echo '<tr>
				<td style="text-align: center !important;">'.$registro2['Id'].'</td>
				<td>'.$registro2['Articulo'].'</td>
				<td style="text-align: center !important;">'.$registro2['Nombre_Empresa'].'</td>
				<td>Q. '.number_format($registro2['PrecioCosto'],2).'</td>
				<td>Q. '.number_format($registro2['PrecioSugerido'],2).'</td>
				<td style="text-align: center !important;">'.$registro2['Cantidad'].'</td>
				<td>Q. '.number_format($subtotal,2).'</td>
				';
	}
	echo '<div class="row text-center">
			<div class="col-md-4">
				<h3>'."Total Compra: Q. ".''.number_format($total,2).'</h3>
			</div>
		 </div>';
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';

 ?>