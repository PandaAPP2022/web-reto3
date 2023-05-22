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

        <main class='ctn'>

            <aside>
                <h3>Búsqueda:</h3>
                <input id="nombre" placeholder="gerente" type="text" name="" id="">
            </aside>

            <section class="list"></section>

            <form id="delete" action="assets/php/requests.php" method="post">
                <input id="btnDelete"  type="submit" name="deleteUser">
            </form>
            
            <script type="text/javascript">
                $('#nombre').keyup(function(e) { requestUsers(this.value) } );
                requestUsers("");
            </script>
        </main>

    </div>

</body>
</html>