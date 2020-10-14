<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/comum.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/icofont.min.css">
  <link rel="stylesheet" href="assets/css/template.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <title>In 'n Out</title>
</head>

<body>
  <?php include(TEMPLATE_PATH . '/toast.php') ?>

  <header class="header">

    <div class="logo">

      <i class="icofont-travelling mr-2"> </i>
      <span class="font-weight-light mr-2">In</span>
      <span class="font-weight-bold mx-2">N'</span>
      <span class="font-weight-light">Out</span>
      <i class="icofont-runner-alt-1 ml-2"> </i>

    </div>

    <div class="menu-toggle mx-3">
      <i class="icofont-navigation-menu"></i>
    </div>

    <div class="spacer"></div>


    <div class="dropdown">
      <div class="dropdown-button">

        <img class="avatar" src="<?="https://picsum.photos/200"?>" alt="user">
        <span class="ml-3"> <?= $_SESSION['user']->name ?></span>
        <i class="icofont-simple-down ml-2"></i>

      </div>
      <div class="dropdown-content">
        <ul class="nav-list">
          <li class="nav-item my-1">
            <a href="logout.php">
              <i class="icofont-logout mx-3"></i>
              Sair
            </a>
          </li>

          <li class="nav-item my-1">
            <a href="logout.php">
              <i class="icofont-logout mx-3"></i>
              Sair
            </a>
          </li>
        </ul>

      </div>
    </div>
  </header>