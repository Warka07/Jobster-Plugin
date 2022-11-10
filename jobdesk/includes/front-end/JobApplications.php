<?php


namespace JobDesk\Includes\FrontEnd;

use JobDesk\Classes\Database;

/**
 * Class JobApplications
 */
class JobApplications {

    public function __construct() {
        add_action( 'wp_ajax_jb_job_apply', array( $this, "apply_job" ) );    // If called from admin panel
        add_action( 'wp_ajax_nopriv_jb_job_apply', array( $this, "apply_job" ) );     // If called from front end
    }

    public function apply_job() {
        $apiSetup = Database::getApiSetup();
        if ($apiSetup->client_key) {
            $form_data = array();
            $form_data['ClientKey'] = $apiSetup->client_key;

            foreach ( $_POST as $key => $row ) {
                $form_data[ $key ] = sanitize_text_field( $row );
            }

            foreach ( $_FILES as $key => $row ) {
                $file_name = $row['name'];
                $file_type = $row['type'];
                $file_tmp_name = $row['tmp_name'];

                if ( ! empty( $file_name ) ) {
                    $form_data[ $key ] = curl_file_create( $file_tmp_name, $file_type, $file_name );
                }

            }

            $response = $this->api_request( $apiSetup->apply_job_endpoint, $form_data );
            wp_send_json_success( $response );
        } else {
            wp_send_json_error( [ "errorMessage" => "API is not setup yet!" ] );
        }
        wp_die();
    }

    public function api_request( $url, $data ) {


        $header = array(
            'Accept: application/json', 'Content-type: application/json'
        );

        $process = curl_init( $url );
        curl_setopt( $process, CURLOPT_HEADER, $header );
        curl_setopt( $process, CURLOPT_POST, true );
        curl_setopt( $process, CURLOPT_POSTFIELDS, $data );
        curl_setopt( $process, CURLOPT_URL, $url );
        curl_setopt( $process, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($process);
        $error = curl_error($process);
        curl_close($process);

        return $response;
    }
}
