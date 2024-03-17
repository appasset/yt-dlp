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

function checkLinksHeaderLine($curl, $header_line) {
    echo "<br>YEAH: ".$header_line;
    return strlen($header_line);
}

function check($link){
  $result = true;
  $info = checkLinks($link)[0];
  var_dump($info);
  
  return $result;
}

function checkLinks($links){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_FILETIME, true);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  // curl_setopt($ch, CURLOPT_HEADERFUNCTION, "checkLinksHeaderLine");
  
  if (!is_array($links)) {
    $tmp = [];
    array_push($tmp, $links);
    $links = (array) $tmp;
    unset($tmp);
  }
  
  $result = [];
  foreach ($links as $entry) {
    $info = (object) array(
      "link"   => $entry,
      "code"   => null,
      "header" => null,
      "info"   => null
    );
    curl_setopt($ch, CURLOPT_URL, $entry);
    $info->header = curl_exec($ch);
    $info->info = curl_getinfo($body);
    
    $result[] = $info;
  }
  
  return $result;
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
