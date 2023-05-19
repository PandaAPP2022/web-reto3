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
</head>
<body>
    
    <div id="wrapper">

        <?php require_once('assets/php/header.php'); ?>

        <main>

            <section class="users">
                <?php
                require_once('assets/php/DataBase.php');
                $bd = new DataBase();

                function asd($bd) {
                    $res = $bd->getUsers();
                    foreach ($res as $row) {
                        $tipo = $bd->getTipo(intval($row['tipo']))[0]['Denominacion'];
                        echo '
                        <article class="user">
                            <h3>'. $row['Nombre'] ." ". $row['Apellido'] . "</h3>
                            <p>". $row['Email'] . "</p>
                            <span class='tipo'>". $tipo . '</span>
                        </article>';
                    }                    
                }
                
                $res = $bd->getUsers();
                if (is_string($res)) {
                    echo $res;
                } else {
                    foreach ($res as $row) {
                        $tipo = $bd->getTipo(intval($row['tipo']))[0]['Denominacion'];
                        echo '
                        <article class="user">
                            <h3>'. $row['Nombre'] ." ". $row['Apellido'] . "</h3>
                            <p>". $row['Email'] . "</p>
                            <span class='tipo'>". $tipo . '</span>
                        </article>';
                    }
                    asd($bd);
                    asd($bd);
                    asd($bd);
                    
                }
                ?>
            </section>
        </main>

    </div>

</body>
</html>