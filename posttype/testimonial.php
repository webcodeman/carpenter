<?php 
	register_post_type( 'testimonial',
		array(
		  'labels' => array(
			'name' => __( 'Testimonial', 'hmk' ),
			'singular_name' => __( 'Testimonial', 'hmk' ),		
			'add_new' => _x( 'Add New', 'testimonial', 'hmk' ),
			'add_new_item' => __( 'Add New Testimonial', 'hmk' ),
			'edit_item' => __( 'Edit Testimonial ', 'hmk' ),
			'new_item' => __( 'New Testimonial ', 'hmk' ),
			'view_item' => __( 'View Testimonials ', 'hmk' ),
			'search_items' => __( 'Search Testimonials Item', 'hmk' ),
			'not_found' =>  __( 'No Testimonials found', 'hmk' ),
			'not_found_in_trash' => __( 'No Testimonials Item found in Trash', 'hmk' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title'),
		  'public' => true,
		  'show_ui' => true,
		  'exclude_from_search'  => true,
		  'capability_type' => 'post',
		  'hierarchical' => false,
		  'menu_position' => 5,
		  'rewrite' => true,
		  'query_var' => false,
		  'rewrite' => array( 'slug' => 'testimonial' ),

		)
	  );
	 


						



function hmk_testimonial_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-testimonial .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/images/testimonial-icon.png) no-repeat 7px 7px !important;
        }
		#menu-posts-testimonial:hover .wp-menu-image, 
		#menu-posts-testimonial.wp-has-current-submenu .wp-menu-image {
            background-position:7px -15px !important;
        }
		#icon-edit.icon32-posts-testimonial {
		    background: url(<?php echo get_template_directory_uri(); ?>/images/testimonial-32x32.png) no-repeat 0 -0px;
		}
		#icon-edit.icon32-posts-testimonial {
		    background: url(<?php echo get_template_directory_uri(); ?>/images/testimonial-32x32.png) no-repeat 0 -0px;
		}
    </style>
<?php }


add_action( 'admin_head', 'hmk_testimonial_icons' );
	
function hmk_edit_columns_testimonial($testimonial_columns){  
	$testimonial_columns = array(  
		'cb' => '<input type="checkbox" />',  
		'title' => _x( 'Title', 'hmk', 'column name' ),
		'authorname' => __( 'Author', 'hmk' )
		
		
	);  
	
	return $testimonial_columns;  
}  
add_filter('manage_edit-testimonial_columns', 'hmk_edit_columns_testimonial');  
  
function hmk_custom_columns_testimonial($testimonial_columns, $post_id){  

	switch ($testimonial_columns) {
		case 'authorname':
			$authorname = get_post_meta( $post_id, 'hmk_testimonial_author', true );
			
	           echo $authorname;
	      
		break;
		
	    case 'testimonialavatar':
	        $author_avatar = get_post_meta( $post_id, 'hmk_testimonial_gravatar', true );
	        
	       
	        
	      
	         echo    get_avatar(  $author_avatar , '48' );
	       

	        break;
	        
		
	}  
}  
add_action('manage_posts_custom_column',  'hmk_custom_columns_testimonial', 10, 2);  







?>