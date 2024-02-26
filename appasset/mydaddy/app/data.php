<?php
$__path   = dirname($argv[0]);
$__vendor = "${__path}/vendor";
$__data   = dirname($__path)."/data";
include_once "${__vendor}/autoload.php";



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

function application($input_){
	array_shift($input_);
	
	$result = main((array) $input_);
	render($result, 'json5'); 
}

function load_data($path) {
	 
}

function main($args_){
  $r = $args_;
  $result = $r;
  
  $data = load_data($_data);
  
  $result = $data;
  return $result;
}

 
application($argv);

?>
  