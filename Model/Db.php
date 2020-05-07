<?php
  class Db {
    protected $dbName = 'learning_dollars_db';
    protected $dbHost = 'localhost';
    protected $dbUser = 'root';
    protected $dbPass = '';
    protected $dbHandler, $dbStmt;

    public function __construct()
    {
      // Create a DSN Resource...
      $Dsn = "mysql:host=" . $this->dbHost . ';dbname=' . $this->dbName;
      //create a pdo options array
      $Options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
      try {
        $this->dbHandler = new PDO($Dsn, $this->dbUser, $this->dbPass, $Options);
      } catch (Exception $e) {
        var_dump('Couldn\'t Establish A Database Connection. Due to the following reason: ' . $e->getMessage());
      }
    }

    public function query($query)
    {
      $this->dbStmt = $this->dbHandler->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
      if (is_null($type)) {
        switch (true) {
          case is_int($value):
            $type = PDO::PARAM_INT;
          break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
          break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
          break;
          default:
            $type = PDO::PARAM_STR;
          break;
        }
      }

      $this->dbStmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
      $this->dbStmt->execute();
    }

    public function fetch()
    {
      $this->execute();
      return $this->dbStmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
      $this->execute();
      return $this->dbStmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
 ?>
