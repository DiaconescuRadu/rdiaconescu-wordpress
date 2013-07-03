/*
 * Add HTML markup for the switched
 */

var html = '';
html += '<div id="skin-switcher">';
html += '  <ul id="skin-list">';
html += '    <li id="head_width" class="skin-item" data-skin="black"><strong>Header width:</strong><br /><span id="head_txt">Full</span></li>';
//html += '    <li id="head_style" class="skin-item" data-skin="black"><strong>Header style:</strong><br /><span id="head_style_txt">Scroll</span></li>';
html += '    <li id="page_title" class="skin-item" data-skin="black"><strong>Page Title Width:</strong><br /><span id="page_title_txt">Fixed</span></li>';
html += '    <li id="footer_width" class="skin-item" data-skin="black"><strong>Footer Width:</strong><br /><span id="footer_width_txt">Full</span></li>';
html += '    <li id="boxed_lyout" class="skin-item" data-skin="black"><strong>Boxed Layout:</strong><br /><span id="boxed_lyout_txt">Disabled</span></li>';
html += '    <li class="skin-item" data-skin="black" style="white-space: nowrap"><strong>Site background</strong><br /><div id="colorSelector"><div style="background-color: #FFFFFF"></div></div></li>';
html += '  </ul>';
html += '  <div id="switcher-toggle"><div class="icon-toggle"></div></div>';
html += '</div>';

/*
 * Manage Cookies with jQuery – http://www.quirksmode.org/js/cookies.html
 */

function createCookie(name,value,days) {
if (days) {
	var date = new Date();
	date.setTime(date.getTime()+(days*24*60*60*1000));
	var expires = "; expires="+date.toGMTString();
}
else var expires = "";
document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
var nameEQ = name + "=";
var ca = document.cookie.split(';');
for(var i=0;i < ca.length;i++) {
	var c = ca[i];
	while (c.charAt(0)==' ') c = c.substring(1,c.length);
	if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
}
return null;
}

function eraseCookie(name) {
createCookie(name,"",-1);
}



$(document).ready(function(){

$("body").append(html);

$("#head_width").click(function() {
//    $("#head_width").toggleClass("active-skin");
    $("header").toggleClass("fixed-width");
        if (readCookie("head_txt") != null) {
            eraseCookie("head_txt");
        } else {
            createCookie("head_txt", 'set');
        }
    if($('#head_txt').text()!="Fixed"){
        $('#head_txt').text('Fixed');
    }else{
        $('#head_txt').text('Full');
    }
  });
  if (readCookie("head_txt") != null) {
//    $("#head_width").attr("class","skin-item active-skin");
    $('#head_txt').text('Fixed');
    $("header").toggleClass("fixed-width");
}



$("#page_title").click(function() {
//    $("#page_title").toggleClass("active-skin");
    $(".page-title-wrapper").toggleClass("fixed-width");
        if (readCookie("page_title_txt") != null) {
            eraseCookie("page_title_txt");
        } else {
            createCookie("page_title_txt", 'set');
        }
    if($('#page_title_txt').text()!="Full"){
        $('#page_title_txt').text('Full');
    }else{
        $('#page_title_txt').text('Fixed');
    }
  });
  if (readCookie("page_title_txt") != null) {
//    $("#page_title").attr("class","skin-item active-skin");
    $('#page_title_txt').text('Full');
    $(".page-title-wrapper").toggleClass("fixed-width");
}



$("#footer_width").click(function() {
//    $("#footer_width").toggleClass("active-skin");
    $("#page-footer").toggleClass("fixed-width");
        if (readCookie("footer_width_txt") != null) {
            eraseCookie("footer_width_txt");
        } else {
            createCookie("footer_width_txt", 'set');
        }
    if($('#footer_width_txt').text()!="Fixed"){
        $('#footer_width_txt').text('Fixed');
    }else{
        $('#footer_width_txt').text('Full');
    }
  });
  if (readCookie("footer_width_txt") != null) {
//    $("#footer_width").attr("class","skin-item active-skin");
    $('#footer_width_txt').text('Fixed');
    $("#page-footer").toggleClass("fixed-width");
}



$("#boxed_lyout").click(function() {
//    $("#boxed_lyout").toggleClass("active-skin");


var $myDiv = $('#boxed-layout');

    if ( $myDiv.length){
            $("body > :first-child").attr('id','');
            $("body").attr('id','');
        } else {
            $("body > :first-child").attr('id','boxed-layout');
            $("body").attr('id','box');
        }

        if (readCookie("boxed_lyout_txt") != null) {
            eraseCookie("boxed_lyout_txt");
        } else {
            createCookie("boxed_lyout_txt", 'set');
        }
    if($('#boxed_lyout_txt').text()!="Enabled"){
        $('#boxed_lyout_txt').text('Enabled');
    }else{
        $('#boxed_lyout_txt').text('Disabled');
    }
  });
  if (readCookie("boxed_lyout_txt") != null) {
//    $("#boxed_lyout").attr("class","skin-item active-skin");
    $('#boxed_lyout_txt').text('Enabled');
    $("body > :first-child").attr('id','boxed-layout');
    $("body").attr('id','box');
}




  // Clicking skin switcher toggle
  $('#switcher-toggle').click(function() {
    if (readCookie("switcher") != null) {
      $('#skin-switcher').animate({left: "0"}, 500);
      $('#switcher-toggle .icon-toggle').css({'transform': 'rotate(180deg)'});
      eraseCookie("switcher");
    } else {
      $('#skin-switcher').animate({left: "-118px"}, 500);
      $('#switcher-toggle .icon-toggle').css({'transform': 'rotate(0deg)'});
      createCookie("switcher",true);
    }
  });

  // Check innitial switcher visibility cookie
  if (readCookie("switcher") != null) {
    $('#skin-switcher').css({left: "-118px"});
    $('#switcher-toggle .icon-toggle').css({'transform': 'rotate(0deg)'});
  } else {
    $('#switcher-toggle .icon-toggle').css({'transform': 'rotate(180deg)'});
  }

});