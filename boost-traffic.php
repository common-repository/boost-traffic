<?php
/*
Plugin Name: Boost Traffic
Description: Boost is a new way to market new websites without being bogged down by expensive marketing campaigns
Author: Boost Traffic
Version: 1.0
Author URI: https://boost-traffic.io
Text Domain: boost-traffic
Copyright 2020  Harshal Dhingra  (email : harshal@ignitemediasolution.com)
*/

if (!defined('ABSPATH')){
    die();
}

define('IM_BOOST_TRAFFIC_VERSION', '1.0');
define('IM_BOOST_TRAFFIC_PLUGIN_DIR', untrailingslashit( dirname(__FILE__)));
define('IM_BOOST_TRAFFIC_ADMIN_SLUG', 'im-boost-traffic');
define('IM_BOOST_TRAFFIC_DIR_NAME', plugin_basename(dirname(__FILE__)));
define('IM_BOOST_TRAFFIC_BASE_URL', plugins_url() . '/' . IM_BOOST_TRAFFIC_DIR_NAME);
define('IM_BOOST_TRAFFIC_BASE_PATH', plugin_dir_path( __FILE__ ));
define('IM_BOOST_TRAFFIC_WEBSITE_URL', 'https://boost-traffic.io');
define('IM_BOOST_TRAFFIC_WEBSITE_IFRAME_URL', 'https://boost-traffic.io');

require_once( IM_BOOST_TRAFFIC_PLUGIN_DIR. '/inc/im-boost-traffic-functions.php');

add_action('plugins_loaded', 'imBoostTrafficStart');
register_activation_hook(__FILE__, 'imBoostTrafficActivate');

function imBoostTrafficStart() {
    if(is_admin()){
        add_action('admin_menu', 'imBoostTrafficAdminMenu');
        add_action('admin_enqueue_scripts','imBoostTrafficLoadAdminScripts');
      
    }
}

function imBoostTrafficActivate(){
    //run when activate the plugin
    
}
  
function imBoostTrafficDeactive(){
           // run when deactivate the plugin
}


add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'imBoostTrafficActionlinks' );
function imBoostTrafficActionlinks( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page='.IM_BOOST_TRAFFIC_ADMIN_SLUG) ) .'">Settings</a>';
  
   return $links;
}


function imBoostTrafficAdminMenu() {
    
    include (IM_BOOST_TRAFFIC_BASE_PATH . '/inc/admin/im-boost-traffic-template-manage.php');
    add_options_page('Boost Traffic', 'Boost Traffic', 'manage_options', IM_BOOST_TRAFFIC_ADMIN_SLUG, 'imBoostTrafficTemplateManage');
    
}

function imBoostTrafficLoadAdminScripts() {
   
    wp_enqueue_style( 'im-boost-traffic-admin-settings',IM_BOOST_TRAFFIC_BASE_URL.'/inc/admin/assets/css/im-boost-traffic-admin-settings.css', array(),IM_BOOST_TRAFFIC_VERSION,'all' );
    wp_enqueue_script('im-boost-traffic-admin-settings', IM_BOOST_TRAFFIC_BASE_URL . '/inc/admin/assets/js/im-boost-traffic-admin-settings.js', array( 'jquery','wp-color-picker' ),IM_BOOST_TRAFFIC_VERSION);
   
}