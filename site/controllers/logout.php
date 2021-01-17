<?php

return function ($kirby) {

  $error = null;
  
  if($user = $kirby->user()) {

    try {
      $user->logout();
      go();

    } catch(Exception $e) {

      $error = $e->getMessage(); 
    }
  }
   
  return [
    'error' => $error
  ];
};