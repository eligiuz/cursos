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

	/*=====  End of REGISTRO DE USUARIO  ======*/

	/*==========================================
	=            INGRESO DE USUARIO            =
	==========================================*/
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

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
			<input type="text" value="'. $respuesta["usuario"].'" placeholder="Usuario" name="usuarioEditar" required>

			<input type="text" value="'. $respuesta["password"].'" placeholder="Contraseña" name="passwordEditar" required>

			<input type="email" value="'. $respuesta["email"].'" placeholder="Email" name="emailEditar" required>

			<input type="submit" value="Actualizar">';

	}
	
	
	/*=====  End of EDITAR USUARIO  ======*/
	
	/*==========================================
	=            ACTUALIZAR USUARIO            =
	==========================================*/
	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

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
