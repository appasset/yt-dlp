<?php
$CFG = (object) ['App' => (object) [
  "Path" => null
]];
$App = &$CFG->App;

$App->Token = hash('crc32', time());

function srcScheme($link){
  $link = trim($link);
  
  $scheme = "nplayer-${link}";
  
  return $scheme;
}

function srcName($link){
  $basename = basename($link);
  
  $name = explode('&id=', $basename, 2);
  
  if (count($name) == 1)
    return trim("${basename}");
  
  
  $name = $name[1];
  $name = "${name}";
  
  return trim($name);
}

function loadLinks($file){
  $links = (string) file_get_contents($file);
  $links = (array)  explode("\n", $links);
  foreach ($links as &$line) {
    $line = explode(";", $line, 2);
    $group = "Main Group";
    
    if (isset($line[1]))
      $group = $line[1];
    
    $line = (object) [
      "hash"   => hash("md5", $line[0]),
      "source" => $line[0],
      "group"  => $group
    ];
  }
  
  $links = array_reverse($links);
  
  return $links;
}

function __init(){
  global $CFG, $App;
  $App->Path = realpath(__DIR__);
  loadConfig();
}

function loadConfig(){
  global $CFG, $App;
  $data = (array) json_decode(file_get_contents($App->Path.'/config.json'));
  $App = array_merge((array) $App, (array) $data['app']);
  $App = (object) $App;
  $App->Home = $App->home.$App->prefix;
  unset($App->home);
  unset($App->prefix);
}
?>
