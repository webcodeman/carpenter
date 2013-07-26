<div id="home_slides" class="grid_24">
   <div id="slides">
      <?php  $i=0;
       $posts = query_posts(array('post_type' => 'slider')); ?>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php   $post_meta_data = get_post_custom($post->ID);  
         $post_thumbnail_id = get_post_thumbnail_id($post->ID);
		 $slide1_array = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
         
         					
         ?>
      <div id="banner_<?php echo $post->ID  ?>" class="slide_container">						
         <img class="fade-image-b slide_image" src="<?php  echo $slide1_array[0] ?>" width="950" height="534" alt="" />
        <!-- <img class="fade-image-a slide_image" src="<?php  echo $slide2_array[0] ?>" width="950" height="534" alt="" />   -->
      </div>
      <?php $i++; ?>
      <?php endwhile; ?>
   </div>
   <div id="banner_controls_container">
      <div id="banner_display">
         <?php 
            foreach ($posts as $post) {  ?>
         <p id="banner_control_<?php echo $post->ID ?>" class="slide_control" data-slide="<?php echo $post->ID ?>">&nbsp;</p>
         <?php } ?>
      </div>
   </div>
</div>
<?php  else:  ?>
<!-- Else in here -->
<?php  endif; ?>
<?php wp_reset_query(); ?>