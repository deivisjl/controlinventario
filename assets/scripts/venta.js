var facturador = {
    detalle: {
        total:    0,
        cliente_id: 0,
        forma_pago: 0,
        items:    []
    },

    /* Encargado de agregar un producto a nuestra colección */
    registrar: function(item)
    {
        var existe = false;
        
        item.total = (item.cantidad * item.precio);
        
        this.detalle.items.forEach(function(x){
            if(x.producto_id === item.producto_id) {
                x.cantidad += item.cantidad;
                x.total += item.total;
                existe = true;
            }
        });

        if(!existe) {
            this.detalle.items.push(item);
        }

        this.refrescar();
    },

    /* Encargado de actualizar el precio/cantidad de un producto */
    actualizar: function(id, row)
    {
        /* Capturamos la fila actual para buscar los controles por sus nombres */
        row = $(row).closest('.list-group-item');

        /* Buscamos la columna que queremos actualizar */
        $(this.detalle.items).each(function(indice, fila){
            if(indice == id)
            {
                /* Agregamos un nuevo objeto para reemplazar al anterior */
                facturador.detalle.items[indice] = {
                    producto_id: row.find("input[name='producto_id']").val(),
                    producto: row.find("input[name='producto']").val(),
                    cantidad: row.find("input[name='cantidad']").val(),
                    precio:   row.find("input[name='precio']").val(),
                };

                facturador.detalle.items[indice].total = facturador.detalle.items[indice].precio *
                                                         facturador.detalle.items[indice].cantidad;

                return false;
            }
        })

        this.refrescar();
    },

    /* Encargado de retirar el producto seleccionado */
    retirar: function(id)
    {
        /* Declaramos un ID para cada fila */
        $(this.detalle.items).each(function(indice, fila){
            if(indice == id)
            {
                facturador.detalle.items.splice(id, 1);
                return false;
            }
        })

        this.refrescar();
    },

    /* Refresca todo los productos elegidos */
    refrescar: function()
    {
        this.detalle.total = 0;

        /* Declaramos un id y calculamos el total */
        $(this.detalle.items).each(function(indice, fila){
            facturador.detalle.items[indice].id = indice;
            facturador.detalle.total += fila.total;
        })

        /* Calculamos el subtotal e IGV */
        //this.detalle.igv      = (this.detalle.total * 0.18).toFixed(2); // 18 % El IGV y damos formato a 2 deciamles
        //this.detalle.subtotal = (this.detalle.total - this.detalle.igv).toFixed(2); // Total - IGV y formato a 2 decimales
        this.detalle.total    = this.detalle.total.toFixed(2);

        var template   = $.templates("#facturador-detalle-template");
        var htmlOutput = template.render(this.detalle);

        $("#facturador-detalle").html(htmlOutput);
    }
};

$(document).ready(function(){

 // Guardamos el select de cursos
        var pago = $("#lst-pago");

            $.ajax({
                data: { },
                url:   '../controllers/AutoCompletaPago.php',
                type:  'POST',
                dataType: 'json',
                beforeSend: function () 
                {
                    
                },
                success:  function (r) 
                {
                    // Limpiamos el select
                    pago.find('option').remove();

                    $(r).each(function(i, v){ // indice, valor
                        pago.append('<option value="' + v.Id + '">' + v.Forma + '</option>');
                    })

                },
                error: function()
                {
                    alert('Ocurrio un error en el servidor ..');
                }
            });

    GuardarCliente();

    
    $("#btn-item").click(function(){
        var producto_id = $("#producto_id"),
            producto = $("#producto"),
            cantidad = $("#cantidad"),
            precio =   $("#precio");
        
        // Validaciones
        if(producto_id.val() === '0') {
            alert('Debe seleccionar un producto');
            return;
        }
        
        if(!isNumber(cantidad.val())) {
            alert('Debe ingresar una cantidad válida');
            return;
        } else if( parseInt(cantidad.val()) <= 0 ) {
            alert('Debe ingresar una cantidad válida');
            return;
        }
        if(!isNumber(precio.val())) {
            alert('Debe ingresar una precio válido');
            return;
        } else if( parseInt(precio.val()) <= 0 ) {
            alert('Debe ingresar una precio válido');
            return;
        }
        
        facturador.registrar({
            producto_id: parseInt(producto_id.val()),
            producto: producto.val(),
            cantidad: parseFloat(cantidad.val()),
            precio: parseFloat(precio.val()),
        });

        producto_id.val('0');
        producto.val('');
        cantidad.val('');
        precio.val('');
        $("#producto").focus();
    })
    
    $("#frm-venta").submit(function(){

        var form = $(this);

        var forma = $("#lst-pago");

        facturador.detalle.forma_pago = parseInt(forma.val());

        if(facturador.detalle.cliente_id == 0)
        {
            alert('Debe agregar un cliente');
        }
        else if(facturador.detalle.items.length == 0)
        {
            alert('Debe agregar por lo menos un detalle al comprobante');
        }
        else if(facturador.detalle.forma_pago == 0)
        {
            alert('Debe seleccionar una forma de pago');
        }
        else
        {
            $.ajax({
                dataType: 'JSON',
                type: 'POST',
                url: form.attr('action'),
                data: facturador.detalle,
                success: function (r) {
                    //if(r) window.location.href = './venta.php';
                    var json_info = r.resp;
                    if(json_info == 'EXITO'){
                          window.location.href = './venta.php';
                     }else{
                        $('#load').append('<div id="alertdiv" class="alert alert-danger"><a class="close" data-dismiss="alert"></a><span>'+ info.msj +'</span></div>')
                            setTimeout(function() { 
                              $("#alertdiv").remove();
                            }, 5000);
                     }
                },
                error: function(jqXHR, textStatus, errorThrown){
                     window.location.href = './venta.php';
                }   
            });           
        }

        return false;
    })
    
    /* Autocomplete de cliente, jquery UI */
    $("#clientes").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
                url: '../controllers/AutoCompletaCliente.php',
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            id: item.id,
                            value: item.Nombre,
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#cliente_id").val(ui.item.id);            
            facturador.detalle.cliente_id = ui.item.id;
        }
    })


    
    /* Autocomplete de producto, jquery UI */
    $("#producto").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
                url: '../controllers/AutoCompletaVenta.php',
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            id: item.id,
                            value: item.Nombre,
                            precio: item.Precio
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#producto_id").val(ui.item.id);
            $("#precio").val(ui.item.precio);
            $("#cantidad").focus();
        }
    })
})

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

var GuardarCliente = function(){
    $("#frm_fast_client").on("submit",function(e){
        e.preventDefault();
        var frm = $(this).serialize();
        $('#myModal').modal('toggle');
        $.ajax({
            method:"POST",
            url: "./controllers/getFastClient.php",
            data: frm
        }).done(function(info){
            var json_info = JSON.parse(info);
            set_resp(json_info);
            limpiar_modal();
        });
    });
}

var set_resp = function(info){
    if(info.resp != "ERROR"){
        $("#cliente_id").val(info.resp);
        $("#clientes").val(info.client);
        facturador.detalle.cliente_id = info.resp;
    }
}

/*var msj_show = function(info){
    var texto = "", color = "";
    if(info.resp == "true"){
        texto = "<strong>OK</strong> Registro exitoso";
        color = "#fdfdfd";
    }

    $.(".mensaje").html(texto).css({"color:" color});
    $.(".mensaje").fadeOut(5000, function(){
        $(this).html("");
        $(this).fadeIn(3000);
    });
}*/

var limpiar_modal = function(){
    $("#nombre").val("");
    $("#apellido").val("");
    $("#dpi").val("");
}