<?php

return function ($kirby) {

  // don't show the login screen to already logged in users
  if ($kirby->user()) {
    go('/');
  }

  $error = false;

  // handle the form submission
  if ($kirby->request()->is('POST') && get('login')) {

    // try to log the user in with the provided credentials
    try {
      $kirby->auth()->login(get('email'), get('password'));

      // redirect to the homepage if the login was successful
      go('/');
    } catch (Exception $e) {
      $error = true;
    }

  }

  return [
    'error' => $error
  ];

};