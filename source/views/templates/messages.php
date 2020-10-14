<?php
$errors = [];




if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];

  $type = selectType($message['type']);

  unset($_SESSION['message']);
}


if (isset($exception)) {
  $message = [
    'type' => 'error',
    'message' => $exception->getMessage()
  ];


  if (get_class($exception) === 'ValidationException') {
    $errors = $exception->getErrors();
  }

  $type = selectType($message['type']);
}



?>

<?php if (isset($exception) || isset($message)) : ?>
  <div role="alert" class="my-3 alert alert-<?= $type ?>">
    <?= $message['message'] ?>
  </div>
<?php endif ?>