<div id="home_testimonials" class="grid_12">
						<h3>Testimonials</h3>
						<div id="testimonial_container">
      <?php  $i=0;
       $posts = query_posts(array('post_type' => 'testimonial')); ?>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php    $post_meta_data = get_post_custom($post->ID);     ?>
			 <div id="testimonial_551" class="slide_container">
			   <p><?php echo $post_meta_data['hmk_testimonial_content'][0]; ?></p>
			   <h4> <?php echo $post_meta_data['hmk_testimonial_author'][0]; ?>, <?php echo $post_meta_data['hmk_testimonial_company'][0]; ?></h4>
		    </div>
     
      <?php $i++; ?>
      <?php endwhile; ?>
   </div>
   <div id="testimonial_controls_container">
	<div id="testimonial_display">
	 <p>
         <?php 
            foreach ($posts as $post) {  ?>
				<span id="testimonial_control_<?php echo $post->ID ?>" class="slide_control" data-slide="<?php echo $post->ID ?>">&nbsp;</span>
           <?php } ?>
		</p>
      </div>
   </div>

<?php  else:  ?>
<div id="testimonial_551" class="slide_container">
<p>Add Testimonials to show up heree</p>									
</div> </div>
<?php  endif; ?>
</div>
<?php wp_reset_query(); ?>
