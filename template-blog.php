<?php /* Template Name: Blog */ ?>
<?php get_header(); ?>
	
	<div id="main">
	<div id="primary" class="main_page">
		<div id="content" role="main" class="homes">
			<div class="container_24">
	
		<div id="page_header" class="no_banner">
							<div class="container_24">
								<h1 class="entry-title grid_24"><?php the_title();  ?></h1>
							</div>
						</div>
	<?php 
	global $post;
	query_posts(array('post_type' => 'post'));
	if (have_posts()): while (have_posts()) : the_post(); ?>
	<div class="columns column_3 ">
	
	<h3 class="entry-title grid_24">
	  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();  ?></a>
   </h3>
		
			<div class="blog_post">
			<?php echo get_excerpt(255); ?>
			</div>
				
			<ul class="share-links">
			<li>
			<a class="tweet-link" href="http://twitter.com/home/?status=<?php the_title(); ?> : <?php the_permalink(); ?>" title="Tweet this!" target="_blank"> &#xe002; </a>
			</li>
			<li>
			    <a class="fb-link" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="Share on Facebook." target="_blank">
						&#xe000;
				</a>
			</li>
			<li class="pin-link">
				<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" target="_blank">
					&#xe001;
				</a>
			</li>
			<li>
				<a class="comment-link" href="<?php the_permalink(); ?>#comments">
					&#xe003;
				</a>
			</li>
			<li>
				<a class="perma-link" href="<?php the_permalink(); ?>">
					&#xe004;
				</a>
			</li>
		</ul>
			
			
			
			
			<?php //edit_post_link(); ?>
			
		
		
	</div>
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