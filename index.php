<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="assets/js/main.js"></script>
</head>
<body>
    
    <div id="wrapper">

        <?php require_once('assets/php/header.php'); ?>
        <main>
            <section>
                <article>
                    <h3>PannasApp ¡El Quizz Definitivo!</h3>
                    <p>TEXTO</p>
                    <img src="portada" alt="">
                    <button>DESCARGAR</button>
                </article>
                <article></article>
                <article></article>
                <article></article>
            </section>
            <?php
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
        </main>
        <footer>
            <p>Copyright</p>
        </footer>

    </div>

</body>
</html>