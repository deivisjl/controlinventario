<?php

////¿¿$JAN2150

include 'controllers/BaseUrl.php';

$baseUrl = BaseUrl::getServer();
	$pass = "12345";
	//echo $baseUrl.'/';
	//echo sha1($pass);
 


/*public function cgetAction(Request $request){

	$draw;
	$start;
	$lenght;
	$search;
	$order(columna);
	$order(asc);

	$em = $this->getDoctrine()->getManager();
	$disponibilidad = $this->getDoctrine()->getRepository('AppBundle:Disponibilidad');
	$ordenadores = array("d.id","d.fecha","d.hora");

	$datos = $disponibilidad->createQueryBuilder('d')
	->where('d.fecha like :searchvalue OR d.hora LIKE :searchvalue')
	->orderBy($ordenadores[$request->query->get('order')[0]["column"]],$request->query->get("order")[0]["dir"])
	->setFirstResult($request->query->get('start'))
	->setMaxResults($request->query->get('lenght'))
	->setParameter('searchvalue', '%'.$request->query->get('search')["value"].'%')
	->getQuery()
	->getResult();


	$cantidaddatos = $disponibilidad->createQueryBuilder('d')
	->select('COUNT (d.id)')
	->where('d.fecha like :searchvalue OR d.hora like :searchvalue' )
	->orderBy($ordenadores[$request->query->get('order')[0]["column"]],$request->query->get('order')[0]["dir"])
	->setParameter('searchvalue','%'.$request->query->get('search')["value"].'%')
	->getQuery()
	->getSingleScalarResult();

	$valores = array();
	foreach($datos as $dato){
		$valores[] = array(
			'id' => $dato->getId(),
			'fecha' => $dato->getFecha()->format("Y-m-d"),
			'hora' => $dato->getHora()->format("H:i:s"),
		);
	}

	$respuesta = array(
		'draw' => $request->query->get("draw"),
		'recordsTotal' => $cantidaddatos,
		'recordsFiltered' => $cantidaddatos,
		'data' => $valores,
		);





	$datos = $repository->findAll();
	foreach ($datos as $dato) {
		$valores[] = array(
			'id'=> $dato->getId(),
			'fecha' => $dato->getFecha()->format("Y-m-d"),
			'hora' => $dato->getHora()->format("H:i:s"),
		);
	}

	$respuesta = array(
		'draw' => '1',
		'recordsTotal' => '57',
		'recordsFiltered' => '57',
		'data' => $valores,
		);
}


	
  ?>

  <table id = "tabla2" class="table table-striped">
  <thead>
  	<tr>
  		<th>Id</th>
  		<th>Fecha</th>
  		<th>Hora</th>
  	</tr>
  </thead>
  	
  </table>

  <script type="text/javascript">
  	(function(){})
  	$(document).ready(function(){
  		$("#tabla2").DataTable(
  				{
  					"processing": true,
  					"serverSide": true,
  					"ajax":{
  						'url': 'app/api/disponibilidad',
  						'type': GET
  					},
  					"columns": [
  						{'data': 'id'},
  						{'data': 'fecha'},
  						{'data': 'hora'}
  					]
  				}
  			);
  	});

$(document).ready(function () {
    var editor; // use a global for the submit and return data rendering in the examples
    editor = new $.fn.dataTable.Editor({
        dom: "Tfrtip",
        "ajax": "adendum1",
        "table": "#example",
        "fields": [{
            "label": "First name:",
            "name": "first_name"
        }, {
            "label": "Last name:",
            "name": "last_name"
        }, {
            "label": "Position:",
            "name": "position"
        }, {
            "label": "Office:",
            "name": "office"
        }, {
            "label": "Extension:",
            "name": "extn"
        }, {
            "label": "Start date:",
            "name": "start_date",
            "type": "datetime"
        }, {
            "label": "Salary:",
            "name": "salary"
        }
        ]
    });

    // New record
    $('a.editor_create').on('click', function (e) {
        e.preventDefault();

        editor.create({
            title: 'Create new record',
            buttons: 'Add'
        });
    });

    // Edit record
    $('#example').on('click', 'a.editor_edit', function (e) {
        e.preventDefault();

        editor.edit($(this).closest('tr'), {
            title: 'Edit record',
            buttons: 'Update'
        });
    });

    // Delete a record
    $('#example').on('click', 'a.editor_remove', function (e) {
        e.preventDefault();

        editor.remove($(this).closest('tr'), {
            title: 'Delete record',
            message: 'Are you sure you wish to remove this record?',
            buttons: 'Delete'
        });
    });

    $('#example').DataTable({
        dom: "Tfrtip",
        ajax: "adendum1",
        //data: function (data) { return data = JSON.stringify(data); },
        columns: [

            
            {
                data: null, render: function (data, type, row) {
                    // Combine the first and last names into a single table field
                    return data.first_name + ' ' + data.last_name;
                }
            },
            { data: "position" },
            { data: "office" },
            { data: "extn"},
            { data: "start_date"},
            { data: "salary"},
            {
                data: null,
                className: "center",
                defaultContent: '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
            }
        ]
    });
});


  	
  </script>

  <head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>DataTables example - HTML (DOM) sourced data</title>
	<link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
	<link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=b05357026107a2e3ca397f642d976192">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script><script type="text/javascript" src="/media/js/site.js?_=9a83ad61fa12260d710e54eb5f3203dc">
	</script>
	<script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fdata_sources%2Fdom.html" async="">
	</script>
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="../resources/demo.js">
	</script>
	<script type="text/javascript" class="init">
	

$(document).ready(function() {
	$('#example').DataTable();
} );


	</script>


</head>

Select P.Id, Concat(C.Nombre_Categoria,' ',K.Nombre,' ',A.Nombre_Atributo) as Nombre, I.CostoActual, I.PrecioSugerido, I.Stock from producto as P join categoria as C
	on P.Categoria_Id = C.Id 
	inner join Cantidad as K 
	on P.Cantidad_Id = K.Id 
	inner join Atributo as A 
	on P.Atributo_Id = A.Id 
	inner join inventario as I 
	on P.Id = I.Id;

	draw:1
columns[0][data]:Id
columns[0][name]:
columns[0][searchable]:true
columns[0][orderable]:true
columns[0][search][value]:
columns[0][search][regex]:false
columns[1][data]:Nombre
columns[1][name]:
columns[1][searchable]:true
columns[1][orderable]:true
columns[1][search][value]:
columns[1][search][regex]:false
columns[2][data]:PrecioActual
columns[2][name]:
columns[2][searchable]:true
columns[2][orderable]:true
columns[2][search][value]:
columns[2][search][regex]:false
columns[3][data]:PrecioSugerido
columns[3][name]:
columns[3][searchable]:true
columns[3][orderable]:true
columns[3][search][value]:
columns[3][search][regex]:false
columns[4][data]:Stock
columns[4][name]:
columns[4][searchable]:true
columns[4][orderable]:true
columns[4][search][value]:
columns[4][search][regex]:false
order[0][column]:0
order[0][dir]:asc
start:0
length:10
search[value]:
search[regex]:false
_:1485188088369

<script type="text/javascript">
	(function(){
		$(document).ready(function(){
			$('$productosReporte').DataTable(
				{
					"processing": true,
					"serverSide": true,
					"ajax":{
						'url': './controllers/getInventario.php',
						'type': 'GET'
					},
					"columns":[
						{'data': 'Id'},
  						{'data': 'Nombre'},
  						{'data': 'PrecioActual'},
  						{'data': 'PrecioSugerido'},
  						{'data': 'Stock'}
					]
				}
			);
		});
	}) ();
</script>

array (size=7)
  'draw' => string '1' (length=1)
  'columns' => 
    array (size=5)
      0 => 
        array (size=5)
          'data' => string 'Id' (length=2)
          'name' => string '' (length=0)
          'searchable' => string 'true' (length=4)
          'orderable' => string 'true' (length=4)
          'search' => 
            array (size=2)
              ...
      1 => 
        array (size=5)
          'data' => string 'Nombre' (length=6)
          'name' => string '' (length=0)
          'searchable' => string 'true' (length=4)
          'orderable' => string 'true' (length=4)
          'search' => 
            array (size=2)
              ...
      2 => 
        array (size=5)
          'data' => string 'PrecioActual' (length=12)
          'name' => string '' (length=0)
          'searchable' => string 'true' (length=4)
          'orderable' => string 'true' (length=4)
          'search' => 
            array (size=2)
              ...
      3 => 
        array (size=5)
          'data' => string 'PrecioSugerido' (length=14)
          'name' => string '' (length=0)
          'searchable' => string 'true' (length=4)
          'orderable' => string 'true' (length=4)
          'search' => 
            array (size=2)
              ...
      4 => 
        array (size=5)
          'data' => string 'Stock' (length=5)
          'name' => string '' (length=0)
          'searchable' => string 'true' (length=4)
          'orderable' => string 'true' (length=4)
          'search' => 
            array (size=2)
              ...
  'order' => 
    array (size=1)
      0 => 
        array (size=2)
          'column' => string '0' (length=1)
          'dir' => string 'asc' (length=3)
  'start' => string '0' (length=1)
  'length' => string '10' (length=2)
  'search' => 
    array (size=2)
      'value' => string '' (length=0)
      'regex' => string 'false' (length=5)
  '_' => string '1485264664212' (length=13)


<link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/dataTables.semanticui.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/dataTables.uikit.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/jquery.dataTables_themeroller.css"/>
<link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/dataTables.material.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/dataTables.bootstrap4.min.css"/>
  