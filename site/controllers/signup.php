<?php

return function ($kirby) {

  if($kirby->user()) {
    go('/');
  } 

  $error = null;
  
	if($kirby->request()->is('POST') and get('email') and get('password')) {

    $error = 1;

     try {

      // impersonate
      $kirby->impersonate('kirby'); // switch to a callback function

      // create user
      $user = $kirby->users()->create([
        'email'     => esc(get('email')),
        'role'      => 'visitor',
        'language'  => 'en',
        'password'  => esc(get('password'))
      ]);

      // deimpersonate
      $kirby->impersonate();

      // login user
      if($user and $user->login(get('password'))) {
        go();
      }   

    } catch(Exception $e) {
    
      $error = $e->getMessage();    
    }

  }
    
  return [
    'error' => $error
  ];
};