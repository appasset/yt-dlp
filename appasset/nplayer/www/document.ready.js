function hash_hystory($hash) {
  
  $h = $.parseJSON($.cookie('hash-history'));
  console.log($h);
  if ($hash == null)
    return $h;
    
  $h.push($hash);
  if ($h.length > 5);
    $h.pop();
    
  $.cookie('hash-history', JSON.stringify($h));
}

$(document).ready(function(){
  let TITLE = $('title').text();
  console.group(TITLE);
  let $links = $('ul.links li a'); 
  
  $('ul.links').find('li').removeClass('active');
  
  /* var hh = hash_hystory(null);
  
  if (hh != 'undefined') $.each(hh, function(entry){
      $('.link-'+entry).parents('li').addClass('active');
  }); */
  
  $links.click(function(){
    // hash_hystory($(this).data('hash'));
   
    $(this).parents('ul').parent().find('li.active').removeClass('active');
  
    //$.each(hash_hystory(null), function(entry){
      $(this).parents('li').addClass('active');
    //});
    //console.log($(this).data('link'));
  });
  
  console.groupEnd();
});
