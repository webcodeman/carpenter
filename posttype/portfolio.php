<?php 
	register_post_type( 'portfolio',
		array(
		  'labels' => array(
			'name' => __( 'Portfolio', 'hmk' ),
			'singular_name' => __( 'Project', 'hmk' ),		
			'add_new' => _x( 'Add New', 'portfolio', 'hmk' ),
			'add_new_item' => __( 'Add New Project', 'hmk' ),
			'edit_item' => __( 'Edit Project ', 'hmk' ),
			'new_item' => __( 'New Project ', 'hmk' ),
			'view_item' => __( 'View Project ', 'hmk' ),
			'search_items' => __( 'Search Portfolio Item', 'hmk' ),
			'not_found' =>  __( 'No Projects found', 'hmk' ),
			'not_found_in_trash' => __( 'No Projects Item found in Trash', 'hmk' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('author','title','thumbnail'),
		  'public' => true,
		  'show_ui' => true,
		  'capability_type' => 'post',
		  'hierarchical' => false,
		  'menu_position' => 5,
		  'rewrite' => true,
		  'query_var' => false,
		  'rewrite' => array( 'slug' => 'portfolio' ),

		)
	  );
	  add_action( 'init', 'builds_taxonomies', 0 ); 

function builds_taxonomies() {

register_taxonomy( 'project-by', 'portfolio', array( 'hierarchical' => true, 'label' => 'Portfolio Categories', 'query_var' => true, 'rewrite' => true ) ); 


						
						


}
function hmk_portfolio_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/images/portfolio-icon.png) no-repeat 6px 6px !important;
            
        }
		#menu-posts-portfolio:hover .wp-menu-image, 
		#menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px -16px !important;
        }
		#icon-edit.icon32-posts-portfolio {
		    background: url(<?php echo get_template_directory_uri(); ?>/images/portfolio-32x32.png) no-repeat 0 -4px;
		}
		#icon-edit.icon32-posts-portfolio {
		    background: url(<?php echo get_template_directory_uri(); ?>/images/portfolio-32x32.png) no-repeat 0 -4px;
		}
    </style>
<?php }

add_action( 'admin_head', 'hmk_portfolio_icons' );
	
function hmk_edit_columns_portfolio($portfolio_columns){  
	$portfolio_columns = array(  
		'cb' => '<input type="checkbox" />',  
		'title' => _x( 'Title', 'hmk', 'column name' ),
				);  
	
	return $portfolio_columns;  
}  
add_filter('manage_edit-portfolio_columns', 'hmk_edit_columns_portfolio');  
  
function hmk_custom_columns_portfolio($portfolio_columns, $post_id){  

	switch ($portfolio_columns) {
	    case 'thumbnail':
	        $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
	        
	        if( $thumbnail_id ) {
	            $thumb = wp_get_attachment_image( $thumbnail_id, 'portfolio-admin-thumb', true );
	        }
	        
	        if( isset($thumb) ) {
	            echo $thumb;
	        } else {
	            echo __('None', 'hmk');
	        }
	        
	        break;
	        
		case 'type':  
			echo get_the_term_list( $post_id, 'skill-type', '', ', ', '' );
			break;
	}  
}  
add_action('manage_posts_custom_column',  'hmk_custom_columns_portfolio', 10, 2);  

/*-------------------------------------------------------------------------------*/
/*  Enable Sorting of the Portfolio 
/*-------------------------------------------------------------------------------*/

function hmk_create_portfolio_sort_page() {
    $hmk_sort_page = add_theme_page('edit.php?post_type=portfolio', 'Sort Portfolios', __('Sort Projects', 'hmk'), 'edit_posts', basename(__FILE__), 'hmk_portfolio_sort');
    
    add_action('admin_print_styles-' . $hmk_sort_page, 'hmk_print_sort_styles');
    add_action('admin_print_scripts-' . $hmk_sort_page, 'hmk_print_sort_scripts');
}
add_action('admin_menu', 'hmk_create_portfolio_sort_page');


function hmk_portfolio_sort() {
    $portfolios = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');    
	?>
    <div class="wrap">
        <div id="icon-edit" class="icon32 icon32-posts-portfolio"><br /></div>
        <h2><?php _e('Sort Portfolios', 'hmk'); ?></h2>
        <p><?php _e('Click, drag, re-order. Repeat as neccessary. Portfolio at the top will appear first in home.', 'hmk'); ?></p>

        <ul id="portfolio_list">
            <?php while( $portfolios->have_posts() ) : $portfolios->the_post(); ?>        
                <?php if( get_post_status() == 'publish' ) { ?>
                    <li id="<?php the_id(); ?>" class="menu-item">
                        <dl class="menu-item-bar">
                            <dt class="menu-item-handle">
                                <span class="item-title"><?php the_title(); ?></span>
                            </dt>
                        </dl>
                        <ul class="menu-item-transport"></ul>
                    </li>
                <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
	<?php 
}


function hmk_save_portfolio_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $portfolio_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
        $counter++;
    }
    die(1);
}
add_action('wp_ajax_portfolio_sort', 'hmk_save_portfolio_sorted_order');


function hmk_print_sort_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('hmk_portfolio_sort', get_template_directory_uri() . '/admin/assets/js/hmk_portfolio_sort.js');
}

function hmk_print_sort_styles() {
    wp_enqueue_style('nav-menu');
}
?>