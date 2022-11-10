<?php

/**
 * Plugin Name:       jobdesk®
 * Plugin URI:        http://recruiter-software.com/
 * Description:       jobdesk® wordpress plugin.
 * Version:           1.0.0
 * Author:            jobdesk®
 * Author URI:        https://recruiter-software.com/
 * License:           GPL v2 or later
 * Text Domain:       jobdesk
 * Domain Path:       /languages/
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly


require_once __DIR__ . "/vendor/autoload.php";

use JobDesk\Classes\Database;

/**
 * Class JobDesk
 */
final class JobDesk
{

    /**
     * JobDesk constructor.
     */
    public function __construct()
    {
        $this->define_constants();
        add_action('plugins_loaded', array($this, 'init_plugin'));
        add_action('plugins_loaded', array($this, 'plugins_loaded_text_domain'));
        add_action("wp_enqueue_scripts", array($this, "enqueue_script"));
        add_action("wp_ajax_jd_ajax_handler_function", array($this, "jd_ajax_handler_function"));
        add_action("wp_ajax_nopriv_jd_ajax_handler_function", array($this, "jd_ajax_handler_function"));
        add_action("after_setup_theme", function () {
            $apiSetup = Database::getApiSetup();
            if (!$apiSetup->client_key) {
                add_action("admin_notices", function () {
                    $notice_board = "<div style='margin-left: 2px;margin-right: 10px;' class='notice notice-error'>" .
                        "<p>Please setup API keys, tokens and endpoints to let JobDesk® plugin run normally. <a href='admin.php?page=jobdesk-api-setup'>Setup now!</a></p>" .
                        "</div>";
                    echo $notice_board;
                });
            }
        });
    }

    /**
     * Initializes a single instance
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Plugin text domain loaded
     */
    public function plugins_loaded_text_domain()
    {
        load_plugin_textdomain('jobdesk', false, JD_PLUGIN_PATH . 'languages/');
    }

    /**
     * Define plugin path and url constants
     */
    public function define_constants()
    {
        define("JD_PLUGIN_PATH", plugin_dir_path(__FILE__));
        define("JD_PLUGIN_URL", plugin_dir_url(__FILE__));

        // define( "JD_CLIENT_KEY", "323AE189-EE81-4C0F-8FBA-F3AAA30BD7A9" );
        // define( "JD_JOBSV4", "https://test1.jobdesk.io/integration/jobsV4" );
        // define( "JD_JOBSV8", "https://test1.jobdesk.io/integration/TopJobsV2/8" );
        // define( "JD_GETJOBAD", "https://test1.jobdesk.io/integration/GetJobAd/" );
        // define( "JD_COETABLES", "https://jddhaka.jobdesk.io/integration/Codetables" );
        // define( "JD_JOB_APPLICATION", "https://jddhaka.jobdesk.io/integration/Application/v1" );
        define('JD_VERSION', '1.0.0');
    }

    public function enqueue_script()
    {
        wp_enqueue_style("jd-front-end", JD_PLUGIN_URL . "assets/css/front-end.css", null, JD_VERSION);
        wp_enqueue_script("jd-front-end",  JD_PLUGIN_URL . "assets/js/front-end.js", array('jquery'), JD_VERSION, true);
        wp_localize_script("jd-front-end", "data", array(
            "ajax_url" => admin_url("admin-ajax.php")
        ));
    }

    public function jd_ajax_handler_function($hook)
    {

        if (isset($_POST['parse_cv'])) {

            $apiSetup = Database::getApiSetup();

            $endpoint = $apiSetup->parse_cv_endpoint; # 'https://services.jobdesk.com/api/ParseCV';
            $curl = curl_init($endpoint);

            $file = $_FILES['file'];

            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_POST => TRUE,
                CURLOPT_URL => $endpoint,
                CURLOPT_HTTPHEADER => [
                    'appclientid: ' . $apiSetup->parse_cv_appclientid,
                    'token: ' . $apiSetup->parse_cv_token
                    // 'appclientid: JDCHALLMARKETING',
                    // 'token: 409ae53501594472bc6b7935ee44824feae36a688ad84f5abd6c7313cbcfd6d7571647af6bad49eb946f7d85d914df38'
                ],
                CURLOPT_POSTFIELDS => [
                    'file' => new CURLFile($file['tmp_name'], $file['type'], $file['name'])
                ]
            ]);

            # for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($curl);
            $curl_error = curl_error($curl);
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $status_text = '';

            if ($status_code == 204) {
                $status_text = 'CV could not be parsed. Maybe the uploaded file is not readable. Try another file.';
            }

            curl_close($curl);

            echo json_encode([
                'response' => $response,
                'status_text' => $status_text,
                'status_code' => $status_code,
                'curl_error' => $curl_error
            ]);
            // echo $response;

        }

        wp_die();
    }

    /**
     *  Init plugin
     */
    public function init_plugin()
    {
        new \JobDesk\Classes\DynamicSettings();
        new JobDesk\Classes\Featured_Jobs();
        new JobDesk\Includes\FrontEnd\JobApplications();
    }
}


/**\
/**
 * Initializes the main plugin
 *
 * @return false|JobDesk
 */
function jobdesk()
{
    return JobDesk::init();
}

/**
 * Rick off the plugin
 */
jobdesk();
