<?php

# including wordpress's media uploader

function wp_gear_manager_admin_scripts()
{
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('jquery');
}

function wp_gear_manager_admin_styles()
{
  wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');

use JobDesk\Classes\Database;

# to show a cancellable admin notice
function notify(string $msg, string $type, bool $is_dismissible = true)
{
  $dismissible = ($is_dismissible == true) ? "is-dismissible" : '';
  $notice_board = "<div style='margin-left: 2px;margin-right: 10px;' class='notice notice-$type $dismissible'>" .
    "<p>$msg</p>" .
    "</div>";
  echo $notice_board;
}

if (isset($_POST['save-dss'])) {

  $logo_width = intval($_POST['dss-logo-width']);
  $logo_height = intval($_POST['dss-logo-height']);
  $logo_link_to_homepage = ($_POST['dss-logo-link-to-homeage'] === 'on') ? true : false;
  $logo_height_flex = ($_POST['dss-logo-height-flex'] === 'on') ? true : false;
  $logo_width_flex = ($_POST['dss-logo-width-flex'] === 'on') ? true : false;
  $email = trim($_POST['dss-email']);
  $site_title = trim($_POST['dss-site-title']);
  $site_description = trim($_POST['dss-site-description']);
  $contact_number = trim($_POST['dss-contact-number']);
  $address = trim($_POST['dss-address']);

  $resp = Database::update(
    $logo_width,
    $logo_height,
    $logo_width_flex,
    $logo_height_flex,
    $logo_link_to_homepage,
    $email,
    $contact_number,
    $address
  );

  # updating wordpress admin_email
  $email_updated = $GLOBALS['wpdb']->update(
    $GLOBALS['wpdb']->prefix . 'options',
    ['option_value' => $admin_email],
    ['option_name' => 'admin_email']
  );

  # updating wordpress blogname
  $title_updated = $GLOBALS['wpdb']->update(
    $GLOBALS['wpdb']->prefix . 'options',
    ['option_value' => $site_title],
    ['option_name' => 'blogname']
  );

  # updating wordpress blogdescription
  $subtitle_updated = $GLOBALS['wpdb']->update(
    $GLOBALS['wpdb']->prefix . 'options',
    ['option_value' => $site_description],
    ['option_name' => 'blogdescription']
  );

  if ($resp == 'success') {
    notify("Settings updated successfully!", "success");
  } else if ($resp == 'error') {
    notify("Failed to update settings!", "warning");
  }

  if ($title_updated) {
    notify("Title updated successfully!", "success");
  }

  if ($subtitle_updated) {
    notify("Subtitle updated successfully!", "success");
  }
}

$nhr_DSS = Database::getDynamicSettings();

?>

<h1 class="nhr-dss-dash-title">JobDesk® Settings</h1>
<hr>

<label>Preview</label>
<div class="dss-logo-preview" id="dss-logo-preview">
  <?php

  if (function_exists('the_custom_logo')) {

    $nhr_DSS = Database::getDynamicSettings();
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

    $nhr_DSS_logo_width = "width: $nhr_DSS->logo_width" . "px";
    if ($nhr_DSS->logo_width_flex == 'true') {
      $nhr_DSS_logo_width = "max-width: $nhr_DSS->logo_width" . "px; width: auto;";
    }

    $nhr_DSS_logo_height = "height: $nhr_DSS->logo_height" . "px";
    if ($nhr_DSS->logo_height_flex == 'true') {
      $nhr_DSS_logo_height = "max-height: $nhr_DSS->logo_height" . "px; height: auto;";
    }

  ?>

    <style>
      #nhr-dss-logo {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        color: inherit;
      }
    </style>

    <?php if (has_custom_logo()) : ?>

      <?php if ($nhr_DSS->logo_link_to_homepage == 'true') : ?>
        <a href="<?php echo get_bloginfo('url') ?>">
        <?php endif ?>

        <img id="nhr-dss-logo" style="<?php echo $nhr_DSS_logo_width;
                                      $nhr_DSS_logo_height; ?>" src="<?php echo esc_url($logo[0]) ?>" alt="<?php echo get_bloginfo('name') ?>" />

        <?php if ($nhr_DSS->logo_link_to_homepage == 'true') : ?>
        </a>
      <?php endif ?>

    <?php else : ?>

      <?php if ($nhr_DSS->logo_link_to_homepage == 'true') : ?>
        <a href="<?php echo get_bloginfo('url') ?>">
        <?php endif ?>

        <h1 id="nhr-dss-logo"><?php echo get_bloginfo('name') ?></h1>

        <?php if ($nhr_DSS->logo_link_to_homepage == 'true') : ?>
        </a>
      <?php endif ?>

  <?php endif;
  }

  ?>
