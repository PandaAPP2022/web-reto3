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
    <!-- ALERTAS -->
    <script src="assets/alertifyjs/alertify.min.js"></script>
    <link rel="stylesheet" href="assets/alertifyjs/css/alertify.min.css">
</head>
<body>
    <div id="wrapper">
        <?php require_once('assets/php/header.php'); ?>
        <main>
            <?php
            if ($session->getState()) {
                require_once('assets/php/DataBase.php');
                $db = new DataBase();
                $res = $db->getUser($_SESSION['id'], null, null);
                $remove = '<button id="deleteSelf" onclick="deleteSelf()">Eliminar cuenta</button>';
                if ($session->getTipo() == "gerente") $remove = '';
                foreach ($res as $row) {
                echo '
                <section>'.$remove.'
                    <button id="toggle" onclick="toggleFormLogged(this)">Cambiar contraseña</button>
                    <article id="account">
                        <form action="assets/php/requests.php" method="post">
                            <h3>Editar información</h3>
                            <label>Nombre:
                                <input value="'.$row['Nombre'].'" required type="text" name="name" placeholder="Usuario">
                            </label>
                            <label>Apellido:
                                <input value="'.$row['Apellido'].'" required type="text" name="surname" placeholder="Apellido">
                            </label>
                            <label>Correo:
                                <input value="'.$row['Email'].'" required placeholder="usuario@gmail.com" type="email" name="mail">
                            </label>
                            <label>Fecha de nacimiento:
                                <input value="'.$row['fecha'].'" required id="f" type="date" placeholder="dd-mm-yyyy" name="fecha">
                            </label>
                            <label>
                                <input class="button" type="submit" name="updateUser" value="Guardar">
                            </label>
                        </form>
                    </article>
                    <article id="password">
                        <form id="passForm" action="assets/php/requests.php" method="post">
                            <h3>Cambiar contraseña</h3>
                            <label>
                                Nueva contraseña:
                                <input id="pass1" required type="password" name="pass1">
                            </label>
                            <label>
                                Escribe de nuevo:
                                <input id="pass2" required type="password" name="pass2">
                            </label>
                            <input id="passButton" class="button" type="button" value="Cambiar contraseña">
                            <input id="oldPassword" type="hidden" name="oldPassword">
                        </form>
                    </article>
                </section>';
                }
            } else {
                echo '
                <section>
                    <button id="toggle" onclick="toggleForm(this)">Registrarse</button>
                    <article id="login">
                        <form action="assets/php/requests.php" method="post">
                            <h3>Iniciar sesión</h3>
                            <label>Correo:
                                <input type="email" name="mail" value="ppaquensen@gmail.com">
                            </label>
                            <label>Contraseña:
                                <input type="password" name="pass" value="almi123">
                            </label>
                            <label>
                                <input class="button" type="submit" name="login" value="Iniciar">
                            </label>
                        </form>
                    </article>
                    <article id="singup">
                        <!--$name, $surname, $passwd, $mail, $tipo, $fecha-->
                        <form action="assets/php/requests.php" method="post">
                            <h3>Registro</h3>
                            <input type="hidden" name="tipo" value="1">
                            <label>Nombre:
                                <input tupe="text" name="name" placeholder="Usuario">
                            </label>
                            <label>Apellido:
                                <input type="text" name="surname" placeholder="Apellido">
                            </label>
                            <label>Contraseña:
                                <input placeholder="myAwesomePassword" type="password" name="pass">
                            </label>
                            <label>Correo:
                                <input placeholder="usuario@gmail.com" required type="email" name="mail">
                            </label>
                            <label>Fecha de nacimiento:
                                <input required id="f" type="date" placeholder="dd-mm-yyyy" name="fecha">
                            </label>
                            <label>
                                <input class="button" type="submit" name="createUser" value="Crear cuenta">
                            </label>
                        </form>
                    </article>
                </section>';
            }
            ?>
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>