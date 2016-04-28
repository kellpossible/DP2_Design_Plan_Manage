<?php
$this->layout('base::item_form',
[
  'title' => "Login",
  'message' => $this->e($message),
  'form' => [
    'inputs' => [
      [
        'id' => 'username',
        'label' => 'Username',
        'type' => 'text'
      ],
      [
        'id' => 'password',
        'label' => 'Password',
        'type' => 'password'
      ],
      [
        'id' => 'return_uri',
        'type' => 'hidden',
        'value' => $this->e($return_uri)
      ]
    ],
    'button_label' => 'Login',
    'title' => 'Login',
    'action' => '/index.php/Login/Login/',
    'id' => 'login'
  ]
]) ;
/** show a table of items in the inventory */
?>
