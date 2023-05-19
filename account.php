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
            <?php
            if ($session->getState()) {
                echo '
                <section>
                    <button id="toggle" onclick="toggleFormLogged(this)">Cambiar contraseña</button>
                    <article id="account">
                        <form action="assets/php/requests.php" method="post">
                            <h3>Editar información</h3>
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
                                <input class="button" type="submit" name="registro" value="Crear cuenta">
                            </label>
                        </form>
                    </article>
                    <article id="password">
                        <form action="assets/php/requests.php" method="post">
                            <h3>Cambiar contraseña</h3>
                            <label>
                                Nueva contraseña:
                                <input required type="password" name="pass1">
                            </label>
                            <label>
                                Escribe de nuevo:
                                <input required type="password" name="pass2">
                            </label>
                            <input id="passButton" class="button" type="button" value="Cambiar contraseña">
                            <input id="updatePassword" type="submit" name="updatePassword">
                            <input id="oldPassword" type="hidden" name="oldPassword">
                        </form>
                    </article>
                </section>';
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
                                <input placeholder="usuario@gmail.com" required type="email" name="mail" id="">
                            </label>
                            <label>Fecha de nacimiento:
                                <input required id="f" type="date" placeholder="dd-mm-yyyy" name="fecha">
                            </label>
                            <label>
                                <input class="button" type="submit" name="registro" value="Crear cuenta">
                            </label>
                        </form>
                    </article>
                </section>';
            }
            ?>
            <script>/*
                asd = () => {
                    int d1 = 365;
                    int d2 = 365;
                    var d = 0;
                    switch
                        case 1:
                            d += d2+d1*3; // 4
                            d += d2+d1*3; // 8
                            d += d2+d1*3; // 12
                            d += d2+d1*3; // 16
                            d += d2+d1; // 18
                            // 5
                            ;;
                        case 2:
                            d += d1+d2+d1*2; // 4
                            d += d1+d2+d1*2; // 8
                            d += d1+d2+d1*2; // 12
                            d += d1+d2+d1*2; // 16
                            d += d1+d2; // 18
                            ;;
                        case 3:
                            d += d1*2+d2+d1; //4
                            d += d1*2+d2+d1; //8
                            d += d1*2+d2+d1; //12
                            d += d1*2+d2+d1; //16
                            d += d1*2; //18
                            ;;
                        case 4:
                            ;;
                }*/
            </script>
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>