<?php
/**
 * Uninstall Anbarli Android App Redirect.
 *
 * @package Anbarli_Android_App_Redirect
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'anbarli_android_app_redirect_options' );
