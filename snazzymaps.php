<?php
/**
 * Plugin Name: Snazzy Maps
 * Plugin URI: https://snazzymaps.com/plugins
 * Description: Apply styles to your Google Maps with the official Snazzy Maps WordPress plugin.
 * Version: 1.0.0
 * Author: Atmist
 * Author URI: http://atmist.com/
 * License: GPL2
 */
/*  Copyright 2014  Atmist  (email : hello@atmist.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Recommended by wordpress
defined( 'ABSPATH' ) OR exit;

//This API key is used to explore the styles in snazzy maps
define('API_BASE', 'https://snazzymaps.com/');
define('API_KEY', 'ecaccc3c-44fa-486c-9503-5d473587a493');
    

include(plugin_dir_path(__FILE__) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'index.php');

function resourceURL($file){
    return plugins_url($file, __FILE__);
}


function init_plugin(){
    add_option('SnazzyMapUniqueStyle');
}
add_action('init', 'init_plugin');

//Pass the style information into the javascript file on the main page
function enqueue_script() {
    
    $uniqueStyle = get_option('SnazzyMapDefaultStyle');
    if(!empty($uniqueStyle) && !is_null($uniqueStyle)){
        $handle = 'snazzymaps-js';
        wp_register_script($handle, plugins_url('snazzymaps.js', __FILE__), array('jquery'));    
        wp_enqueue_script($handle, $in_footer = true);
        wp_localize_script($handle, 'SnazzyMapDefaultStyle', $uniqueStyle);
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_script');


//Found in admin/index.php
add_action( 'admin_enqueue_scripts', 'admin_enqueue_script');

function admin_add_custom_menu(){    
    add_theme_page('Snazzy Maps', 'Snazzy Maps', 'edit_theme_options', 'snazzy_maps', 'admin_add_custom_content');
}
add_action( 'admin_menu', 'admin_add_custom_menu');

// Add a settings link to the plugin listing page
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'my_plugin_action_links' );

function my_plugin_action_links( $links ) {
   array_unshift($links, '<a href="'. get_admin_url(null, 'themes.php?page=snazzy_maps') .'">Settings</a>');
   return $links;
}

//The post method is performed by the tab before redirecting
add_action ('admin_head-appearance_page_snazzy_maps', 'admin_perform_post');
?>