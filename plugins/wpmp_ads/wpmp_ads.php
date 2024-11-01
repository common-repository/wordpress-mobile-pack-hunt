<?php

/*

Copyright (c) 2009 HUNT, James Pearce & friends, portions mTLD Top Level Domain Limited, ribot, Forum Nokia

This file is part of the WordPress Mobile Pack.

The WordPress Mobile Pack is Licensed under the Apache License, Version 2.0
(the "License"); you may not use this file except in compliance with the
License.

You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed
under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
CONDITIONS OF ANY KIND, either express or implied. See the License for the
specific language governing permissions and limitations under the License.
*/

/*
Plugin Name: HUNT Mobile Ads
Plugin URI: http://huntmads.com/
Description: Gives a configuration option for HUNT mobile ads.
Version: 1.0
Author: HUNT based on a previous work of James Pearce & friends
Author URI: http://huntmads.com/
*/


add_action('init', 'wpmp_ads_init');
if ( wpmp_switcher_outcome() == WPMP_SWITCHER_MOBILE_PAGE) {
	add_action('wp_footer', 'wpmp_ads_insertion_HUNT_footer');		
} 



function wpmp_ads_init() {
  wp_register_sidebar_widget('wpmp_ads_widget', __('HUNT Mobile Ads', 'wpmp'), 'wpmp_ads_widget',
    array('classname' => 'wpmp_ads_widget', 'description' => __( "Displays HUNT mobile ads", 'wpmp'))
  );
  wp_register_widget_control('wpmp_ads_widget', __('HUNT Mobile Ads', 'wpmp'), 'wpmp_ads_widget_control');
}

function wpmp_ads_activate() {
  foreach(array(
    'wpmp_ads_title'=>__('HUNT Mobile ads', 'wpmp'),
    'wpmp_ads_provider'=>'none',
    'wpmp_ads_publisher_id'=>'',
    'wpmp_ads_hunt_header_id'=>'',
    'wpmp_ads_hunt_footer_id'=>'',
    'wpmp_ads_desktop_disable'=>'true',
    'wpmp_ads_over_18'=>'true',
  ) as $name=>$value) {
    if (get_option($name)=='') {
      update_option($name, $value);
    }
  }
}

function wpmp_ads_deactivate() {}

function wpmp_ads_widget($args) {
  if(get_option('wpmp_ads_desktop_disable') &&
    function_exists('wpmp_switcher_outcome') &&
    wpmp_switcher_outcome() == WPMP_SWITCHER_DESKTOP_PAGE
  ) {
    return;
  }
	if (($provider = get_option('wpmp_ads_provider'))!='' && ($publisher_id = get_option('wpmp_ads_publisher_id'))!='') {
    extract($args);
    $buffer = $before_widget;
    if (($title = get_option('wpmp_ads_title'))=='') {
      $title = __("HUNT Mobile ads", 'wpmp');
    }

    //nice to see them in accordions
    $before_title = str_replace('class="collapsed"', 'class="expanded"', $before_title);
    $after_title = str_replace('style="display: none;"', 'style="display: block;"', $after_title);

    $buffer .= $before_title . $title . $after_title;
    if(strpos($provider, '_')!==false) {
      $provider = explode('_', $provider, 2);
      $format = $provider[1];
      $provider = $provider[0];
    }
    if (function_exists($function = "wpmp_ads_insertion_$provider")) {
      if(($ad =call_user_func($function, $publisher_id, $format))!='') {
        print $buffer;
        print "<ul><li>$ad</li></ul>";
      	print $after_widget;
      }
    }
	}
}

function wpmp_ads_widget_control() {
  if($_POST['wpmp_ads']) {
    wpmp_ads_widget_options_write();
  }
  include('wpmp_ads_widget_admin.php');
}

function wpmp_ads_widget_options_write() {
  foreach(array(
    'wpmp_ads_title'=>false,
    'wpmp_ads_provider'=>false,
    'wpmp_ads_publisher_id'=>false,
  	'wpmp_ads_hunt_header_id'=>false,
	'wpmp_ads_hunt_footer_id'=>false,  
    'wpmp_ads_desktop_disable'=>true,
    'wpmp_ads_over_18'=>true
  ) as $option=>$checkbox) {
    if(isset($_POST[$option])){
      $value = $_POST[$option];
			$value = trim($value);
			$value = stripslashes_deep($value);
      update_option($option, $value);
    } elseif ($checkbox) {
      update_option($option, 'false');
    }
  }
}

