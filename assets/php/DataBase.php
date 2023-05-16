<?php
/*
$mail = "ppaquensen@gmail.com";
$pass = "almi123";
$mail = "hola";
$pass = "hola";
*/
class DataBase {
  private $conn = null;
  
  function __construct() {
    $servername = "192.168.0.129";
    $username = "admin";
    $password = "Almi123";
    $db = "photoplay";
    
    try {
      $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  private function execute($sql, $data) {
    $query = $this->conn->prepare($sql);
    $query->execute($data);
    return $query->fetchAll();
  }

  function getRegistro($id) {
    $res = null;
    $sql = 'SELECT Puntuacion, Fecha FROM Registro WHERE idUsuario= ?';
    try {
      $res = $this->execute($sql, array($id));
      if (!$res) $res = 'ERROR: No se encontraron registros.';
    } catch (PDOExecption $e) {
      $res = 'ERROR: No hay registros.';
    }
    return $res;
  }

  /***** USUARIOS *****/
  function getUser($mail, $passwd) {
    $res = null;
    $sql = 'SELECT idUsuario, Nombre, Apellido, tipo, fecha FROM Usuario WHERE Email= ? AND Contraseña= ?';
    $data = array($mail, $passwd);
    try {
      $res = $this->execute($data);
      /*$query = $this->conn->prepare($sql);
      $query->execute(array($mail, $passwd));
      $res = $query->fetchAll();*/
      if (!$res) $res = "ERROR: Usuario no encontrado.";
    } catch(PDOException $e) {
      $res = "ERROR: ".$e->getMessage();
    }
    return $res;
  }
  function getUsers() {
    $sql = 'SELECT idUsuario, Nombre, Apellido, Email, tipo, fecha FROM Usuario';
    try {
      return $this->conn->query($sql, PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      return "ERROR:" . $e->getMessage();
    }
  }

  /***** USUARIOS: CREAR, EDITAR DATOS, EDITAR CONTRASEÑA, BORRAR *****/
  // CREAR
  function createUser($name, $surname, $passwd, $mail, $tipo, $fecha) {
    $sql = "INSERT INTO Usuario (Nombre, Apellido, Contraseña, Email, tipo, fecha) VALUES (?, ?, ?, ?, ?, ?)";
    $data = array($name, $surname, $passwd $mail, $tipo, $fecha);
    try {
      $res = $this->execute($data);
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }
  // EDITAR DATOS
  function updateUser($id, $name, $surname, $mail, $tipo, $fecha) {
    $sql = "UPDATE Usuario SET Nombre= ?, Apellido= ?, Email= ?, tipo= ?, fecha= ? WHERE idUsuario= ?";
    try {
      $query = $this->conn->prepare($sql);
      $query->execute(array($name, $surname, $mail, $tipo, $fecha, $id));
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
  // EDITAR CONTRASEÑA
  function updatePassword($id, $newPassword) {
    $sql = "UPDATE Usuario SET Contraseña= ? WHERE idUsuario= ?";
    $data = array($newPassword, $id);
    try {
      $query = $this->conn->prepare($sql);
      $query->execute($data);
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  // BORRAR
  function deleteUser($id, $passwd) {
    $sql = "DELETE FROM Usuario WHERE idUsuario= ? AND Contraseña= ?";
    try {
      $query = $this->conn->prepare($sql);
      $query->execute(array($id, $passwd));
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  // TIPO DE USUARIO
  function getTipo($tipo) {
    $res = null;
    if (is_string($tipo)) {
      $sql = "SELECT idTipo FROM TipoUsuario WHERE Denominacion= ?";
    } else {
      $sql = "SELECT Denominacion FROM TipoUsuario WHERE idTipo= ?";
    }
    
    try {
      $query = $this->conn->prepare($sql);
      $query->execute(array($tipo));
      $res = $query->fetch();
      if (!$res) $res = "ERROR: Tipo no encontrado.";
    } catch(PDOException $e) {
      $res = "ERROR: ".$e->getMessage();
    }
    return $res;
  }

  // CERRAR CONEXIÓN
  function close() {
    $conn = null;
  }
}
?>