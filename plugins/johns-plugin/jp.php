<?php

/**
 * Plugin Name: John's plugin
 * Plugin URI: http://www.johnswork.com
 * Description: A simple plugin to experiment with.
 * Version 0.01
 * Author: John Horoszewski
 * Author URI: http://www.johnswork.com
 */


function jp_register_styles() {
  
  wp_enqueue_style( 'jp_style', plugin_dir_url( __FILE__ ) . 'styles/style.css' );
  
}
add_action( 'wp_enqueue_scripts', 'jp_register_styles' );


include_once( plugin_dir_path( __FILE__ ) . '/includes/incs.php');

function jp_cta() { ?>

<div class="cta-btn">
	<p>Call us at 000-0000 or email us at <a href="mailto:send@someemail.com">send@someemail.com</a></p>
</div>

<?php }

add_action( 'mytheme_sidebar', 'jp_cta' );
add_action( 'mytheme_below_content', 'jp_cta' );

function jp_shortcode_cta()
{
	ob_start(); ?>

	<div class="cta-btn">
		<p><a href="#">Some Sweet Link!</a></p>
	</div>

	<?php return ob_get_clean();
}

add_shortcode( 'CTA', 'jp_shortcode_cta' );