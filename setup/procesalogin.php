<?php

include("setup.php");

$sql="select * from usuarios where email='".$_POST['frmusuario']."' and password='".$_POST['frmpassword']."'";
$result=mysqli_query(conectar(),$sql);
$cont_login=mysqli_num_rows($result);
$datos=mysqli_fetch_array($result);

if($cont_login!=0)
{
    session_start();
    $_SESSION['nombre']=$datos['nombre'];
    header('Location:../index.php');
}else{
    header('Location:../index.php'); 
}

<<<<<<< Updated upstream
=======
$usuario_raw = isset($_POST['frmusuario']) ? trim($_POST['frmusuario']) : '';
$password_raw = isset($_POST['frmpassword']) ? trim($_POST['frmpassword']) : '';

// 1. Regla de validación de entrada en servidor:
// - Ambos campos obligatorios
// - Usuario con formato de correo válido y longitud máxima de 100 caracteres
// - Contraseña con longitud entre 1 y 64 caracteres
$email_valido = filter_var($usuario_raw, FILTER_VALIDATE_EMAIL);

if (
    $usuario_raw === '' ||
    $password_raw === '' ||
    $email_valido === false ||
    strlen($usuario_raw) > 100 ||
    strlen($password_raw) > 64
) {
    http_response_code(400);
    exit('Solicitud inválida: Debe ingresar un correo electrónico válido y una contraseña dentro del formato permitido.');
}

// 2. Control complementario: Consulta parametrizada para prevenir SQL Injection
// 2. Control complementario: Consulta parametrizada y verificación de Hash (Bcrypt)
$con = conectar();
mysqli_set_charset($con, 'utf8mb4'); // Cambiado a utf8mb4

$sql = "SELECT nombre, password FROM usuarios WHERE email = ? LIMIT 1";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $email_valido);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$datos = mysqli_fetch_array($result);

$id_redirect = isset($_SESSION['id']) ? (int)$_SESSION['id'] : 1;

// Verificar que el usuario exista y que la contraseña coincida con el hash Bcrypt
if ($datos && password_verify($password_raw, $datos['password'])) {
    $_SESSION['nombre'] = htmlspecialchars($datos['nombre'], ENT_QUOTES, 'UTF-8');
    header('Location: ../index.php?id=' . $id_redirect);
    exit();
} else {
    header('Location: ../index.php?id=' . $id_redirect . '&login=error');
    exit();
}
>>>>>>> Stashed changes
?>