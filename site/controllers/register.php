<?php

return function ($kirby) {

  if($kirby->user()) {
    go('/');
  } 
  
  $error = false;

	if($kirby->request()->is('POST') && get('register')) {

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
      
  return [
    'error' => $error
  ];
};