function wpmp_ads_option($option, $onchange='', $class='', $style='') {
  // We add 2 variables for showing header and footer id as text fields 
  switch ($option) {
    case 'wpmp_ads_title':
    case 'wpmp_ads_publisher_id':
	case 'wpmp_ads_hunt_header_id':    	
	case 'wpmp_ads_hunt_footer_id':		
      return wpmp_ads_option_text(
        $option, $onchange, $class, $style
      );

    case 'wpmp_ads_provider':
      return wpmp_ads_option_dropdown(
        $option,
        array(
          "none"=>__("None", 'wpmp'),
          "hunt"=>__("HUNT", 'wpmp')
        ),
        $onchange
      );

    case 'wpmp_ads_desktop_disable':
	case 'wpmp_ads_over_18':    	
      return wpmp_ads_option_checkbox(
        $option, $onchange
      );

  }
}

function wpmp_ads_option_text($option, $onchange='', $class='', $style='') {
  if ($onchange!='') {
    $onchange = 'onchange="' . attribute_escape($onchange) . '" onkeyup="' . attribute_escape($onchange) . '"';
  }
  if ($class!='') {
    $class = 'class="' . attribute_escape($class) . '"';
  }
  if ($style!='') {
    $style = 'style="' . attribute_escape($style) . '"';
  }
  $text = '<input type="text" id="' . $option . '" name="' . $option . '" value="' . attribute_escape(get_option($option)) . '" ' . $onchange . ' ' . $class . ' ' . $style . '/>';
  return $text;
}
function wpmp_ads_option_dropdown($option, $options, $onchange='') {
  if ($onchange!='') {
    $onchange = 'onchange="' . attribute_escape($onchange) . '" onkeyup="' . attribute_escape($onchange) . '"';
  }
  $dropdown = "<select id='$option' name='$option' $onchange>";
  foreach($options as $value=>$description) {
    if(get_option($option)==$value) {
      $selected = ' selected="true"';
    } else {
      $selected = '';
    }
    $dropdown .= '<option value="' . attribute_escape($value) . '"' . $selected . '>' . __($description, 'wpmp') . '</option>';
  }
  $dropdown .= "</select>";
  return $dropdown;
}
function wpmp_ads_option_checkbox($option, $onchange='') {
  if ($onchange!='') {
    $onchange = 'onchange="' . attribute_escape($onchange) . '"';
  }
  $checkbox = '<input type="checkbox" id="' . $option . '" name="' . $option . '" value="true" ' . (get_option($option)==='true'?'checked="true"':'') . ' ' . $onchange . ' />';
  return $checkbox;
}


/* The custom made HuntMAds ad insertion function */
function wpmp_ads_insertion_HUNT_footer (){
	echo wpmp_ads_insertion_HUNT( 'footer' ); 
}
function wpmp_ads_insertion_HUNT_header (){
	// esto es redundante
	$ad = wpmp_ads_insertion_HUNT();
}

function wpmp_ads_insertion_HUNT( $location = 'header' )  {
	
	// edit the siteid and zoneid values & copy this snippet elsewhere on your page for display more of ads
	$hunt_params = Array();
	$site_id = get_option('wpmp_ads_publisher_id');
	if ( empty ( $site_id )){
		/* if user give no $site_id, we use default */ 
		$site_id = 9088;
	}
	
	$hunt_params['siteid'] = $site_id;
	
	if ( $location == 'header'){
		// Get user header_id 
		$zone_id = get_option('wpmp_ads_hunt_header_id');
		// If user has not give a  header_id, use default
		if ( empty ($zone_id) ){
			$zone_id = 18353;
		}
	}
	else {
		// Get user footer_id 
		$zone_id = get_option('wpmp_ads_hunt_footer_id');
		// If user has not give a footer_id, use default
		if ( empty ($zone_id) ){
			$zone_id = 18354;
		}		
		
	}
	$hunt_params['zoneid'] = $zone_id; 

	// Does this placement accept adult ads?

	$over_18 = get_option('wpmp_ads_over_18');

	if ( $over_18 == 'true' ){
		$hunt_params['over18'] = '1';
	}
	else {
		$hunt_params['over18'] = '0';
	}
	
	return hunt_ad($hunt_params);

}

function wpmp_ads_http($url) {
  $html = "";
  if($handle = @fopen($url, 'r')) {
    while (!feof($handle)) {
      $html .= fread($handle, 8192);
      $html .= ' --- fopen ';
    }
    fclose($handle);
  } elseif ($handle = @curl_init($url)) {
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
    $html = curl_exec($handle);
    $html .= ' --- curl ';
    curl_close($handle);
  }
  return $html;
}

