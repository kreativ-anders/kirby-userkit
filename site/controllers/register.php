<?php

return function ($kirby) {

  if($kirby->user()) {
    go('/');
  } 

  echo "Start";
  
  $error = false;

	if($kirby->request()->is('POST') && get('register')) {

    echo "Request";

    $kirby = kirby();
    $kirby->impersonate('kirby');

    try {

      // create user
      $user = $kirby->users()->create([
        'email'     => esc(get('email')),
        'role'      => 'user',
        'language'  => 'en',
        'password'  => esc(get('password'))
      ]);

      $kirby->impersonate();

      // login user
      if($user and $user->login(get('password'))) {
        go();
      }   

    } catch(Exception $e) {
    
      $error = true;  
    }

  };
  
  echo "Ende";
    
  return [
    'error' => $error
  ];
};