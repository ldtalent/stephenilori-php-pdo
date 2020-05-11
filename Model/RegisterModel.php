 <?php
  require_once(__dir__ . '/Db.php');
  class RegisterModel extends Db {

    public function createUser(array $user) :array
    {
      $this->query("INSERT INTO `db_user` (name, email, phone_no, password) VALUES (:name, :email, :phone_no, :password)");
      $this->bind('name', $user['name']);
      $this->bind('email', $user['email']);
      $this->bind('phone_no', $user['phone']);
      $this->bind('password', $user['password']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
        );
        return $Response;
      } else {
        $Response = array(
          'status' => false
        );
        return $Response;
      }
    }

    public function fetchUser(string $email) :array
    {
      $this->query("SELECT * FROM `db_user` WHERE `email` = :email");
      $this->bind('email', $email);
      $this->execute();

      $User = $this->fetch();
      return $User;
    }
  }
 ?>
