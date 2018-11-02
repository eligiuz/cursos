<h1>INGRESAR</h1>

	<form method="post" onsubmit="return validarIngreso()">
		
        <label for="usuarioIngreso">Usuario</label>
		<input type="text" placeholder="Máximo 6 caracteres" maxlength="6" name="usuarioIngreso" id="usuarioIngreso" required>
        
        <label for="usuarioIngreso">Usuario</label>
		<input type="password" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" name="passwordIngreso" id="passwordIngreso" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>

		<input type="submit" value="Enviar">

	</form>

    <?php 

    $ingreso = new MvcController;
    $ingreso->ingresoUsuarioController();

    if(isset($_GET["action"])){

        if($_GET["action"] == "fallo"){

            echo "Fallo al ingresar";

        }

        if($_GET["action"] == "fallo3intentos"){

            echo "Ha fallado 3 veces para ingresar, favor llenar el captcha";

        }

    }

     ?>
