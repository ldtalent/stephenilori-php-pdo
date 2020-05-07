<?php
  require_once(__dir__ . '/Controller.php');

  class Logout extends Controller {
    public function __construct()
    {
      session_destroy();
      header("Location: index.php");
    }
  }
 ?>
