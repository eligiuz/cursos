/*========================================
=            VALIDAR INGRESO            =
========================================*/
function validarIngreso() {

    var usuario = document.querySelector('#usuarioIngreso').value;
    
    var password = document.querySelector('#passwordIngreso').value;
    
    /* VALIDAR USUARIO */
    
    if (usuario != "") {

        var caracteres = usuario.length;
        var expresion = /^[a-zA-Z0-9]*$/;

        if (caracteres > 6) {

            document.querySelector("label[for='usuarioIngreso']").innerHTML += "<br>Escriba por favor menos de 6 caracteres.";

            return false;

        }

        if (!expresion.test(usuario)) {

            document.querySelector("label[for='usuarioIngreso']").innerHTML += "<br>Por favor, no escriba caracteres especiales.";

            return false;

        }

    }

    /* VALIDAR PASSWORD */
    

    if (password != "") {

        var caracteres = password.length;
        var expresion = /^[a-zA-Z0-9]*$/;

        if(caracteres < 6){

            document.querySelector("label[for='passwordIngreso']").innerHTML += "<br>Escriba por favor más de 6 caracteres.";

            return false;

        }

        if(!expresion.test(password)){

            document.querySelector("label[for='passwordIngreso']").innerHTML += "<br>Por favor, no escriba caracteres especiales.";

            return false;

        }

    }

return true;

}

/*=====  End of VALIDAR INGRESO  ======*/

