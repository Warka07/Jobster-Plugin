<?php

namespace JobDesk\Classes;

use Exception;

/**
 * Class Featured_Jobs
 */
class Featured_Jobs {

    /**
     * Featured_Jobs constructor.
     */
    public function __construct() {
        add_shortcode("featured-jobs", array($this, "featured_jobs"));
        add_shortcode("listing-jobs", array($this, "list_jobs"));
        add_shortcode("search-jobs", array($this, "search_jobs"));

        if (isset($_GET['jobdesk_ref_code'])) {
            add_filter('template_include', array($this, "pluginname_load_template"), 99);
        }
        /////////
        if (isset($_GET['www'])) {
            add_filter('template_include', array($this, "pluginname_load_template2"), 99);
        }
        ////////
    }

    /**
     * Featured jobs views load
     */
    public function featured_jobs() {
        $apiSetup = Database::getApiSetup();
        $featured_jobs = [];
        if ($apiSetup->top_jobs_endpoint) {
            $response = file_get_contents($apiSetup->top_jobs_endpoint);
            $featured_jobs = json_decode($response);
        }
        ob_start();
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/views/featured-jobs.php';
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

    function pluginname_load_template($template) {
        $template = plugin_dir_path(dirname(__FILE__)) . 'includes/views/featured-job-single.php';
        return $template;
    }


    function pluginname_load_template2($template) {
        $template = plugin_dir_path(dirname(__FILE__)) . 'includes/views/new_feature_jobs_Single.php';
        return $template;
    }


    public function list_jobs() {
        $apiSetup = Database::getApiSetup();
        $queries = [];
        foreach ($_GET as $k => $v) {
            if ($k === 'filter-title') {
                $queries['Jobtitle'] = $v;
            } elseif ($k === 'filter-contract-type') {
                $queries['ContractType'] = $v;
            } elseif ($k === 'filter-sector') {
                $queries['Sector'] = $v;
            }
        }
        $featured_jobs = [];
        if ($apiSetup->all_jobs_endpoint) {
            $api_endpoint = $apiSetup->all_jobs_endpoint . '?' . http_build_query($queries);
            $response = file_get_contents($api_endpoint);
            $featured_jobs = json_decode($response);
        }

        # filtering the jobs based on RegionCity
        if (isset($_GET['filter-location']) && !empty($_GET['filter-location'])) {
            $featured_jobs_filtered = [];
            foreach ($featured_jobs as $fjob) {
                $RegionCityFilter = strtolower(trim($_GET['filter-location']));
                if (strpos(strtolower($fjob->RegionCity), $RegionCityFilter) !== false) {
                    $featured_jobs_filtered[] = $fjob;
                }
            }
            $featured_jobs = $featured_jobs_filtered;
        }

        ob_start();
        require_once(plugin_dir_path(dirname(__FILE__)) . 'includes/views/Find_Job_listing_page.php');
        $contents = ob_get_clean();
        return $contents;
    }


    public function search_jobs()
    {
        $apiSetup = Database::getApiSetup();
        $queries = [];
        foreach ($_GET as $k => $v) {
            if ($k === 'filter-title') {
                $queries['Jobtitle'] = $v;
            } elseif ($k === 'filter-location') {
                $queries['Region'] = $v;
            } elseif ($k === 'filter-contract-type') {
                $queries['ContractType'] = $v;
            } elseif ($k === 'filter-sector') {
                $queries['Sector'] = $v;
            }
        }
        $featured_jobs = false;
        if ($apiSetup->all_jobs_endpoint) {
            $api_endpoint = $apiSetup->all_jobs_endpoint . '?' . http_build_query($queries);
            $response = file_get_contents($api_endpoint);
            $featured_jobs = json_decode($response);
        }

        ob_start();
        require_once(plugin_dir_path(dirname(__FILE__)) . 'includes/views/Search_Job_listing_page.php');
        $contents = ob_get_clean();
        return $contents;
    }
}
