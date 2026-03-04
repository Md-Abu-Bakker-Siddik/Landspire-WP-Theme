<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php do_action( 'landspire_blog_post_entry_header_start' ); ?>
		<?php landspire_get_post_thumbnail( $post_format ); ?>
		<?php do_action( 'landspire_blog_post_entry_header_end' ); ?>
	</div>
	<div class="entry-content">
		<?php do_action( 'landspire_blog_post_entry_content_start' ); ?>



		<?php landspire_post_meta(); ?>
		<?php landspire_get_post_title(); ?>
		<div class="post-excerpt">
			<?php landspire_get_excerpt(); ?>
		</div>
		<?php do_action( 'landspire_blog_post_entry_content_end' ); ?>

		<?php echo landspire_blog_read_more_link(); ?>
	</div>
	<div class="clearfix"></div>
</article>