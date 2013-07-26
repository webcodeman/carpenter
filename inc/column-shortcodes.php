<?php
/*
Shortcodes File
Author : Kashif
*/
if ( !function_exists('hmk_formatter') ) :

function hmk_formatter($content) {
	$new_content = '';
	
	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {
			
			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {
			
			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));		
		}
	}
	
	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'hmk_formatter', 99);
add_filter('widget_text', 'hmk_formatter', 99);

endif;




/**
 * Columns Shortcodes
 *
 */
function hmk_one_third( $atts, $content = null ) {
   return '<div class="columns column_3">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'hmk_one_third');

function hmk_one_third_last( $atts, $content = null ) {
   return '<div class="columns column_3 last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'hmk_one_third_last');


function hmk_one_half( $atts, $content = null ) {
   return '<div class="columns column_2"><p>' . do_shortcode($content) . '</p></div>';
}
add_shortcode('one_half', 'hmk_one_half');

function hmk_one_half_last( $atts, $content = null ) {
   return '<div class="columns column_2 last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'hmk_one_half_last');


?>