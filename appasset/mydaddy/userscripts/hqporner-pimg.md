HQPorner 🅿️ \<pimg\/\>
======================

```javascript
javascript:(function(){function callback(){var head = $('head')[0],poster_stylesheet = {position: "relative",width: "100%",'max-width': "100%",display: "block"};$('<link/>').attr({href: 'http://hq.appasset.ru/assets/bookmarklets/pinboard-img/pinboard-main.css',type: 'text/css',rel: 'stylesheet'}).appendTo(head);$(".bookmark").each(function () {var $poster = $();$.each(["jpg", "jpeg", "png", "gif", 'GIF'], function (i, ext) {$poster = $poster.add($("#bookmarks%22).find(%22.description%22).find(%22a[href$=%22%20+%20ext%20+%20%22]%22));});$poster.each(function%20()%20{var%20$wrapper%20=%20$(%22%3Cdiv/%3E%22).addClass(%22poster-wrapper%22);$(%22%3Cimg/%3E%22).attr({src:%20$(this).attr(%22href%22)}).css(poster_stylesheet).appendTo($wrapper);$(this).replaceWith($wrapper);$wrapper.css(poster_stylesheet);});$().add('.user_navbar').add('.star').addClass('hide');})}var%20s=document.createElement(%22script%22);s.src=%22https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js%22;if(s.addEventListener){s.addEventListener(%22load%22,callback,false)}else%20if(s.readyState){s.onreadystatechange=callback}document.body.appendChild(s);})()
```

* * *

[github][s]

[s]: https://github.com/appasset/profile/blob/main/bookmarklets/hqporner-pimg.md