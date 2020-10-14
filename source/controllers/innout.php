<?php
session_start();
requireValidSession();



$user = $_SESSION['user'];

$records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

try {


  $currentTime = strftime('%H:%M:%S', time());

  if ($_POST['forcedTime']) {
    # code...
    $currentTime = $_POST['forcedTime'];
  }
  $records->innout($currentTime);
  addSucessMessage('Ponto inserido com sucesso');
} catch (AppException $e) {
  addErrorMessage($e->getMessage());
}

header('Location: day_records.php');
