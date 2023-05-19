<?php
/*ERRORES*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Session.php');
$session = new Session();

require_once('DataBase.php');
$db = new DataBase();

if (isset($_POST['login'])) {
    $pass = $_POST['pass'];
    $res = $db->getUser($_POST['mail'], $pass);
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

        if ($oldPassword != $_SESSION['passwd']) {
            //header('Location: ../../account.php#oldPassError');
        } else {
        }
        //echo $oldPassword;
        echo $_SESSION['passwd'];
        die();
        if (true == false) {
            $newPassword = $_POST['pass1'];
            $newPassword2 = $_POST['pass2'];
            if (strlen($newPassword) < 1) {
                header('Location: ../../account.php#faltaNuevaContraseña');
            } else if ($newPassword != $newPassword2) {
                header('Location: ../../account.php#contraseñasNoIguales');
            } else {
                $id = $session->getId();
                $updated = $db->updatePassword($id, $newPassword);
                if ($updated) {
                    header('Location: ../../account.php#actualizado');
                } else {
                    header('Location: ../../account.php#errorActualizando');
                }
            }
        }

    }
} else {
    header('Location: ../../account.php#noIniciado');
}



?>