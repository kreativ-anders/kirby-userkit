<?php

return function ($kirby) {

  if($kirby->user()) {
    go('/');
  } 

  $error = null;
  
	if($kirby->request()->is('POST') and get('email') and get('password')) {

     try {

      $user = $kirby->user(get('email'));

      if($user and $user->login(get('password'))) {
        // redirect to the homepage
        // or any other page
        go();
      } else {
        echo 'ungültiger Benutzername oder Passwort! ';
      }
    
    } catch(Exception $e) {
    
      $error = $e->getMessage();    
    }

  }
    
  return [
    'error' => $error
  ];
};