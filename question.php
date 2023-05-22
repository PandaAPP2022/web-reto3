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
        <?php
        require_once('assets/php/header.php');
        ?>
        <main>
            <section id="quest">
                <button id="toggle"><a href="questions.php">Atrás</a></button>
                <article id="account" class="question">
                    <form id="form" action="assets/php/upload.php" method="post" enctype="multipart/form-data">
                        <h3>Editar pregunta</h3>
                        <label>
                            Imagen:
                            <img id="imagen" src="" alt="">
                            Cambiar imagen:
                            <input id="img" required type="file" name="fileToUpload" accept="image/png, image/jpeg">
                        </label>
                        <label>Pregunta:
                            <textarea id="pregunta" required placeholder="¿En que año...?" cols="50" rows="10"></textarea>
                        </label>
                        <label>Explicación:
                            <textarea id="explicacion" required placeholder="Durante los años xxxx y xxxx..." cols="50" rows="10"></textarea>
                        </label>
                        <label>Categoría:
                            <input id="categoria" required placeholder="informática" type="text">
                        </label>
                        <label>Dificultad:
                            <input id="dificultad" required type="number" min="1" max="3" placeholder="1">
                        </label>
                        <label style="place-self: unset; width: 100%;">
                            <p>Respuestas:</p>
                            <div id="respuestas">
                                <input id="res1" required type="text" placeholder="Respuesta 1">
                                <input id="res2" required type="text" placeholder="Respuesta 2">
                                <input id="res3" required type="text" placeholder="Respuesta 3">
                                <input id="res4" required type="text" placeholder="Respuesta 4">
                            </div>

                        </label>
                        <label>
                            Respuesta correcta:
                            <input id="correcta" required type="number" min="1" max="4" placeholder="1">
                        </label>
                            
                        <label>
                            <input class="button" type="submit" name="updateUser" value="Guardar">
                        </label>
                    </form>
                </article>
            </section>
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>