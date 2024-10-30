<?php
/*
Plugin Name: JGC Facebook Page Widget
Description: This plugin creates a widget to display Facebook Page Plugin. Page Plugin lets you easily embed and promote any Facebook Page on your website. Just like on Facebook, your visitors can like and share the Page without having to leave your site.
Version: 1.0.1
Author: GalussoThemes
Author URI: https://galussothemes.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: jgc-facebook-page-widget
Domain Path: /languages

JGC Facebook Page Widget is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

JGC Facebook Page Widget is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with JGC Facebook Page Widget. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

// Salir si se accede directamente
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('init', 'jgcfpp_load_textdomain');
function jgcfpp_load_textdomain() {

	load_plugin_textdomain( 'jgc-facebook-page-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );

}

require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-widget-facebook-page-widget.php' );
