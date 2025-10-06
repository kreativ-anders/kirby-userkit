<?php

return function ($kirby) {

  if ($kirby->user()) {
    go('/');
  }

  $error = null;
  $alert = null;

  if ($kirby->request()->is('POST') && get('login')) {

    // VALIDATE CSRF TOKEN
    if (csrf(get('csrf')) === true) {

      // GET FORM DATA
      $data = [
        'email'     => get('email'),
        'password'  => get('password')
      ];

      $rules = [
        'email'     => ['required', 'email'],
        'password'  => ['required']
      ];

      $messages = [
        'email'     => 'Please enter a valid email adress',
        'password'  => 'Please enter a password'
      ];

      // VALIDATE FORM DATA
      if($invalid = invalid($data, $rules, $messages)) {

        $alert = $invalid;
        $error = true;

      // VALID DATA
      } else {

        // LOGIN USER
        try {

          $kirby->auth()->login($data['email'], $data['password']);

        } catch (Exception $e) {

          if(option('debug')) {

            $alert['error'] = 'Invalid email or password: ' . $e->getMessage();
          }
          else {

            $alert['error'] = 'Invalid email or password!';
          }
        }

        // SUCCESSFUL
        if (empty($alert) === true) {

          $data = [];
          go();
        }
      }
    // INVALID CSRF TOKEN    
    } else {

      $alert['error'] = 'Invalid CSRF token!';
    }
  }

  return [
    'error'   => $error,
    'alert'   => $alert,
    'data'    => $data ?? false
  ];
};