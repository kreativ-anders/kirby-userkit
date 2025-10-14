<?php

return function ($kirby) {

  if($kirby->user()) {
    go('/');
  } 
  
  $error = null;
  $alert = null;

  // TOKEN FOR ACCOUNT ACTIVATION
  $token = Str::random(16);

	if($kirby->request()->is('POST') && get('register')) {

    // CHECK HONEYPOT
    if(empty(get('username')) === false) {
      go('//localhost');
      exit;
    }

    // VALIDATE CSRF TOKEN
    if (csrf(get('csrf')) === true) {

      // GET FORM DATA
      $data = [
        'email'     => get('email'),
        'password'  => get('password')
      ];
  
      $rules = [
        'email'     => ['required', 'email'],
        'password'  => ['required', 'minLength' => 8]
      ];
  
      $messages = [
        'email'     => 'Please enter a valid email adress',
        'password'  => 'Please enter a valid password'
      ];

      // VALIDATE FORM DATA
      if($invalid = invalid($data, $rules, $messages)) {

        $alert = $invalid;
        $error = true;

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
          if (option('kreativ-anders.userkit.user.email.activation', false) === true) {
            
            $user->update([
              'emailActivation'       => false,
              'emailActivationToken'  => $token
            ]);
          }

        } catch(Exception $e) {

          if(option('debug')) {

            $alert['error'] = 'The user could not be created: ' . $e->getMessage();
          }
          else {

            $alert['error'] = 'The user could not be created!';
          }
        }

        $kirby->impersonate();

        // SUCCESSFUL
        if (empty($alert) === true && $user) {

          // ACTIVATE ACCOUNT BY EMAIL IF ENABLED
          if (option('kreativ-anders.userkit.user.email.activation', false) === true) {

            $link = $kirby->site()->url() . "/user/activate/" . $token;

            $email = $kirby->email([
              'to'       => $data['email'],
              'from'     => option('kreativ-anders.userkit.user.email.activation.sender'),
              'subject'  => option('kreativ-anders.userkit.user.email.activation.subject', 'Account Activation Link'),
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
    // INVALID CSRF TOKEN  
    } else {

        $alert['error'] = 'Invalid CSRF token!';
    }
  };
      
  return [
    'error'   => $error,
    'alert'   => $alert,
    'data'    => $data ?? false
  ];
};