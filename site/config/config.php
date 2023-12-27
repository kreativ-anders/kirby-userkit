<?php

/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen. 
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */
return [
  'debug' => true,
  'panel' =>[
    'install' => true
  ],
  'user.email.activation' => false,
  'user.email.activation.sender' => '...',
  'user.email.activation.subject' => 'Account Activation Link',
  'routes' => [
    [
      'pattern' => 'logout',
      'action'  => function() {

        if ($user = kirby()->user()) {
          $user->logout();
        }

        go('login');

      }
    ],
    [
      'pattern' => 'user/activate/(:alphanum)',
      'action'  => function($token) {

        if (option('user.email.activation', false) === false) {
          go();
        }

        $kirby = kirby();
        $kirby->impersonate('kirby');

        if ($user = $kirby->users()->findBy('emailActivationToken', $token)) {

          if ($user->emailActivationToken()->toString() === Str::toType($token, 'string')) {

            $user->update([
              'emailActivation' => true
            ]);

            go();
            //go('CUSTOM_SUCCESSFUL_ACTIVATION_PAGE');

          }
          else {
            return false;
            //go('CUSTOM_ERROR_ACTIVATION_PAGE');
            //return page('CUSTOM_ERROR_ACTIVATION_PAGE');
          }
          
        }

        $kirby->impersonate(); 
      }
    ]
  ],
  'email' => [
    'transport' => [
      'type' => 'smtp',
      'host' => '...',
      'port' => 587,
      'security' => 'tls',
      'auth' => true,
      'username' => '...',
      'password' => '..'
    ]
  ]
];
