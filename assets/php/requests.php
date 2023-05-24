<?php
/*ERRORES*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Session.php');
$session = new Session();

require_once('DataBase.php');
$db = new DataBase();

if (isset($_POST['createUser'])) {
    $tipo = intval($_POST['tipo']);
    $pass = $_POST['pass'];
    if (!preg_match('~[0-9]+~', $pass)) {
        if ($tipo == 2) {
            header('Location: ../../user.php#passNeedsNum');
        } else {
            header('Location: ../../account.php#passNeedsNum');
        }
        die();
    }
    $res = $db->createUser($_POST['name'], $_POST['surname'], $pass, $_POST['mail'], $tipo, $_POST['fecha']);
    if ($res) {
        if ($tipo == 2) {
            header('Location: ../../users.php#usuarioCreado');
        }  else {
            header('Location: ../../account.php#usuarioCreado');
        }
    }
    die();
}

if (isset($_POST['login'])) {
    $pass = $_POST['pass'];
    $res = $db->getUser(null, $_POST['mail'], $pass);
    if (is_string($res)) header('Location: ../../account.php#datosIncorrectos');
    else {
        foreach ($res as $row) {
            $tipo = $db->getTipo(intval($row['tipo']))[0]['Denominacion'];
            $session->create($row['idUsuario'], $_POST['mail'], $row['Nombre'], $row['Apellido'], $tipo, $pass);
        }
    }
} else if ($session->getState()) {
    if (isset($_POST['logout'])) {
        $session->destroy();
    } else if (isset($_POST['updatePassword'])) {
        $oldPassword = $_POST['oldPassword'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        if (!preg_match('~[0-9]+~', $pass1)) {
            header('Location: ../../account.php#passNeedsNum');
            die();
        }
        
        if ($oldPassword != $_SESSION['passwd']) {
            header('Location: ../../account.php#oldPassError');
        } else if ($pass1 != $pass2) {
            header('Location: ../../account.php#contrasenasNoIguales');
        } else {
            $id = $session->getId();
            $updated = $db->updatePassword($id, $pass1);
            if ($updated) {
                $session->setPass($pass1);
                header('Location: ../../account.php#actualizado');
            } else {
                header('Location: ../../account.php#errorActualizando');
            }
        }

    } else if (isset($_POST['updateUser'])) {
        $id = $_SESSION['id'];
        if (isset($_POST['id'])) $id = $_POST['id'];
        
        $updated = $db->updateUser($id, $_POST['name'], $_POST['surname'], $_POST['mail'], $_POST['fecha']);
        if ($updated && !isset($_POST['id'])) header('Location: ../../account.php#actualizado'); 
        else if ($updated) header('Location: ../../user.php?id='.$id.'#actualizado');
        else header('Location: ../../account.php#errorActualizando');

    } else if (isset($_POST['deleteUser'])) {
        if (!isset($_POST['deleteSelf'])) {
            $deleted = $db->deleteUser($_POST['deleteUser']);
            if ($deleted) header('Location: ../../users.php#eliminado');
            else header('Location: ../../users.php#noEliminado');
        } else {
            $deleted = $db->deleteUser($_SESSION['id']);
            if ($deleted) header('Location: ../../index.php#eliminado');
            else header('Location: ../../account.php#noEliminado');
            $session->destroy();
        }
    }
} else {
    header('Location: ../../account.php#noIniciado');
}
?>