<?php 
global $post;

$hamza_lite_read_more_text = get_theme_mod('hamza_lite_readmore_text', 'Read More');
$hamza_lite_call_to_action_post_id = get_theme_mod('hamza_lite_callto_post');
$hamza_lite_call_to_action_post_content = get_theme_mod('hamza_lite_show_full_content');
$hamza_lite_call_to_action_post_char = get_theme_mod('hamza_lite_call_to_action_char', '650');
$hamza_lite_call_to_action_read_more = get_theme_mod('hamza_lite_call_to_action_text', 'Check Out');
$hamza_lite_featured_title = get_theme_mod('hamza_lite_featured_title', 'Hamza Lite - A FREE WORDPRESS THEME');
$hamza_lite_featured_text = get_theme_mod('hamza_lite_featured_content', 'Free Responsive, Multipurpose Business and Corporate Theme perfect for any one.');
$show_fontawesome_icon = get_theme_mod('hamza_lite_featured_post_icon');
$featured_post1 = get_theme_mod('hamza_lite_featured_post_one');
$featured_post2 = get_theme_mod('hamza_lite_featured_post_two');
$featured_post3 = get_theme_mod('hamza_lite_featured_post_three');
$featured_post4 = get_theme_mod('hamza_lite_featured_post_four');
$featured_post1_icon = get_theme_mod('hamza_lite_featured_post_one_icon');
$featured_post2_icon = get_theme_mod('hamza_lite_featured_post_two_icon');
$featured_post3_icon = get_theme_mod('hamza_lite_feature_post_three_icon');
$featured_post4_icon = get_theme_mod('hamza_lite_featured_post_four_icon');
$featured_post_readmore = get_theme_mod('hamza_lite_featured_read_more', 'Read More');
$hamza_lite_blog_cat = get_theme_mod('hamza_lite_blog_category');
$hamza_lite_show_blog_date = get_theme_mod('hamza_lite_show_blog_date', '1') ;
$hamza_lite_hide_blogmore = get_theme_mod('hamza_lite_show_blog_button') ;
$testimonial_category = get_theme_mod('hamza_lite_testimonial_category');
$hamza_lite_blog_title = get_theme_mod('hamza_lite_blog_title', 'Latest Posts');
$hamza_lite_google_map_iframe = get_theme_mod('hamza_lite_google_map_iframe');
$hamza_lite_contact_address = get_theme_mod('hamza_lite_contact_address');
?>

<?php if(!empty($hamza_lite_call_to_action_post_id)){ ?>
<section id="about-section">
	<div class="ak-container clearfix">
	<?php 
    
        $query1 = new WP_Query( 'p='.$hamza_lite_call_to_action_post_id );
        while ($query1->have_posts()) : $query1->the_post(); ?>
					 
        <h1 class="roboto-light main-title"><a href="<?php the_permalink(); ?>"><?php echo hamza_lite_get_title( get_the_ID()); ?></a></h1>
        <div class="welcome-detail">
            <?php 
                if($hamza_lite_call_to_action_post_content != 1 || empty($hamza_lite_call_to_action_post_content)){ ?>
                    <p class="welcome-content"><?php echo hamza_lite_truncate( get_the_content(), $hamza_lite_call_to_action_post_char, '...', false, true );?></p>
                    <?php if(!empty($hamza_lite_call_to_action_read_more)){ ?>
                        <a href="<?php the_permalink(); ?>" class="read-more bttn"><?php echo esc_html($hamza_lite_call_to_action_read_more); ?></a>
                    <?php } 
                }else{ 
				    the_content();
				}?>
					
        </div>
        <?php endwhile;	
            wp_reset_postdata();  ?>
	
	</div>
</section>
<?php } ?>

