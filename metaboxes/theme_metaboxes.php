<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */





/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = 'hmk_';
global $meta_boxes;
$meta_boxes = array();



$meta_boxes[] = array(
	'id' => 'gallery_setting',
	'title' => __('Gallery Setting', 'hmk'),
	'pages' => array('post'),

	'fields' => array(
	

		array(
			'name' => __('Upload The Images', 'hmk'),
			'id' => $prefix . 'slideshow_imgs',
			'class' => 'slideshow_img',
			'type' => 'plupload_image',
			'std' => ''

		),

	)
);
$meta_boxes[] = array(
	'id' => 'quote_setting',
	'title' => __('Quote Setting', 'hmk'),
	'pages' => array('post'),

	'fields' => array(
	

		array(
			'name' => __('The Quote', 'hmk'),
			'id' => $prefix . 'quote',
			'desc' => 'Write your quote in this field.',
			'type' => 'textarea',
			'std' => ''

		),

	)
);

$meta_boxes[] = array(
	'id' => 'image_setting',
	'title' => __('Image Setting', 'hmk'),
	'pages' => array('post'),

	'fields' => array(
	

		array(
			'name' => __('Enable Lightbox', 'hmk'),
			'id' => $prefix . 'lightbox',
			"desc" => __('Check this to enable the lightbox.', 'hmk'),
			'type' => 'checkbox',
			'std' => false,
		),

	)
);

$meta_boxes[] = array(
	'id' => 'link_setting',
	'title' => __('Link Setting', 'hmk'),
	'pages' => array('post'),

	'fields' => array(
	

		array(
			'name' => __('The URL', 'hmk'),
			'id' => $prefix . 'link_url',
			"desc" => __('Check this to enable the lightbox.', 'hmk'),
			'type' => 'text',
			'std' => '',
		),

	)
);





$meta_boxes[] = array(
	'id' => 'project_images',
	'title' => __('Project', 'hmk'),
	'pages' => array('portfolio'),

	'fields' => array(
	
		array(
			
			'name'  => 'Project Sub Title',
			'id'    => $prefix . "project_sub_title",
			'desc'  => 'Project Sub Title',
			'type'  => 'text',
			'std'   => '',
		),
		
		
		array(			
			'name'  => 'Site',
			'id'    => $prefix . "project_site",
			'desc'  => 'Site',
			'type'  => 'text',
			'std'   => '',
		),
		
		array(			
			'name'  => 'Designer',
			'id'    => $prefix . "project_designer",
			'desc'  => 'Designer',
			'type'  => 'text',
			'std'   => '',
		),
		
		
		array(			
			'name'  => 'Fabricated',
			'id'    => $prefix . "project_fabricated",
			'desc'  => 'Fabricated',
			'type'  => 'textarea',
			'std'   => '',
		),
		
		array(			
			'name'  => 'Photography',
			'id'    => $prefix . "project_photography",
			'desc'  => 'Photography',
			'type'  => 'text',
			'std'   => '',
		),
			
	
		array(
			'name' => __('Upload Gallery Images', 'hmk'),
			'id' => $prefix . 'project_imgs',
			'class' => 'project_img',
			'type' => 'plupload_image',
			'std' => ''

		),
		
		
		

	)
	
);

$meta_boxes[] = array(
	'id' => 'testimonial_info',
	'title' => __('Testimonial Information', 'hmk'),
	'pages' => array('testimonial'),

	'fields' => array(
	
	
	
		
		array(
			
			'name'  => 'Author',
			'id'    => $prefix . "testimonial_author",
			'desc'  => 'Name of the testimonial author.',
			'type'  => 'text',
			'std'   => '',
		),
		
		array(
			
			'name'  => 'Author Company',
			'id'    => $prefix . "testimonial_company",
			'desc'  => 'Author Wesite or Facebook Account , etc.',
			'type'  => 'text',
			'std'   => '',
		),
		array(
			
			'name'  => 'Testimonial',
			'id'    => $prefix . "testimonial_content",
			'desc'  => 'The content of the testimonial.',
			'type'  => 'textarea',
			'std'   => '',
		),

		

		
		

	)
	
);



/**
 * Register meta boxes
 *
 * @return void
 */
function hmk_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'hmk_register_meta_boxes' );
?>
