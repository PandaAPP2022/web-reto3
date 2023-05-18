<?php
/* ERRORES */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Session.php');

$session = new Session();
$state = $session->getState();

function userAllowed($user)
{
    $url = $_SERVER['REQUEST_URI'];

    if ($user == 'gerente') {
        if (strpos($url, 'scores')) header('Location: index.php?missing');
    } else if ($user == 'administrador') {
        if (strpos($url, 'users') || strpos($url, 'scores')) header('Location: index.php?missing');
    } else if ($user == 'usuario') {
        if (strpos($url, 'users') || strpos($url, 'questions')) header('Location: index.php?missing');
    } else {
        if (strpos($url, 'users') || strpos($url, 'questions') || strpos($url, 'scores')) header('Location: index.php?missing');
    }
}

function getHeader($tipo) {
    $header = '<img class="header-display" src="assets/img/menu.svg">
    <header class="header">
    <img class="icon"> <a href="index.php">Inicio</a>';
    if ($tipo == 'gerente') {
        $header .= '<a href="users.php">Usuarios</a>';
        $header .= '<a href="questions.php">Preguntas</a>';
    } else if ($tipo == 'administrador') {
        $header .= '<a href="questions.php">Preguntas</a>';
    } else if ($tipo == 'usuario') {
        $header .= '<a href="scores.php">Puntuaciones</a>';
    }
    
    echo $header .= '<a href="account.php">Cuenta</a></header>';
}

$tipo = $state ? $session->getTipo() : 'none';
//$tipo = 'none';
//if ($state) $tipo = $session->getTipo();

userAllowed($tipo);
getHeader($tipo);

?>