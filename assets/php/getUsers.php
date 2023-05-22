<?php
require_once('DataBase.php');
$db = new DataBase();

session_start();
if ($_SESSION['tipo'] == 'gerente') {
    $input = $_POST['input'].'%';
    $res = $db->getFilteredUsers($input);
    $data = array();
    foreach ($res as $row) {
        $data[] = array(
            'id' => $row['idUsuario'],
            'name' => $row['Nombre'],
            'surname' => $row['Apellido'],
            'mail' => $row['Email'],
            'tipo' => $db->getTipo(intval($row['tipo']))[0]['Denominacion']
        );
    }
    echo json_encode(array('success' => 1, 'data' => $data));
} else {
    echo json_encode(array('success' => 0));
}

?>