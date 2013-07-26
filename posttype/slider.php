<?php 
	register_post_type( 'Slider',
		array(
		  'labels' => array(
			'name' => __( 'Slider', 'hmk' ),
			'singular_name' => __( 'Slide', 'hmk' ),		
			'add_new' => _x( 'Add New', 'Slider', 'hmk' ),
			'add_new_item' => __( 'Add New Slide', 'hmk' ),
			'edit_item' => __( 'Edit Slide ', 'hmk' ),
			'new_item' => __( 'New Slide ', 'hmk' ),
			'view_item' => __( 'View Slides ', 'hmk' ),
			'search_items' => __( 'Search Slide Item', 'hmk' ),
			'not_found' =>  __( 'No Slides found', 'hmk' ),
			'not_found_in_trash' => __( 'No Slides Item found in Trash', 'hmk' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title','thumbnail'),
		  'public' => true,
		  'show_ui' => true,
		  'capability_type' => 'post',
		  'hierarchical' => false,
		  'exclude_from_search'  => true,
		  'rewrite' => true,
		  'query_var' => false,
		  'rewrite' => array( 'slug' => 'slider' ),

		)
	  );
	  add_action( 'init', 'builds_taxonomies', 0 ); 
	 


						



function hmk_slider_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-slider .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/images/slider-icon.png) no-repeat 7px 7px !important;
        }
		#menu-posts-slider:hover .wp-menu-image, 
		#menu-posts-slider.wp-has-current-submenu .wp-menu-image {
            background-position:7px -15px !important;
        }
		#icon-edit.icon32-posts-slider {
		    background: url(<?php echo get_template_directory_uri(); ?>/images/slider-32x32.png) no-repeat 0 -0px;
		}
		#icon-edit.icon32-posts-slider {
		    background: url(<?php echo get_template_directory_uri(); ?>/images/slider-32x32.png) no-repeat 0 -0px;
		}
    </style>
<?php }


add_action( 'admin_head', 'hmk_slider_icons' );
	
 
  
function hmk_custom_columns_slider($slider_columns, $post_id){  

	switch ($slider_columns) {
		
			case 'sliderstype':  
			echo get_the_term_list( $post_id, 'slider-type', '', ', ', '' );
			break;
			
			
	    case 'sliderthumbnail':
	        $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
	        
	        if( $thumbnail_id ) {
	            $thumb = wp_get_attachment_image( $thumbnail_id, 'slider-admin-thumb', true );
	        }
	        
	        if( isset($thumb) ) {
	            echo $thumb;
	        } else {
	            echo __('None', 'hmk');
	        }
	        
	        break;
			
			
	        
		case 'slideActive':
			
			$activeslide =  get_post_meta( $post_id, 'hmk_slide_active', true);
			if( $activeslide == 'slideactive' ) {
	            echo 'Active';
	        }  elseif($activeslide == 'slidenotactive')  {
			
			echo 'Not Active';
			}
		break;
	}  
}  
add_action('manage_posts_custom_column',  'hmk_custom_columns_slider', 10, 2);  







?>