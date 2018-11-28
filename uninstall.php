<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit(); }

function modpinn_delete_plugin() {
	global $wpdb;

	delete_option( 'modpinn' );

	$posts = get_posts(
		array(
			'numberposts' => -1,
			'post_type' => 'remote_image_post',
			'post_status' => 'any',
		)
	);

	foreach ( $posts as $post ) {
		wp_delete_post( $post->id, true );
	}

	$wpdb->query( sprintf( "DROP TABLE IF EXISTS %s",
		$wpdb->prefix . 'remimg_settings' ) );
}
modpinn_delete_plugin();
