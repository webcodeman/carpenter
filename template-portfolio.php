<?php /* Template Name: Portfolio */ ?>

<?php get_header(); ?>

<div id="main">
<div id="primary" class="main_page">
	<div id="content" role="main" class="portfolio">
			<article id="" class="page">
				<header class="entry-header subnav">
				
					
						<div id="page_header" class="no_banner">
							<div class="container_24">
								<h1 class="entry-title grid_24"><?php the_title();  ?></h1>
							</div>
						</div>

					
				</header><!-- .entry-header -->	
				
				
					<div class="container_24">
						<div id="projects_container">
						<?php
						global $post;
						$posts = query_posts(array('post_type' => 'portfolio')); 				
						
						
						?>
							<ul id="projects_list">
							<?php if($posts) { ?>
							<?php foreach( $posts as $post ) :	setup_postdata($post);  
							$post_meta_data = get_post_custom($post->ID); 
							$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
							?> 
							<li id="projects_list_1721" class="grid_6 prefix_1 suffix_1 projects_list_item selected " data-info="<?php the_title();  ?>" data-categories="">
							  <a href="<?php echo get_permalink($post->ID);  ?>">
							   <img class="fade-image-b" src="<?php echo $url;  ?>" width="230" height="230" alt="5Church Restaurant" />
							   <h2><?php the_title();  ?></h2><h3></h3>
							  </a>
						   </li>
						
							<?php endforeach; wp_reset_postdata(); ?>
								<?php } else { echo "Tatooo"; } ?>
							</ul>						
					</div>
					</div>
				
								
			</article>


			
	</div><!-- #content -->
</div><!-- #primary -->



<?php get_footer(); ?>