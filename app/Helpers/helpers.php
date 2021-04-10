<?php


// svg colors
if (!function_exists('help_svg_link')) {
    function help_svg_link(){ 
          return 'inline-block text-gray-600 hover:text-gray-400 p-1 rounded-full shadow';
    }
}

// svg_icon_show
if (!function_exists('help_svg_icon_show')) {
    function help_svg_icon_show(){ 
          return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>';
    }
}

// svg_icon_edit
if (!function_exists('help_svg_icon_edit')) {
    function help_svg_icon_edit(){ 
          return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>';
    }
}

// svg_icon_pause
if (!function_exists('help_svg_icon_pause')) {
    function help_svg_icon_pause(){ 
          return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
    }
}


// DATE

// MESI
if (!function_exists('help_mesi_array')) {
    function help_mesi_array(){ 
        return [ 1 =>'Gennaio', 2 =>'Febbraio', 3 =>'Marzo', 4 =>'Aprile', 5=> 'Maggio', 6 =>'Giugno', 7=>'Luglio', 8=>'Agosto', 9=>'Settembre', 10=>'Ottobre', 11=>'Novembre', 12=>'Dicembre'];
    }
}



