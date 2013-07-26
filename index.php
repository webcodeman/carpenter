<?php get_header(); ?>

	<div id="main">
	<div id="primary" class="main_container">
		<div id="content" role="main" class="home">
			<div class="container_24">
			
			<?php require_once dirname( __FILE__ ) . '/inc/slider.php'; ?>
								
			
				
							
								
					<div id="mobile_banner" class="grid_24">
						 			</div>
				
							</div>
			<div id="home_blurb_container">
				<div class="container_24">
					<div id="home_blurb" class="grid_22 prefix_1 suffix_1">
				     <p><?php echo of_get_option('hmk_home_text')  ?> </p>
					</div>
				</div>
			</div>
			<div id="sub_footer_container">
				<div id="home_features" class="container_24">	
					
							<?php require_once dirname( __FILE__ ) . '/inc/testimonials.php'; ?>	
							<div id="home_feature_543" class="home_feature grid_6">
								<h3>Gallery</h3>
								
								<div id="home_feature_543_image" class="sub_footer_image">
								
									
										<a href="<?php  echo  get_permalink(of_get_option('home_feature1_link') ); ?>" title="Gallery">	
										<img class="fade-image-b slide_image" src="<?php echo of_get_option('home_feature1_img');?>" width="230" height="307" alt="Gallery" />
											
										</a>

																	
								</div>
							</div>
						
												
							<div id="home_feature_545" class="home_feature grid_6">
								<h3>Design</h3>
								<div id="home_feature_545_image" class="sub_footer_image">
								
									
										<a href="<?php  echo  get_permalink(of_get_option('home_feature2_link') ); ?>" title="Design">	
										   <img class="fade-image-b slide_image" src="<?php echo of_get_option('home_feature2_img');?>" width="230" height="307" alt="Design" />
											
										</a>

																	
								</div>
							</div>
						
											
					
				</div>	
               
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>