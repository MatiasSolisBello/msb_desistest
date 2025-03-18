$(document).ready(function () {
    $("#bodega").change(function () {
        let bodegaID = $(this).val();
        if (bodegaID) {
            $.ajax({
                type: "POST",
                url: "get_sucursales.php",
                data: { bodega_id: bodegaID },
                dataType: "json",
                success: function (data) {
                    $("#sucursal").html('<option value=""></option>');
                    $.each(data, function (key, value) {
                        $("#sucursal").append('<option value="' + value.id + '">' + value.nombre + '</option>');
                    });
                }
            });
        }
    });

    $("#codigo").change(function () {
        let codigo = $(this).val();
        if (codigo) {
            $.ajax({
                type: "POST",
                url: "validar_codigo.php",
                data: { codigo: codigo },
                success: function (data) {
                    if (data == "true") {
                        alert('El código del producto ya existe en la base de datos.');
                        $('#codigo').val('');
                    }
                }
            });
        }
    });

    $('#producto-form').submit(function (e) {
        e.preventDefault();
        var material = [];

        // Codigo: Obligatorio, formato específico (letras, números), 
        // longitud mínima de 5 y máxima de 15 caracteres.
        // Debe ser único y verificado en la base de datos
        codigo = $('#codigo').val()
        if (codigo == null || codigo == "") {
            alert('El código del producto no puede estar en blanco.');
            return;
        };
        if (codigo.length < 5 || codigo.length > 15) {
            alert('El código debe tener entre 5 y 15 caracteres');
            return;
        }
        const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/;
        if (!regex.test(codigo)) {
            alert("El código del producto debe contener letras y números");
            return false;
        }


        // Nombre: Obligatorio, longitud mínima de 2 y máxima de 50 caracteres
        nombre = $('#nombre_producto').val();
        if (nombre == null || nombre == "") {
            alert('El nombre del producto no puede estar en blanco.');
            return;
        };
        if (nombre.length < 2 || nombre.length > 50) {
            alert('El nombre del producto debe tener entre 2 y 50 caracteres.');
            return;
        }
        
        // precio: Obligatorio, formato de número positivo con hasta dos decimales
        precio = $('#precio').val();
        if (precio == null || precio == "") {
            alert('El precio del producto no puede estar en blanco.');
            return;
        };

        const regexPrecio = /^(?!0$)(\d+(\.\d{1,2})?)$/;
        if (!regexPrecio.test(precio)) {
            alert("El precio del producto debe ser un número positivo con hasta dos decimales.");
            return false;
        }


        // Material: Se debe seleccionar al menos dos opciones de materiales
        $.each($("input[name='material']:checked"), function(){
            material.push($(this).val());
        });
        
        if (material.length < 2) {
            alert("Debe seleccionar al menos dos materiales para el producto.");
            return;
        }
        material = material.toString();

        //Bodega
        bodega = $('#bodega').val();
        if (bodega == null || bodega == "") {
            alert('Debe seleccionar una bodega.');
            return;
        };

        //Sucursal
        sucursal = $('#sucursal').val();
        if (sucursal == null || sucursal == "") {
            alert('Debe seleccionar una sucursal para la bodega seleccionada.');
            return;
        };

        //Moneda
        moneda = $('#moneda').val();
        if (moneda == null || moneda == "") {
            alert('Debe seleccionar una moneda para el producto.');
            return;
        }

        // Descripción: Obligatorio, longitud mínima de 10 caracteres y máxima de 1000
        descripcion = $('#descripcion').val();
        if(descripcion == null || descripcion == "") {
            alert('La descripción del producto no puede estar en blanco.');
            return;
        }
        if (descripcion.length < 10 || descripcion.length > 1000) {
            alert('La descripción del producto debe tener entre 10 y 1000 caracteres.');
            return;
        }

        const data = {
            codigo: codigo,
            nombre: nombre,
            bodega: bodega,
            sucursal: sucursal,
            moneda: moneda,
            precio: precio,
            material: material,
            descripcion: descripcion
        };
        $.ajax({
            type: "POST",
            url: "guardar_producto.php",
            data: data,
            success: function (response) {
                alert('Producto guardado correctamente');
                $('#producto-form').trigger('reset');
            }
        });
    });
});