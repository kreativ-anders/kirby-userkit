<?php

/**
 * Kirby Userkit Plugin
 * 
 * A functional, lean, and unstyled Kirby User Management Plugin for Kirby CMS.
 * 
 * @version 1.0.0
 * @author kreativ-anders
 */

Kirby::plugin('kreativ-anders/userkit', [
  'options' => [
    'user.email.activation' => false,
    'user.email.activation.sender' => null,
    'user.email.activation.subject' => 'Account Activation Link',
  ],
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

        if (option('kreativ-anders.userkit.user.email.activation', false) === false) {
          go();
        }

        $kirby = kirby();
        $kirby->impersonate('kirby');

        if ($user = $kirby->users()->findBy('emailActivationToken', $token)) {

          if ($user->emailActivationToken()->toString() === Str::toType($token, 'string')) {

            $user->update([
              'emailActivation' => true
            ]);

            $kirby->impersonate();
            go();
            //go('CUSTOM_SUCCESSFUL_ACTIVATION_PAGE');

          }
          else {
            $kirby->impersonate();
            return false;
            //go('CUSTOM_ERROR_ACTIVATION_PAGE');
            //return page('CUSTOM_ERROR_ACTIVATION_PAGE');
          }
          
        }

        $kirby->impersonate(); 
      }
    ]
  ],
  'pageControllers' => [
    'login' => require __DIR__ . '/controllers/login.php',
    'register' => require __DIR__ . '/controllers/register.php',
    'user' => require __DIR__ . '/controllers/user.php',
  ],
  'templates' => [
    'login' => __DIR__ . '/templates/login.php',
    'register' => __DIR__ . '/templates/register.php',
    'user' => __DIR__ . '/templates/user.php',
    'user.json' => __DIR__ . '/templates/user.json.php',
    'user.csv' => __DIR__ . '/templates/user.csv.php',
  ],
  'blueprints' => [
    'pages/login' => __DIR__ . '/blueprints/pages/login.yml',
    'pages/register' => __DIR__ . '/blueprints/pages/register.yml',
    'users/user' => __DIR__ . '/blueprints/users/user.yml',
  ],
  'snippets' => [
    'userkit/notification' => __DIR__ . '/snippets/notification.php',
  ]
]);
