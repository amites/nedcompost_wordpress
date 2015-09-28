<?php
/**
 * @package Hamza Lite
 */
?>
<?php
global $post;
$cat_blog = get_theme_mod('hamza_lite_blog_category');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
            
		<?php 
		if(has_category( $cat_blog) && !empty($cat_blog)){?>
			<div class="entry-meta">
				<?php hamza_lite_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php }?>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'hamza_lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	<?php if(has_category( $cat_blog) && !empty($cat_blog)){

			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'hamza_lite' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'hamza_lite' ) );

			if ( ! hamza_lite_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'hamza_lite' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'hamza_lite' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'hamza_lite' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'hamza_lite' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>
	<?php } ?>
		<?php edit_post_link( __( 'Edit', 'hamza_lite' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
