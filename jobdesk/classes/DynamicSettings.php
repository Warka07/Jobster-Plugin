<?php

namespace JobDesk\Classes;




class DynamicSettings
{

  function __construct()
  {
    AdminPages::init();
    Database::init();
    add_action('admin_enqueue_scripts', [$this, 'addAdminScripts']);
    add_action('after_setup_theme', [$this, 'registerCustomLogo']);
    add_action('wp_ajax_JD_Dynamic_Settings_AjaxHandler', [$this, 'JD_Dynamic_Settings_AjaxHandler']);
    $this->addShortCodes();
  }

  function addAdminScripts()
  {
    wp_enqueue_media();
    wp_enqueue_script('jobdesk-admin', plugin_dir_url(dirname(__FILE__)) . 'assets/js/admin.js', ['jquery'], false, true);
  }

  function JD_Dynamic_Settings_AjaxHandler($hook)
  {

    if (isset($_POST['changeSiteLogo'])) {
      $id = intval($_POST['post_id']);
      $prefix = $GLOBALS['wpdb']->prefix;
      $isImageLogoEnabled = ($GLOBALS['wpdb']->get_row("SELECT * FROM " . $prefix . "options WHERE option_name = 'site_logo'", ARRAY_A)) ? true : false;
      if ($isImageLogoEnabled) {
        echo $GLOBALS['wpdb']->update(
          $prefix . 'options',
          ['option_value' => $id],
          ['option_name' => 'site_logo']
        ) ? 'success' : 'error';
      } else {
        echo $GLOBALS['wpdb']->insert(
          $prefix . 'options',
          [
            'option_name' => 'site_logo',
            'option_value' => $id
          ],
          ['%s', '%d']
        ) ? 'success' : 'error';
      }
    } else if (isset($_POST['reset_api_setup'])) {
      if (is_admin()) {
        echo Database::resetApiSetup();
      } else {
        echo 'unauthorized';
      }
    }

    wp_die();
  }

  function registerCustomLogo()
  {

    $jobdeskDynamicSettings = Database::getDynamicSettings();
    add_theme_support('custom-logo', [
      'height'               => $jobdeskDynamicSettings->logo_height,
      'width'                => $jobdeskDynamicSettings->logo_width,
      'flex-height'          => true,
      'flex-width'           => $jobdeskDynamicSettings->logo_width_flex,
      'header-text'          => array('site-title', 'site-description'),
      'unlink-homepage-logo' => !($jobdeskDynamicSettings->logo_link_to_homepage == 'true')
    ]);
  }

  function displayCustomLogo()
  {

    ob_start();

    if (function_exists('the_custom_logo')) {

      $jobdeskDynamicSettings = Database::getDynamicSettings();
      $custom_logo_id = get_theme_mod('custom_logo');
      $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

      $JD_Dynamic_Settings_logo_width = "width: $jobdeskDynamicSettings->logo_width" . "px";
      if ($jobdeskDynamicSettings->logo_width_flex == 'true') {
        $JD_Dynamic_Settings_logo_width = "max-width: $jobdeskDynamicSettings->logo_width" . "px; width: auto;";
      }

      $JD_Dynamic_Settings_logo_height = "height: $jobdeskDynamicSettings->logo_height" . "px";
      if ($jobdeskDynamicSettings->logo_height_flex == 'true') {
        $JD_Dynamic_Settings_logo_height = "max-height: $jobdeskDynamicSettings->logo_height" . "px; height: auto;";
      }

?>

      <style>
        #jobdesk-logo {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          color: inherit;
        }
      </style>

      <?php if (has_custom_logo()) : ?>

        <?php if ($jobdeskDynamicSettings->logo_link_to_homepage == 'true') : ?>
          <a href="<?php echo get_bloginfo('url') ?>">
          <?php endif ?>

          <img class="jobdesk-logo" style="<?php echo $JD_Dynamic_Settings_logo_width;
                                            $JD_Dynamic_Settings_logo_height; ?>" src="<?php echo esc_url($logo[0]) ?>" alt="<?php echo get_bloginfo('name') ?>" />

          <?php if ($jobdeskDynamicSettings->logo_link_to_homepage == 'true') : ?>
          </a>
        <?php endif ?>

      <?php else : ?>

        <?php if ($jobdeskDynamicSettings->logo_link_to_homepage == 'true') : ?>
          <a href="<?php echo get_bloginfo('url') ?>">
          <?php endif ?>

          <h1 class="jobdesk-logo"><?php echo get_bloginfo('name') ?></h1>

          <?php if ($jobdeskDynamicSettings->logo_link_to_homepage == 'true') : ?>
          </a>
        <?php endif ?>

<?php endif;
    }

    $logo = ob_get_clean();
    return $logo;
  }

  function addShortCodes()
  {

    add_shortcode('jobdesk-logo', [$this, 'displayCustomLogo']);

    add_shortcode('jobdesk-number', function () {
      $jobdeskDynamicSettings = Database::getDynamicSettings();
      return "<span class='jobdesk-number'>$jobdeskDynamicSettings->contact_number</span>";
    });

    add_shortcode('jobdesk-address', function () {
      $jobdeskDynamicSettings = Database::getDynamicSettings();
      return "<p class='jobdesk-address'>$jobdeskDynamicSettings->address</p>";
    });

    add_shortcode('jobdesk-email', function () {
      $jobdeskDynamicSettings = Database::getDynamicSettings();
      return "<span class='jobdesk-email'>$jobdeskDynamicSettings->email</span>";
    });

    add_shortcode('jobdesk-title', function () {
      $jobdeskDynamicSettings = Database::getDynamicSettings();
      return get_bloginfo('name');
    });

    add_shortcode('jobdesk-subtitle', function () {
      $jobdeskDynamicSettings = Database::getDynamicSettings();
      return get_bloginfo('description');
    });
  }
}
