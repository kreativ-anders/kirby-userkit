<?php

header('Content-type: text/plain; charset=UTF-8');

$csv = "";

if($kirby->user()) {
  
  $csv .= "Email;Langauge\n";
  $csv .= $kirby->user()->email().";".$kirby->user()->language()."\n";


}
else {
  $csv = [];
}

echo $csv;