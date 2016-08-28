<?php
//============================================================+
// File name   : tce_page_header.php
// Begin       : 2001-09-18
// Last Update : 2010-09-20
//
// Description : Outputs default XHTML page header.
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//
// License:
//    Copyright (C) 2004-2010  Nicola Asuni - Tecnick.com LTD
//    See LICENSE.TXT file for more information.
//============================================================+

/**
 * @file
 * Outputs default XHTML page header.
 * @package com.tecnick.tcexam.public
 * @author Nicola Asuni
 * @since 2001-09-18
 */

/**
 */

require_once('tce_xhtml_header.php');

// display header (image logo + timer)
echo '<div class="header">'.K_NEWLINE;
echo '<div class="left"></div>'.K_NEWLINE;
echo '<div class="right">'.K_NEWLINE;
echo '<a name="timersection" id="timersection"></a>'.K_NEWLINE;
include('../../shared/code/tce_page_timer.php');
echo '</div>'.K_NEWLINE;
echo '</div>'.K_NEWLINE;

// display menu
echo '<div id="scrollayer" class="scrollmenu">'.K_NEWLINE;
// CSS changes for old browsers
echo '<!--[if lte IE 7]>'.K_NEWLINE;
echo '<style type="text/css">'.K_NEWLINE;
echo 'ul.menu li {text-align:left;behavior:url("../../shared/jscripts/IEmen.htc");}'.K_NEWLINE;
echo 'ul.menu ul {background-color:#003399;margin:0;padding:0;display:none;position:absolute;top:20px;left:0px;}'.K_NEWLINE;
echo 'ul.menu ul li {width:200px;text-align:left;margin:0;}'.K_NEWLINE;
echo 'ul.menu ul ul {display:none;position:absolute;top:0px;left:190px;}'.K_NEWLINE;
echo '</style>'.K_NEWLINE;
echo '<![endif]-->'.K_NEWLINE;
require_once(dirname(__FILE__).'/tce_page_menu.php');
echo '</div>'.K_NEWLINE;

echo '<div class="body">'.K_NEWLINE;

echo '<a name="topofdoc" id="topofdoc"></a>'.K_NEWLINE;
//echo '<h1 class="heading-text">'.htmlspecialchars($thispage_title, ENT_NOQUOTES, $l['a_meta_charset']).'</h1>'.K_NEWLINE;

//============================================================+
// END OF FILE
//============================================================+
?>
<script>
    $(document).ready(function(){
   
       // $('#numBox').click(function(){
        $('#keypad').fadeToggle('fast');
        event.stopPropagation();
  //  });
    
    
  
    $('.key').click(function(){
        var numBox = document.getElementById('answertext');
//        if(this.innerHTML == '0'){
//            if (numBox.value.length > 0 && numBox.value.length<11)
//                numBox.value = numBox.value + this.innerHTML;
//        }
//        else 
      if(numBox.value.length<11){
        if(this.innerHTML == '-'){
            if (numBox.value.length == 0)
                numBox.value = numBox.value + this.innerHTML;
        }
        else if(this.innerHTML == '.'){
            console.log(numBox.value.indexOf('-'));
            if(numBox.value.length == 1){                
            }else{
                if(numBox.value.indexOf('.') == -1)
                 numBox.value = numBox.value + this.innerHTML;
            }
        }
        else{
        
            numBox.value = numBox.value + this.innerHTML;
        }
    }
        event.stopPropagation();
    });
    
    $('.btn').click(function(){
          var numBox = document.getElementById('answertext');
        if(this.innerHTML == 'Backspace'){           
            if(numBox.value.length > 0){
                numBox.value = numBox.value.substring(0, numBox.value.length - 1);
            }
        }
        else if(this.innerHTML == '←'){
          var current_position = numBox.value.slice(0, numBox.selectionStart).length;
          if(current_position != 0){
              numBox.setSelectionRange(current_position-1,current_position-1);
          }
           numBox.focus();
        }
        else if(this.innerHTML == '→'){
           var current_position = numBox.value.slice(0, numBox.selectionStart).length;
           
           if(current_position != numBox.value.length){
              numBox.setSelectionRange(current_position+1,current_position+1);
          }
           numBox.focus();
        }
        else{
            document.getElementById('answertext').value = '';
        }
        
        event.stopPropagation();
    });
    });
    
    function validateNumeric(e) {        
    if (!e) var e = window.event;
    if (!e.which) keyPressed = e.keyCode;
    else keyPressed = e.which;
   
    if ((keyPressed >= 48 && keyPressed <= 57) ||keyPressed == 45 || keyPressed == 46 || keyPressed == 8 || keyPressed == 9 || (keyPressed > 37 && keyPressed <= 40)) {
      keyPressed = keyPressed;
      var text = $("#answertext").val();
      if(keyPressed ==  46){
         if(text.indexOf(".") > -1){
              return false;
          }
      }
    
       if(keyPressed ==  45){             
             if(text.length == 0){
              return true;
            }else{
                return false;
            }
        }
        if(keyPressed ==  46){             
             if(text.length == 0){
              return true;
            }else{
             if(text.length==1){
                if(text.indexOf("-") == "0"){
                        return false;
                  }
                 }
                return true;
            }
        }
      return true;
    } else {
      keyPressed = 0;
      return false;
    }
  }
  
</script>