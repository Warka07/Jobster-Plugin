$ = jQuery;

$(document).ready(() => {

  $('#dss-wp-media-uploader-btn').click(function () {

    let nhr_DssLogoUploader = wp.media({
      title: 'Select or upload a logo',
      button: { text: 'Select Logo' },
      multiple: false
    }).on('select', function () {
      let attachment = nhr_DssLogoUploader.state().get('selection').first().toJSON();
      $('#dss-wp-media-uploader-btn').text('Updating...').prop('disabled', true);
      $.ajax({
        type: "post",
        url: ajaxurl,
        data: {
          post_id: attachment.id,
          changeSiteLogo: true,
          action: 'JD_Dynamic_Settings_AjaxHandler'
        },
        success: function (resp) {
          console.log(resp)
          if (resp == 'success') {
            if (!document.querySelector('#dss-logo-preview img')) {
              $('#dss-logo-preview #nhr-dss-logo').remove();
              $('#dss-logo-preview a').append(
                `<img id="nhr-dss-logo" style="max-width: 200px; width: auto;" src="#" alt="Logo">`
              );
            }
            $('#dss-logo-preview img').attr("src", attachment.url);
          } else {
            alert('Failed to change the logo!');
          }
          $('#dss-wp-media-uploader-btn').text('Change Logo').prop('disabled', false);
        }
      });
    }).open();

  });

  $('#dss-site-title').keyup((e) => {
    $('#wp-admin-bar-site-name a.ab-item').text(e.target.value?.trim())
  });

  $('.dss-setting-form input').on('input', (e) => {

    let name = e.target.name;

    if (name === 'dss-logo-width-slider') {

      jQuery('#dss-logo-width').val(e.target.value);
      jQuery('#dss-logo-preview img').css({
        width: e.target.value + 'px'
      });

    } else if (name === 'dss-logo-width') {

      jQuery('#dss-logo-width-slider').val(e.target.value);
      jQuery('#dss-logo-preview img').css({
        width: e.target.value + 'px'
      });

    } else if (name === 'dss-logo-height-slider') {

      jQuery('#dss-logo-height').val(e.target.value);
      jQuery('#dss-logo-preview img').css({
        height: e.target.value + 'px'
      });

    } else if (name === 'dss-logo-height') {

      jQuery('#dss-logo-height-slider').val(e.target.value);
      jQuery('#dss-logo-preview img').css({
        height: e.target.value + 'px'
      });

    }

  });

  $('#reset-api-setup-btn').click((e) => {
    e.preventDefault()
    $('#save-api-setup-btn').prop('disabled', true);
    $('#reset-api-setup-btn').prop('disabled', true).text('Reseting...');
    $.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        action: 'JD_Dynamic_Settings_AjaxHandler',
        reset_api_setup: true
      },
      success: (resp) => {
        $('#save-api-setup-btn').prop('disabled', false);
        $('#reset-api-setup-btn').prop('disabled', false).text('Reset');
        if (resp == 'unauthorized') {
          swal("Unauthorized!", "You must be admin to make this request!", "error");
        } else if (resp == 'error') {
          swal("Oops!", "Something went wrong!", "error");
        } else {
          document.querySelector('#jobdesk-api-setup-form').reset();
        }
      }
    })
  })

});
