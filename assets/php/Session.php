<?php

class Session {
    function __construct() {
        session_start();
    }

    function getState() {
        return isset($_SESSION['user']);
    }
    
    function create($id, $mail, $name, $surname) {
        $_SESSION['id'] = $id;
        echo $id;
        $_SESSION['mail'] = $mail;
        $_SESSION['user'] = $name;
        $_SESSION['surname'] = $surname;
        header('Location: ../../account.php#iniciado');
    }

    function destroy() {
        if ($this->getState()) {
            session_destroy();
            header('Location: ../../account.php#cerrado');
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