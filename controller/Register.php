<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/RegisterModel.php');
  class Register extends Controller {
    public $active = 'Register'; //for highlighting the active link...
    private $registerModel;
    public function __construct()
    {
      $this->registerModel = new RegisterModel();
    }

    public function register(array $data) :array
    {
      $name = stripcslashes(strip_tags($data['name']));
      $email = stripcslashes(strip_tags($data['email']));
      $phone = stripcslashes(strip_tags($data['phone']));
      $password = stripcslashes(strip_tags($data['password']));

      $EmailRecords = $this->registerModel->fetchEmail($email);

      $Error = array(
        'name' => '',
        'email' => '',
        'phone' => '',
        'password' => '',
        'status' => false
      );

      if (preg_match('/[^A-Za-z_]/', $name)) {
        $Error['name'] = 'Only Alphabets are allowed.';
        return $Error;
      }

      if (!$EmailRecords['status']) {
        $Error['email'] = 'Sorry. This Email Address has been taken.';
        return $Error;
      }

      if (preg_match('/[^0-9_]/', $phone)) {
        $Error['phone'] = 'Please, use a valid phone number.';
        return $Error;
      }

      if (strlen($password) < 7) {
        $Error['password'] = 'Please, use a stronger password.';
        return $Error;
      }

      if (!empty($Error['name']) || !empty($Error['email']) || !empty($Error['phone']) || !empty($Error['password'])) {
        return $Error;
      }


      $Payload = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => password_hash($password, PASSWORD_BCRYPT)
      );

      $Response = $this->registerModel->createUser($Payload);
      if (!$Response['status']) {
        $Response['status'] = 'Sorry, An unexpected error occurred and your request could not be completed.';
        return $Response;
      }

      $_SESSION['data'] = $this->registerModel->fetchUser($email);
      $_SESSION['auth_status'] = true;
      header("Location: dashboard.php");
      return true;
    }
  }
 ?>
