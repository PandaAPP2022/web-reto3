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
    <!-- ALERTAS -->
    <script src="assets/alertifyjs/alertify.min.js"></script>
    <link rel="stylesheet" href="assets/alertifyjs/css/alertify.min.css">
</head>
<body>
    <div id="wrapper">
        <?php
        require_once('assets/php/header.php');
        ?>
        <main>
            <section id="quest">
                <button onclick="toggle()" id="toggle">Atrás</button>
                <article id="account" class="question">
                    <div id="form">
                        <h3>Editar pregunta</h3>
                        <label>
                            Imagen:
                            <img id="image" src="" alt="">
                            Cambiar imagen:
                            <input id="nuevaImagen" onchange="uploadImage(this)" type="file" name="fileToUpload" accept="image/png, image/jpeg">
                        </label>
                        <label>Pregunta:
                            <textarea id="pregunta" placeholder="¿En que año...?" cols="50" rows="10"></textarea>
                        </label>
                        <label>Explicación:
                            <textarea id="explicacion" placeholder="Durante los años xxxx y xxxx..." cols="50" rows="10"></textarea>
                        </label>
                        <label>Categoría:
                            <input id="categoria" placeholder="esp" type="text">
                            <!--<select name="select">
                                <option value="Español">Español</option>
                                <option value="Ingles" selected>Ingles</option>
                            </select>-->
                        </label>
                        <label>Dificultad:
                            <input id="dificultad" type="number" min="1" max="3" placeholder="1">
                        </label>
                        <label style="place-self: unset; width: 100%;">
                            <p>Respuestas:</p>
                            <div id="respuestas">
                                <input class="res" type="text" placeholder="Respuesta 1">
                                <input id="2" class="res" type="text" placeholder="Respuesta 2">
                                <input class="res" type="text" placeholder="Respuesta 3">
                                <input class="res" type="text" placeholder="Respuesta 4">
                            </div>

                        </label>
                        <label>
                            Respuesta correcta:
                            <input id="correcta" required type="number" min="1" max="4" placeholder="1">
                        </label>
                            
                        <label>
                            <button id="send" onclick="updateQuestion()" class="button">Guardar</button>
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