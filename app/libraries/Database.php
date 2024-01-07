<?php

  class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
      // Set DSN
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      // Create PDO instance
      try{
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      } catch(PDOException $e){
        $this->error = $e->getMessage();
        echo $this->error;
      }
    }

    // Prepare statement with query
    private $paramCounter = 0;
   private $params = array();
    // Reset the counter when preparing a new query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
        $this->paramCounter = 0;
    }
 



  public function bind($value){
    $this->paramCounter++;
    $type = PDO::PARAM_STR;  // Default type is string

    if (is_int($value)) {
        $type = PDO::PARAM_INT;
    } elseif (is_bool($value)) {
        $type = PDO::PARAM_BOOL;
    } elseif (is_null($value)) {
        $type = PDO::PARAM_NULL;
    }

    $this->params[$this->paramCounter] = array('value' => $value, 'type' => $type);  // Store parameter and value for debugging
    return $this->stmt->bindValue($this->paramCounter, $value, $type);
}

  
 
  
  
  public function getSQL(){
    return $this->stmt->queryString;
}

// Get the parameters and their types for debugging
public function getParams(){
    return $this->params;
}

 

    // Execute the prepared statement
    public function execute(){
      try {
        return $this->stmt->execute();
    } catch (PDOException $e) {
        // Handle the exception, log the error, etc.
        echo 'Error: ' . $e->getMessage();
        return false;
    }
  }

    // Get result set as array of objects
    public function resultSet(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function return_array(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get single record as object
    public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
      return $this->stmt->rowCount();
    }
  }