</div>

<p class="dss-hint">
  To select and style this logo element use this CSS selector <code> .nhr-dss-logo { /* your styles */ } </code>
</p>

<div class="inline-btns">
  <button class="btn btn-primary" id="dss-wp-media-uploader-btn">Change Logo</button>
</div>

<form method="post" class="dss-setting-form">

  <label for="dss-logo-width">Logo Width (px)</label>
  <div class="inline-btns">
    <input type="number" class="small mr-2" name="dss-logo-width" id="dss-logo-width" min="0" max="500" step="1" value="<?php echo $nhr_DSS->logo_width ?>" required />
    <input type="range" class="auto-width" name="dss-logo-width-slider" id="dss-logo-width-slider" min="0" step="1" max="500" value="<?php echo $nhr_DSS->logo_width ?>" />
  </div>

  <label for="dss-logo-height">Logo Height (px)</label>
  <div class="inline-btns">
    <input type="number" class="small mr-2" name="dss-logo-height" id="dss-logo-height" min="0" max="150" step="1" value="<?php echo $nhr_DSS->logo_height ?>" required />
    <input type="range" class="auto-width" name="dss-logo-height-slider" id="dss-logo-height-slider" min="0" step="1" max="150" value="<?php echo $nhr_DSS->logo_height ?>" />
  </div>

  <label for="dss-logo-link-to-homeage" class="mb-2">
    <input type="checkbox" name="dss-logo-link-to-homeage" id="dss-logo-link-to-homeage" <?php echo ($nhr_DSS->logo_link_to_homepage == 'true' ? 'checked' : '') ?> />
    Link Logo to homepage
  </label>

  <label for="dss-logo-height-flex" class="mb-2">
    <input type="checkbox" name="dss-logo-height-flex" id="dss-logo-height-flex" <?php echo ($nhr_DSS->logo_height_flex == 'true' ? 'checked' : '') ?> />
    Flexible logo height
  </label>

  <label for="dss-logo-width-flex" class="mb-2">
    <input type="checkbox" name="dss-logo-width-flex" id="dss-logo-width-flex" <?php echo ($nhr_DSS->logo_width_flex == 'true' ? 'checked' : '') ?> />
    Flexible logo width
  </label>

  <label for="dss-site-title">Site Title</label>
  <input type="text" class="mb-2" name="dss-site-title" id="dss-site-title" placeholder="Site Title" value="<?php echo (isset($_POST['dss-site-title']) ? trim($_POST['dss-site-title']) : get_bloginfo('name')); ?>" required />

  <label for="dss-site-description">Site Description</label>
  <input type="text" class="mb-2" name="dss-site-description" id="dss-site-description" placeholder="Site Description" value="<?php echo (isset($_POST['dss-site-description']) ? trim($_POST['dss-site-description']) : get_bloginfo('description')); ?>" />

  <label for="dss-email">Support Email</label>
  <input type="email" class="mb-2" name="dss-email" placeholder="yourname@your-company.com" id="dss-email" value="<?php echo $nhr_DSS->email; ?>" required />

  <p class="dss-hint">
    CSS selector <code> .nhr-dss-email { /* your styles */ } </code>
  </p>

  <label for="dss-contact-number">Contact Number</label>
  <input type="tel" minlength="11" class="mb-2 medium" placeholder="+01234567891" name="dss-contact-number" id="dss-contact-number" value="<?php echo $nhr_DSS->contact_number ?>" />

  <p class="dss-hint">
    CSS selector <code> .nhr-dss-number { /* your styles */ } </code>
  </p>

  <label for="dss-contact-number">Address</label>
  <textarea cols="30" rows="4" placeholder="Address" name="dss-address" id="dss-address"><?php echo $nhr_DSS->address ?></textarea>

  <p class="dss-hint">
    CSS selector <code> .nhr-dss-address { /* your styles */ } </code>
  </p>

  <button type="submit" class="btn btn-primary" id="save-dss-btn" name="save-dss">Save Settings</button>
</form>
