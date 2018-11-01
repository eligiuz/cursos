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

				$datosController = array("usuario"=>$_POST["usuarioRegistro"],
					"password"=>$_POST["passwordRegistro"],
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

				$datosController = array("usuario"=>$_POST["usuarioIngreso"],
					"password"=>$_POST["passwordIngreso"]
					);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

				if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

					session_start();

					$_SESSION["validar"] = true;

					header("location:index.php?action=usuarios");

				}

				else{

					header("location:index.php?action=fallo");

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

				$datosController = array("id"=>$_POST["idEditar"],"usuario"=>$_POST["usuarioEditar"],"password"=>$_POST["passwordEditar"],"email"=>$_POST["emailEditar"]);

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
