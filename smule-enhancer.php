<?php 
/* 
 * Plugin Name: Smule enhancement features and functions 
 * Plugin URI: https://github.com/martinm76/smule-enhancer/
 * Description: Automatically embed smule recordning URLs, if they are in the right format.
 * Version: 1.00
 * Author: Martin Møller <martin.moller@gmail.com> 
 * Author URI: https://github.com/martinm76
 * License: GPL2
 * -=-
 *
 * Tried oemhed of recordings for automatic embedding. Taken from 
 * https://www.smule.com/support/embedding - couldn't get it to work.
 * Attempted a regular embed in stead.
 * --
 * martin.moller@gmail.com
 */

// Register oEmbed providers
/*
function smule_oembed_provider() {

	wp_oembed_add_provider( 'https://www.smule.com/recording/*', 'https://www.smule.com/s/oembed', false );

}
add_action( 'init', 'smule_oembed_provider' );
*/

add_action( 'init', function()
{
    wp_embed_register_handler( 
        'smule', 
        '#https://www\.smule\.com/recording/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)$#i',
        'smule_embed_handler' 
    );
} );

/**
 * Handle callback for the smule karaoke provider
 */
function smule_embed_handler( $matches, $attr, $url, $rawattr )
{
	$embed = sprintf(
			'<iframe src="https://www.smule.com/recording/%1$s/%2$s/frame" width="450" height="125" frameborder="0" scrolling="no" marginwidth="0" marginheight="0"></iframe>',
			esc_attr($matches[1]),
			esc_attr($matches[2])
			);
    return apply_filters( 'smule_embed_handler', $embed, $matches, $attr, $url, $rawattr );
}

?>