<?php if(!empty($featured_post1) || !empty($featured_post2) || !empty($featured_post3) || !empty($featured_post4)){ ?>
<section id="mid-section" class="featured-section clearfix">
	<div class="ak-container">
		<?php 
        if(!empty($hamza_lite_featured_title)){ ?>
            <h3 class="roboto-light main-title"><?php echo apply_filters('the_title', $hamza_lite_featured_title); ?></h3>
		<?php } 
        if(!empty($hamza_lite_featured_text)){ ?>
            <div class="sub-desc"><?php echo wp_kses_post($hamza_lite_featured_text); ?></div>
		<?php } ?>

		<div class="featured-post-wrapper clearfix">
		<?php
		    if(!empty($featured_post1)) { ?>
				<div id="featured-post-1" class="featured-post">
					<?php
						$query2 = new WP_Query( 'p='.$featured_post1 );
						// the Loop
						while ($query2->have_posts()) : $query2->the_post();
							if( $show_fontawesome_icon != 1 ){
							?>
							<figure class="featured-image">
								<a href="<?php the_permalink(); ?>">
									<?php 							
									if( has_post_thumbnail()){
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hamza-lite-featured-thumbnail', false ); 
									?>
									<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>" />
									<?php }else { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/featured-fallback.jpg" alt="<?php the_title(); ?>" />
									<?php } 
									?>
								</a>
							</figure>
							<?php } ?>
                            
							<?php 
							if($show_fontawesome_icon == 1){ ?>
							<div class="featured-icon">
                                <i class="fa <?php echo esc_attr($featured_post1_icon); ?>"></i>
							</div>		
							<?php } ?>
							
							<div class="featured-content">
								<h2 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo hamza_lite_excerpt( get_the_content() , 90 ) ?></p>
								<?php if(!empty($featured_post_readmore)){?>
								<a href="<?php the_permalink(); ?>" class="view-more"><?php echo esc_attr($featured_post_readmore); ?></a>
								<?php } ?>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>
				</div>
			<?php }

			if(!empty($featured_post2)) { ?>
				<div id="featured-post-2" class="featured-post">					
					<?php
						$query3 = new WP_Query( 'p='.$featured_post2 );
						// the Loop
						while ($query3->have_posts()) : $query3->the_post();							
							if( $show_fontawesome_icon != 1 ){
							?>
							<figure class="featured-image">
								<a href="<?php the_permalink(); ?>">
									<?php 							
									if( has_post_thumbnail()){
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hamza-lite-featured-thumbnail', false ); 
									?>
									<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>" />
									<?php }else { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/featured-fallback.jpg" alt="<?php the_title(); ?>" />
									<?php } 
									?>
								</a>
							</figure>
							<?php } ?>
                            	
							<?php 
							if($show_fontawesome_icon == 1){ ?>
							<div class="featured-icon">
                                <i class="fa <?php echo esc_attr($featured_post2_icon); ?>"></i>
							</div>		
							<?php } ?>
							
							<div class="featured-content">
								<h2 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo hamza_lite_excerpt( get_the_content() , 90 ) ?></p>
								<?php if(!empty($featured_post_readmore)){?>
								<a href="<?php the_permalink(); ?>" class="view-more"><?php echo esc_attr($featured_post_readmore); ?></a>
								<?php } ?>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>				
				</div>
			<?php } ?>
			
			<div class="clearfix hide"></div>

			<?php if(!empty($featured_post3)) { ?>
				<div id="featured-post-3" class="featured-post">
					<?php
						$query4 = new WP_Query( 'p='.$featured_post3 );
						// the Loop
						while ($query4->have_posts()) : $query4->the_post(); 
							if( $show_fontawesome_icon != 1 ){
							?>
							<figure class="featured-image">
								<a href="<?php the_permalink(); ?>">
									<?php 							
									if( has_post_thumbnail()){
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hamza-lite-featured-thumbnail', false ); 
									?>
									<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>" />
									<?php }else { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/featured-fallback.jpg" alt="<?php the_title(); ?>" />
									<?php } 
									?>
								</a>
							</figure>
							<?php } ?>	
				
							<?php 
							if($show_fontawesome_icon == 1){ ?>
							<div class="featured-icon">
    							<i class="fa <?php echo esc_attr($featured_post3_icon); ?>"></i>
							</div>		
							<?php } ?>
	
							<div class="featured-content">
								<h2 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo hamza_lite_excerpt( get_the_content() , 90 ) ?></p>
								<?php if(!empty($featured_post_readmore)){?>
								<a href="<?php the_permalink(); ?>" class="view-more"><?php echo esc_attr($featured_post_readmore); ?></a>
								<?php } ?>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>				
				</div>
			<?php } 

			if(!empty($featured_post4)) { ?>
				<div id="featured-post-4" class="featured-post">
					<?php
						$query5 = new WP_Query( 'p='.$featured_post4 );
						// the Loop
						while ($query5->have_posts()) : $query5->the_post(); 
							if( $show_fontawesome_icon != 1 ){
							?>
							<figure class="featured-image">
								<a href="<?php the_permalink(); ?>">
									<?php 							
									if( has_post_thumbnail()){
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hamza-lite-featured-thumbnail', false ); 
									?>
									<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>" />
									<?php }else { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/featured-fallback.jpg" alt="<?php the_title(); ?>" />
									<?php }  
									?>
								</a>
							</figure>
							<?php } ?>	

							<?php 
							if($show_fontawesome_icon == 1){ ?>
							<div class="featured-icon">
							<i class="fa <?php echo esc_attr($featured_post4_icon); ?>"></i>
							</div>		
							<?php } ?>
							
							<div class="featured-content">
								<h2 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo hamza_lite_excerpt( get_the_content() , 90 ) ?></p>
								<?php if(!empty($featured_post_readmore)){?>
								<a href="<?php the_permalink(); ?>" class="view-more"><?php echo esc_attr($featured_post_readmore); ?></a>
								<?php } ?>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>				
				</div>
			<?php } ?>
		</div>	
	</div>
</section>
<?php } ?>

