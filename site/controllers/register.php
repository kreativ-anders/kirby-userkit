<?php

return function ($kirby) {

  if($kirby->user()) {
    go('/');
  } 
  
  $error = false;

	if($kirby->request()->is('post') && get('register')) {

    $kirby = kirby();
    $kirby->impersonate('kirby');

    try {

      // CREATE USER
      $user = $kirby->users()->create([
        'email'     => esc(get('email')),
        'role'      => 'user',
        'language'  => 'en',
        'password'  => esc(get('password'))
      ]);

      $kirby->impersonate();

      // LOGIN USER
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