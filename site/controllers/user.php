<?php

return function ($kirby, $page) {

  if(!$kirby->user()) {
    go('/');
  } 

  $error = false;

  // Update
  if($kirby->request()->is('POST') && get('update')) {

    echo "Update";

    // Email
    if (V::email(get('email')) && !get('password')) {
      
      try {

        $kirby->user()->changeEmail(get('email'));
      
      } catch(Exception $e) {
      
        $error = true;
      }
    }

    // Password
    if (get('password')) {
      
      try {

        $kirby->user()->changePassword(get('password'));
      
      } catch(Exception $e) {
      
        $error = true;  
      }
    } 
  }

  // Delete
  if($kirby->request()->is('POST') && get('delete')) {

    try {

      $kirby->user()->delete();
      go('/');
    
    } catch(Exception $e) {
    
      $error = true;    
    }
  }
    
  return [
    'error' => $error
  ];
};