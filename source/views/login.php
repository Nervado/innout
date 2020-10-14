<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/comum.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/icofont.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <title>In 'n Out</title>
</head>

<body>
  <?php include(TEMPLATE_PATH . '/toast.php') ?>

  <form action="#" method="post" class="form-login">
    <div class="login-card card">
      <div class="card-header">
        <i class="icofont-travelling"> </i>
        <span class="font-weight-light mr-2">In</span>
        <span class="font-weight-bold mx-2">N'</span>
        <span class="font-weight-light ml-2">Out</span>
        <i class="icofont-runner"> </i>
      </div>
      <div class="card-body">
        <?php include(TEMPLATE_PATH . '/messages.php') ?>
        <div class="form-group">
          <label for="email"></label>
          <input value="<?= isset($email) ? $email : '' ?>" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" type="email" id="email" name="email" placeholder="Seu melhor email" autocomplete="email">
          <div class="invalid-feedback">
            <?= $errors['email'] ?>
          </div>
        </div>
        <div class="form-group">
          <label for="password"></label>
          <input class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" type="password" id="password" name="password" placeholder="Sua melhor senha" autocomplete="current-password">
          <div class="invalid-feedback">
            <?= $errors['password'] ?>
          </div>
        </div>

      </div>
      <div class="card-footer">
        <button class="btn btn-lg btn-primary">Entrar</button>
      </div>
    </div>
  </form>
</body>

</html>