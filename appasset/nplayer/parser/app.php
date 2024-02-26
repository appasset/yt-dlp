<?php
class Parser {
  public $path, $resources, $links;
  function __construct() {
    $this->main();
  }
  
  function init_config() {
    $this->path = (object) [
      "app" => realpath(dirname(__FILE__)."/../"),
      "config" => "config.json"
    ];
    
    $this->path->config = $this->path->app."/".$this->path->config;
    
    $this->config = (object) json_decode(file_get_contents($this->path->config));
    $this->links = (array) $this->config->parser->links;
  }
  
  function output($data, $format = "json") {
    switch ($format) {
      case "json":
        $out = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;
    }
    
    echo $out;
  }
  
  function curl($url){
    $headers = array(
    	'cache-control: max-age=0',
    	'upgrade-insecure-requests: 1',
    	'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
    	'sec-fetch-user: ?1',
    	'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
    	'x-compress: null',
    	'sec-fetch-site: none',
    	'sec-fetch-mode: navigate',
    	'accept-encoding: deflate, br',
    	'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    );
     
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    
    return $output;
  }
  
  function main() {
    header("Content-Type:text/plain");
    
    $this->init_config();
    foreach ($this->links as &$entry) {
      $entry->body = $this->curl($entry->link);
    }
    $this->resources;
    
    $this->output($this->config);
  }
}

$parser = new Parser;
?>