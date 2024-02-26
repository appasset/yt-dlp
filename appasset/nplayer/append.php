<?php
header('Content-Type: text/plain; Charset=UTF-8');
function main(){
  $result = array();
  if (!isset($_GET['source'])) return $result;
  if (empty($_GET['source'])) return $result;
  
  $source = urldecode($_GET['source']);
  $data = explode("\n", file_get_contents('../data/links.lst'));
 
  $new_data = array();
  
  foreach ($data as $src) {
    if (empty($src)) continue;
    if ($src == $source) continue;
    
    array_push($new_data, $src);
  }
  
  array_push($data, $source);
  
  
  
  
  $data = join("\n", $new_data)."\n";
  //unset($new_data);
  file_put_contents('../data/links.lst', $data);
  $result = $new_data;
  return $result;
}

echo json_encode(main());
