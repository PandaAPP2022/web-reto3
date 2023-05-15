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
        <header>
        </header>
        <main>
            <?php
            require_once('assets/php/Session.php');
            $session = new Session();
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
                </section>';
            }
            ?>
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>