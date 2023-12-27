<?php

return function ($kirby, $page) {

  if(!$kirby->user()) {
    go('/');
  } 

  $error = null;
  $alert = null;

  // CHECK ACCOUNT ACTIVATION
  if(option('user.email.activation', false) === true && $kirby->user()->emailActivation()->toString() === '' || $kirby->user()->emailActivation() != true) {

    $alert['error'] = 'Please check your emails to activate the account.';
  }

  // UPDATE USER
  if($kirby->request()->is('post') && get('update')) {

    // VALIDATE CSRF TOKEN
    if (csrf(get('csrf')) === true) {

      // GET FORM DATA
      $data = [
        'email'     => esc(get('email')),
        'password'  => esc(get('password'))
      ];

      $rules = [
        'email'     => ['email'],
        'password'  => ['minLength' => 8]
      ];

      $messages = [
        'email'     => 'Please enter a valid email adress',
        'password'  => 'Please enter an eight character password'
      ];

      // VALIDATE FORM DATA
      if($invalid = invalid($data, $rules, $messages)) {

        $alert = $invalid;
        $error = true;

      // VALID DATA
      } else {

        // EMAIL
        if (V::email($data['email']) && !get('password')) {
          
          try {

            $kirby->user()->changeEmail($data['email']);
            $success = 'Your email has been changed!';

            // TOKEN FOR ACCOUNT RE-ACTIVATION
            $token = Str::random(16);

            $kirby->user()->update([
              'emailActivation'       => false,
              'emailActivationToken'  => $token
            ]);

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
          
          } catch(Exception $e) {
          
            if(option('debug')) {

              $alert['error'] = 'The user email could not be changed: ' . $e->getMessage();
            }
            else {
    
              $alert['error'] = 'The user email could not be changed!';
            }
          }
        }

        // PASSWORD
        if ($data['password']) {
          
          try {

            $kirby->user()->changePassword($data['password']);
            $success = 'Your password has been changed!';
          
          } catch(Exception $e) {
          
            if(option('debug')) {

              $alert['error'] = 'The user password could not be changed: ' . $e->getMessage();
            }
            else {
    
              $alert['error'] = 'The user password could not be changed!';
            } 
          }
        }

        // SUCCESSFUL
        if (empty($alert) === true) {

          $error = null;
        }
      } 
    // INVALID CSRF TOKEN  
    } else {

      $alert['error'] = 'Invalid CSRF token!';
    } 
  }

  // DELETE USER
  if($kirby->request()->is('post') && get('delete')) {

    try {

      $kirby->user()->delete();
      go('/');
    
    } catch(Exception $e) {
    
      if(option('debug')) {

        $alert['error'] = 'The user could not be deleted: ' . $e->getMessage();
      }
      else {

        $alert['error'] = 'The user could not be deleted!';
      }     
    }
  }
    
  return [
    'error'   => $error,
    'alert'   => $alert,
    'data'    => $data ?? false,
    'success' => $success ?? false
  ];
};