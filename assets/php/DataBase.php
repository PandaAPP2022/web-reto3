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
    $servername = "192.168.0.129"; // CLASE
    //$servername = "192.168.1.137"; // CASA
    $username = "admin";
    $password = "Almi123"; // CLASE
    //$password = "Almi123+"; // CASA
    $db = "photoplay";
    
    try {
      $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    $data = array($id);
    try {
      $res = $this->execute($sql, $data);
      if (!$res) $res = 'ERROR: No se encontraron registros.';
    } catch (PDOExecption $e) {
      $res = 'ERROR: No hay registros.';
    }
    return $res;
  }

  /***** USUARIOS *****/
  function getUser($id, $mail, $passwd) {
    $res = null;
    $sql = 'SELECT idUsuario, Nombre, Apellido, tipo, fecha FROM Usuario WHERE Email= ? AND Contraseña= ?';
    $data = array($mail, $passwd);
    if ($id != null) {
      $sql = 'SELECT idUsuario, Nombre, Apellido, Email, tipo, fecha FROM Usuario WHERE idUsuario= ?';
      $data = array($id);
    }
    try {
      $res = $this->execute($sql, $data);
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

  function getFilteredUsers($input) {
    $sql = 'SELECT idUsuario, Nombre, Apellido, Email, tipo, fecha FROM Usuario';
    $data = null;
    if ($input != "") {
      
      $tipo = 0;
      if ($input == 'gerente%') $tipo = 1;
      else if ($input == 'administrador%') $tipo = 2;
      else if ($input == 'usuario%') $tipo = 3;
      
      if ($tipo == 0) {
        $sql = 'SELECT idUsuario, Nombre, Apellido, Email, tipo, fecha FROM Usuario WHERE Nombre LIKE ? OR Apellido LIKE ? OR Email LIKE ?';
        $data = array($input, $input, $input);
      } else {
        $sql = 'SELECT idUsuario, Nombre, Apellido, Email, tipo, fecha FROM Usuario WHERE Nombre LIKE ? OR Apellido LIKE ? OR Email LIKE ? OR tipo LIKE ?';
        $data = array($input, $input, $input, $tipo);
      }
    }
    try {
        return $this->execute($sql, $data);
    } catch(PDOException $e) {
      return "ERROR:" . $e->getMessage();
    }
  }

  /***** USUARIOS: CREAR, EDITAR DATOS, EDITAR CONTRASEÑA, BORRAR *****/
  // CREAR
  function createUser($name, $surname, $passwd, $mail, $tipo, $fecha) {
    $sql = "INSERT INTO Usuario (Nombre, Apellido, Contraseña, Email, tipo, fecha) VALUES (?, ?, ?, ?, ?, ?)";
    $data = array($name, $surname, $passwd, $mail, $tipo, $fecha);
    try {
      $query = $this->conn->prepare($sql);
      $query->execute($data);
      return true;
    } catch(PDOException $e) {
      return $e;
    }
  }
  // EDITAR DATOS
  function updateUser($id, $name, $surname, $mail, $fecha) {
    $sql = "UPDATE Usuario SET Nombre= ?, Apellido= ?, Email= ?, fecha= ? WHERE idUsuario= ?";
    try {
      $query = $this->conn->prepare($sql);
      $query->execute(array($name, $surname, $mail, $fecha, $id));
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
      $this->execute($sql, $data);
    } catch(PDOException $e) {
    }
    return true;
  }

  // BORRAR
  function deleteUserScores($id) {
    $sql = "DELETE FROM Registro WHERE idUsuario= ?";
    $data = array(intval($id));
    try {
      $query = $this->conn->prepare($sql);
      $query->execute($data);
      return true;
    } catch (PDOException $e) {
      return $e;
    }
  }

  function deleteUser($id) {
    $this->deleteUserScores($id);
    $sql = "DELETE FROM Usuario WHERE idUsuario= ?";
    $data = array($id);
    try {
      $query = $this->conn->prepare($sql);
      $query->execute($data);
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }


  // TIPO DE USUARIO
  function getTipo($tipo) {
    $res = null;
    $sql = null;
    if (is_string($tipo)) {
      $sql = "SELECT idTipo FROM TipoUsuario WHERE Denominacion= ?";
    } else {
      $sql = "SELECT Denominacion FROM TipoUsuario WHERE idTipo= ?";
    }
    $data = array($tipo);
    try {
      $res = $this->execute($sql, $data);
      if (!$res) $res = "ERROR: Tipo no encontrado.";
    } catch(PDOException $e) {
      $res = "ERROR: ".$e->getMessage();
    }
    return $res;
  }

  /***** PUNTUACIONES *****/
  function getScores() {
    $sql = 'SELECT Usuario.idUsuario, Usuario.Nombre, Usuario.Apellido, Registro.Puntuacion, Registro.Fecha
        FROM Usuario
        INNER JOIN Registro ON Usuario.idUsuario = Registro.idUsuario
        ORDER BY Registro.Puntuacion DESC';
    try {
      return $this->conn->query($sql, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return "ERROR: ".$e->getMessage();
    }
  }


  // CERRAR CONEXIÓN
  function close() {
    $conn = null;
  }
}
?>