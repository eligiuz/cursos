<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}

	/*===========================================
	=            REGISTRO DE USUARIO            =
	===========================================*/
	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])){

		/* preg_match => Realiza una comparación con una expresión regular */
		
			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioRegistro"]) && preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordRegistro"]) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRegistro"])){

				/* crypt() devolverá el hash de un string utilizando el algoritmo estándar basado en DES de Unix o algoritmos alternativos que puedan estar disponibles en el sistema. */
				
				$encriptar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("usuario"=>$_POST["usuarioRegistro"],
					"password"=>$encriptar,
					"email"=>$_POST["emailRegistro"]
					);

				$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

				if($respuesta == "success"){

					header("location:index.php?action=ok");

				}

				else{

					header("location:index.php");

				}

			}

		}

	}

	/*=====  End of REGISTRO DE USUARIO  ======*/

	/*==========================================
	=            INGRESO DE USUARIO            =
	==========================================*/
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioIngreso"]) && preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordIngreso"])){

				$encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("usuario"=>$_POST["usuarioIngreso"],
					"password"=>$encriptar);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

				$intentos = $respuesta["intentos"];
				$usuario = $_POST["usuarioIngreso"];
				$maximoIntentos = 3;

				if($intentos < $maximoIntentos){

					if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $encriptar){

						session_start();

						$_SESSION["validar"] = true;

						$intentos = 0;

						$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);

						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");

						header("location:index.php?action=usuarios");

					}

					else{

						++$intentos;

						$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);

						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");

						header("location:index.php?action=fallo");

					}

				}

				else{

					$intentos = 0;

					$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);

					$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");

					header("location:index.php?action=fallo3intentos");

				}

			}	

		}

	}
	
	/*=====  End of INGRESO DE USUARIO  ======*/
	
	/*==========================================
	=            VISTAS DE USUARIOS            =
	==========================================*/
	public function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("usuarios");

		foreach ($respuesta as $row => $item) {
			echo '<tr>
				<td>'.$item["usuario"].'</td>
				<td>'.$item["password"].'</td>
				<td>'.$item["email"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';
		}

	}

	/*=====  End of VISTAS DE USUARIOS  ======*/

	/*======================================
	=            EDITAR USUARIO            =
	======================================*/
	
	public function editarUsuarioController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");
		echo '<input type="hidden" value="'. $respuesta["id"].'" name="idEditar">

			<label for="usuarioEditar">Usuario</label>
			<input type="text" value="'. $respuesta["usuario"].'" placeholder="Máximo 6 caracteres" maxlength="6" name="usuarioEditar" id="usuarioEditar" required>
			
			<label for="passwordEditar">Contraseña</label>
			<input type="text" value="'. $respuesta["password"].'" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" name="passwordEditar" id="passwordEditar" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>

			<label for="emailEditar">Correo electrónico</label>
			<input type="email" value="'. $respuesta["email"].'" placeholder="Escriba su correo electrónico correctamente" name="emailEditar" id="emailEditar" required>

			<input type="submit" value="Actualizar">';

	}
	
	
	/*=====  End of EDITAR USUARIO  ======*/
	
	/*==========================================
	=            ACTUALIZAR USUARIO            =
	==========================================*/
	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioEditar"]) && preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordEditar"]) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailEditar"])){

				$encriptar = crypt($_POST["passwordEditar"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("id"=>$_POST["idEditar"],"usuario"=>$_POST["usuarioEditar"],"password"=>$encriptar,"email"=>$_POST["emailEditar"]);

				$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

				if($respuesta == "success"){

					header("location:index.php?action=cambio");

				}

				else{

					echo "error";

				}

			}

		}

	}
	
	
	/*=====  End of ACTUALIZAR USUARIO  ======*/

	/*======================================
	=            BORRAR USUARIO            =
	======================================*/
	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=usuarios");

			}

		}

	}
	
	
	/*=====  End of BORRAR USUARIO  ======*/
	
	
}

?>
