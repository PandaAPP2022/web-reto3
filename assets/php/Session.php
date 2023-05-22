<?php

class Session {
    function __construct() {
        session_start();
    }

    function getState() {
        return isset($_SESSION['user']);
    }
    function getTipo() {
        return $_SESSION['tipo'];
    }
    function setPass($new) {
        $_SESSION['passwd'] = $new;
    }
    
    function create($id, $mail, $name, $surname, $tipo, $passwd) {
        $_SESSION['id'] = $id;
        $_SESSION['mail'] = $mail;
        $_SESSION['user'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['tipo'] = $tipo;
        $_SESSION['passwd'] = $passwd;
        if ($tipo == 'gerente') header('Location: ../../users.php');
        else if ($tipo == 'administrador') header('Location: ../../questions.php');
        else if ($tipo == 'usuario') header('Location: ../../scores.php');
    }

    function destroy() {
        if ($this->getState()) {
            session_destroy();
            header('Location: ../../index.php#cerrado');
        } else {
            header('Location: ../../account.php#noiniciado');
        }
    }

    function getId() {
        return $_SESSION['id'];
    }
    function getUser() {
        return $_SESSION['user'];
    }
}
?>