<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cannot access pages directly.' );
}
?>

<div class="wrap about-wrap mascot-admin-tpl-wrapper">
	<?php echo landspire_get_template_part( 'admin/admin-tpl/mascot-header' ); ?>
	<?php echo landspire_get_template_part( 'admin/admin-tpl/mascot-tabs' ); ?>


<div class="feature-section">
	<div class="mascot-faq-tab">
		<div class="heading"><?php esc_html_e( 'Mascot Core Plugins', 'landspire' ); ?></div>
		<div class="content">
		<pre>
			<?php
			echo sprintf( esc_html__( 'For proper theme functioning, the %s plugins are required.', 'landspire' ), "<strong>Mascot Core</strong>" );
			echo "</br>";
			echo "</br>";
			esc_html_e( 'Installation Instructions:', 'landspire' );
			echo "</br>";

			esc_html_e( '1. From your WordPress dashboard, visit Appearance > Install Plugins.', 'landspire' );
			echo "</br>";
			echo sprintf( esc_html__( '2. Search for %s plugins and install them.', 'landspire' ), "<strong>Mascot Core</strong>");
			echo "</br>";
			esc_html_e( '3. Now activate them.', 'landspire' );
			echo "</br>";
			echo sprintf( esc_html__( '4. Once the plugins are activated you will find full features of the theme including Custom Post Types, Theme Options, Post Meta etc. For proper theme functioning, the  %s plugin is required.', 'landspire' ), "<strong>Mascot Core</strong>");
			?>
		</pre>
		</div>
	</div>

<hr>
	<div class="mascot-faq-tab">
		<div class="heading"><?php esc_html_e( 'One Click Demo Import', 'landspire' ); ?></div>
		<div class="content">
		<pre>
			<?php
			esc_html_e( 'Import your demo content, widgets and theme settings with one click. It\'s as simple as clicking one button! To import demo data, make sure that \'One Click Demo Import\' plugin is installed and active.', 'landspire' );
			echo "</br>";
			echo "</br>";

			esc_html_e( 'Installation Process 1:', 'landspire' );
			echo "</br>";
			esc_html_e( '1. From your WordPress dashboard visit Appearance > Install Plugins.', 'landspire' );
			echo "</br>";
			esc_html_e( '2. Search for \'One Click Demo Import\' and install/activate the plugin.', 'landspire' );
			echo "</br>";
			echo "</br>";

			esc_html_e( 'Installation Process 2:', 'landspire' );
			echo "</br>";
			esc_html_e( '1. From your WordPress dashboard visit \'Plugins > Add New\'.', 'landspire' );
			echo "</br>";
			esc_html_e( '2. Search for \'One Click Demo Import\' and install/activate the plugin.', 'landspire' );
			echo "</br>";
			echo "</br>";

			esc_html_e( 'Demo Import Instructions:', 'landspire' );
			echo "</br>";
			esc_html_e( '1. Once the plugin is activated you will find the actual import page in: Appearance -> Import Demo Data.', 'landspire' );
			echo "</br>";
			echo sprintf( esc_html__( 'See the %1$sScreenshots Tab%2$s for more details.', 'landspire' ), '<a target="_blank" href="https://wordpress.org/plugins/one-click-demo-import/screenshots/">', '</a>' ); ?>
		</pre>
		</div>
	</div>

<hr>

	<div class="mascot-faq-tab">
		<div class="heading"><?php esc_html_e( 'Regenerate Thumbnails', 'landspire' ); ?></div>
		<div class="content">
		<pre>
			<?php
			esc_html_e( 'Regenerate Thumbnails allows you to regenerate the thumbnails for your image attachments. This is very handy if you\'ve changed any of your thumbnail dimensions (via Settings -> Media) after previously uploading images or have changed to a theme with different featured post image dimensions.', 'landspire' );
			echo "</br>";
			echo "</br>";
			esc_html_e( 'You can either regenerate the thumbnails for all image uploads, individual image uploads, or specific multiple image uploads.', 'landspire' );
			echo "</br>";
			echo "</br>";
			echo sprintf( esc_html__( 'See the %1$sScreenshots Tab%2$s for more details.', 'landspire' ), '<a target="_blank" href="https://woddrdpress.org/extend/plugins/regenerate-thumbnails/screenshots/">', '</a>' );
			echo "</br>";
			echo "</br>";
			esc_html_e( 'Installation and Usage Method:', 'landspire' );
			echo "</br>";
			esc_html_e( '1. Go to your admin area and select Plugins -> Add new from the menu.', 'landspire' );
			echo "</br>";
			esc_html_e( '2. Search for Regenerate Thumbnails.', 'landspire' );
			echo "</br>";
			esc_html_e( '3. Click install.', 'landspire' );
			echo "</br>";
			esc_html_e( '4. Click activate.', 'landspire' );
			echo "</br>";
			esc_html_e( '5. Go to Tools > Regen. Thumbnails', 'landspire' );
			echo "</br>";
			esc_html_e( '6. Click "Regenerate All Thumbnails" button and let the process to finish till it reaches 100 percent.', 'landspire' );
			?>
		</pre>
		</div>
	</div>

<hr>

	<div class="mascot-faq-tab">
		<div class="heading"><?php esc_html_e( 'Flush Rewrite Rules', 'landspire' ); ?></div>
		<div class="content">
		<pre>
			<?php
			esc_html_e( 'Remove rewrite rules and then recreate rewrite rules. This method can be used to refresh WordPress rewrite rule cache. Generally, this should be used after programmatically adding one or more custom rewrite rules.', 'landspire' );
			echo "</br>";
			echo "</br>";

			esc_html_e( 'When it is necessary?', 'landspire' );
			echo "</br>";
			esc_html_e( '-> Usually needs to flush rewrite rules for new custom post types.', 'landspire' );
			echo "</br>";
			esc_html_e( '-> You should only flush rules on activation or deactivation of a plugin or theme.', 'landspire' );
			echo "</br>";
			esc_html_e( '-> If you get 404 Page not found error on some pages/posts that already exist.', 'landspire' );
			echo "</br>";
			echo "</br>";

			esc_html_e( 'To flush WordPress rewrite rules or permalinks from the Dashboard:', 'landspire' );
			echo "</br>";
			echo sprintf( esc_html__( 'In the main menu find %1$sSettings > Permalinks%2$s', 'landspire' ), '<a target="_blank" href="' . admin_url( 'options-permalink.php' ) . '">', '</a>', '</br>' );
			echo "</br>";
			esc_html_e( '2: Scroll down if needed and click Save Changes.', 'landspire' );
			echo "</br>";
			esc_html_e( '3: Rewrite rules and permalinks are flushed.', 'landspire' );
			?>
		</pre>
		</div>
	</div>

<hr>


</div>