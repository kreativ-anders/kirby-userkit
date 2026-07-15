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
  
  // Userkit plugin configuration
  'kreativ-anders.userkit.user.email.activation' => false,
  'kreativ-anders.userkit.user.email.activation.sender' => '...',
  'kreativ-anders.userkit.user.email.activation.subject' => 'Account Activation Link',
  
  // Email configuration for sending activation emails
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
