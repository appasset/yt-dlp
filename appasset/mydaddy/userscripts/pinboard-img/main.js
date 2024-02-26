// ==UserScript==
// @name          pinboard-img
// @namespace     pim
// @description   Images in description
// @icon          https://s8.hostingkartinok.com/uploads/images/2019/11/2ab08c9548c65432bbd1aa43cc6024e4.png
// @icon64        https://s8.hostingkartinok.com/uploads/images/2019/11/e657976443b254b0ed09bb647d6fbcdb.png
// @noframes
// @match       *://pinboard.in/*
// @match       *://m.pinboard.in/*
// @run-at        document-idle
// @require       https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js
// @connect       pastebin.com
// @grant         GM_xmlhttpRequest
// @grant         GM_setValue
// @grant         GM_getValue
// @grant         GM_listValues
// @grant         GM_log
// @grant         unsafeWindow
// @author        moalex <trofimoff@live.ru>
// @version       3.5.7
// ==/UserScript==
/**
 * Apply downloaded stylesheet
 *
 * @prop css [string]
 */
function GM__stylesheet(css){
    var node  = document.createElement('style'),
        heads = document.getElementsByTagName('head');

    node.type = 'text/css';
    node.appendChild( document.createTextNode(css) );

    if (heads.length > 0)
        heads[0].appendChild(node);
    else
        document.documentElement.appendChild(node);
}

/**
 * Get stylesheet raw css data from url
 */
function GM__curl(url, method, data, success){
  GM_xmlhttpRequest({
    url:    url,
    method: method,
    data:   data,
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    onload: success
  });
}

function GM__style(href){
  GM__curl(href, 'GET', null, function(response){
    if (GM__App.debug.log.response) console.log(response);

    GM__stylesheet(response.responseText);
  });
}
function name_is_init(name){
  let is = GM__App.is_init,
      result = is.indexOf(name);

  if (result < 0) return false;

  return true;
}

function name_init(name){
  let is = GM__App.is_init;
  if (!name_is_init(name)) {
    is.push(name);
  }
}
function GM__init(){
  if (GM__App.debug.log.group) { console.group('<pinboard-img/>'); name_init('group'); }

  GM__style(GM__App.include[0]);

  if (name_is_init('group')) console.groupEnd();
}


var GM__App = {
  include: [ 'https://pastebin.com/raw/Lrr8D4Ri' ],
  is_init: [],
  debug: { log: {
      group: true,
      response: true
  } }
};


(function(){ GM__init(); })();


jQuery(document).ready(function($){
  $('.bookmark').each(function(){
    let $b = $(this),
        desc = $b.find('.description').get(0),
        post = {
          id:     $b.attr('id'),
          title:  $.trim($b.find('.bookmark_title').text()),
          href:   $b.find('.bookmark_title').attr('href'),
          desc:   $.trim($b.find('.description').text()),
          poster: [],
          tag:    []
        };

    $().add($(desc).find('a[href$=jpg]'))
       .add($(desc).find('a[href$=jpeg]'))
       .add($(desc).find('a[href$=png]'))
       .add($(desc).find('a[href$=gif]')).each(function(){
          let $poster = $('<div/>').addClass('poster-wrapper');

          post.poster.push($(this).attr('href'));

          $('<img/>').attr({ src: post.poster[0] }).appendTo($poster);

          $(this).replaceWith($poster);
    });
  });
});
