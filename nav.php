<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="application-name" content="LD Talent Login Project">
    <meta name="author" content="Ilori Stephen A">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LD Talent | <?php echo ucfirst($active); ?></title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">LD Talent</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <?php if (!isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
                <a class="nav-link <?php if (strtolower($active) === 'login') echo 'active'; ?>" href="http://localhost/Blog%20-%20Github/authenication-php%20(PDO)%20oop/index.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (strtolower($active) === 'register') echo 'active'; ?>" href="http://localhost/Blog%20-%20Github/authenication-php%20(PDO)%20oop/register.php" tabindex="-1" aria-disabled="true">Register</a>
              </li>
            <?php elseif (isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
                <a href="http://localhost/Blog%20-%20Github/authenication-php%20(PDO)%20oop/dashboard.php" class="nav-link <?php if (strtolower($active) === 'dashboard') echo 'active'; ?>">Dashboard</a>
              </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
                <a class="nav-link" href="http://localhost/Blog%20-%20Github/authenication-php%20(PDO)%20oop/logout.php">Logout</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
