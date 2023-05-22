<?php
/* ERRORES */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Session.php');

$session = new Session();
$state = $session->getState();

function userAllowed($user) {

    $url = $_SERVER['REQUEST_URI'];

    if ($user == 'gerente') {
        if (strpos($url, 'scores')) header('Location: index.php?missing');
    } else if ($user == 'administrador') {
        if (strpos($url, 'user') || strpos($url, 'scores')) header('Location: index.php?missing');
    } else if ($user == 'usuario') {
        if (strpos($url, 'user') || strpos($url, 'question')) header('Location: index.php?missing');
    } else {
        if (strpos($url, 'user') || strpos($url, 'question') || strpos($url, 'scores')) header('Location: index.php?missing');
    }
}

function getHeader($tipo) {
    $header = '<img class="header-display" src="assets/img/logo.png">
    <header class="header">
        <img class="icon" src="assets/img/logo.png">
        <div class="headerContainer">
            <button><a href="index.php">Inicio</a></button>';
    if ($tipo == 'gerente') {
        $header .= '<button><a href="users.php">Usuarios</a></button>';
        $header .= '<button><a href="questions.php">Preguntas</a></button>';
    } else if ($tipo == 'administrador') {
        $header .= '<button><a href="questions.php">Preguntas</a></button>';
    } else if ($tipo == 'usuario') {
        $header .= '<button><a href="scores.php">Puntuaciones</a></button>';
    }
    
    $header .= '<button><a href="account.php">Cuenta</a></button>';
    if ($tipo != 'none') $header .= '<button onclick="logout()"><a href="#logOut">Cerrar sesión</a></button>';
    echo $header .= '</div></header>';
}
function userLogOut($tipo) {
    if ($tipo != 'none') {
        echo '
        <form style="display: none;" action="assets/php/requests.php" method="post">
            <input id="logout" type="submit" name="logout">
        </form>';
    }
}

$tipo = $state ? $session->getTipo() : 'none';

userAllowed($tipo);
getHeader($tipo);
userLogOut($tipo);


?>