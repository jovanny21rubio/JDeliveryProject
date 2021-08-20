<?php
 // Permite acceder a las variables de sesion
 session_start();
include_once("../class/class-motoristas.php");
header("Content-Type: application/json");

switch ($_SERVER['REQUEST_METHOD']) {  
    case 'POST': //insertar un usuario
        $_POST = json_decode(file_get_contents('php://input'),true);
        $motorista = new Motoristas($_POST['Nombre'],$_POST['Apellido'],$_POST['NombreUsuario'],$_POST['imagen'],$_POST['Correo'],$_POST['Contrasena']);
        $motorista->registrarMotorista(); 
       $resultado["mensaje"]="Guadar usuario, informacion" . json_encode($_POST);
       echo json_encode($resultado);
        break;
       case 'GET':
        if (isset($_GET['id'])) {
            Motoristas::obtenerMotorista($_GET['id']);
        
        }else if(isset($_GET["Correo"])|| isset($_GET["Contrasena"])){
         $resultadoFinal= Motoristas::validarInicioSesion($_GET["Correo"],$_GET["Contrasena"]);
         if($resultadoFinal["Resultado"]!=0){
            $_SESSION["Motorista_Nombre"]= $resultadoFinal["Nombre"];
            $_SESSION["Motorista_Apellido"]= $resultadoFinal["Apellido"]; 
            $_SESSION["Motorista_Correo"]= $resultadoFinal["Correo"];
            $_SESSION["Motorista_Contrasena"]=$resultadoFinal["Contrasena"];
            echo $resultadoFinal["Resultado"];
         }else{
             echo $resultadoFinal["Resultado"];
         }
        }
          else{
             Motoristas::obtenerMotoristas();
        }
          break;
        case 'PUT': 
        

   
        break;
    
        case 'DELETE' :
        
        break;
}