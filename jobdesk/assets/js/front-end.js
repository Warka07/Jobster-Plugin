(function ($) {


  // gloobal variables
  let __is_clicked_on_label = false
  let __parseRequestedCV = null


  const uploadFile = () => {

    var files = document.getElementById('CVFile1').files
    let __parseRequestedCVs = document.querySelector('#jd-popup-file-processor-input').files

    if (files.length == 0 && __parseRequestedCVs.length == 0) {
      alert("Please first choose or drop any file(s)...")
      return
    }

    var filenames = []

    if (__parseRequestedCVs.length > 0) {
      filenames.push(__parseRequestedCVs[0].name)
      document.querySelector('#CVFile1').removeAttribute('required')
    }
    for (var i = 0; i < files.length; i++) { filenames.push(files[i].name) }
    for (let filename of filenames) { jQuery('.jd-selected-cv-names').text(filename + "\n") }

  }

  $('#CVFile1').change(uploadFile)


  $('#jd-popup-fill-form-manually-btn').click((e) => {

    $('.jd-popup-automatic-section').css({ display: 'none' })
    $('.jd-popup-manual-section').css({ display: 'block' })

  })

  $('#jd-popup-go-back-btn').click((e) => {

    $('.jd-popup-automatic-section').css({ display: 'flex' })
    $('.jd-popup-manual-section').css({ display: 'none' })

  })


  $('#jd-popup-file-processor-input-label').click((e) => {
    __is_clicked_on_label = true
    $('#jd-popup-file-processor-input').click()
    __is_clicked_on_label = false
  })

  // preventing click action from the file drop section
  $('#jd-popup-file-processor-input').click((e) => {
    if (!__is_clicked_on_label) { e.preventDefault() }
  })

  // handle file drop/change of the CV drop input
  $('#jd-popup-file-processor-input').change((e) => {

    let files = document.querySelector('#jd-popup-file-processor-input').files

    if (files.length > 0) {

      $('#current-file-drop-image, #jd-drag-and-drop-text').css({display: 'none'})
      $('#current-file-processing-animation, #jd-processing-text').css({display: 'block'})
      $('.jd-popup-automatic-section').addClass('block-this-section')
      $('#jd-popup-fill-form-manually-btn').attr('disabled', true)

      let cvFormData = new FormData()
      cvFormData.append('parse_cv', true)
      cvFormData.append('action', 'jd_ajax_handler_function')
      cvFormData.append('file', files[0])
      __parseRequestedCV = files[0]
      uploadFile()

      fetch(data.ajax_url, {
        method: 'POST',
        body: cvFormData
      })
      .then((response) =>  response.json())
      .then((data) => {
        if ( data ) {
          if ( data.status_code == 204 ) {
            swal("Oops!", data.status_text, "error");
          } else if ( data.status_code == 0 ) {
            swal("Oops!", data.curl_error, "error");
          } else {

            let parsedData = JSON.parse(data.response)

            $('.jd-job-apply #FirstName').val(parsedData.FirstName?.trim())
            $('.jd-job-apply #LastName').val(parsedData.LastName?.trim())
            $('.jd-job-apply #EmailAddress').val(parsedData.Email?.trim())
            $('.jd-job-apply #Phone').val(parsedData.PhoneNumber?.trim())
            $('.jd-job-apply #Gender').val(parsedData.Gender == 'm' ? 1 : 2)

            $('#jd-popup-fill-form-manually-btn').click()

          }
        } else {
          swal("Oops!", "Failed to parse the CV!", "error");
        }

        $('#current-file-drop-image, #jd-drag-and-drop-text').css({ display: 'block' })
        $('#current-file-processing-animation, #jd-processing-text').css({ display: 'none' })
        $('.jd-popup-automatic-section').removeClass('block-this-section')
        $('#jd-popup-fill-form-manually-btn').attr('disabled', false)

      }).catch((err) => {

        $('#current-file-drop-image, #jd-drag-and-drop-text').css({ display: 'block' })
        $('#current-file-processing-animation, #jd-processing-text').css({ display: 'none' })
        $('.jd-popup-automatic-section').removeClass('block-this-section')
        $('#jd-popup-fill-form-manually-btn').attr('disabled', false)

      });

    }

  })

  // open the shadow element when click the apply now button
  $('.jd-job-apply-now').click((e) => {
    e.preventDefault();
    $(document.body).css({
      position: 'fixed',
      width: '100%'
    })

    let jobTitle = $('.job-detail-header.v1 .info-detail-job .job-detail-title').text()?.trim()
    $('#jd-popup-box.jd-popup-box .jd-popup-header .title span').text(jobTitle)

    $('div.jd-popup-area-shadow').addClass('appear')
    $('div.jd-popup-area').addClass('popup')
  })

  // hid the shadow element when click the close button of the apply now form
  $('button.jd-popup-close').click((e) => {
    e.preventDefault();
    $(document.body).css({
      position: 'static',
      width: '100%'
    })

    $('#jd-popup-box.jd-popup-box .jd-popup-header .title span').text('')

    $('div.jd-popup-area-shadow').removeClass('appear')
    $('div.jd-popup-area').removeClass('popup')
  })


  $(".jd-job-apply").on("submit", function (e) {
    e.preventDefault();

    const thisFormData = new FormData(this);
    if (__parseRequestedCV) { thisFormData.append('CVFile2', __parseRequestedCV); }

    $.ajax({
      type: "POST",
      url: data.ajax_url,
      data: thisFormData,
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        $(".loader").show();
        $(".jd-job-apply").hide();
      },

      success: function (response) {

        if (response.success == true) {
          $(".jd-application-status-mas").html("<p>Applied Successfully</p>");
          $("input").val("");
          $(".loader").hide();
        } else {
          $(".jd-application-status-mas").html("<p>Error! Try Again</p>");
          $(".loader").hide();
          $("input").val("");
        }
      },
    });
  });
})(jQuery);
