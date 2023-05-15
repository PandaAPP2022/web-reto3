<?php
require_once('assets/php/Session.php');
$session = new Session();

require_once('assets/php/DataBase.php');
$bd = new DataBase();

$res = $bd->getUsers();
if (is_string($res)) {
    echo $res;
} else {
    foreach ($res as $row) {
        echo '<br>';
        echo $row['idUsuario'] ."\t";
        echo $row['Nombre'] . "\t";
        echo $row['Apellido'] . "\t";
        echo $row['Email'] . "\t";
        $tipo = $bd->getTipo($row['tipo']);
        echo $tipo['Denominacion'] . "\t";
        echo $row['fecha'];
    }
}

?>