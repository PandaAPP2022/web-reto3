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
            <section>
                <button id="toggle"><a href="users.php">Atrás</a></button>
                <article id="account">
                    <form action="assets/php/requests.php" method="post">
                        <?php

                        if (isset($_GET['id'])) {
                            require_once('assets/php/DataBase.php');
                            $db = new DataBase();
                            $res = $db->getUser($_GET['id'], null, null);

                            echo "<h3>Editar información</h3>
                            <input type='hidden' name='id' value=".$_GET["id"].">";
                            foreach ($res as $row) {
                                echo '
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
                                </label>';
                            }
                        } else {
                            echo '<h3>Datos del usuario</h3>
                                <input type="hidden" name="tipo" value="2">
                                <label>Nombre:
                                    <input required type="text" name="name" placeholder="Usuario">
                                </label>
                                <label>Apellido:
                                    <input required type="text" name="surname" placeholder="Apellido">
                                </label>
                                <label>Contraseña:
                                    <input placeholder="myAwesomePassword" type="password" name="pass">
                                </label>
                                <label>Correo:
                                    <input required placeholder="usuario@gmail.com" type="email" name="mail">
                                </label>
                                <label>Fecha de nacimiento:
                                    <input required id="f" type="date" placeholder="dd-mm-yyyy" name="fecha">
                                </label>
                                <label>
                                    <input class="button" type="submit" name="createUser" value="Crear">
                                </label>';
                        }

                    
                    ?>
                        
                    </form>
                </article>
            </section>
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>