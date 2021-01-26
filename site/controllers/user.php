<?php

return function ($kirby, $page) {

  if(!$kirby->user()) {
    go('/');
  } 

  $error = false;

  // UPDATE USER
  if($kirby->request()->is('post') && get('update')) {

    // EMAIL
    if (V::email(get('email')) && !get('password')) {
      
      try {

        $kirby->user()->changeEmail(get('email'));
      
      } catch(Exception $e) {
      
        $error = true;
      }
    }

    // PASSWORD
    if (get('password')) {
      
      try {

        $kirby->user()->changePassword(get('password'));
      
      } catch(Exception $e) {
      
        $error = true;  
      }
    } 
  }

  // DELETE USER
  if($kirby->request()->is('post') && get('delete')) {

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