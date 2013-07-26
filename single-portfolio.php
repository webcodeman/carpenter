<?php get_header(); ?>
<div id="main">	
<div id="primary">								
<div id="content" role="main" class="work">	
<article id="post-1721" class="post-1721 work type-work status-publish hentry">
	<header class="entry-header">
		<?php  
		$post_meta_data = get_post_custom($post->ID);  
		$slides_array=$post_meta_data['hmk_project_imgs'];
		?>
				
		<div id="page_header" class="container_24">
			<div class="grid_2 suffix_2 prev_project">
				<a href="<?php echo get_permalink($post->ID+1);  ?>"></a>
			</div>
			<div class="project_title grid_15">
				<h1><?php the_title();  ?> <span class="year"></span></h1><h2><?php echo $post_meta_data['hmk_project_sub_title'][0]; ?></h2>			
			</div>
			<div class="grid_2 prefix_2 next_project">
				<a href="<?php echo get_permalink($post->ID-1);  ?>"></a>
			</div>
		</div>
	</header><!-- .entry-header -->
	
	<div id="project_slides_container">

		<div class="container_24">
	
				
		
			<div id="project_slider" class="grid_24">
				<div id="project_slide_prev"></div>
				<div id="slides">
				<?php   						
						foreach ($slides_array as $img_id) {						
						$slide_array = wp_get_attachment_image_src( $img_id,'full' );
				?>
					<div id="banner_1758" class="slide_container">
									<div class="fade-image-container">
										<img class="slide_image" src="<?php echo $slide_array[0]; ?>" width="947" height="630" alt="" />
									</div>
								</div>
					
				<?php
						
						} 
				?>
		
												
				</div>
				<div id="project_slide_next"></div>
			</div>
						
			<div class="grid_24">
				<div id="project_controls_container">
					<ul id="project_display">
				<?php
						foreach ($slides_array as $img_id) {						
						$slide_array = wp_get_attachment_image_src( $img_id,'full' );
				?>
					<li id="project_control_<?php echo $img_id; ?>" class="slide_control" data-slide="<?php echo $img_id; ?>">
								<a href="javascript:void(0);">
									<img class="fade-image-a" src="<?php echo $slide_array[0]; ?>" width="30" height="30" alt="" />
									<img class="fade-image-b" src="<?php echo $slide_array[0]; ?>" width="30" height="30" alt="" />
									
								</a>
							</li>
					
				<?php
						
						} 
				?>
				
						
											
					</ul>
				</div>
			</div>
		
		
	</div>
	
		
		<div id="project_info_container">
			<div class="container_24">
				<div class="grid_24">
					<h3><span class="info_title">Site:</span><br /><?php echo $post_meta_data['hmk_project_site'][0]; ?></h3>
					<h3><span class="info_title">Designers:</span><br /><?php echo $post_meta_data['hmk_project_designer'][0]; ?></h3>
					<h3><span class="info_title">Fabricated:</span><br /><?php echo $post_meta_data['hmk_project_fabricated'][0]; ?></h3>
					<h3><span class="info_title">Photography:</span><br /><?php echo $post_meta_data['hmk_project_photography'][0]; ?></h3>				
				</div>
			</div>
		</div>
	
		
	
</article><!-- #post-1721 -->
				
					</div>
					
						
		
		</div><!-- #primary -->

<?php get_footer(); ?>