<?php if(!empty($hamza_lite_blog_cat)){ ?>
<section id="top-section" class="blog-section clearfix">
	<div id="latest-blog" class="ak-container clearfix">
			<?php		
	            $loop = new WP_Query( array(
	                'cat' => $hamza_lite_blog_cat,
                    'post_status' => 'publish',
	                'posts_per_page' => 4,
	            )); ?>
	        <h1 class="roboto-light main-title">
                <a href="<?php echo get_category_link($hamza_lite_blog_cat); ?>">
                    <?php echo get_cat_name($hamza_lite_blog_cat); ?>
                </a>
            </h1>
            <div class="blog-list-wrapper clearfix">
                <div class="blog-list-content">
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
    	        	<div class="blog-list clearfix">
	        		
	        		<figure class="blog-thumbnail clearfix">
						<a href="<?php the_permalink(); ?>">
						<?php 
						if( has_post_thumbnail() ){
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hamza-lite-blog-thumbnail', false ); 
						?>
						<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>" />
						<?php }else{
						?>
						<img src="<?php echo get_template_directory_uri() ?>/images/blog-fallback.jpg" />
						<?php } ?>
						</a>
					</figure>	

					<div class="blog-detail clearfix">
		        		<h4 class="blog-title">
		        			<a href="<?php the_permalink(); ?>"><?php echo hamza_lite_excerpt( get_the_title() , 30 ); ?></a>
		        		</h4>
                        <div class="date-byline-wrap">
                        <?php if($hamza_lite_show_blog_date == 1){?>
                            <div class="blog-date">
                                <?php echo get_the_date('jS, M Y');?>
                            </div>
                        <?php } ?>
                        <div class="by-line">
                            <?php echo __( 'by ', 'hamza_lite'); the_author_posts_link(); ?>
                        </div>
		        		</div>
                        <div class="blog-excerpt">
		        			<?php echo hamza_lite_excerpt( get_the_content() , 100 ); ?>
		        		</div>

						<a class="read-more-btn" href="<?php echo the_permalink(); ?>"><?php echo esc_html($hamza_lite_read_more_text);?></a>

	        		</div>
	        	</div>
	        
	        <?php endwhile; ?>
			</div>
			<?php if($hamza_lite_hide_blogmore != 1 ) { ?>
			<?php }else{ ?>
			<div class="clearfix">&nbsp;</div>
			<?php } ?>
			</div>
	        <?php wp_reset_postdata(); ?>	
	        <a href="<?php echo get_category_link($hamza_lite_blog_cat); ?>" class="read-more bttn"><?php _e('Read All Blog','hamza_lite');?></a>
	</div>
</section>
<?php }?>

<?php if(!empty($testimonial_category)) {	?>
<section id="bottom2-section" class="clients-say-section clearfix">
	<div class="ak-container">		
        <h3 class="testimonial-title roboto-light"><?php echo get_cat_name($testimonial_category); ?></h3>
        <div class="testimonial-content"><?php echo category_description( $testimonial_category ); ?></div>
        <?php
            $loop2 = new WP_Query( array(
            'cat' => $testimonial_category,
            'post_status' => 'publish',
            'posts_per_page' => 5,
            )); ?>
            <div class="testimonial-wrap">
                <div class="testimonial-slider">
                <?php 
                    while ($loop2->have_posts()) : $loop2->the_post(); 
                    $designation = get_post_meta( get_the_ID(), 'hamza_lite_testimonail_designation', true );?>
       	            <div class="testimonial-slide">
                        <div class="testimonial-excerpt">
                            <?php echo hamza_lite_excerpt( get_the_content() , 140 ) ?>
      		            </div>                                    
                        <div class="testimonial-list clearfix">
      		                <div class="testimonial-thumbnail">
		        		    <?php 
                            if(has_post_thumbnail()){
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hamza-lite-testimonial-thumbnail', false ); ?> 
                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>" />
                            <?php }else{ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/testimonial-dummy.jpg" alt="no-image"/>
                            <?php } ?>
                            </div>
                            <div class="testimonial-name-box">
	                            <div class="testimoinal-client-name"><?php the_title(); ?></div>
	                            <div class="testimonail-designation"><?php echo $designation;?></div>
	                        </div>
   	                    </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php wp_reset_postdata(); ?>		 
	</div>			
</section>
<?php }?>

<?php if(!empty($hamza_lite_google_map_iframe)) { ?>           
<section id="google-map" class="clearfix">
		<?php		
		$allowed = array(
			'iframe' => array(
				'src' => array()
				)
			);		        	
        echo wp_kses($hamza_lite_google_map_iframe , $allowed);
					
		if(!empty($hamza_lite_contact_address)) { ?>
		<div class="google-section-wrap ak-container">			
            <div class="ak-contact-address">
            <h3><?php _e('Contact Us', 'hamza_lite'); ?></h3>
            <?php echo wpautop($hamza_lite_contact_address);
                do_action( 'hamza_lite_social_links' ); 
            ?>
            <div class="direction-pointer"></div>
            <div class="trialgle"></div>
            </div>

		</div>
		<?php } ?>
</section>
<?php } ?>