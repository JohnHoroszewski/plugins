<?
/* Plugin Name: Pretty Callouts
 * Plugin URI: 
 * Description: Provides the ability to add a callout box in the flow of content
 * Version 0.1
 * Author: John H (via WPMU)
 * Author URI: http://www.johnswork.com
 * License: GPLv2
 */

function pretty_callout_stylsheet()
{
	wp_register_style( 'pretty_callouts_style', plugins_url( 'style/style.css', __FILE__ ) );
	wp_enqueue_style( 'pretty_callouts_style' );
}

add_action( 'wp_enqueue_scripts', 'pretty_callout_stylsheet' );

function pretty_callouts( $atts, $content = null )
{

  $atts = shortcode_atts( array(
    'align' => ''
  	), $atts, 'pretty-callout');

  ob_start();

  echo '<aside class="pretty-callout ' . $atts[ 'align' ] . '">' . $content . '</aside>';

  return ob_get_clean();
}

add_shortcode( 'pretty-callout', 'pretty_callouts' );
