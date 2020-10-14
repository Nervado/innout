<?php

function selectType($messageType)
{
  if (!$messageType) {
    return null;
  }

  $type = '';

  switch ($messageType) {
    case 'error':
      $type = 'danger';
      break;

    case 'success':
      $type = 'success';
      break;

    case 'warning':
      $type = 'warning';
      break;

    case 'info':
      $type = 'info';
      break;

    case 'primary':
      $type = 'primary';
      break;

    case 'secondary':
      $type = 'secondary';
      break;

    case 'light':
      $type = 'light';
      break;

    case 'dark':
      $type = 'dark';
      break;

    case 'danger':
      $type = 'error';
      break;

    default:
      $type = 'danger';
      break;
  }

  return $type;
}
