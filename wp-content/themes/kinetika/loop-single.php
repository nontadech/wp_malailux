<?php
$postformat = get_post_format();
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="post-<?php echo esc_attr($postformat); ?>-wrapper">
			<?php get_template_part( 'includes/postformats/default' );	?>
			<?php comments_template(); ?>
		</div>
<?php endwhile; // end of the loop. ?>