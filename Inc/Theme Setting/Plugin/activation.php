<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme PaperXfor publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/Inc/Theme Setting/Plugin/theme-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'vasutheme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */


function vasutheme_register_required_plugins() {

	$plugins = array(

        array(
            'name'         => 'Paper Core',
            'slug'         => 'paper-core',
            'source'       => 'https://mjnnu.com/demo/demofile/paper-core.zip',
            'required'     => true,
            'version'      => '1.0',

        ),
        array(
            'name'         => 'Elementor Page Builder',
            'slug'         => 'elementor',
            'required'     => true,
            'external_url' => 'https://wordpress.org/plugins/elementor/',
        ),
		array(
			'name'               => esc_html__('Envato Market', 'paperx'),
			'slug'               => 'envato-market',
			'source'             => esc_url( 'https://goo.gl/pkJS33' ),
            'external_url'       => esc_url( 'https://goo.gl/pkJS33' ),
			'required'           => true,
		), 
		array(
            'name'     => esc_html__('One User Avatar | User Profile Picture', 'paperx'),
            'slug'     => 'one-user-avatar',
            'required' => true,
        ),
		array(
			'name'         => 'Contact Form 7',
			'slug'         => 'contact-form-7',
			'required'     => false,
			'external_url' => 'http://wordpress.org/plugins/contact-form-7',
		),
        // array(
		// 	'name'         => 'Svg Support',
		// 	'slug'         => 'svg-support',
		// 	'required'     => false,
		// 	'external_url' => 'https://wordpress.org/plugins/svg-support/',
		// ),
		array(
			'name'         => 'One Click Demo Import',
			'slug'         => 'one-click-demo-import',
			'required'     => True,
			'external_url' => 'https://wordpress.org/plugins/one-click-demo-import',
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'paperx',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',

	);

	tgmpa( $plugins, $config );
}