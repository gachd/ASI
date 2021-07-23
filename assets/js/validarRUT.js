function checkRut(rut) {

    // Despejar Puntos

    var id = $(rut).attr('id');

    var valor = rut.value.replace('.', '');

    //var error = "#e" + id;

    // Despejar Gui�n

    valor = valor.replace('-', '');



    // Aislar Cuerpo y D�gito Verificador

    cuerpo = valor.slice(0, -1);

    dv = valor.slice(-1).toUpperCase();



    // Formatear RUN

    rut.value = cuerpo + '-' + dv



    // Si no cumple con el m�nimo ej. (n.nnn.nnn)

    if (cuerpo.length < 7) {


        $("#guardarArch").attr("disabled", 'disabled');
        $("#e" + id).show();
        $("#guardar_dp").attr("disabled", 'disabled');
        $("#agCargaSocio").attr("disabled", 'disabled');








    } else {
        $("#guardarArch").prop("disabled", false);
        $("#e" + id).hide();
        $("#guardar_dp").prop("disabled", false);
        $("#agCargaSocio").prop("disabled", false);





    }



    // Calcular D�gito Verificador

    suma = 0;

    multiplo = 2;



    // Para cada d�gito del Cuerpo

    for (i = 1; i <= cuerpo.length; i++) {



        // Obtener su Producto con el M�ltiplo Correspondiente

        index = multiplo * valor.charAt(cuerpo.length - i);



        // Sumar al Contador General

        suma = suma + index;



        // Consolidar M�ltiplo dentro del rango [2,7]

        if (multiplo < 7)
         
        { 
            multiplo = multiplo + 1; 
        
        } else{ 

            multiplo = 2; 
        }



    }



    // Calcular D�gito Verificador en base al M�dulo 11

    dvEsperado = 11 - (suma % 11);



    // Casos Especiales (0 y K)

    dv = (dv == 'K') ? 10 : dv;

    dv = (dv == 0) ? 11 : dv;



    // Validar que el Cuerpo coincide con su D�gito Verificador

    if (dvEsperado != dv) {

        $("#e" + id).show();
        $("#guardar_dp").attr('disabled');

        $("#guardarArch").attr('disabled');
        // return error; 

    } else {

        $("#e" + id).hide();
        $("#guardar_dp").prop('disabled', false);

        $("#guardarArch").prop('disabled', false);

    }




    // Si todo sale bien, eliminar errores (decretar que es v�lido)

    rut.setCustomValidity('');

}

