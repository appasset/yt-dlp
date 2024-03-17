<?php
$__path   = dirname($argv[0]);
$__vendor = "${__path}/vendor";
$__data   = dirname($__path)."/data";
include_once "${__vendor}/autoload.php";


class App {
  $response;
  
  function render($input_, $format = 'raw'){
    switch($format) {
      case 'json':
      case 'json5':
        render_data($input_, $format);
        return;
        break;
    }
    $output = var_export($input_);
    print $output;
  }
  
  function init($input_){
  	array_shift($input_);
  	
  	
  }
  
  function parser(&$r){
    foreach($r as &$entry) {
      $matches = [];
      preg_match_all('/\"([^\"]+\.mp4)\"/is', $this->response->response, $matches);
  
      if (!isset($matches[1])) continue;
  
      $matches = $matches[1];
      $last = count($matches) - 1;
      $video = "http:".$matches[$last];
      unset($entry->response);
      // var_dump($matches[$last]);
    }
  }
  
  function config($path) {
  	 
  }
  
  function __construct($args_){
    $this->response = (object) array( 'url' => $entry, 'response' => file_get_contents($entry));
    $r = $args_;
    // $result = $r;
    $result = $this->init($r);
    $data = $this->load_data($_data);
    $result = $this->render($data, 'json5'); 
    // $result = $data;
    
    return $result;
  }
}


 
$app = new App($argv);

?>
  