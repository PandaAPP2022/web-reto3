<?php
require_once('assets/php/DataBase.php');
require_once('assets/php/Session.php');

$session = new Session();




/*
$res = $db->getUser($mail, $pass);
if (is_string($res)) {
    echo $res;
} else {
    foreach ($res as $row) {
        echo '<br>';
        echo $row['idUsuario'] ."\t";
        print $row['Nombre'] . "\t";
        echo $row['Apellido'];
    }
}*/

?>