<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframeproject_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframeproject_settings = get_option( 'optionsframework' );
	$optionsframeproject_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframeproject_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_frameproject_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframeproject_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_frameproject_theme'),
		'two' => __('Two', 'options_frameproject_theme'),
		'three' => __('Three', 'options_frameproject_theme'),
		'four' => __('Four', 'options_frameproject_theme'),
		'five' => __('Five', 'options_frameproject_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_frameproject_theme'),
		'two' => __('Pancake', 'options_frameproject_theme'),
		'three' => __('Omelette', 'options_frameproject_theme'),
		'four' => __('Crepe', 'options_frameproject_theme'),
		'five' => __('Waffle', 'options_frameproject_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('General Settings', 'options_frameproject_theme'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Logo Upload', 'options_frameproject_theme'),
		'desc' => __('Logo Upload.', 'options_frameproject_theme'),
		'id' => 'hmk_logo',
		'type' => 'upload');
	
			
	$options[] = array(
		'name' => __('Copyright Text', 'options_frameproject_theme'),
		'desc' => __('Copyright Text.', 'options_frameproject_theme'),
		'id' => 'hmk_copyright',
		'type' => 'textarea');
	
	$wp_editor_settings = array(
		'wpautop' => false, // Default
		'textarea_rows' => 8,
		'quicktags' => false,
		'tinymce' => false
	);

	$options[] = array(
		'name' => __('Google Analytics Code', 'options_frameproject_theme'),
		'desc' =>'',
		'id' => 'google_analytics',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
	
	$options[] = array(
		'name' => __('Homepage', 'options_frameproject_theme'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Homepage Text', 'options_frameproject_theme'),
		'desc' => __('Homepage Text Below Slider.', 'options_frameproject_theme'),
		'id' => 'hmk_home_text',
		'std' => 'Quality is never an accident; it is always the result of high intentions, sincere effort, intelligent direction and skillful execution; It represents the wise choice of many alternatives" William A. Foster.',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => __('Homepage Feature Boxes', 'options_frameproject_theme'),
		'desc' => __('', 'options_frameproject_theme'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Featured Box 1 Image', 'options_frameproject_theme'),
		'desc' => __('Logo Upload.', 'options_frameproject_theme'),
		'id' => 'home_feature1_img',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Featured Box 1 Page', 'options_frameproject_theme'),
		'desc' => __('Featured Box 1 Links to this page', 'options_frameproject_theme'),
		'id' => 'home_feature1_link',
		'type' => 'select',
		'std' => '#',
		'class' => 'mini',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => __('Featured Box 2 Image', 'options_frameproject_theme'),
		'desc' => __('Logo Upload.', 'options_frameproject_theme'),
		'id' => 'home_feature2_img',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Featured Box 2 Page', 'options_frameproject_theme'),
		'desc' => __('Featured Box 2 Links to this page', 'options_frameproject_theme'),
		'id' => 'home_feature2_link',
		'type' => 'select',
		'std' => '#',
		'class' => 'mini',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => __('Social', 'options_frameproject_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Facebook Url', 'options_frameproject_theme'),
		'desc' => __('Facebook Url.', 'options_frameproject_theme'),
		'id' => 'hmk_facebook_url',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter Url', 'options_frameproject_theme'),
		'desc' => __('Twitter Url.', 'options_frameproject_theme'),
		'id' => 'hmk_twitter_url',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Linkedin Url', 'options_frameproject_theme'),
		'desc' => __('Linkedin Url.', 'options_frameproject_theme'),
		'id' => 'hmk_linkedin_url',
		'std' => '#',
		'type' => 'text');
	
	
	return $options;
}