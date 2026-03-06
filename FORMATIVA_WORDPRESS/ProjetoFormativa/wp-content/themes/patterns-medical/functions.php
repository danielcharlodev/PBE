<?php // phpcs:ignore
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Patterns Medical functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Patterns Medical
 */

/**
 * Current theme path.
 * Current theme url.
 * Current theme version.
 * Current theme name.
 * Current theme option name.
 */
define( 'PATTERNS_MEDICAL_PATH', trailingslashit( get_template_directory() ) );
define( 'PATTERNS_MEDICAL_URL', trailingslashit( get_template_directory_uri() ) );
define( 'PATTERNS_MEDICAL_VERSION', '1.0.0' );
define( 'PATTERNS_MEDICAL_THEME_NAME', 'patterns-medical' );
define( 'PATTERNS_MEDICAL_OPTION_NAME', 'patterns-medical' );

/**
 * The core theme class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require PATTERNS_MEDICAL_PATH . 'includes/main.php';

/**
 * Begins execution of the theme.
 *
 * @since    1.0.0
 */
function patterns_medical_run() {
	new Patterns_Medical();
}
patterns_medical_run();
