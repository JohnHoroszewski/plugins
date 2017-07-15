<?php

/**
 * Plugin Name: Tweety Plugin
 * Plugin URI: http://www.johnswork.com
 * Description: This adds a tweet to the end of some content.
 * Version: 0.1
 * Author: John H - Thanks to WPMUDev
 * Author URI: http://www.johnswork.com
 * License: GPL2
 */

add_action( 'admin_menu', 'tweet_settings_menu' );

function tweet_settings_menu()
{
	add_menu_page( 'Tweet Link Settings', 'Tweet Link', 'manage_options', 'tweet-settings', 'tweet_settings_page', 'dashicons-twitter', 25 );
}

// function tweet_settings_page()
// {
// 	echo '<div class="wrap"><h2>Tweet Link Options</h2></div>';
// }

add_action( 'admin_init', 'tweet_settings' );

function tweet_settings()
{
	register_setting( 'tweet_settings', 'twitter_account' );
}

// Tweet Page Form

function tweet_settings_page()
{
	?>
	<form method="post" action="options.php">
		<?php settings_fields( 'tweet_settings' ); ?>
		<?php do_settings_sections( 'tweet_settings' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Twitter Account</th>
				<td><input type="text" name="twitter_account" value="<?php echo esc_attr( get_option( 'twitter_account' ) ); ?>" /></td>
			</tr>
		</table>

		<?php submit_button(); ?>

	</form>
<?php }





function add_tweet( $content )
{
	return $content . '<p><a href="https://twitter.com/intent/tweet?url=' . get_permalink() . '">Tweet about this!</a></p>';
}

add_action( 'the_content', 'add_tweet' );