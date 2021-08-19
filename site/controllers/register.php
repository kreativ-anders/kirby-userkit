<?php

return function ($kirby) {

  if($kirby->user()) {
    go('/');
  } 
  
  $error = null;
  $alert = null;

  // TOKEN FOR ACCOUNT ACTIVATION
  $token = Str::random(16);

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
          'email'             => $data['email'],
          'role'              => 'user',
          'language'          => 'en',
          'password'          => $data['password']
        ]);

        // CHECK EMAIL ACTIVATION
        if (option('user.email.activation', false) === true) {
          
          $user->update([
            'emailActivation'       => false,
            'emailActivationToken'  => $token
          ]);
        }

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
      if (empty($alert) === true && $user) {

        // ACTIVATE ACCOUNT BY EMAIL IF ENABLED
        if (option('user.email.activation', false) === true) {

          $link = $kirby->site()->url() . "/user/activate/" . $token;

          $email = $kirby->email([
            'to'       => $data['email'],
            'from'     => option('user.email.activation.sender'),
            'subject'  => option('user.email.activation.sender', 'Account Activation Link'),
            'template' => 'account-activation',
            'data'     => [
              'link'   => $link,
            ]
          ]);
        }

        // LOGIN USER
        if($user->login($data['password'])) {
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