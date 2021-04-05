<?php

return function ($kirby) {

  if($kirby->user()) {
    go('/');
  } 
  
  $error = null;
  $alert = null;

	if($kirby->request()->is('post') && get('register')) {

    $data = [
      'email'     => esc(get('email')),
      'password'  => esc(get('password'))
    ];

    $rules = [
      'email'     => ['required', 'email'],
      'password'  => ['required', 'minLength' => 8]
    ];

    $messages = [
      'email'     => 'Please enter a valid email adress',
      'password'  => 'Please enter a valid password'
    ];

    // INVALID DATA
    if($invalid = invalid($data, $rules, $messages)) {

      $alert = $invalid;
      $error = true;

    // VALID DATA
    } else {

      $kirby = kirby();
      $kirby->impersonate('kirby');

      try {

        // CREATE USER
        $user = $kirby->users()->create([
          'email'     => $data['email'],
          'role'      => 'user',
          'language'  => 'en',
          'password'  => $data['password']
        ]);

        $kirby->impersonate(); 

      } catch(Exception $e) {

        if(option('debug')) {

          $alert['error'] = 'The user could not be created: ' . $e->getMessage();
        }
        else {

          $alert['error'] = 'The user could not be created!';
        }
      }

      // SUCCESSFUL
      if (empty($alert) === true) {

        // LOGIN USER
        if($user and $user->login($data['password'])) {
          go();
        }  

        $data = [];
      }
    }
  };
      
  return [
    'error'   => $error,
    'alert'   => $alert,
    'data'    => $data ?? false
  ];
};