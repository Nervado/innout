<?php

loadModel('Login');

session_start();

$exception = null;

if (count($_POST) > 0) {

  $login = new Login($_POST);

  $_POST['toastMessage'] = null;

  try {

    $user = $login->checkLogin();
    $_SESSION['user'] = $user;
    $_POST['toastMessage'] = ['message' => 'Bem vindo', 'type' => 'success'];

    header("Location: day_records.php");
  } catch (AppException $e) {

    $exception = $e;
    $_POST['toastMessage'] = ['message' => 'Falha ao entrar', 'type' => 'danger'];
  }
}



loadView('login',  $_POST + ['exception' => $exception]);