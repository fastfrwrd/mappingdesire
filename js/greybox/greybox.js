/* Greybox Redux
 * Required: http://jquery.com/
 * Written by: John Resig
 * Based on code by: 4mir Salihefendic (http://amix.dk)
 * License: LGPL (read more in LGPL.txt)
 */

var GB_DONE = false;
var GB_HEIGHT = 400;
var GB_WIDTH = 400;

function GB_show(caption, url, height, width) {
  if($("#GB_window")) {
 	 $("#GB_window").empty();
 	 $("#GB_window").append("<div id='GB_caption'></div>");
  }
  GB_HEIGHT = height || 400;
  GB_WIDTH = width || 400;
  if(!GB_DONE) {
    $(document.body)
      .append("<div id='GB_overlay'></div><div id='GB_window'><div id='GB_caption'></div>"
        + "</div>");
		
    $(window).resize(GB_position);
    GB_DONE = true;
  }
  $("#GB_window").append("<iframe name='GB_frame' id='GB_frame' src='"+url+"'></iframe>");
  if (url=="js/bios.php") {
  	
  	var html = caption + '<img onClick="parent.GB_hide();" src="images/close.gif" />';
  }
  else {
  	if ($.browser.msie || $.browser.webkit || $.browser.safari) {
    	var html = caption + '<img onClick="GB_frame.soundManager.stop(\'player\'); parent.closeFunction(); parent.GB_hide();" src="images/close.gif" />';
  	}
  	else {
    	var html = caption + '<img onClick="soundManager.stop(\'player\'); parent.closeFunction(); parent.GB_hide();" src="images/close.gif" />';
  	}
  }
  $("#GB_caption").html(html);
  $("#GB_overlay").fadeIn(400);
  GB_position();
  $("#GB_window").fadeIn(400);
}
function GB_hide() {
	$("#GB_window,#GB_overlay").fadeOut(150);
}
function GB_position() {
  var de = document.documentElement;
  var w = self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
  $("#GB_window").css({width:GB_WIDTH+"px",height:GB_HEIGHT+"px",
    left: ((w - GB_WIDTH)/2)+"px" });
  $("#GB_frame").css("height",GB_HEIGHT - 32 +"px");
}