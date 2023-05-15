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
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  /***** USUARIOS *****/
  function getUser($mail, $passwd) {
    $res = null;
    $sql = 'SELECT idUsuario, Nombre, Apellido, tipo, fecha FROM Usuario WHERE Email= ? AND Contraseña= ?';
    
    try {
      $query = $this->conn->prepare($sql);
      $query->execute(array($mail, $passwd));
      //$query->execute();
      $res = $query->fetchAll();
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
  

  /***** CAMBIAR CONTRASEÑA *****/
  function updatePassword($id, $newPassword) {
    $sql = "UPDATE Usuario SET Contraseña= ? WHERE idUsuario= ?";
    try {
      $query = $this->conn->prepare($sql);
      $query->execute(array($newPassword, $id));
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  function getTipo($tipo) {
    $res = null;
    $sql = "SELECT Denominacion FROM TipoUsuario WHERE idTipo='$tipo'";
    try {
      $query = $this->conn->prepare($sql);
      $query->execute();
      $res = $query->fetch();
      if (!$res) $res = "ERROR: Tipo no encontrado.";
    } catch(PDOException $e) {
      $res = "ERROR: ".$e->getMessage();
    }
    return $res;
  }

  
  function close() {
    $conn = null;
  }
}



?>