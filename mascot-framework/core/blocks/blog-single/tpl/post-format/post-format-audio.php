<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'post-single clearfix ' . $enable_drop_caps ) ); ?>>
	<div class="entry-header">
		<?php do_action( 'landspire_blog_single_entry_header_start' ); ?>
		<?php landspire_get_blog_single_post_thumbnail( $post_format ); ?>
		<?php do_action( 'landspire_blog_single_entry_header_end' ); ?>
	</div>
	<div class="entry-content">
		<?php do_action( 'landspire_blog_single_entry_content_start' ); ?>
		<?php landspire_get_single_post_title(); ?>
		<div class="post-excerpt">
			<?php the_content();?>
			<div class="clearfix"></div>
		</div>
		<?php landspire_get_post_wp_link_pages(); ?>
		<?php landspire_blog_single_post_meta(); ?>
		<?php do_action( 'landspire_blog_single_entry_content_end' ); ?>
	</div>
</article>