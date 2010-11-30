<?php

// JCART v1.2
// http://conceptlogic.com/jcart/

// INCLUDE CONFIG SO THIS SCRIPT HAS ACCESS USER FIELD NAMES
require_once('jcart-config.php');

// INCLUDE DEFAULT VALUES SINCE WE NEED TO PASS THE VALUE OF THE UPDATE BUTTON BACK TO jcart.php IF UPDATING AN ITEM QTY
// IF NO VALUE IS SET IN CONFIG, THERE MUST BE A DEFAULT VALUE SINCE SIMPLY CHECKING FOR THE VAR ITSELF FAILS
require_once('jcart-defaults.php');

// OUTPUT PHP FILE AS JAVASCRIPT
header('content-type:application/x-javascript');

// PREVENT CACHING
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

// CONTINUE THE SESSION
session_start();

?>
$(function(){(function(d){d.fn.jcartTooltip=function(a,q){a=d.extend({content:null,follow:true,auto:true,fadeIn:0,fadeOut:0,appendTip:document.body,offsetY:25,offsetX:-10,style:{},id:'jcart-tooltip'},a||{});if(!a.style&&typeof a.style!="object"){a.style={};a.style.zIndex="1000"}else{a.style=d.extend({},a.style||{})}a.style.display="none";a.style.position="absolute";var n={};var o=false;var f=document.createElement('div');f.id=a.id;for(var m in a.style){f.style[m]=a.style[m]}function fillTooltip(b){if(b){d(f).html(a.content)}}fillTooltip(a.content&&!a.ajax);d(f).appendTo(a.appendTip);return this.each(function(){this.onclick=function(c){function e(){var b;if(a.content){b="block"}else{b="none"}if(b=="block"&&a.fadeIn){d(f).fadeIn(a.fadeIn);setTimeout(function(){d(f).fadeOut(a.fadeOut)},1000)}}e()};this.onmousemove=function(b){var c=(b)?b:window.event;n=this;if(a.follow){var e=d(window).scrollTop();var g=d(window).scrollLeft();var h=c.clientY+e+a.offsetY;var i=c.clientX+g+a.offsetX;var k=d(window).width()+g-d(f).outerWidth();var l=d(window).height()+e-d(f).outerHeight();o=(h>l||i>k)?true:false;if(i-g<=0&&a.offsetX<0){i=g}else if(i>k){i=k}if(h-e<=0&&a.offsetY<0){h=e}else if(h>l){h=l}f.style.top=h+"px";f.style.left=i+"px"}};this.onmouseout=function(){d(f).css('display','none')}})}})(jQuery);$('.jcart input[name="<?php echo $jcart['item_add'];?>"]').jcartTooltip({content:'<?php echo $jcart['text']['item_added_message'];?>',fadeIn:500,fadeOut:350});var p=$('td.jcart-item-qty').html();if(p===null){$('#jcart-paypal-checkout').attr('disabled','disabled')}$('.jcart-hide').remove();var j=$('#jcart-is-checkout').val();if(j!=='true'){j='false'}$('form.jcart').submit(function(){var c=$(this).find('input[name=<?php echo $jcart['item_id']?>]').val();var e=$(this).find('input[name=<?php echo $jcart['item_price']?>]').val();var g=$(this).find('input[name=<?php echo $jcart['item_name']?>]').val();var h=$(this).find('input[name=<?php echo $jcart['item_qty']?>]').val();var i=$(this).find('input[name=<?php echo $jcart['item_add']?>]').val();$.post('<?php echo $jcart['path'];?>jcart-relay.php',{"<?php echo $jcart['item_id']?>":c,"<?php echo $jcart['item_price']?>":e,"<?php echo $jcart['item_name']?>":g,"<?php echo $jcart['item_qty']?>":h,"<?php echo $jcart['item_add']?>":i,"jcart_token":$('[name=jcart_token]').val()},function(b){$('#jcart').html(b);$('.jcart-hide').remove()});return false});$('#jcart').keydown(function(b){if(b.which==13){return false}});$('#jcart a').live('click',function(){var c=$(this).attr('href');c=c.split('=');var e=c[1];$.get('<?php echo $jcart['path'];?>jcart-relay.php',{"jcart_remove":e,"jcart_is_checkout":j},function(b){$('#jcart').html(b);$('.jcart-hide').remove()});return false});$('#jcart input[type="text"]').live('keyup',function(){var c=$(this).attr('id');c=c.split('-');c=c[3];var e=$(this).val();if(e!==''){var g=setTimeout(function(){$.post('<?php echo $jcart['path'];?>jcart-relay.php',{"item_id":c,"item_qty":e,"jcart_update_item":'<?php echo $jcart['text']['update_button'];?>',"jcart_is_checkout":j,"jcart_token":$('[name=jcart_token]').val()},function(b){$('#jcart').html(b);$('.jcart-hide').remove()})},1000)}$(this).keydown(function(){window.clearTimeout(g)})})});
