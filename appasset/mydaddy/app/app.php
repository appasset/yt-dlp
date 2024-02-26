<?php
header('Content-Type:text/plain');
// $__file = $argv[0];
$__file = __FILE__;

$__path = dirname($__file);
$__vendor = $__path."/vendor";

include_once $__vendor."/autoload.php";

// var_dump($__vendor); die();


function render_data($input_, $format = 'json'){
  $output = (string) json_encode($input_, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
  print $output;
}

function render($input_, $format = 'raw'){
  switch($format) {
    case 'json':
    case 'json5':
      render_data($input_, $format);
      return;
      break;

    case 'text':
      $o = [];
      foreach($input_ as $entry){
        $o[] = $entry->video;
      }
      $o = implode("\n", $o);
      echo $o;
      return;
      break;

    case 'aria2c':
      $o = [];
      foreach($input_ as $entry){
        $entry->url = str_replace('&alt', '', $entry->url);
        $b = basename($entry->url);
        // var_dump($b); die();
        $o[] = "aria2c -x 5 -o \"".$b.".mp4\" \"".$entry->video."\"";
      }
      $o = implode("\n", $o);
      echo $o;
      return;
      break;
  }
  $output = var_export($input_);
  print $output;
}

function application($input_, $format = 'json'){
	// array_shift($input_);
	
	$result = main((array) $input_);
  switch($format){
    case 'json':
    case 'text':
    case 'aria2c':
      render($result, $format); 
      break;
  }
}

function main($args_){
  $r = array();
  foreach ($args_ as $entry) {
    if (!$entry) continue;
    if (!is_url($entry)) continue;
    $r[] = (object) array( 'url' => $entry, 'response' => file_get_contents($entry));
    
  }

  $result = $r;
  parser($r);
  return $result;
}

function parser(&$r){
  foreach($r as &$entry) {
    $matches = [];
    preg_match_all('/\"([^\"]+\.mp4)\"/is', $entry->response, $matches);

    if (!isset($matches[1])) continue;

    $matches = $matches[1];
    $last = count($matches) - 1;
    $entry->video = "http:".$matches[$last];
    unset($entry->response);
    // var_dump($matches[$last]);
  }
}

function is_url($input_){
  $result = (boolean) false;
  $mask = "/^https?\:.*/i";
  
  if( preg_match($mask, $input_)) {
    return true;
  }
  return $result;
}

// $input = $argv;
$input = urldecode($_GET['links']);
$format = 'json';
if (isset($_GET['format']))
  $format = $_GET['format'];

$input = explode(";", $input);
application($input, $format);

?>
  