// change to "live" to disable demo mode and show real ads
define("HUNT_MODE", "live");

function hunt_ad($hunt_params = array())
{
	## Original function provided by Hunt
	
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $ip = (stristr($ua,"opera mini") && array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
        ? trim(end(split(",", $_SERVER['HTTP_X_FORWARDED_FOR'])))
        : $_SERVER['REMOTE_ADDR'];

    // prepare url parameters of request
    $hunt_get  = 'site='.urlencode($hunt_params['siteid']);
    $hunt_get .= '&ip='.urlencode($ip);
    $hunt_get .= '&ua='.urlencode($ua);
    $hunt_get .= '&url='.urlencode(sprintf("http%s://%s%s", (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == TRUE ? "s": ""), $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"]));
    $hunt_get .= '&zone='.urlencode($hunt_params['zoneid']);
    $hunt_get .= '&adstype=3'; // type of ads (1 - text only, 2 - images only, 3 - text + images, 6 - sms)
    $hunt_get .= '&key=1';
    //$hunt_get .= '&lat=1';
    //$hunt_get .= '&long=1';
    $hunt_get .= '&count=1'; // quantity of ads
    $hunt_get .= '&keywords='; // keywords to search ad delimited by commas (not necessary)
    $hunt_get .= '&whitelabel=0'; // filter by whitelabel(0 - all, 1 - only whitelabel, 2 - only non-whitelabel)
    $hunt_get .= '&premium=0'; // filter by premium status (0 - non-premium, 1 - premium only, 2 - both)
    $hunt_get .= '&over_18='.urlencode($hunt_params['over18']); // filter by ad over 18 content (0 or 1 - deny over 18 content , 2 - only over 18 content, 3 - allow all ads including over 18 content)
    $hunt_get .= '&paramBORDER='.urlencode('#000000'); // ads border color
    $hunt_get .= '&paramHEADER='.urlencode('#cccccc'); // header color
    $hunt_get .= '&paramBG='.urlencode('#eeeeee'); // background color
    $hunt_get .= '&paramTEXT='.urlencode('#000000'); // text color
    $hunt_get .= '&paramLINK='.urlencode('#ff0000'); // url color
    
    if(HUNT_MODE == "test") $hunt_get .= '&test=1';

    // send request
    
    /* curl check */
	
    if (function_exists('curl_init') ){
		## this is the cURL version of the adserver function 
	    $sc_headers = array();
	    foreach ($_SERVER as $name => $value) {
	        $sc_headers[] = "CS_$name: $value";
	    }
	
	    $url="http://ads.huntmad.com:80/ad?".$hunt_get;
	    $timeout=3; //timeout in seconds
	    $ch  = curl_init($url);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_HTTPHEADERS, array('Content-Type: application/json') );
	    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $sc_headers);
	    $html=@curl_exec($ch);
	    @curl_close($ch);
	    if($html!==false) return $html;
	    else return "";    	
    }
    else {
    	## This is standard mode when cURL is not present
    
	    $hunt_request = @fsockopen('ads.huntmad.com', 80, $errno, $errstr, 1);
	    if ($hunt_request) {
	        stream_set_timeout($hunt_request, 3000);
	        fwrite($hunt_request, "GET /ad?".$hunt_get." HTTP/1.0\r\n");
	        fwrite($hunt_request, "Host: ads.huntmad.com\r\n");
	        fwrite($hunt_request, "Connection: Close\r\n");
	
	        foreach ($_SERVER as $name => $value) {
	            fwrite($hunt_request, "CS_$name: $value\r\n");
	        }
	
	        fwrite($hunt_request, "\r\n");
	        $hunt_info = stream_get_meta_data($hunt_request);
	        $hunt_timeout = $hunt_info['timed_out'];
	        $hunt_contents = "";
	        $hunt_body = false;
	        $hunt_head = "";
	        while (!feof($hunt_request) && !$hunt_timeout) {
	            $hunt_line = fgets($hunt_request);
	            if(!$hunt_body && $hunt_line == "\r\n") $hunt_body = true;
	            if(!$hunt_body) $hunt_head .= $hunt_line;
	            if($hunt_body && !empty($hunt_line)) $hunt_contents .= $hunt_line;
	            $hunt_info = stream_get_meta_data($hunt_request);
	            $hunt_timeout = $hunt_info['timed_out'];
	        }
	
	        fclose($hunt_request);
	        if (!preg_match('/^HTTP\/1\.\d 200 OK/', $hunt_head)) $hunt_timeout = true;
	        if($hunt_timeout) return "";
	        
	        return $hunt_contents;
	    }
    }
    
}

?>
