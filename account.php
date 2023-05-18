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
                    <form action="assets/php/requests.php" method="post">
                        <label>
                            Nueva contraseña:
                            <input type="password" name="pass1">
                        </label>
                        <label>
                            Escribe de nuevo la contraseña:
                            <input type="password" name="pass2">
                        </label>
                        <input type="submit" name="updatePassword" value="Cambiar contraseña">
                        <input type="submit" name="logout" value="Cerrar sesión">
                    </form>
                </section>';
            } else {
                echo '
                <section>
                    <form action="assets/php/requests.php" method="post">
                        <label>Iniciar sesión</label>
                        <label>Correo:
                            <input type="email" name="mail" id="" value="ppaquensen@gmail.com">
                        </label>
                        <label>Contraseña:
                            <input type="password" name="pass" id="" value="almi123">
                        </label>
                        <label>
                            <input type="submit" name="login" value="Iniciar sesión">
                        </label>
                    </form>
                </section>
                <section>
                    <!--$name, $surname, $passwd, $mail, $tipo, $fecha-->
                    <form action="assets/php/requests.php" method="post">
                        <label>Registro</label>
                        <label>Nombre:
                            <input tupe="text" name="name" placeholder="Usuario">
                        </label>
                        <label>Apellido:
                            <input type="text" name="surname" placeholder="Apellido">
                        </label>
                        <label>Contraseña:
                            <input type="password" name="pass">
                        </label>
                        <label>Correo:
                            <input required type="email" name="mail" id="">
                        </label>
                        <label>Fecha de nacimiento:
                            <input required id="f" type="date" placeholder="dd-mm-yyyy" name="fecha">
                        </label>
                        <label>
                            <input type="submit" name="registro" value="Crear cuenta">
                        </label>
                    </form>
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