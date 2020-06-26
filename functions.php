<?php
add_action( 'init', 'php_block_init');

function php_block_init() {
	$isArconixActive = is_plugin_active('arconix-faq/plugin.php');

	if($isArconixActive){
		// Register our block editor script.
		wp_register_script('php-block', get_template_directory_uri() . '/js/php-block.js', array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ));

		// Register our block, and explicitly define the attributes we accept.
		register_block_type( 'pento/php-block', 
			array(
				'attributes'      => array( 'foo' => array(	'type' => 'string' )),
				'editor_script'   => 'php-block', // The script name we gave in the wp_register_script() call.
				'render_callback' => 'php_block_render'
			)
		);

		// Define our shortcode, too, using the same render function as the block.
		add_shortcode( 'php_block', 'php_block_render' );
	}
}

function php_block_render( $attributes ) {
    return "<p>[faq p='".@$attributes['foo']."']</p>"; 
}