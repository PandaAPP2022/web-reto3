<?php

class DataBase {
  private $conn = null;
  
  function __construct() {
    $servername = "192.168.0.129";
    $username = "admin";
    $password = "Almi123";
    $db = "photoplay";
    
    try {
      $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }
  function asd() {
    echo '<h2>2</h2>';
  }
  function users() {
    //$stmt = $conn->prepare("SELECT Nombre FROM Usuario");
    
    try {
      //$conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
      // set the PDO error mode to exception
      $sql = 'SELECT Nombre FROM Usuario';
      /*foreach ($this->conn->query($sql) as $row) {
        echo $row['Nombre'];
        //print $row['name'] . "\t";
      }*/

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      //$res;
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
      }

      /*
      $stmt = $conn->prepare($sql);

      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      if ($result != null) {
        while ($returnValue[] = $result->fetch_array(PDO::FETCH_ASSOC));
        return $returnValue;
      }
      // set the resulting array to associative
      //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      /*echo $result;
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v['idUsuario'];
      }*/
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  function Close() {
    $conn = null;
  }
}



?>