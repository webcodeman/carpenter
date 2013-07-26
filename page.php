<?php get_header(); ?>
	
	<div id="main">
	<div id="primary" class="main_container">
		<div id="content" role="main" class="homes">
			<div class="container_24">
	
		<div id="page_header" class="no_banner">
							<div class="container_24">
								<h1 class="entry-title grid_24"><?php the_title();  ?></h1>
							</div>
						</div>
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php the_content(); ?> 
			
			<?php //comments_template( '', true ); // Remove if you don't want comments ?>
			
			
			
			<?php //edit_post_link(); ?>
			
		
		</article>
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h2><?php _e( 'Sorry, nothing to display.', 'hmk' ); ?></h2>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>
	

	<!-- /section -->
	
</div>	
               
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>