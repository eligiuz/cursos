/*========================================
=            VALIDAR REGISTRO            =
========================================*/
function validarRegistro() {

    var usuario = document.querySelector('#usuarioRegistro').value;
    
    var password = document.querySelector('#passwordRegistro').value;
    
    var email = document.querySelector('#emailRegistro').value;

    var terminos = document.querySelector('#terminos').checked;
    
    /* VALIDAR USUARIO */
    
    if(usuario != ""){

        var caracteres = usuario.length;
        var expresion = /^[a-zA-Z0-9]*$/;

        if(caracteres > 6){

            document.querySelector("label[for='usuarioRegistro']").innerHTML += "<br>Escriba por favor menos de 6 caracteres.";

            return false;

        }

        if(!expresion.test(usuario)){

            document.querySelector("label[for='usuarioRegistro']").innerHTML += "<br>Por favor, no escriba caracteres especiales.";

            return false;

        }

    }

    /* VALIDAR PASSWORD */
    

    if(password != ""){

        var caracteres = password.length;
        var expresion = /^[a-zA-Z0-9]*$/;

        if(caracteres < 6){

            document.querySelector("label[for='passwordRegistro']").innerHTML += "<br>Escriba por favor más de 6 caracteres.";

            return false;

        }

        if(!expresion.test(password)){

            document.querySelector("label[for='passwordRegistro']").innerHTML += "<br>Por favor, no escriba caracteres especiales.";

            return false;

        }

    }

/* VALIDAR EMAIL */
    

    if(email != ""){

        var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

        if(!expresion.test(email)){

            document.querySelector("label[for='emaildRegistro']").innerHTML += "<br>Por favor, excriba correctamente el email.";

            return false;

        }

    }

    /* VALIDAR TERMINOS */

    if(!terminos){

        document.querySelector("form").innerHTML += "<br>No se logró el registro, acepte términos y condiciones.";

        document.querySelector('#usuarioRegistro').value = usuario;
        document.querySelector('#passwordRegistro').value = password;
        document.querySelector('#emailRegistro').value = email;

        return false;

    }
    

return true;

}

/*=====  End of VALIDAR REGISTRO  ======*/

