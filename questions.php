<?php
/*
header('Access-Control-Allow-Methods: GET, POST, DELETE');
    // Indica los encabezados permitidos.
    header('Access-Control-Allow-Headers: Authorization');
    http_response_code(204);*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PanasApp</title>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/mongo.js"></script>
</head>
<body>
    
    
    <div id="wrapper">

        <?php require_once('assets/php/header.php'); ?>

        <main>
            <h3>PREGUNTAS</h3>

            <section class="list"></section>

        </main>

    </div>

</body>
</html>