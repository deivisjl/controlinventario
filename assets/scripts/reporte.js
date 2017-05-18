$(document).ready(function(){
      $('#start').on('change', function(){
		var desde = $('#start').val();
		var hasta = $('#limit').val();
		var url = '../controllers/getReporteVenta.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	
	$('#limit').on('change', function(){
		var desde = $('#start').val();
		var hasta = $('#limit').val();
		var url = '../controllers/getReporteVenta.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});


	$('#starts').on('change', function(){
		var desde = $('#starts').val();
		var hasta = $('#limits').val();
		var url = '../controllers/getReporteCompra.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	
	$('#limits').on('change', function(){
		var desde = $('#starts').val();
		var hasta = $('#limits').val();
		var url = '../controllers/getReporteCompra.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});

});