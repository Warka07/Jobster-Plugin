<?php

namespace JobDesk\Classes;

class AdminPages {

  public static function dashboard() {
    echo "<link rel='stylesheet' type='text/css' href='" . plugin_dir_url(dirname( __FILE__ )) . "assets/css/admin-page.css' />";
    require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/views/dashboard.php' );
  }

  public static function shortcodes() {
    echo "<link rel='stylesheet' type='text/css' href='" . plugin_dir_url(dirname( __FILE__ )) . "assets/css/admin-page.css' />";
    require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/views/short-codes.php' );
  }

  public static function api_setup() {
    echo "<link rel='stylesheet' type='text/css' href='" . plugin_dir_url(dirname( __FILE__ )) . "assets/css/admin-page.css' />";
    require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/views/api-setup.php' );
  }

  public static function addAdminPages() {
    add_menu_page(
      'jobdesk® Settings',
      'jobdesk® Settings',
      'manage_options',
      'jobdesk-dashboard',
      [self::class, 'dashboard'],
      '',
      5
    );
    add_submenu_page(
      'jobdesk-dashboard',
      'API Setup',
      'API Setup',
      'manage_options',
      'jobdesk-api-setup',
      [self::class, 'api_setup'],
      6
    );
    add_submenu_page(
      'jobdesk-dashboard',
      'ShortCodes',
      'ShortCodes',
      'manage_options',
      'jobdesk-shortcodes',
      [self::class, 'shortcodes'],
      6
    );
  }

  public static function init() {
    add_action('admin_menu', [self::class, 'addAdminPages']);
  }

}
