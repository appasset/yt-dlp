<?php
function main(){
  if (!isset($_GET['source'])) return;
  if (empty($_GET['source'])) return;
  
  $source = urldecode($_GET['source']);
  $data = explode("\n", file_get_contents('../data/links.lst'));
  array_push($data, $source);
  
  $new_data = array();
  
  foreach ($data as $src) {
    if (empty($src)) continue;
    
    array_push($new_data, $src);
  }
  $data = join("\n", $new_data)."\n";
  unset($new_data);
  file_put_contents('../data/links.lst', $data);
  
  return $data;
}

echo main();
