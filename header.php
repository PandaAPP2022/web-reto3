<?php
/*ERRORES*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('assets/php/Session.php');
$session = new Session();
$state = $session->getState();
$header = '<header><a href="index.php">Inicio</a>';
if ($state) {
    $tipo = $session->getTipo();

    if ($tipo == 'gerente') {
        $header .= '<a href="users.php">Usuarios</a>';
        $header .= '<a href="questions.php">Preguntas</a>';
    } else if ($tipo == 'administrador') {
        $header .= '<a href="questions.php">Preguntas</a>';
    } else if ($tipo == 'usuario') {
        $header .= '<a href="scores.php">Puntuaciones</a>';
    }
}
$header .= '<a href="account.php">Cuenta</a></header>';
echo $header;
?>