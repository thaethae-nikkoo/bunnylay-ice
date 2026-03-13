$(document).ready(function () {
  $('.indicator-progress').hide();
  $('#kt_stepper_form').on('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission behavior
    // Disable the submit button
    $(this).find('.btn, .button').attr('disabled', true);

    // Hide the indicator label
    $('.indicator-label').hide();

    // Show the indicator progress
    $('.indicator-progress').show();
    // Submit the form
    this.submit();
  });
}
);
