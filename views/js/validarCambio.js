/*========================================
=            VALIDAR CAMBIO           =
========================================*/
function validarCambio() {

    var usuario = document.querySelector('#usuarioEditar').value;
    
    var password = document.querySelector('#passwordEditar').value;
    
    var email = document.querySelector('#emailEditar').value;
    
    /* VALIDAR USUARIO */
    
    if(usuario != ""){

        var caracteres = usuario.length;
        var expresion = /^[a-zA-Z0-9]*$/;

        if(caracteres > 6){

            document.querySelector("label[for='usuarioEditar']").innerHTML += "<br>Escriba por favor menos de 6 caracteres.";

            return false;

        }

        if(!expresion.test(usuario)){

            document.querySelector("label[for='usuarioEditar']").innerHTML += "<br>Por favor, no escriba caracteres especiales.";

            return false;

        }

    }

    /* VALIDAR PASSWORD */
    

    if(password != ""){

        var caracteres = password.length;
        var expresion = /^[a-zA-Z0-9]*$/;

        if(caracteres < 6){

            document.querySelector("label[for='passwordEditar']").innerHTML += "<br>Escriba por favor más de 6 caracteres.";

            return false;

        }

        if(!expresion.test(password)){

            document.querySelector("label[for='passwordEditar']").innerHTML += "<br>Por favor, no escriba caracteres especiales.";

            return false;

        }

    }

/* VALIDAR EMAIL */
    

    if(email != ""){

        var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

        if(!expresion.test(email)){

            document.querySelector("label[for='emaildEditar']").innerHTML += "<br>Por favor, excriba correctamente el email.";

            return false;

        }

    }

return true;

}

/*=====  End of VALIDAR CAMBIO  ======*/

