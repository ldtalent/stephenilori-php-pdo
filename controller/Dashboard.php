<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/DashboardModel.php');
  class Dashboard extends Controller {
    public $active = 'dashboard'; //for highlighting the active link...
    private $dashboardModel;

    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: index.php");
      $this->dashboardModel = new DashboardModel();
    }

    public function getNews() :array
    {
      return $this->dashboardModel->fetchNews();
    }
  }
 ?>
