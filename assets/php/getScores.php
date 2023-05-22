<?php
require_once('DataBase.php');
$db = new DataBase();

session_start();
if ($_SESSION['tipo'] == 'usuario') {
    $res = $db->getScores();
    $data = array();
    foreach ($res as $row) {
        $data[] = array(
            'name' => $row['Nombre'],
            'surname' => $row['Apellido'],
            'score' => $row['Puntuacion'],
            'fecha' => $row['Fecha']
        );
    }
    echo json_encode(array('success' => 1, 'data' => $data));
} else {
    echo json_encode(array('success' => 0));
}
?>