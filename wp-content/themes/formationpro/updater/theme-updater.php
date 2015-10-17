<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}


$test_license = trim( get_option( 'formationpro_license_key' ) );

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'http://www.templateexpress.com', // Site where EDD is hosted
		'item_name' => 'Formation Pro', // Name of theme
		'theme_slug' => 'formationpro', // Theme slug
		'version' => '2.0.3', // The current version of this theme
		'author' => 'Template Express', // The author of this theme
		'licence'	=> $test_license,
		'download_id' => '', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Theme License', 'formationpro' ),
		'enter-key' => __( 'Enter your theme license key.', 'formationpro' ),
		'license-key' => __( 'License Key', 'formationpro' ),
		'license-action' => __( 'License Action', 'formationpro' ),
		'deactivate-license' => __( 'Deactivate License', 'formationpro' ),
		'activate-license' => __( 'Activate License', 'formationpro' ),
		'status-unknown' => __( 'License status is unknown.', 'formationpro' ),
		'renew' => __( 'Renew?', 'formationpro' ),
		'unlimited' => __( 'unlimited', 'formationpro' ),
		'license-key-is-active' => __( 'License key is active.', 'formationpro' ),
		'expires%s' => __( 'Expires %s.', 'formationpro' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'formationpro' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'formationpro' ),
		'license-key-expired' => __( 'License key has expired.', 'formationpro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'formationpro' ),
		'license-is-inactive' => __( 'License is inactive.', 'formationpro' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'formationpro' ),
		'site-is-inactive' => __( 'Site is inactive.', 'formationpro' ),
		'license-status-unknown' => __( 'License status is unknown.', 'formationpro' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'formationpro' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'formationpro' )
	)

);