<?php
class Database extends PDO
{
  public function __construct($connect, $user, $password)
  {
    // $db = new PDO($connect, $user, $password);
    parent::__construct($connect, $user, $password);
  }
  public function select($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC)
  {
    $statement = $this->prepare($sql);
    foreach ($data as $key => $value) {
      $statement->bindParam($key, $value);
    }
    // $statement->bindParam(':id',$id);
    $statement->execute();
    return $statement->fetchAll($fetchStyle);
  }

  public function insert($table, $data)
  { 
    $keys = implode(',', array_keys($data));
    $values = ':' . implode(', :', array_keys($data));
    $sql = "INSERT INTO $table($keys) VALUES($values)";
    $statement = $this->prepare($sql);
    foreach ($data as $key => $value) {
      $statement->bindValue(":$key", $value);
    }
    return $statement->execute();
  }
  public function update($table,$data,$cond){
    
    $updatekey = NULL;
    foreach ($data as $key => $value) {
      $updatekey .= "$key=:$key,";
    }
    $updatekey = rtrim($updatekey, ',');
    
    $sql = "UPDATE $table SET $updatekey WHERE $cond";
    $statement = $this->prepare($sql);
    
    foreach ($data as $key => $value) {
      $statement->bindValue(":$key", $value);
    }
    return $statement->execute();
  }
  public function delete($table,$cond,$limit = 1){
    $sql = "DELETE FROM $table WHERE $cond LIMIT $limit";
    return $this->exec($sql);
  }

  public function affectedRows($sql, $username, $password){
    $statement = $this->prepare($sql);
    $statement->execute(array($username, $password));
    return $statement ->rowCount();
  }

  public function selectUser($sql, $username, $password){
    $statement = $this->prepare($sql);
    $statement->execute(array($username, $password));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  
}