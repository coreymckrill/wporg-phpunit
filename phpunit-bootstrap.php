<?php

define( 'WP_PLUGIN_DIR', __DIR__ . '/public_html/wp-content/plugins' );
define( 'WP_MU_PLUGIN_DIR', __DIR__ . '/public_html/wp-content/mu-plugins' );
define( 'PLUGINS_TABLE_PREFIX', 'wp_' );

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	echo "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	exit( 1 );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Load individual plugin bootstrappers.
 */
require_once WP_PLUGIN_DIR . '/plugin-directory/tests/bootstrap.php';
require_once WP_PLUGIN_DIR . '/wporg-5ftf/tests/bootstrap.php';
require_once WP_PLUGIN_DIR . '/wporg-meeting-calendar/tests/bootstrap.php';

require_once $_tests_dir . '/includes/bootstrap.php';
