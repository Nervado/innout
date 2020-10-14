<?php

if (isset($toastMessage)) {

  $type = selectType($toastMessage['type']);

  echo '<script type="text/javascript">
    toastr.' . $type . '("' . $toastMessage['message'] . '")
  </script>';
}
