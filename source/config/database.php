<?php


class Database
{

  public static function getConnection()
  {
    # code...
    $envPath = realpath((dirname(__FILE__) . '/../env.ini'));

    $env = parse_ini_file($envPath);

    $connection = new mysqli($env['host'], $env['username'], $env['password'],  $env['database']);

    if ($connection->connect_error) {
      die('Erro ao connectar com o banco' . $connection->connect_error);
    }

    return $connection;
  }

  public static function getResultFromQuery($sql)
  {
    $conn = self::getConnection();
    $result = $conn->query($sql);
    $conn->close();
    return $result;
  }

  public static function executeSQL($sql) {
    $conn = self::getConnection();

    if(!mysqli_query($conn, $sql)) {
        throw new Exception(mysqli_error($conn));
    }
    
    $id = $conn->insert_id;
       
    $conn->close();

    return $id;
}
}