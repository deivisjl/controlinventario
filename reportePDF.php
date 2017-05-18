<?php
	include 'includes/redirect.php';
	include 'controllers/BaseUrl.php';

if(isset($_GET["report"]) && $_GET["report"]==1 && $_SESSION["login"]["Rol_Id"] == 1){

	function limpiaCadena($cadena) {
		$vowels = array("&nbsp");

     	return str_replace($vowels,'',$cadena);
	}

	include 'fpdf/fpdf.php';
	include 'config.php';

	$pdf = new FPDF();
	$pdf->SetAutoPageBreak(true,10);
	$pdf->AddPage();
	$pdf->SetFont('Arial', '', 10);
	$pdf->Image('images/stock.png' , 10 ,8, 10 , 13,'PNG');
	$pdf->Cell(18, 10, '', 0);
	$pdf->Cell(150, 10, 'Libreria | Control', 0);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
	$pdf->Ln(15);
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(70, 8, '', 0);
	$pdf->Cell(100, 8, 'Listado de Productos con Bajo Stock', 0);
	$pdf->Ln(2);//10
	$pdf->Cell(60, 8, '', 0);
	
	$pdf->Ln(15);//23
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(20, 8, 'Codigo', 1,0,'C');
	$pdf->Cell(60, 8, 'Producto', 1,0,'C');
	$pdf->Cell(35, 8, 'Proveedor', 1,0,'C');
	$pdf->Cell(25, 8, 'Stock Minimo', 1,0,'C');
	$pdf->Cell(25, 8, 'Stock Maximo', 1,0,'C');
	$pdf->Cell(25, 8, 'Stock Actual', 1,0,'C');
	
	$pdf->Ln(8);
	$pdf->SetFont('Arial', '', 8);
	//CONSULTA
	$consultaProd = "SELECT P.Id, CONCAT(C.Nombre_Categoria,' ',M.Nombre_Marca,' ',T.Nombre,' ',A.Nombre_Atributo) 
			as Articulo, 
			R.Nombre_Empresa, P.StockMin, P.StockMax, I.Stock
			from producto as P join categoria as C
			On P.Categoria_Id = C.Id
			inner join marca as M
			On P.Marca_Id = M.Id
			inner join cantidad as T
			On P.Cantidad_Id = T.Id
			inner join atributo as A
			On P.Atributo_Id = a.Id
			inner join proveedor as R
			On P.Proveedor_Id = R.Persona_Id
			inner join inventario as I
			On P.Id = I.Producto_Id
				WHERE P.StockMin > I.Stock";

	$productos = mysqli_query($db,$consultaProd);
	while($productos2 = mysqli_fetch_array($productos)){
		$pdf->Cell(20, 8, $productos2['Id'], 0,0,'C');
		$pdf->Cell(60, 8, limpiaCadena($productos2['Articulo']), 0,0,'C');
		$pdf->Cell(35, 8, $productos2['Nombre_Empresa'], 0,0,'C');
		$pdf->Cell(25, 8, $productos2['StockMin'], 0,0,'C');
		$pdf->Cell(25, 8, $productos2['StockMax'], 0,0,'C');
		$pdf->Cell(25, 8, $productos2['Stock'], 0,0,'C');
		$pdf->Ln(8);
	}

	$pdf->Output('reporte.pdf','I');

	}else{
		$baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
	}
?>