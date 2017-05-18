
var facturador = {
    detalle: {
        total:    0,
        subtotal: 0,
        cliente_id: 0,
        items:    []
    },

registrar: function(item)
    {
        var existe = false;
        
        item.total = (item.cantidad * item.costo);
        
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
                    costo:   row.find("input[name='precio']").val(),
                };

                facturador.detalle.items[indice].total = facturador.detalle.items[indice].costo *
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
        this.detalle.igv      = (this.detalle.total * 0.12).toFixed(2); // 18 % El IGV y damos formato a 2 deciamles
        this.detalle.subtotal = (this.detalle.total - this.detalle.igv).toFixed(2); // Total - IGV y formato a 2 decimales
        this.detalle.total    = this.detalle.total.toFixed(2);

        var template   = $.templates("#facturador-detalle-template");
        var htmlOutput = template.render(this.detalle);

        $("#facturador-detalle").html(htmlOutput);
    }
};

$(document).ready(function() {



    $("#frm-comprobante").submit(function(){

        var form = $(this);

        if(facturador.detalle.items.length == 0)
        {
            alert('Debe agregar por lo menos un detalle a la compra');
        }else
        {
            $("#load").addClass('block-loading');
            $.ajax({
                dataType: 'JSON',
                type: 'POST',
                url: form.attr('action'),
                data: facturador.detalle,
                success: function (info) {
                    $("#load").removeClass('block-loading');
                    var json_info = info.resp;
                    if(info.resp == 'EXITO'){
                          window.location.href = './compra.php';
                     }else{
                        $('#load').append('<div id="alertdiv" class="alert alert-danger"><a class="close" data-dismiss="alert"></a><span>'+ info.msj +'</span></div>')
                            setTimeout(function() { 
                              $("#alertdiv").remove();
                            }, 5000);
                     }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $("#load").removeClass('block-loading');
                     window.location.href = './compra.php';
                }
            });           
        }

        return false;
    })

     $("#producto").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
                url: '../controllers/AutoCompletaCompra.php',
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            id: item.Id,
                            value: item.Nombre                            
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#producto_id").val(ui.item.id);
            $("#cantidad").focus();
        }
    })

$("#btn-agregar").click(function(){
        var producto_id = $("#producto_id"),
            producto = $("#producto"),
            cantidad = $("#cantidad"),
            costo = $("#costo"),
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

        if(!isNumber(costo.val())) {
            alert('Debe ingresar un precio costo válido');
            return;
        }else if( parseInt(costo.val()) <= 0 ) {
            alert('Debe ingresar un precio costo válido');
            return;
        }

        if(!isNumber(precio.val())) {
            alert('Debe ingresar un precio válido');
            return;
        }else if( parseInt(precio.val()) <= 0 ) {
            alert('Debe ingresar un precio válido');
            return;
        }else if(parseFloat(precio.val()) <= parseFloat(costo.val())) {
            alert('El precio sugerido debería ser mayor al costo');
            return;
        }

        facturador.registrar({
            producto_id: parseInt(producto_id.val()),
            producto: producto.val(),
            cantidad: parseFloat(cantidad.val()),
            costo: parseFloat(costo.val()),
            precio: parseFloat(precio.val())
        });

        producto_id.val('0');
        producto.val('');
        cantidad.val('');
        costo.val('');
        precio.val('');
        $("#producto").focus();
    })



})
    function isNumber(n) {
          return !isNaN(parseFloat(n)) && isFinite(n);
        }