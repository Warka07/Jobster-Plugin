<?php

namespace JobDesk\Classes;

use Exception;

/**
 * Class Database
 */

class Database {

  public static $settingsTable = "jobdesk_dynamic_settings";
  public static $apiSetupTable = "jobdesk_api_setup";

  public static function init() {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    # creating table to store readers reward codes
    $createSettingsTable = "CREATE TABLE IF NOT EXISTS " . self::$settingsTable . " (
                id INT(255) PRIMARY KEY AUTO_INCREMENT,
                logo_width INT(3),
                logo_height INT(3),
                logo_height_flex ENUM('true', 'false'),
                logo_width_flex ENUM('true', 'false'),
                logo_link_to_homepage ENUM('true', 'false'),
                contact_number VARCHAR(20),
                email VARCHAR(255),
                address TEXT
            )";

    $createApiSetupTable = "CREATE TABLE IF NOT EXISTS " . self::$apiSetupTable . " (
                id INT(1) PRIMARY KEY AUTO_INCREMENT,
                all_jobs_endpoint TEXT,
                top_jobs_endpoint TEXT,
                single_job_endpoint TEXT,
                code_table_endpoint TEXT,
                apply_job_endpoint TEXT,
                client_key VARCHAR(255),
                parse_cv_endpoint TEXT,
                parse_cv_appclientid VARCHAR(255),
                parse_cv_token VARCHAR(255)
            )";

    # executing the sql
    dbDelta($createSettingsTable);
    dbDelta($createApiSetupTable);

    if (!self::getDynamicSettings()) {
      $wpdb->insert(
        self::$settingsTable,
        [
          'logo_width' => 200,
          'logo_height' => 90,
          'logo_width_flex' => 'false',
          'logo_height_flex' => 'false',
          'logo_link_to_homepage' => 'true'
        ],
        [ '%d', '%d', '%s', '%s', '%s' ]
      );
    }

    if (!self::getApiSetup()) {
      $wpdb->insert(
        self::$apiSetupTable,
        [
          'client_key' => '',
          'all_jobs_endpoint' => '',
          'single_job_endpoint' => '',
          'top_jobs_endpoint' => '',
          'apply_job_endpoint' => '',
          'parse_cv_token' => '',
          'parse_cv_appclientid' => '',
          'parse_cv_endpoint' => '',
          'code_table_endpoint' => ''
        ],
        [ '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
      );
    }

  }


  public static function getDynamicSettings() {
    return $GLOBALS['wpdb']->get_row("SELECT * FROM " . self::$settingsTable . " WHERE id='1'", OBJECT);
  }

  public static function getApiSetup() {
    return $GLOBALS['wpdb']->get_row("SELECT * FROM " . self::$apiSetupTable . " WHERE id='1'", OBJECT);
  }


  public static function updateApiSetup(
    string $client_key = '',
    string $all_jobs_endpoint = '',
    string $single_job_endpoint = '',
    string $top_jobs_endpoint = '',
    string $apply_job_endpoint = '',
    string $code_table_endpoint = '',
    string $parse_cv_token = '',
    string $parse_cv_appclientid = '',
    string $parse_cv_endpoint = ''
  ) {

    $updated = $GLOBALS['wpdb']->update(
    self::$apiSetupTable,
      [
        'client_key' => $client_key,
        'all_jobs_endpoint' => $all_jobs_endpoint,
        'single_job_endpoint' => $single_job_endpoint,
        'top_jobs_endpoint' => $top_jobs_endpoint,
        'apply_job_endpoint' => $apply_job_endpoint,
        'parse_cv_token' => $parse_cv_token,
        'parse_cv_appclientid' => $parse_cv_appclientid,
        'parse_cv_endpoint' => $parse_cv_endpoint,
        'code_table_endpoint' => $code_table_endpoint
      ],
      [
        'id' => 1
      ]
    );

    return $updated ? 'success' : 'error';

  }


  public static function resetApiSetup() {
    $updated = $GLOBALS['wpdb']->update(
      self::$apiSetupTable,
      [
        'client_key' => '',
        'all_jobs_endpoint' => '',
        'single_job_endpoint' => '',
        'top_jobs_endpoint' => '',
        'apply_job_endpoint' => '',
        'parse_cv_token' => '',
        'parse_cv_appclientid' => '',
        'parse_cv_endpoint' => '',
        'code_table_endpoint' => ''
      ],
      [
        'id' => 1
      ]
    );

    return $updated ? 'success' : 'error';
  }


  public static function update(int $logo_width, int $logo_height, bool $logo_width_flex, bool $logo_height_flex, bool $logo_link_to_homepage, string $email, string $contact_number, string $address) {

    $updated = $GLOBALS['wpdb']->update(
    self::$settingsTable,
      [
        'logo_link_to_homepage' => $logo_link_to_homepage ? 'true' : 'false',
        'logo_width_flex' => $logo_width_flex ? 'true' : 'false',
        'logo_height_flex' => $logo_height_flex ? 'true' : 'false',
        'logo_width' => $logo_width,
        'logo_height' => $logo_height,
        'email' => $email,
        'contact_number' => $contact_number,
        'address' => $address,
      ],
      [
        'id' => 1
      ]
    );

    return $updated ? 'success' : 'error';

  }

}
