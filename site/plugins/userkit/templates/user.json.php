<?php

$json = null;

if($kirby->user()) {

  $bookmarks = $kirby->user()->bookmarks()->yaml();

  $json = [
    'User'        => $kirby->user()->email()
  ];

}
else {
  $json = [];
}

echo json_encode($json);